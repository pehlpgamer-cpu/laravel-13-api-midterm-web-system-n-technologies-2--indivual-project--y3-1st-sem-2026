<?php declare(strict_types=1);

arch('Enums are string backed')
    ->expect('App\Enums')
    ->toBeStringBackedEnums();
