<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Jpush extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'jpush';
    }
}
