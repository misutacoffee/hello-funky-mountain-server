<?php

namespace App\Models;

use Database\Factories\RentalFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rental_date',
        'return_date',
        'description',
        'note',
        'contract_uuid',
        'user_uuid',
        'uuid',
    ];

    public function contract()
    {
        return $this->hasOne(Contract::class, 'uuid', 'contract_uuid');
    }

    public function rentalEquipment()
    {
        return $this->hasMany(RentalEquipment::class, 'rental_uuid', 'uuid');   
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'rental_uuid', 'uuid');
    }

}
