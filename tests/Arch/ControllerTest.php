<?php
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Http\Resources\Json\JsonResource;


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


test('all methods return a JsonResource', function (): void {
    $controllerPath = dirname(__DIR__, 2) . '/app/Http/Controllers';

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator(
            $controllerPath,
            FilesystemIterator::SKIP_DOTS,
        ),
    );

    $isJsonResourceType = null;

    $isJsonResourceType = function (
        ReflectionType $reflectionType,
    ) use (&$isJsonResourceType): bool {
        if ($reflectionType instanceof ReflectionNamedType) {
            return ! $reflectionType->isBuiltin()
                && is_a(
                    $reflectionType->getName(),
                    JsonResource::class,
                    allow_string: true,
                );
        }

        if ($reflectionType instanceof ReflectionUnionType) {
            foreach ($reflectionType->getTypes() as $unionType) {
                if (! $isJsonResourceType($unionType)) {
                    return false;
                }
            }

            return true;
        }

        return false;
    };

    foreach ($iterator as $file) {
        if (
            ! $file->isFile()
            || $file->getExtension() !== 'php'
        ) {
            continue;
        }

        $relativePath = substr(
            $file->getPathname(),
            strlen($controllerPath) + 1,
        );

        $class = 'App\\Http\\Controllers\\'
            . str_replace(
                [DIRECTORY_SEPARATOR, '.php'],
                ['\\', ''],
                $relativePath,
            );

        if (! class_exists($class)) {
            continue;
        }

        $reflection = new ReflectionClass($class);

        // Ignore abstract base controllers.
        if ($reflection->isAbstract()) {
            continue;
        }

        $methods = $reflection->getMethods(
            ReflectionMethod::IS_PUBLIC,
        );

        foreach ($methods as $method) {
            // Only test methods actually declared by this controller.
            // Inherited framework/base-controller methods are ignored.
            if (
                $method->getDeclaringClass()->getName()
                !== $class
            ) {
                continue;
            }

            if (
                $method->isConstructor()
                || $method->isDestructor()
            ) {
                continue;
            }

            $returnType = $method->getReturnType();

            expect($returnType)
                ->not
                ->toBeNull(
                    "{$class}::{$method->getName()}() "
                    . 'must declare a return type.',
                )
                ->and($isJsonResourceType($returnType))->toBeTrue("{$class}::{$method->getName()}() "
            . 'must return JsonResource or a subclass of JsonResource.');
        }
    }
});
