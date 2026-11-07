<?php

namespace App\Models;

use Database\Factories\RentalEquipmentFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentalEquipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_uuid', 
        'equipment_uuid', 
        'quantity', 
        'unit', 
        'price', 
        'total', 
        'note', 
        'uuid', 
    ];

    public function equipment()
    {
        return $this->hasOne(Equipment::class, 'uuid', 'equipment_uuid');
    }

    public function rental()
    {
        return $this->hasOne(Rental::class, 'uuid', 'rental_uuid');
    }
    
}
