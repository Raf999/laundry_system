<?php

namespace App\Models;

use App\Enum\PaymentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'Staff_id', 'order_date', 'status'];

    protected $appends = ['total_amount', 'payment_status'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalAmountAttribute()
    {
        return $this->items->sum('total_amount');
    }

    public function amountDue(): float
    {
        return ($this->total_amount + $this->delivery_cost) - $this->discount_amount - $this->amount_paid;
    }


    public function getPaymentStatusAttribute()
    {
        if (($this->amountDue()) <= 0) {
            return PaymentStatus::PAID->value;
        }

        return PaymentStatus::UNPAID->value;
    }

}
