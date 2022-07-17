<?php

namespace App\Filters;

use App\Http\Requests\Filters\AccommodationFilterRequest;
use Illuminate\Database\Eloquent\Builder;

class AccommodationFilter extends AbstractFilter
{
    public AccommodationUnitFilter $accommodationUnitFilter;

    public function __construct(AccommodationFilterRequest $request, AccommodationUnitFilter $accommodationUnitFilter)
    {
        parent::__construct($request);
        $this->accommodationUnitFilter = $accommodationUnitFilter;
    }

    public const CITY = 'city';
    public const CATEGORY_ID = 'category_id';
    public const OPPORTUNITY_ID = 'opportunity_id';
    public const RENT_DATE_FROM = 'rent_date_from';
    public const PEOPLE = 'people';
    public const FACILITY_ID = 'facility_id';
    public const ROOMS = 'rooms';
    public const MAX_PRICE = 'max_price';
    public const MIN_PRICE = 'min_price';
    public const STAR_ID = 'star_id';

    protected function getCallbacks(): array
    {
        return [
            self::CITY => [$this, 'city'],
            self::CATEGORY_ID => [$this, 'category'],
            self::OPPORTUNITY_ID => [$this, 'opportunity'],
            self::RENT_DATE_FROM => [$this, 'rentDateFrom'],
            self::PEOPLE => [$this, 'people'],
            self::FACILITY_ID => [$this, 'facilities'],
            self::ROOMS => [$this, 'rooms'],
            self::MAX_PRICE => [$this, 'maxPrice'],
            self::MIN_PRICE => [$this, 'minPrice'],
            self::STAR_ID => [$this, 'star']
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
            $query
                ->where('accommodation_units.is_available', true)
                ->where('date_available_from', '<=', $rent_date_from);
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
        $builder->whereHas('accommodationUnits', function (Builder $query) {
                $query->where('is_available', true)->filter($this->accommodationUnitFilter);
        }, '>=', $rooms);
    }

    public function maxPrice(Builder $builder, $max_price)
    {
        $builder->whereHas('accommodationUnits', function (Builder $query) use ($max_price) {
            $query->where('price', '<=', $max_price);
        });
    }

    public function minPrice(Builder $builder, $min_price)
    {
        $builder->whereHas('accommodationUnits', function (Builder $query) use ($min_price) {
            $query->where('price', '>=', $min_price);
        });
    }

    public function star(Builder $builder, $star_id)
    {
        $builder->whereHas('star', function (Builder $query) use ($star_id) {
            $query->where('id', $star_id);
        });
    }
}
