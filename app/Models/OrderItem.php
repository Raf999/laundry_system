<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'clothing_type_id', 'service_id', 'color', 'price'];

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
}
