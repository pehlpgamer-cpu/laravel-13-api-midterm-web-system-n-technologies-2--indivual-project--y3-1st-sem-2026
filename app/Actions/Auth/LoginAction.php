<?php declare(strict_types=1);

namespace App\Actions\Auth;

use App\DTOs\Auth\LoginDto;
use App\Models\User;
use Illuminate\Support\Facades\DB;

readonly final class LoginAction
{
    public function __invoke(LoginDto $loginDto): array
    {
        //DB::transaction(
            // fn () => User::query()->create([
            //     'name' => $loginDto->email,
            //     'password' => $loginDto->password,
            // ])
        //);

        return [];
    }
}

