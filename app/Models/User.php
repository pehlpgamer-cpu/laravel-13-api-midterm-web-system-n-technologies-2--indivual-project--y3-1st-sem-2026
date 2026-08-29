<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\UserRole;
use App\Policies\UserPolicy;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Table(
    name: 'users',
    key: 'user_id'
)]

#[Fillable([
    'name',
    'email',
    'password'
])]

#[Hidden([
    'password',
    'remember_token'
])]

#[UsePolicy(UserPolicy::class)]

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role' => UserRole::class,
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(
            related: Role::class,
        );
    }
}
