<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClothingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'customer_id',
        'clothing_type_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function clothingType()
    {
        return $this->belongsTo(ClothingType::class);
    }

    public function orderItem()
    {
        return $this->hasMany(Order::class);
    }
}
