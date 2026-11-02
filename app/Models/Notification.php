<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'url',
        'title',
        'description',
        'read_date',
        'dismissed_date',
        'is_read',
        'user_uuid',
        'uuid',
    ];
}
