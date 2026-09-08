<?php declare(strict_types=1);

$path = 'App\Actions';

arch('Naming Conventions')
    ->expect($path)
    ->toHaveSuffix('Action');

arch('Final & readonly')
    ->expect($path)
    ->toBeReadonly()
    ->toBeFinal();

arch('Invokable')
    ->expect($path)
    ->toBeInvokable();

