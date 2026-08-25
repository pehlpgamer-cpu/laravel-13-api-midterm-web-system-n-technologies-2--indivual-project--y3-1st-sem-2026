<?php
declare(strict_types=1);

arch('DTOs')
    ->expect('App\DTOs')
    ->toHaveSuffix('Dto');

arch('Queries')
    ->expect('App\Queries')
    ->toHaveSuffix('Query');

arch('Actions')
    ->expect('App\Actions')
    ->toHaveSuffix('Action');

arch('Requests')
    ->expect('App\Http\Request')
    ->toHaveSuffix('Request');

arch('Controllers')
    ->expect('App\Http\Controllers')
    ->toHaveSuffix('Controller');

arch('Resources')
    ->expect('App\Http\Resources')
    ->toHaveSuffix('Resource');

arch('Policies')
    ->expect('App\Http\Policies')
    ->toHaveSuffix('Policy');

arch('Providers')
    ->expect('App\Http\Providers')
    ->toHaveSuffix('Provider');

arch('Services')
    ->expect('App\Http\Services')
    ->toHaveSuffix('Service');
