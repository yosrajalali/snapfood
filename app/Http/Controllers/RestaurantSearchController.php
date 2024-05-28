<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RestaurantSearchController extends Controller
{

    public function index(): View
    {
        return view('restaurants_search.index');
    }

    private function getCoordinates($address): ?array
    {
        $client = new Client();
        $response = $client->get('https://nominatim.openstreetmap.org/search', [
            'query' => [
                'q' => $address,
                'format' => 'json',
                'limit' => 1
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        if (!empty($data)) {
            return [
                'lat' => $data[0]['lat'],
                'lon' => $data[0]['lon']
            ];
        }

        return null;
    }

    public function search(Request $request): View|RedirectResponse
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        if (!$latitude || !$longitude) {
            return redirect()->back()->with('error', 'مختصات معتبر نیست.');
        }

        $restaurants = Restaurant::all();
        $nearbyRestaurants = [];

        foreach ($restaurants as $restaurant) {
            $location = $this->getCoordinates($restaurant->address);

            if ($location) {
                $restaurantLatitude = $location['lat'];
                $restaurantLongitude = $location['lon'];

                $distance = $this->haversineGreatCircleDistance($latitude, $longitude, $restaurantLatitude, $restaurantLongitude);

                if ($distance <= 5) {
                    $restaurant->distance = $distance;
                    $nearbyRestaurants[] = $restaurant;
                }
            }
        }

        usort($nearbyRestaurants, function ($a, $b) {
            return $a->distance <=> $b->distance;
        });


        if (empty($nearbyRestaurants)) {
            $message = "هیچ رستورانی در نزدیکی شما یافت نشد.";
        } else {
            $message = null;
        }

        return view('restaurants_search.results', compact('nearbyRestaurants', 'message'));
    }

    private function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371): float|int
    {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $angle * $earthRadius;
    }

}
