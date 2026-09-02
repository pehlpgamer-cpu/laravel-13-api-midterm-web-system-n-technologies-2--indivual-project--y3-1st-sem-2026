<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\UserRole;
use App\Policies\UserPolicy;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Override;
use Tymon\JWTAuth\Contracts\JWTSubject;

#[Table(
    name: 'users',
    key: 'user_id'
)]

#[Fillable([
    'name',
    'email',
    'password'
])]

#[Hidden([
    'password',
    'remember_token'
])]

//#[UsePolicy(UserPolicy::class)]

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    #[Override]
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }
    /**
     * @return array<string, mixed>
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }



    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role' => UserRole::class,
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(
            related: Role::class,
        );
    }
}
