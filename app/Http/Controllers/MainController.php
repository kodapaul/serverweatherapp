<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Utils\OpenWeatherApi;
use File;

class MainController extends Controller
{
    //Tokyo, Yokohama, Kyoto, Osaka, Sapporo, Nagoya
    public function JapanForecast()
    {
        $forecastJapan = [];
        $japanPopCities = ['1857910', '1850144', '1848354', '1853909', '2128295', '1856057'];
        foreach ($japanPopCities as $city) {
            $payload['city_id'] = $city;
            $call = new OpenWeatherApi;
            $call = $call->GetTodaysWeather($payload);
            $call = json_decode($call);
            $forecastJapan[$call->name] = $call;
        }
        return response()->json($forecastJapan, 200);
    }


    public function CurrentWeather(Request $request)
    {
        $payload = [];
        $payload['city_id'] = $request->city_id;
        $api = new OpenWeatherApi;
        $call = $api->GetTodaysWeather($payload);
        $check = json_decode($call);
        $payload['lat'] = $check->coord->lat;
        $payload['lon'] = $check->coord->lon;
        $call7 = $api->GetWeather7Forecast($payload);
        return response()->json(['current' => json_decode($call), 'daily' => json_decode($call7)], 200);
    }

    public function SubWeather(Request $request)
    {
        $payload = [];
        $payload['city_id'] = $request->city_id;
        $call = new OpenWeatherApi;
        $call = $call->GetTodaysWeather($payload);
        return response($call);
    }

    public function Forecast7Days(Request $request)
    {
        $payload = [];
        $payload['lat'] = $request->lat;
        $payload['lon'] = $request->lon;
        $test = new OpenWeatherApi;
        $test = $test->GetWeather7Forecast($payload);
        return response($test);
    }

    public function ListofCities(Request $request)
    {
        if ($request->city == null) {
            return response()->json([], 200);
        } else {
            $cityList = file_get_contents(base_path('public/city_file2.json'));
            $search = $request->city;

            $search =  preg_replace('/[^A-Za-z0-9\-\' ]/', '', $search);

            $newCity = array_filter((array) json_decode($cityList), function ($cityList) use ($search) {
                $word = preg_replace('/[^A-Za-z0-9\-\' ]/', '', strtolower($cityList->complete));
                $pattern = "/$search/i";
                if (preg_match($pattern, $word)) {
                    return $cityList;
                }
            });
            $alp_cities = array_column($newCity, 'name');
            array_multisort($alp_cities, SORT_ASC, $newCity);
            return response()->json($newCity, 200);
        }
    }

    public function ListofCountry()
    {

        //Validate Country if it exists

    }


    //Search Cities with near on foursquare or long and lat


    //Get venue information user the id provided in the search of foursquare


    //Give list of cities based on history city list


    //Get the weather forecast for today


    //Get weather forecast for the next 30 days



}
