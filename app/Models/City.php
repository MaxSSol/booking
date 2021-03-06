<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function accommodation(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Accommodation::class);
    }
}
