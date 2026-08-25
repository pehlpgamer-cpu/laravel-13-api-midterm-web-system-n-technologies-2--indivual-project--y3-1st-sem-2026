<?php
declare(strict_types=1);

arch('Actions')
    ->expect('App\Actions')
    ->toBeInvokable();

arch('Queries')
    ->expect('App\Queries')
    ->toBeInvokable();
