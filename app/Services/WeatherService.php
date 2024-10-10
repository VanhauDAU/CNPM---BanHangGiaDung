<?php
namespace App\Services;

use GuzzleHttp\Client;

class WeatherService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = '9b4d8cb2b1693400d748a35733e217a4'; // Thay đổi API key nếu cần
    }

    public function getWeather($lat, $lon)
    {
        $url = 'https://api.openweathermap.org/data/2.5/weather';

        try {
            $response = $this->client->request('GET', $url, [
                'query' => [
                    'lat' => $lat,
                    'lon' => $lon,
                    'appid' => $this->apiKey,
                    'units' => 'metric'
                ]
            ]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => 'Unable to fetch weather data'];
        }
    }
}
