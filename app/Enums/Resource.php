<?php declare(strict_types=1);

namespace App\Enums;

enum Resource: string
{
    case Products = "products";
    case Users = "users";
    case Categories = "categories";
    case Roles = "roles";
}
