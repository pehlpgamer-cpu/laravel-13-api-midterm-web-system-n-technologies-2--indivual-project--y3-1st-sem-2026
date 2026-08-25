<?php declare(strict_types=1);

namespace App\Actions\Auth;

use App\DTOs\Auth\LogoutDto;
use Illuminate\Database\DatabaseManager;

readonly final class LogoutAction
{
    public function __invoke(LogoutDto $data): array
    {
        // $this->authManager->logout();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return [];
    }
}

