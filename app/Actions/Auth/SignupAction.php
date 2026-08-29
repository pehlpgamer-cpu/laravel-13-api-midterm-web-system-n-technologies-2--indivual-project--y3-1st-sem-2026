<?php declare(strict_types=1);

namespace App\Actions\Auth;

use App\DTOs\Auth\SignupDto;
use App\Models\User;
use Illuminate\Support\Facades\DB;

readonly final class SignupAction
{
    public function __invoke(SignupDto $loginDto): array
    {
        DB::transaction(
            fn () => User::query()->create([
                'username' => $loginDto->email,
                'email' => $loginDto->email,
                'password' => $loginDto->password,
            ])
        );

        return [];
    }
}

