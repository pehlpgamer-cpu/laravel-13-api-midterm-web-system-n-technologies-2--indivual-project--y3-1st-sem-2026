<?php declare(strict_types=1);

$path = 'App\Actions';

arch('Naming Conventions')
    ->expect($path)
    ->toHaveSuffix('Action');

arch('Invokable')
    ->expect($path)
    ->toBeInvokable();

