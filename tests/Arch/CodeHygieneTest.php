<?php
declare(strict_types=1);

arch('uses strict types')
    ->expect('App')
    ->toUseStrictTypes();

arch('No debug calls')
    ->expect('App')
    ->not->toUse(['dd', 'dump', 'ray', 'var_dump', 'die', 'exit']);

arch('No env outside of config')
    ->expect('App')
    ->not->toUse('env');
