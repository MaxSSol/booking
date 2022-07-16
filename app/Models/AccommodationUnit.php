<?php

namespace App\Models;

use App\Contracts\Filter\Filter;
use App\Filters\AccommodationUnitFilter;
use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccommodationUnit extends Model
{
    use HasFactory;
    use Filterable;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'number_of_rooms',
        'number_of_floors',
        'square',
        'max_count_people',
        'price',
        'is_available',
        'date_available_from',
        'accommodation_id',
        'rent_info_id'
    ];

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
        return $this
            ->hasOneThrough(
                User::class,
                Accommodation::class,
                'id',
                'id',
                'accommodation_id',
                'user_id'
            );
    }

    public function rentHistories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RentHistory::class);
    }

    public function city()
    {
        return $this
            ->hasOneThrough(
                City::class,
                Accommodation::class,
                'id',
                'id',
                'accommodation_id',
                'city_id'
            );
    }
}
