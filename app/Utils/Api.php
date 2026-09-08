<?php declare(strict_types=1);

namespace App\Utils;

use App\Enums\ApiVersion;
use App\Enums\Resource;

final readonly class Api
{

    /**
     * @param string $path  Examples: "/1", "?name=paulo", ""
     * @return string "/api/" . $v->value . "/" . $r->value . $path
     */
    static public function uriPath(ApiVersion $v, Resource $r, ?string $path = ""): string
    {
        return "/api/" . $v->value . "/" . $r->value . $path;
    }

}


