<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Authenticatable
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'password' => 'hashed',
    ];


    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
