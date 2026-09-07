<?php declare(strict_types=1);
$namespace = 'App\Models';

arch('Extend Model')
    ->expect($namespace)
    ->toBeClasses()
    ->extending(\Illuminate\Database\Eloquent\Model::class);

arch('All have factories')
    ->expect($namespace)
    ->toUseTrait(\Illuminate\Database\Eloquent\Factories\HasFactory::class);

