<?php

namespace App\Http\Controllers;

use App\Models\RequestTruck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    public function home()
    {
        return view('home.index');
    }

    // private function getDistances($origin, $destination)
    // {
    //     $google_api_key = 'API_KEY';

    //     $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
    //         'origins' => urlencode($origin),
    //         'destinations' => urlencode($destination),
    //         'key' => $google_api_key,
    //     ]);

    //     $distance_arr = $response->json();

    //     if ($distance_arr['status'] == 'OK') {
    //         $destination_address = $distance_arr['destination_addresses'][0];
    //         $origin_address = $distance_arr['origin_addresses'][0];
    //         $elements = $distance_arr['rows'][0]['elements'][0];

    //         if (empty($origin_address) || empty($destination_address)) {
    //             return [
    //                 'msg' => 'Destination or origin address not found',
    //             ];
    //         }

    //         return [
    //             'destination_addresses' => $destination_address,
    //             'origin_addresses' => $origin_address,
    //             'distance' => $elements['distance']['text'],
    //             'duration' => $elements['duration']['text'],
    //             'msg' => '',
    //         ];
    //     } else {
    //         return [
    //             'msg' => 'The request was invalid',
    //         ];
    //     }
    // }

    // public function getDistance(Request $request)
    // {
    //     $dis_details = $this->getDistances($request->origin, $request->destination);

    //     if (isset($dis_details['distance'])) {
    //         // Extract numeric value from distance (e.g., "12 km" -> 12)
    //         $dist = preg_replace('/[^0-9.]/', '', $dis_details['distance']);
    //         $dist_round = round(floatval($dist));

    //         $data = [
    //             'distance' => $dis_details['distance'],
    //             'duration' => $dis_details['duration'],
    //             'perkg' => '',
    //             'dist' => $dist_round,
    //         ];
    //     } else {
    //         $data = [
    //             'msg' => $dis_details['msg'],
    //         ];
    //     }

    //     return response()->json($data, 200);
    // }

    // public function secondIndex()
    // {
    //     return view('home.index2');
    // }


    public function search()
    {
        return view('home.search');
    }

    private function getDistances($origin, $destination)
    {
        $google_api_key = 'AIzaSyCoWgaHxzX0Z5NyrOQO_ST4gr1u9fzEcIw';

        $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
            'origins' => urlencode($origin),
            'destinations' => urlencode($destination),
            'key' => $google_api_key,
        ]);

        $distance_arr = $response->json();

        if ($distance_arr['status'] == 'OK') {
            $destination_address = $distance_arr['destination_addresses'][0];
            $origin_address = $distance_arr['origin_addresses'][0];
            $elements = $distance_arr['rows'][0]['elements'][0];

            if (empty($origin_address) || empty($destination_address)) {
                return [
                    'msg' => 'Destination or origin address not found',
                ];
            }

            return [
                'destination_addresses' => $destination_address,
                'origin_addresses' => $origin_address,
                'distance' => $elements['distance']['text'],
                'duration' => $elements['duration']['text'],
                'msg' => '',
            ];
        } else {
            return [
                'msg' => 'The request was invalid',
            ];
        }
    }

    public function getDistance(Request $request)
    {
        $dis_details = $this->getDistances($request->pickup, $request->drop);

        if (isset($dis_details['distance'])) {
            // Extract numeric value from distance (e.g., "12 km" -> 12)
            $dist = preg_replace('/[^0-9.]/', '', $dis_details['distance']);
            $dist_round = round(floatval($dist));

            $data = [
                'distance' => $dis_details['distance'],
                'duration' => $dis_details['duration'],
                'perkg' => '',
                'dist' => $dist_round,
            ];
        } else {
            $data = [
                'msg' => $dis_details['msg'],
            ];
        }

        return response()->json($data, 200);
    }


    // private function verifyPincodeViaAPI($pincode)
    // {
    //     $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
    //         'address' => $pincode,
    //         'key' => 'API_KEY',
    //     ]);

    //     if ($response->successful() && isset($response['results']) && count($response['results']) > 0) {
    //         $result = $response['results'][0];
    //         $address_components = $result['address_components'];

    //         $district = null;
    //         $state_name = null;

    //         foreach ($address_components as $component) {
    //             if (in_array('administrative_area_level_3', $component['types'])) {
    //                 $district = $component['long_name'];
    //             }
    //             if (in_array('administrative_area_level_1', $component['types'])) {
    //                 $state_name = $component['long_name'];
    //             }
    //         }

    //         return [
    //             'status' => true,
    //             'district' => $district,
    //             'state_name' => $state_name,
    //             'msg' => 'Pincode verified successfully via Google Maps API.',
    //         ];
    //     }

    //     return [
    //         'status' => false,
    //         'msg' => 'Invalid Pincode or API request failed.',
    //     ];
    // }

    // public function submitPincodeVerification(Request $request)
    // {
    //     $pincode = $request->input('pincode');
    //     $verificationResult = $this->verifyPincodeViaAPI($pincode);

    //     if ($verificationResult['status']) {
    //         return response()->json([
    //             'status' => true,
    //             'msg' => $verificationResult['msg'],
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'msg' => $verificationResult['msg'],
    //         ]);
    //     }
    // }

    // private function verifyPincodeBelongsToCity($pincode, $city)
    // {
    //     $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
    //         'address' => $pincode,
    //         'key' => 'API_KEY',
    //     ]);

    //     if ($response->successful() && isset($response['results']) && count($response['results']) > 0) {
    //         $result = $response['results'][0];
    //         $address_components = $result['address_components'];

    //         $city_name = null;

    //         foreach ($address_components as $component) {
    //             if (in_array('locality', $component['types'])) {
    //                 $city_name = $component['long_name'];
    //             } elseif (in_array('administrative_area_level_2', $component['types'])) {
    //                 // Sometimes the city name might be in administrative_area_level_2
    //                 $city_name = $component['long_name'];
    //             }
    //         }

    //         if ($city_name && stripos($city_name, $city) !== false) {
    //             return [
    //                 'status' => true,
    //                 'msg' => "Pincode $pincode verified successfully for city $city.",
    //             ];
    //         } else {
    //             return [
    //                 'status' => false,
    //                 'msg' => "Pincode $pincode does not belong to the city $city.",
    //             ];
    //         }
    //     }

    //     return [
    //         'status' => false,
    //         'msg' => 'Invalid Pincode or API request failed.',
    //     ];
    // }
    // public function verifyPincodeCity(Request $request)
    // {
    //     $pincode = $request->input('pincode');
    //     $city = $request->input('city');

    //     $verificationResult = $this->verifyPincodeBelongsToCity($pincode, $city);

    //     return response()->json($verificationResult);
    // }
}
