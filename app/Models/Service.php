<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price'];

    public function pricings()
    {
        return $this->hasMany(Pricing::class);
    }

    public function orderItems()
    {
        return $this->hasMany(Order::class);
    }
}
