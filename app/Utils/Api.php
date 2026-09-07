<?php declare(strict_types=1);

namespace App\Utils;

final readonly class Api
{
    /**
     * @param string $path
     * Example: "/products"
     * @return string "/api/v1".$path
     */
    static public function v1(string $path): string
    {
        return "/api/v1".$path;
    }

}


