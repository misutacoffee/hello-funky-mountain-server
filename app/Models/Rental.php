<?php

namespace App\Models;

use Database\Factories\RentalFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_uuid',
        'contract_uuid',
        'rental_date',
        'return_date',
        'description',
        'note',
        'uuid',
    ];
}
