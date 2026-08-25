<?php declare(strict_types=1);

namespace App\Actions\Auth;

use App\DTOs\Auth\LoginDto;
use App\Models\User;
use Illuminate\Database\DatabaseManager;

readonly final class LoginAction
{
    public function __construct(
        private DatabaseManager $databaseManager,
    ) {}

    public function __invoke(LoginDto $loginDto): array
    {
        $this->databaseManager->transaction(
            // fn () => User::query()->create([
            //     'name' => $loginDto->email,
            //     'password' => $loginDto->password,
            // ])
        );

        return [];
    }
}

