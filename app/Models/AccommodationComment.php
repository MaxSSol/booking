<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create($validated)
 */
class AccommodationComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'accommodation_id',
        'accommodation_unit_id',
        'user_id',
        'comment',
        'total_rating',
        'location',
        'facilities',
        'price',
        'service',
    ];

    public function accommodation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function accommodationUnit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AccommodationUnit::class);
    }
}
