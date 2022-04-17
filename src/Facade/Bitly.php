<?php

namespace Elmsellem\Bitly\Facade;

use Illuminate\Support\Facades\Facade;

class Bitly extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'bitly';
    }
}
