<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    // // user Defined
    // protected function errorResponse(Exception $e, $code = 400): JsonResponse
    // {
    //     return response()->json([
    //         'success' => false,
    //         'message' => $e->getMessage(),
    //     ], $code);
    // }
    // // user Defined

    // delete cities
    public function deleteCities(Request $request)
    {
        $validatedData = $request->validate([
            'city_id' => 'required',
        ]);

        $city = City::where('city_id', $validatedData['city_id'])->first();

        $city->city_status = 0;
        $city->save();

        return response()->json(['success' => true, 'message' => 'City deleted successfully'], 200);
    }
    // delete cities

    // add cities
    public function addCities(Request $request)
    {
        try {
            $cityId = $request->input('city_id');
            $validatedData = $request->validate([
                'city_name' => 'required',
                'city_province' => 'required'
            ]);

            if (isset($cityId) && $cityId != null) {
                $city = City::where('city_id', $cityId)->first();

                $city->city_name = $validatedData['city_name'];
                $city->city_province = $validatedData['city_province'];
                $city->save();

                return response()->json(['success' => true, 'message' => 'City updated successfully'], 200);
            } else {
                $existingCity = City::where('city_name', $validatedData['city_name'])
                    ->where('city_province', $validatedData['city_province'])
                    ->first();

                if ($existingCity && $existingCity->city_status == 0) {
                    $existingCity->city_status = 1;
                    $existingCity->save();
                    return response()->json(['success' => true, 'message' => 'City added successfully'], 200);
                }elseif ($existingCity && $existingCity->city_status == 1) {
                    return response()->json(['success' => false, 'message' => 'City already existed'], 400);
                }else{
                    $city = City::create([
                        'city_name' => $validatedData['city_name'],
                        'city_province' => $validatedData['city_province'],
                    ]);
    
                    return response()->json(['success' => true, 'message' => 'City added successfully'], 200);
                }
            }
        } catch (\Exception $e) {
            $this->errorResponse($e);
        }
    }
    // add cities

    // get cities
    public function getCities()
    {
        $cities = City::where('city_status', 1)->get();

        return view('cities', ['cities' => $cities]);
    }
    // get cities
}
