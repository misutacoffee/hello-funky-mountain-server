<?php

namespace App\Models;

use Database\Factories\ManufacturerFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'note',
        'website',
        'is_active',
        'uuid',
    ];

    public function manufacturerModels()
    {
        return $this->hasMany(ManufacturerModel::class, 'manufacturer_uuid', 'uuid');
    }
}
