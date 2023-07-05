<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_method_id',
        'bill_number',
        'amount',
        'start_duration_date',
        'state',
        'payment_date',
        'confirm_date'
    ];
    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function method()
    {
        $this->belongsTo(PaymentMethod::class);
    }
}
