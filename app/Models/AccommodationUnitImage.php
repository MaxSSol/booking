<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationUnitImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'accommodation_unit_id',
        'image',
        'order'
    ];

    public function accommodationUnits(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AccommodationUnit::class);
    }
}
