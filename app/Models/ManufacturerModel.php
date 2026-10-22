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
        'description', 
        'note', 
        'is_active', 
        'manufacturer_uuid', 
        'uuid', 
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_uuid', 'uuid');
    }
}
