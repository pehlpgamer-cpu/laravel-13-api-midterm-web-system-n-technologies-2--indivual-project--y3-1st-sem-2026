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

arch('Readonly & Final')
    ->expect($namespace)
    ->toBeFinal()
    ->toBeReadonly();

arch('Attributes')
    ->expect($namespace)
    ->toHaveAttribute('Dedoc\Scramble\Attributes\QueryParameter');
