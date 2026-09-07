<?php declare(strict_types=1);

$namespace = 'App\Http\Requests';

arch('Naming Convention')
    ->expect($namespace)
    ->toHaveSuffix('Request');

arch('Extend FormRequest')
    ->expect('App\Http\Request')
    ->toExtend(\Illuminate\Foundation\Http\FormRequest::class);
