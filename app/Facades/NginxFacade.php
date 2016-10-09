<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class NginxFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Services\Nginx::class;;
    }
}