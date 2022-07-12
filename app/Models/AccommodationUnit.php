<?php

namespace App\Models;

use App\Contracts\Filter\Filter;
use App\Filters\AccommodationUnitFilter;
use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationUnit extends Model
{
    use HasFactory;
    use Filterable;

    public function accommodation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function accommodationUnitImages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AccommodationUnitImage::class);
    }

    public function facilities(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Facility::class);
    }

    public function user()
    {
        $this->hasOneThrough(User::class,Accommodation::class, 'id', 'accommodation_id',   'id', 'id' );
    }
}
