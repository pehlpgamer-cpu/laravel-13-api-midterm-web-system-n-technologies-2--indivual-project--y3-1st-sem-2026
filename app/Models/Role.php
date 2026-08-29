<?php declare(strict_types=1);

namespace App\Models;

use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Table(
    name: 'roles',
    key: 'role_id'
)]

class Role extends Model
{
    /**
     * @use HasFactory<RoleFactory>
     * */
    use HasFactory;
    use SoftDeletes;

    public function user(): HasMany
    {
        return $this->hasMany(
            related: User::class,
        );
    }
}
