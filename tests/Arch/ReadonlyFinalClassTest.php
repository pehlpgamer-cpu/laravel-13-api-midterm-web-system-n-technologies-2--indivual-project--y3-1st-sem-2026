<?php

declare(strict_types=1);

arch('Actions')
    ->expect('App\Actions')
    ->toBeFinal()
    ->toBeReadonly();

arch('DTOs')
    ->expect('App\DTOs')
    ->toBeFinal()
    ->toBeReadonly();

arch('Queries')
    ->expect('App\Queries')
    ->toBeFinal()
    ->toBeReadonly();

arch('Controllers')
    ->expect('App\Http\Controllers')
    ->toBeFinal()
    ->toBeReadonly();

