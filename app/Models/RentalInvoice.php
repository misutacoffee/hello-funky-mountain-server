<?php

namespace App\Models;

use Database\Factories\RentalInvoiceFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentalInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'purchase_order_number', 
        'invoice_date', 
        'sub_total', 
        'tax', 
        'total', 
        'status', 
        'due_date', 
        'paid_date', 
        'rental_uuid', 
        'contract_uuid', 
        'user_uuid', 
        'uuid', 
    ];

    public function contract()
    {
        return $this->hasOne(Contract::class, 'uuid', 'contract_uuid');
    }

    public function rental()
    {
        return $this->hasOne(Rental::class, 'uuid', 'rental_uuid');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'uuid', 'user_uuid');
    }
}
