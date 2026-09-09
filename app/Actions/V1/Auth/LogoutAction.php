<?php declare(strict_types=1);

namespace App\Actions\V1\Auth;

use App\DTOs\V1\Auth\LogoutDto;

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

