# JWT Authentication for the E-commerce API

This document describes the JWT implementation that is currently present in this repository. It is based on the application code, registered routes, installed dependencies, and focused feature tests verified on September 3, 2026.

> **Implementation status:** login, authenticated user lookup, token refresh, and logout are implemented and covered by passing feature tests. The registration route is registered, but its request, controller, model, and database schema do not currently agree. See [Registration is not currently usable](#registration-is-not-currently-usable) before using that endpoint.

## Contents

1. [Project snapshot](#1-project-snapshot)
2. [Where the implementation lives](#2-where-the-implementation-lives)
3. [Registered authentication routes](#3-registered-authentication-routes)
4. [Setup and environment configuration](#4-setup-and-environment-configuration)
5. [How JWT is connected to Laravel](#5-how-jwt-is-connected-to-laravel)
6. [API contract](#6-api-contract)
7. [Authentication flows](#7-authentication-flows)
8. [Rate limiting](#8-rate-limiting)
9. [Tests and verification](#9-tests-and-verification)
10. [Client responsibilities](#10-client-responsibilities)
11. [Production security](#11-production-security)
12. [Known gaps in the current project](#12-known-gaps-in-the-current-project)
13. [References](#13-references)

## 1. Project snapshot

| Item | Current project value |
| --- | --- |
| PHP requirement | `^8.3` |
| Verified local PHP runtime | `8.5.9` |
| Laravel requirement | `^13.8` |
| Installed Laravel version | `13.23.0` |
| jwt-auth requirement | `tymon/jwt-auth:^2.3` |
| Installed jwt-auth version | `2.3.0` |
| JWT guard | `api` |
| Signing algorithm | `HS256` |
| Access-token lifetime | 15 minutes in the current local environment |
| Refresh window | 10,080 minutes, or 7 days, in the current local environment |
| Blacklist | Enabled, with a zero-second grace period |
| Local blacklist/cache store | Laravel's `database` cache store |

The `web` session guard remains Laravel's default guard. JWT code must therefore select the `api` guard explicitly through `auth:api`, `$request->user('api')`, or `AuthFactory::guard('api')`.

Laravel Sanctum is also installed and its personal-access-token migration exists, but the routes documented here use `tymon/jwt-auth` and the JWT `api` guard. A Sanctum token is not interchangeable with one of these JWTs.

A JWT has a readable header and payload plus a cryptographic signature. It is signed, not encrypted. Do not place passwords, secrets, or confidential user data in its claims.

## 2. Where the implementation lives

| File | Responsibility |
| --- | --- |
| [`routes/api.php`](routes/api.php) | Registers the five `/api/auth/*` routes and their middleware |
| [`app/Http/Controllers/AuthController.php`](app/Http/Controllers/AuthController.php) | Coordinates register, login, `me`, refresh, logout, and response formatting |
| [`app/Auth/JwtTokenService.php`](app/Auth/JwtTokenService.php) | Wraps `JWTGuard` operations and always selects the `api` guard |
| [`app/Http/Middleware/RequireBearerToken.php`](app/Http/Middleware/RequireBearerToken.php) | Requires a Bearer header and attaches its token to the JWT guard |
| [`app/Http/Requests/Auth/LoginRequest.php`](app/Http/Requests/Auth/LoginRequest.php) | Normalizes and validates login input |
| [`app/Http/Requests/Auth/SignupRequest.php`](app/Http/Requests/Auth/SignupRequest.php) | Contains the current registration rules, including the mismatch described later |
| [`app/Http/Resources/UserResource.php`](app/Http/Resources/UserResource.php) | Defines the JSON returned by `/api/auth/me` |
| [`app/Models/User.php`](app/Models/User.php) | Implements `JWTSubject`; its primary key becomes the JWT subject |
| [`config/auth.php`](config/auth.php) | Defines the `api` guard with the `jwt` driver |
| [`config/jwt.php`](config/jwt.php) | Published jwt-auth settings, claims, providers, TTLs, keys, and blacklist options |
| [`app/Providers/AppServiceProvider.php`](app/Providers/AppServiceProvider.php) | Defines the named login and refresh rate limiters |
| [`bootstrap/app.php`](bootstrap/app.php) | Registers API routes, JSON exception behavior, and middleware priority |
| [`tests/Feature/Api/V1/JwtAuthTest.php`](tests/Feature/Api/V1/JwtAuthTest.php) | Verifies the four working JWT behaviors |

The classes in `app/Actions/Auth`, the DTOs in `app/DTOs/Auth`, and `LogoutRequest` are not used by the registered JWT routes. They are currently scaffolding, not part of the runtime authentication path.

## 3. Registered authentication routes

Laravel adds the `/api` prefix because `routes/api.php` is registered as the API route file in `bootstrap/app.php`.

| Method | URI | Route name | Middleware | Current status |
| --- | --- | --- | --- | --- |
| `POST` | `/api/auth/register` | `auth.register` | API group, `throttle:6,1` | Registered, but internally inconsistent |
| `POST` | `/api/auth/login` | `auth.login` | API group, `throttle:login` | Working and tested |
| `POST` | `/api/auth/refresh` | `auth.refresh` | API group, `RequireBearerToken`, `throttle:refresh` | Working and tested |
| `GET` | `/api/auth/me` | `auth.me` | API group, `RequireBearerToken`, `auth:api` | Working and tested |
| `POST` | `/api/auth/logout` | `auth.logout` | API group, `RequireBearerToken`, `auth:api` | Working and tested |

The refresh route intentionally does **not** use `auth:api`. An access token may be expired for normal authentication while still being inside its refresh window. Applying `auth:api` would reject it before `JwtTokenService::refresh()` could process it.

> **Authorization boundary:** the resource routes under `/api/v1/*` do not currently have `RequireBearerToken` or `auth:api`. Among the auth routes, `me` and `logout` use `auth:api`, while refresh requires a Bearer JWT that jwt-auth validates in refresh mode. Add authentication and policy middleware to the commerce routes that are meant to be private.

## 4. Setup and environment configuration

### Fresh checkout

Install dependencies and prepare Laravel normally:

```powershell
composer install
if (-not (Test-Path .env)) { Copy-Item .env.example .env }
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan optimize:clear
```

Do not overwrite an existing `.env`. Running `php artisan jwt:secret --force` rotates the signing secret and makes previously issued JWTs invalid, so `--force` should not be part of routine setup or verification.

`config/jwt.php` is already published in this repository. Publishing it again is only necessary when intentionally replacing or comparing the package configuration.

### JWT environment values

The current `.env.example` does not include JWT settings. For a fresh environment, run `php artisan jwt:secret` to add a private `JWT_SECRET`, then add the non-secret settings required by the project:

```dotenv
JWT_TTL=15
JWT_REFRESH_TTL=10080
JWT_BLACKLIST_ENABLED=true
JWT_BLACKLIST_GRACE_PERIOD=0
JWT_ALGO=HS256
```

`JWT_TTL` and `JWT_REFRESH_TTL` are measured in minutes. The controller converts the access TTL to seconds for the `expires_in` response field.

If the environment values are absent, the published configuration falls back to these package defaults:

| Setting | Project environment | `config/jwt.php` fallback |
| --- | ---: | ---: |
| `JWT_TTL` | `15` minutes | `60` minutes |
| `JWT_REFRESH_TTL` | `10080` minutes | `20160` minutes |
| `JWT_BLACKLIST_ENABLED` | `true` | `true` |
| `JWT_BLACKLIST_GRACE_PERIOD` | `0` seconds | `0` seconds |
| `JWT_ALGO` | `HS256` | `HS256` |

Never commit the value of `JWT_SECRET`. After changing environment or authentication settings, clear cached configuration:

```powershell
php artisan optimize:clear
```

### Database and cache requirements

The `User` model uses `SoftDeletes`, so all migrations must be current before manually exercising authentication:

```powershell
php artisan migrate:status
php artisan migrate
```

JWT blacklisting uses Laravel's configured cache store. The current project uses the `database` store. In a multi-instance deployment, all API instances must share the same cache data; a shared Redis store is a common production choice.

## 5. How JWT is connected to Laravel

### API guard

The important part of `config/auth.php` is:

```php
'defaults' => [
    'guard' => env('AUTH_GUARD', 'web'),
    'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
],

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'jwt',
        'provider' => 'users',
    ],
],
```

The `users` provider loads `App\Models\User` records through Eloquent.

### User identity and claims

`User` implements `Tymon\JWTAuth\Contracts\JWTSubject`:

```php
public function getJWTIdentifier(): mixed
{
    return $this->getKey();
}

public function getJWTCustomClaims(): array
{
    return [];
}
```

The user's primary key becomes the token's `sub` claim. The application adds no custom claims. With `lock_subject` enabled in `config/jwt.php`, jwt-auth also binds the token to its provider/model through the `prv` claim.

The package requires the standard `iss`, `iat`, `exp`, `nbf`, `sub`, and `jti` claims. Client-side decoding may help schedule a refresh, but only the server can verify a token's signature, time constraints, subject, and blacklist state.

### Token service

`JwtTokenService` is the package boundary used by the controller:

| Method | Guard operation | Result |
| --- | --- | --- |
| `attempt($credentials)` | `JWTGuard::attempt()` | Token string or `null` |
| `issueFor($user)` | `JWTGuard::login()` | Token string |
| `refresh()` | `JWTGuard::refresh()` | Rotated token string |
| `invalidate()` | `JWTGuard::logout()` | Blacklists the current token |
| `ttlSeconds()` | Reads the guard factory TTL | TTL converted from minutes to seconds |

Every method resolves `guard('api')` and checks that it is a `JWTGuard`. `ttlSeconds()` throws if JWT tokens are configured never to expire, so this API expects a finite `JWT_TTL`.

### Bearer-token middleware

`RequireBearerToken` reads `$request->bearerToken()`. A missing or blank Bearer token returns:

```json
{
  "message": "Unauthenticated."
}
```

When a token is present, the middleware resets any cached guard user and explicitly assigns the current request and header token to the `api` JWT guard. It enforces header transport; it does not validate the token by itself. `auth:api` performs authentication on `me` and `logout`, while the refresh action asks jwt-auth to validate the token in refresh mode.

`bootstrap/app.php` places `RequireBearerToken` ahead of Laravel's `AuthenticatesRequests` middleware so the guard receives the header token before authentication runs.

## 6. API contract

Send JSON where a body is required and request JSON responses:

```http
Accept: application/json
Content-Type: application/json
```

For routes that require a token, send it only in the authorization header:

```http
Authorization: Bearer <access-token>
```

### Login

`POST /api/auth/login`

The request normalizes `email` with `trim()` and lowercase conversion.

| Field | Rules |
| --- | --- |
| `email` | Required string, valid email, 12 to 255 characters |
| `password` | Required string, at most 64 characters |

```json
{
  "email": "student@example.com",
  "password": "correct-password"
}
```

Successful response: `200 OK`

```json
{
  "data": {
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
    "token_type": "Bearer",
    "expires_in": 900
  }
}
```

`expires_in` is `900` seconds with the current 15-minute TTL, but clients should use the returned value rather than hard-code it. Login and registration token responses do **not** include user data. Call `/api/auth/me` when the user representation is needed.

Incorrect credentials return `401 Unauthorized`:

```json
{
  "message": "The provided credentials are incorrect."
}
```

The same generic message is used whether the email or password was incorrect.

### Current user

`GET /api/auth/me`

Successful response: `200 OK`

```json
{
  "data": {
    "id": 1,
    "name": "Example User",
    "email": "student@example.com",
    "email_verified_at": "2026-09-03T01:00:00.000000Z"
  }
}
```

`email_verified_at` may be `null`. The resource does not currently include `created_at`, roles, permissions, or other model fields.

Example request:

```bash
curl --request GET "http://localhost:8000/api/auth/me" \
  --header "Accept: application/json" \
  --header "Authorization: Bearer $TOKEN"
```

### Refresh

`POST /api/auth/refresh`

The request has no JSON body. Send the current JWT as a Bearer token, even if its normal 15-minute access lifetime has elapsed.

Successful response: `200 OK`

```json
{
  "data": {
    "access_token": "new.jwt.value",
    "token_type": "Bearer",
    "expires_in": 900
  }
}
```

The old token is blacklisted when refresh succeeds. Replace it immediately with the returned token.

An invalid token or one outside the refresh window returns `401 Unauthorized`:

```json
{
  "message": "The token is invalid or can no longer be refreshed."
}
```

### Logout

`POST /api/auth/logout`

The request has no JSON body. `LogoutRequest` and its `sessionToken` field are not used. Authentication comes exclusively from the Bearer header.

Successful response: `204 No Content` with an empty body. The presented JWT is blacklisted, so using it again fails authentication.

### Registration is not currently usable

`POST /api/auth/register` nominally returns the same token envelope with `201 Created`, but the input and persistence code are inconsistent:

| Layer | Current behavior |
| --- | --- |
| `SignupRequest` | Requires `username`, `email`, `password`, and matching `password_confirmation` |
| Username validation | Checks uniqueness against `users.username`, but that column does not exist |
| `AuthController` | Keeps only validated `name`, `email`, and `password`; `name` has no validation rule, and `username` is ignored |
| `users` table | Requires `name` and `role_id` |
| `User` fillable fields | Contains `name`, `email`, and `password`, but not `role_id` |
| Registration action | Does not supply a role |

The current password rule is 15 to 64 characters and requires letters, mixed case, numbers, symbols, confirmation, and a successful uncompromised-password check. Those rules do not resolve the schema/controller mismatch.

Do not publish a client registration contract until the application consistently chooses `name` or `username` and defines how a new user's required role is assigned. Add a registration feature test with the fix.

### Status codes

| Status | Meaning in this API |
| --- | --- |
| `200 OK` | Login, `me`, or refresh succeeded |
| `201 Created` | Nominal registration success after registration is fixed |
| `204 No Content` | Logout succeeded |
| `401 Unauthorized` | Login credentials are incorrect, or a JWT is missing, invalid, expired, blacklisted, or no longer refreshable |
| `403 Forbidden` | Expected when a valid identity fails a policy or authorization rule; no current JWT route produces this intentionally |
| `422 Unprocessable Content` | Form Request validation failed |
| `429 Too Many Requests` | A route's rate limit was exceeded |

The application calls `FormRequest::failOnUnknownFields()`, so unrecognized JSON fields on login and registration requests are rejected instead of silently ignored.

## 7. Authentication flows

### Login

1. `LoginRequest` trims and lowercases the email, then validates the request shape.
2. `AuthController::login()` passes only validated email and password values to `JwtTokenService`.
3. The service calls `attempt()` on the `api` JWT guard.
4. Laravel's Eloquent user provider loads the user and verifies the hashed password.
5. jwt-auth creates and signs a JWT for valid credentials.
6. The controller returns the token type and lifetime; the client stores the token.

### Authenticated request

1. The client sends `Authorization: Bearer <token>`.
2. `RequireBearerToken` obtains the header token and attaches it to the `api` guard.
3. `auth:api` verifies its signature and claims, checks expiration and blacklist state, and loads the user identified by `sub`.
4. `/api/auth/me` resolves the user with `$request->user('api')` and returns a `UserResource`.

Authentication answers who the user is. Policies and gates must still decide what that user is allowed to do.

### Refresh and rotation

This project does not issue a second opaque refresh token. The same JWT is the refresh credential:

1. The client sends the current JWT to `/api/auth/refresh`.
2. The Bearer middleware attaches it without running `auth:api`.
3. jwt-auth accepts an expired access token only while its original `iat` remains inside `JWT_REFRESH_TTL`.
4. jwt-auth issues a new access token and blacklists the old token.
5. The client atomically replaces the old token.

The current access lifetime is 15 minutes and the refresh window is 7 days from the original issue time. Refreshing does not create an unlimited sliding session because jwt-auth preserves the original `iat` during rotation.

Only one client refresh should be in flight at a time. Two concurrent refresh attempts can race after the first request blacklists the shared old token.

### Logout

1. `RequireBearerToken` and `auth:api` authenticate the request.
2. `JwtTokenService::invalidate()` calls the JWT guard's `logout()` operation.
3. jwt-auth records the current token in the blacklist.
4. The API returns `204`, and the client deletes its local copy.

Logout revokes only the presented token. It does not automatically revoke tokens on the user's other devices or invalidate every existing token after a password change.

## 8. Rate limiting

| Endpoint | Limit key | Limit |
| --- | --- | ---: |
| Registration | Standard unauthenticated throttle key, effectively the client IP | 6 requests per minute |
| Login | Normalized `email + IP` | 5 requests per minute |
| Login | IP address | 30 requests per minute |
| Refresh | IP address | 30 requests per minute |
| `me` and logout | No additional route-specific limiter | None defined here |

Both login limits apply. The broader IP limit makes changing the submitted email insufficient to bypass all login throttling. The limiter independently trims and lowercases the email before building its key.

Never use the full JWT as a rate-limit key because secrets should not be unnecessarily stored, cached, or logged.

## 9. Tests and verification

Run the focused JWT feature suite:

```powershell
php artisan test tests/Feature/Api/V1/JwtAuthTest.php
```

Verified result on September 3, 2026: **4 tests passed, 16 assertions**.

| Test | What it proves |
| --- | --- |
| Login followed by `me` | Valid credentials issue a token that authenticates the user |
| Incorrect credentials | The API returns `401` and the expected generic message |
| Refresh rotation | A new token is issued, the old token is rejected, and the new token works |
| Logout blacklisting | Logout returns `204` and the logged-out token is rejected |

The current suite does not test registration, missing or malformed Bearer headers, token-expiry boundaries, the end of the refresh window, validation details, rate-limit responses, or protection of `/api/v1/*` routes.

Useful read-only checks:

```powershell
php artisan route:list --path=api/auth --except-vendor -v
php artisan migrate:status
composer show tymon/jwt-auth
```

Run the complete test suite after authentication or middleware changes:

```powershell
composer test
```

## 10. Client responsibilities

A client using this API should:

1. Send the token only through `Authorization: Bearer <token>`.
2. Treat `expires_in` as seconds and use it to schedule refresh.
3. Allow only one refresh request at a time and pause other authenticated requests while it runs.
4. Replace the previous token atomically after refresh.
5. Retry an original request no more than once after a successful refresh.
6. Clear local authentication and return to login when refresh returns `401`.
7. Call the logout endpoint before deleting the local token when server-side revocation is required.

Do not send tokens in query strings. URLs can leak through logs, analytics, histories, referrers, and copied links.

For mobile or desktop software, use operating-system credential storage. For a browser SPA, JavaScript-accessible storage is exposed by XSS. Because Sanctum is already installed, a first-party browser client should also evaluate Sanctum's secure cookie-based SPA authentication instead of assuming JWT storage is the safer design.

## 11. Production security

- Require HTTPS for every request carrying a Bearer token.
- Keep `JWT_SECRET` outside source control and deployment logs.
- Never log authorization headers or full JWT values.
- Keep the signing algorithm fixed in trusted server configuration.
- Keep short access lifetimes and a finite refresh window.
- Leave blacklisting enabled when immediate logout and rotation are required.
- Use one shared cache/blacklist store across all API instances.
- Configure CORS only for known browser origins.
- Keep Laravel, jwt-auth, PHP, and their dependencies patched.
- Keep confidential data out of JWT claims; payloads are readable.
- Load current roles and permissions from server-side state and enforce them with policies or gates.
- Add authentication and authorization to sensitive `/api/v1/*` resources before production exposure.
- Add monitoring for repeated login failures, refresh abuse, and authorization failures without recording token values.

HS256 is appropriate for a single issuer/verifier when its secret is random and protected. If several independent services must verify tokens, an asymmetric algorithm may reduce secret sharing, but it adds key-management complexity and requires an intentional configuration change.

Changing a password does not inherently revoke every JWT already issued to a user. A future “log out everywhere” feature needs additional state, such as a user authentication version or tracked device/token identifiers.

## 12. Known gaps in the current project

These are code or configuration gaps discovered while aligning this documentation; this documentation change does not modify them.

1. **Registration is internally inconsistent.** `username`, `name`, and required `role_id` handling must be aligned, and the route needs feature tests.
2. **The e-commerce resource routes are public.** `/api/v1/*` does not currently use the JWT guard. This may be intentional during development, but it must not be mistaken for protected API coverage.
3. **`.env.example` omits JWT settings.** A new clone must run `php artisan jwt:secret` and add the non-secret JWT options manually.
4. **The local soft-delete migration was pending when this guide was verified.** Run `php artisan migrate`; the `User` model already applies `SoftDeletes`.
5. **Unused auth scaffolding can cause confusion.** Auth Actions, Auth DTOs, and `LogoutRequest` are not wired into the active controller flow. `AuthController` also has a stale unused import for a nonexistent `RegisterRequest`.

## 13. References

- [tymon/jwt-auth repository](https://github.com/tymondesigns/jwt-auth)
- [tymon/jwt-auth Laravel installation](https://jwt-auth.readthedocs.io/en/develop/laravel-installation/)
- [tymon/jwt-auth quick start](https://jwt-auth.readthedocs.io/en/develop/quick-start/)
- [Laravel 13 authentication](https://laravel.com/docs/13.x/authentication)
- [Laravel 13 routing](https://laravel.com/docs/13.x/routing)
- [RFC 8725: JSON Web Token Best Current Practices](https://www.rfc-editor.org/rfc/rfc8725.html)

When this guide and the implementation disagree, the registered routes, current controller/service code, environment configuration, and passing feature tests are the source of truth.
