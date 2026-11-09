<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;

#[Table(name: 'rental_invoices')]
class Invoice extends Model
{
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

    public function user()
    {
        return $this->hasOne(User::class, 'uuid', 'user_uuid');
    }
    
    public function contract()
    {
        return $this->hasOne(Contract::class, 'uuid', 'contract_uuid');
    }
    
    public function rental()
    {
        return $this->hasOne(Rental::class, 'uuid', 'rental_uuid');
    }
    
}
