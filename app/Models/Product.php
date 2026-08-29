<?php declare(strict_types=1);

namespace App\Models;

use App\Policies\ProductPolicy;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Table(
    name: 'products',
    key: 'product_id'
)]
#[Fillable([
    'name',
    'description',
    'price',
])]
// #[Hidden([])]

//#[UsePolicy(ProductPolicy::class)]

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
}
