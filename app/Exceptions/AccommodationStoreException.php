<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class AccommodationStoreException extends Exception
{
    public function report()
    {
        Log::debug('Accommodation store problem');
    }
}
