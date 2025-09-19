<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_number', 'order_id', 'total_amount', 'status'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
