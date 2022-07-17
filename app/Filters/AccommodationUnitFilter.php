<?php

namespace App\Filters;

use App\Http\Requests\Filters\AccommodationFilterRequest;
use Illuminate\Database\Eloquent\Builder;

class AccommodationUnitFilter extends AbstractFilter
{

    public function __construct(AccommodationFilterRequest $request)
    {
        parent::__construct($request);
    }

    public const PEOPLE = 'people';
    public const FACILITY_ID = 'facility_id';
    public const MAX_PRICE = 'max_price';
    public const MIN_PRICE = 'min_price';
    public const RENT_DATE_FROM = 'rent_date_from';

    protected function getCallbacks(): array
    {
        return [
            self::PEOPLE => [$this, 'people'],
            self::FACILITY_ID => [$this, 'facilities'],
            self::MAX_PRICE => [$this, 'maxPrice'],
            self::MIN_PRICE => [$this, 'minPrice'],
            self::RENT_DATE_FROM => [$this, 'rentDateAvailable']
        ];
    }

    public function people(Builder $builder, $people)
    {
        $builder->where('max_count_people', '>=', $people);
    }

    public function rentDateAvailable(Builder $builder, $rent_date_from)
    {
        $builder->where('date_available_from', '<=', $rent_date_from);
    }

    public function facilities(Builder $builder, $facility_id)
    {
        $builder->whereHas('facilities', function (Builder $query) use ($facility_id) {
            $query->whereIn('facility_id', $facility_id);
        });
    }

    public function maxPrice(Builder $builder, $max_price)
    {
        $builder->where('price', '<=', (int) $max_price);
    }

    public function minPrice(Builder $builder, $min_price)
    {
        $builder->where('price', '>=', (int) $min_price);
    }
}
