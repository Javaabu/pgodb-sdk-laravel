<?php

namespace Javaabu\PgoDbAPI\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Javaabu\PgoDbAPI\PgoDbAPI
 */
class PgoDbAPI extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'pgodb-api';
    }
}
