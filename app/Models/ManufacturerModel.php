<?php

namespace App\Models;

use Database\Factories\ManufacturerModelFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManufacturerModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'manufacturer_uuid',
        'manufacturer_model_uuid',
        'serial_number',
        'purchase_date',
        'warranty_expiration_date',
        'status',
        // Add other fillable attributes as needed
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_uuid', 'uuid');
    }
}
