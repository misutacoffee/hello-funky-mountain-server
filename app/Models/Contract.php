<?php

namespace App\Models;

use Database\Factories\ContractFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'phone',
        'email',
        'primary_address',
        'secondary_address',
        'tertiary_address',
        'city',
        'state',
        'zip',
        'description',
        'note',
        'is_active',
        'user_uuid',
        'uuid',
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'contract_uuid', 'uuid');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'contract_uuid', 'uuid');
    }
}
