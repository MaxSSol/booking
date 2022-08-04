<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'rent_for_short_term',
        'rent_for_long_term',
        'free_termination',
        'leave_termination_price',
        'user_id'
    ];

    protected $table = 'rent_info';

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function accommodationUnits(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AccommodationUnit::class);
    }
}
