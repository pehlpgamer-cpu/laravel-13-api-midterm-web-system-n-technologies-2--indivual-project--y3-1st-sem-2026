<?php declare(strict_types=1);

namespace App\Models;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Table(name: 'Products', key: 'product_id')]
#[\Illuminate\Database\Eloquent\Attributes\Fillable([
    'name',
    'description',
    'price',
])]

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;
}
