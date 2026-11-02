<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message',
        'sent_date',
        'read_date',
        'archived_date',
        'deleted_date',
        'marked_as_read',
        'sent_by_uuid',
        'sent_to_uuid',
        'uuid',
    ];
}
