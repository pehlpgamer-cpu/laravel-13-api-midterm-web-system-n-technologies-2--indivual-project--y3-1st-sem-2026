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
    static public function uriPath(ApiVersion $v, ?Resource $r = null, ?string $path = ""): string
    {
        if ($r === null)
            $resource = "";
        else
            $resource = "/" . $r->value;

        return "/api/" . $v->value . $resource . $path;
    }

}


