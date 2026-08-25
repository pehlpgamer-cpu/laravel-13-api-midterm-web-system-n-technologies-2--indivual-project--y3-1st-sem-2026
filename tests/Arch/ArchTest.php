<?php


declare(strict_types=1);

// idk if I'll be using services, but I'll keep this just in case
arch("Services doesn't use facades & helpers")
    ->expect('App\Services')
    ->toBeClasses();


arch('Form requests')
    ->expect('App\Http\Request')
    ->toExtend(\Illuminate\Foundation\Http\FormRequest::class);


arch('DTOs')
    ->expect('App\DTOs')
    ->toBeClasses()
    ->toHaveConstructor() // idk if this is necessary
    ->not->toHavePublicMethodsBesides(["fromArray", "__construct"])
    ->toUseNothing();


arch('Jobs')
    ->expect('App\Jobs')
    ->toBeClasses()
    ->toImplement(\Illuminate\Contracts\Queue\ShouldQueue::class);

arch('Enums are string backed')
    ->expect('App\Enums')
    ->toBeStringBackedEnums();


describe('Models', function(): void
{
    arch('all has a factory')
        ->expect('App\Models')
        ->toBeClasses()
        ->extending(\Illuminate\Database\Eloquent\Model::class)
        ->toUseTrait(\Illuminate\Database\Eloquent\Factories\HasFactory::class);
});
