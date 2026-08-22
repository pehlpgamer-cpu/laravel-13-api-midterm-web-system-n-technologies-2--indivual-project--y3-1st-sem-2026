<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Table('Categories', key: 'category_id')]
// #[Fillable([])]
// #[Hidden([])]

class Category extends Model
{
    /** @use HasFactory<CategoryFactory> */
    use HasFactory;
}
