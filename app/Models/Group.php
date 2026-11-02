<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'type',
        'description',
        'note',
        'user_uuid',
        'uuid',
    ];
}
