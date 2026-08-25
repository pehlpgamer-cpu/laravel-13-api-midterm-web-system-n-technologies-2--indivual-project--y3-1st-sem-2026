<?php declare(strict_types=1);

namespace App\Models;

use Database\Factories\InventoryItemsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    /** @use HasFactory<InventoryItemsFactory> */
    use HasFactory;
}
