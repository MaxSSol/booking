<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class AccommodationFilter extends AbstractFilter
{
    public const CITY = 'city';
    public const CATEGORY_ID = 'category_id';
    public const OPPORTUNITY_ID = 'opportunity_id';
    public const RENT_DATE_FROM = 'rent_date_from';
    public const PEOPLE = 'people';
    public const FACILITY_ID = 'facility_id';
    public const ROOMS = 'rooms';

    protected function getCallbacks(): array
    {
        return [
            self::CITY => [$this, 'city'],
            self::CATEGORY_ID => [$this, 'category'],
            self::OPPORTUNITY_ID => [$this, 'opportunity'],
            self::RENT_DATE_FROM => [$this, 'rentDateFrom'],
            self::PEOPLE => [$this, 'people'],
            self::FACILITY_ID => [$this, 'facilities'],
            self::ROOMS => [$this, 'rooms']
        ];
    }

    public function city(Builder $builder, $city)
    {
        $builder->whereHas('city', function (Builder $query) use ($city) {
            $query->where('cities.title', $city);
        });
    }

    public function category(Builder $builder, $categoryId)
    {
        $builder->whereHas('categories', function (Builder $query) use ($categoryId) {
            $query->whereIn('category_id', $categoryId);
        });
    }

    public function opportunity(Builder $builder, $opportunityId)
    {
        $builder->whereHas('opportunities', function (Builder $query) use ($opportunityId) {
            $query->whereIn('opportunity_id', $opportunityId);
        });
    }

    public function rentDateFrom(Builder $builder, $rent_date_from)
    {
        $builder->whereHas('accommodationUnits', function (Builder $query) use ($rent_date_from) {
            $query->where('date_available_from', '<=', $rent_date_from);
        });
    }

    public function people(Builder $builder, $people)
    {
        $builder->whereHas('accommodationUnits', function (Builder $query) use ($people) {
            $query->where('max_count_people', '>=', $people);
        });
    }

    public function facilities(Builder $builder, $facility_id)
    {
        $builder->whereHas('accommodationUnits', function (Builder $query) use ($facility_id) {
            $query->whereHas('facilities', function (Builder $query) use ($facility_id) {
                $query->whereIn('facility_id', $facility_id);
            });
        });
    }

    public function rooms(Builder $builder, $rooms)
    {
        $builder->withCount('accommodationUnits')
            ->having('accommodation_units_count', '>=', $rooms);
    }
}
