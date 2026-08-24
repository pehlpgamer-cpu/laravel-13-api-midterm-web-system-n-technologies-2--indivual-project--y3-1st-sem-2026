<?php
// TODO 1. configure Arch tests in its own folder "tests/Arch"
// TODO 2. not use presets to be more explicit with arch rules
describe('3 Built-in Presets', function()
{
    arch('Security')->preset()->security();
        // https://github.com/pestphp/pest/blob/3.x/src/ArchPresets/Security.php
    arch('PHP')->preset()->php();
        // https://github.com/pestphp/pest/blob/4.x/src/ArchPresets/Php.php
    arch('Laravel')->preset()->laravel()
        ->ignoring('App\Http\Controllers\AuthController')
        ->ignoring('App\Providers\AppServiceProvider'); // *  Expecting 'App\Providers\TelescopeServiceProvider' not to be used on 'App\Providers\AppServiceProvider'
        // https://github.com/pestphp/pest/blob/3.x/src/ArchPresets/Laravel.php
});

describe('Controllers', function()
{
    arch('only use external form request validation')
        ->expect('App\Http\Controllers')
        ->not->toUse([
            'Illuminate\Http\Request',
            'Illuminate\Support\Facades\Request',
            'Illuminate\Support\Facades\Validator',
            'request',
            'validator',
        ]);

    arch('only orchestrates business logic & not contain it')
        ->expect('App\Http\Controllers')
        ->toOnlyUse([
            'App\Models',
            'App\Actions',
            'App\Services',
            'App\Data',
            'App\Http\Requests',
            'App\Http\Resources',
            'Illuminate\Http\Response',
            'Illuminate\Http\JsonResponse',
            'Illuminate\Support\Facades\Gate',
        ]);

});

// idk if I'll be using services, but I'll keep this just in case
arch("Services doesn't use facades & helpers")
    ->expect('App\Services')
    ->not->toUse([
        'Illuminate\Support\Facades',
        'auth',
        'cache',
        'config',
        'session',
        'request',
        'app',
        'resolve',
    ]);


arch('Form requests')
    ->expect('App\Http\Request')
    ->toHaveSuffix('Request')
    ->toExtend('Illuminate\Foundation\Http\FormRequest');

arch('Actions')
    ->expect('App\Actions')
    ->toHaveSuffix('Action')
    ->toBeFinal()
    ->toBeReadonly()
    ->toBeInvokable();

arch('DTOs')
    ->expect('App\DTOs')
    ->toHaveSuffix('Dto')
    ->toBeFinal()
    ->toBeReadonly()
    ->toHaveConstructor() // idk if this is necessary
    ->not->toHavePublicMethodsBesides(["fromArray", "__construct"])
    ->toUseNothing()

arch('Queries')
    ->expect('App\Queries')
    ->toHaveSuffix('Query')
    ->toBeReadonly()
    ->toBeInvokable();

arch('Jobs')
    ->expect('App\Jobs')
    ->toImplement('Illuminate\Contracts\Queue\ShouldQueue');

arch('Enums are string backed')
    ->expect('App\Enums')
    ->toBeStringBackedEnums();


describe('App Hygiene', function() {
    arch('uses strict types')
        ->expect('App')
        ->toUseStrictTypes();

    arch('No debug calls')
        ->expect('App')
        ->not->toUse(['dd', 'dump', 'ray', 'var_dump', 'die', 'exit']);

    arch('No env outside of config')
        ->expect('App')
        ->not->toUse('env');
});


describe('Models', function()
{
    arch('all has a factory')
        ->expect('App\Models')
        ->extending('Illuminate\Database\Eloquent\Model')
        ->toUseTrait('Illuminate\Database\Eloquent\Factories\HasFactory');

    arch("Doesn't reach outward")
        ->expect('App\Models');
});
