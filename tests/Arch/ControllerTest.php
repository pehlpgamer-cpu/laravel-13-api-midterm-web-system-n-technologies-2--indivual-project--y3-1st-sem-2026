<?php
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;


it('uses external form requests', function (): void {
    $routes = new \Illuminate\Support\Collection(\Illuminate\Support\Facades\App::make(Router::class)->getRoutes()->getRoutes());

    $routes
        ->filter(
            fn (Route $route): bool => (new \Illuminate\Support\Collection($route->methods()))
                ->intersect(['POST', 'PUT', 'PATCH'])
                ->isNotEmpty()
        )
        ->each(function (Route $route): void {
            $action = $route->getActionName();

            if ($action === 'Closure' || ! str_contains($action, '@')) {
                return;
            }

            [$controller, $method] = explode('@', $action);

            if (! str_starts_with(
                $controller,
                'App\\Http\\Controllers\\'
            )) {
                return;
            }

            $reflection = new ReflectionClass($controller);

            $reflectionMethod = $reflection->getMethod($method);

            $hasFormRequest = (new \Illuminate\Support\Collection($reflectionMethod->getParameters()))->contains(function ($parameter): bool {
                $type = $parameter->getType();

                if (! $type instanceof ReflectionNamedType) {
                    return false;
                }

                if ($type->isBuiltin()) {
                    return false;
                }

                return is_a(
                    $type->getName(),
                    FormRequest::class,
                    allow_string: true,
                );
            });

            expect($hasFormRequest)
                ->toBeTrue(
                    "{$controller}::{$method}() must use an external FormRequest."
                );
        });
});


