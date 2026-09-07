<?php declare(strict_types=1);

arch('Naming Conventions')
    ->expect('App\Jobs')
    ->toBeClasses()
    ->toImplement(\Illuminate\Contracts\Queue\ShouldQueue::class);
