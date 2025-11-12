<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $appends = ['total_amount'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function clothingType()
    {
        return $this->belongsTo(ClothingType::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getTotalAmountAttribute()
    {
        return $this->unit_price * $this->quantity;
    }
}
