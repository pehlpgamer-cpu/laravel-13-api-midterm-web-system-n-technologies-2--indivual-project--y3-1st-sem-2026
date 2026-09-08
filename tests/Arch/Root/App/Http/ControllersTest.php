<?php

$namespace = 'App\Http\Controllers';

arch('Naming Conventions')
    ->expect($namespace)
    ->toHaveSuffix('Controller');

arch("Only External Validation")
    ->expect($namespace)
    ->toUse('App\DTOs')
    ->toUse('App\Actions\*')
    ->toUse('App\Http\Requests\*')
    ->toBeClasses()
    ->not->toUse('App\Http\Request');

arch('Final class')
    ->expect($namespace)
    ->toBeClasses()
    ->toBeFinal();

arch('NOT a readonly class')
    ->expect($namespace)
    ->toBeClasses()
    ->not->toBeReadonly();

arch('Attributes')
    ->expect($namespace)
    ->toHaveAttribute('Dedoc\Scramble\Attributes\QueryParameter');
