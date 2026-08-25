<?php 
// TODO 1. configure Arch tests in its own folder "tests/Arch"
// TODO 2. not use presets to be more explicit with arch rules
describe('Built-in', function(): void
{
    arch('Security')->preset()->security();
        // https://github.com/pestphp/pest/blob/3.x/src/ArchPresets/Security.php
    arch('PHP')->preset()->php();
        // https://github.com/pestphp/pest/blob/4.x/src/ArchPresets/Php.php
    arch('Laravel')->preset()->laravel()
        ->ignoring(\App\Http\Controllers\AuthController::class)
        ->ignoring(\App\Providers\AppServiceProvider::class); // *  Expecting 'App\Providers\TelescopeServiceProvider' not to be used on 'App\Providers\AppServiceProvider'
        // https://github.com/pestphp/pest/blob/3.x/src/ArchPresets/Laravel.php
});
