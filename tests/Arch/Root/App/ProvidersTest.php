<?php declare(strict_types=1);

arch('Naming Conventions')
    ->expect('App\Http\Providers')
    ->toHaveSuffix('Provider');
