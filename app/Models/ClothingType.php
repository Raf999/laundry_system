<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClothingType extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'color'];

    public function clothingItems()
    {
        return $this->hasMany(ClothingItem::class);
    }

    public function pricings()
    {
        return $this->hasMany(Pricing::class);
    }   
}
