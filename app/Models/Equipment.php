<?php

namespace App\Models;

use Database\Factories\EquipmentFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'serial_number',
        'type',
        'description',
        'note',
        'rental_rate',
        'rental_unit',
        'status', 
        'is_active',
        'user_uuid',
        'manufacturer_model_uuid',
        'uuid',
    ];

    public function manufacturerModel()
    {
        return $this->hasOne(ManufacturerModel::class, 'uuid','manufacturer_model_uuid');
    }

    public function manufacturer()
    {
        return $this->hasOneThrough(Manufacturer::class, ManufacturerModel::class, 'uuid', 'uuid', 'manufacturer_model_uuid', 'manufacturer_uuid');
    }
}
