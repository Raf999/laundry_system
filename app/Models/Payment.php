<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['payment_number', 'invoice_id', 'amount', 'method', 'payment_date'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
