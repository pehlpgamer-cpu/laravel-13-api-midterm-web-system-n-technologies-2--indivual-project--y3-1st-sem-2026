<?php declare(strict_types=1);

$namespace = 'App\DTOs';


arch('Naming Conventions')
    ->expect($namespace)
    ->toHaveSuffix('Dto');

arch('Method Requirements')
    ->expect($namespace)
    ->toBeClasses()
    ->toHaveConstructor() // idk if this is necessary
    ->not->toHavePublicMethodsBesides(["fromArray", "__construct"])
    ->toUseNothing();

arch('Readonly & Final')
    ->expect($namespace)
    ->toBeFinal()
    ->toBeReadonly();
