<?php

namespace App\Http\Utils;

use Illuminate\Support\Facades\Http;

class OpenWeatherApi
{

    private $uri = 'api.openweathermap.org/data/2.5/';
    private $app_id = '218ca7a1da3ecd38966ec62bfc3c562d';

    function sample()
    {
        $response = Http::get(
            //url
            $this->uri.'/forecast',
            //Query parameters
            [
                'q'=>'tokyo',
                'appid'=>$this->app_id,
                'units'=>'metric'
            ]
        );

        return $response->body();
    }

    //Payload consist of city id
    function GetTodaysWeather($payload){
        
        $response = Http::get(
            //url
            $this->uri.'/weather',
            //Query parameters
            [
                'id'=>$payload['city_id'],
                'appid'=>$this->app_id,
                'units'=>'metric',
            ]
        );

        return $response->body();
    }

    //Payload consist of city id
    function GetWeather7Forecast($payload){
        $response = Http::get(
            //url
            $this->uri.'/onecall',
            //Query parameters
            [
                'lat'=>$payload['lat'],
                'lon'=>$payload['lon'],
                'exclude'=>'current,minutely',
                'appid'=>$this->app_id,
                'units'=>'metric',
            ]
        );

        return $response->body();
    }
}
