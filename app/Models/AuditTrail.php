<?php

namespace App\Models;

use Database\Factories\AuditTrailFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    /** @use HasFactory<AuditTrailFactory> */
    use HasFactory;
}
