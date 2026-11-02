<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;

#[Table(name: 'rental_invoices')]
class Invoice extends Model
{
    protected $fillable = [
        'rental_uuid',
        'purchase_order_number',
        'invoice_date',
        'amount',
        'tax',
        'status',
        'due_date',
        'paid_date',
        'user_uuid',
        'uuid',
    ];
}
