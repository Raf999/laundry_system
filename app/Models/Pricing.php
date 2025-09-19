<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pricing extends Model
{
    use HasFactory;

    protected $fillable = ['clothing_type_id', 'service_id', 'price'];

    public function clothingType()
    {
        return $this->belongsTo(ClothingType::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
