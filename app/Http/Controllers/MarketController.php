<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Market;
use App\Models\MarketHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MarketController extends Controller
{

    // delete market history
    public function deleteMarketHistory(Request $request)
    {
        try {
            $user = session('user_details');

            $vlaidatedData = $request->validate([
                'market_history_id' => 'required',
            ]);

            $marketHistory = MarketHistory::where('market_history_id', $vlaidatedData['market_history_id'])->first();

            $marketHistory->delete();

            return response()->json(['success' => true, 'message' => 'market history deleted'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // delete market history

    // add market history
    public function addMarketHistory(Request $request)
    {
        try {
            $user = session('user_details');
            $marketHistoryId = $request->input('market_history_id');
            $vlaidatedData = $request->validate([
                'market_id' => 'required',
                'market_rate' => 'required',
                'market_openrate' => 'required',
                'market_closerate' => 'required',
                'market_doc' => 'required',
            ]);

            if ($marketHistoryId) {
                $marketHistory = MarketHistory::where('market_history_id', $marketHistoryId)->first();
                $marketHistory->market_rate = $vlaidatedData['market_rate'];
                $marketHistory->market_openrate = $vlaidatedData['market_openrate'];
                $marketHistory->market_closerate = $vlaidatedData['market_closerate'];
                $marketHistory->market_doc = $vlaidatedData['market_doc'];
                $marketHistory->update();

                return response()->json(['success' => true, 'message' => 'Market history updated'], 200);
            } else {
                $marketHistory = MarketHistory::create([
                    'market_id' => $vlaidatedData['market_id'],
                    'user_id' => $user['id'],
                    'market_rate' => $vlaidatedData['market_rate'],
                    'market_openrate' => $vlaidatedData['market_openrate'],
                    'market_closerate' => $vlaidatedData['market_closerate'],
                    'market_doc' => $vlaidatedData['market_doc'],
                ]);

                return response()->json(['success' => true, 'message' => 'Market history added'], 200);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // add market history

    // get markets
    public function getMarkets()
    {
        $markets = Market::with('marketHistory')->where('market_status', 1)->get();
        $cities = City::select('city_id', 'city_name')->where('city_status', 1)->get();
        foreach ($markets as $market) {
            $market->updated_date = Carbon::parse($market->created_at)->format('M d, Y');
        }
        return view('markets', ['markets' => $markets, 'cities' => $cities]);
    }
    // get markets

    // get market updates
    public function getMarketUpdates()
    {
        $marketsUpdates = Market::with('marketHistory')->where('market_status', 1)->get();
        return view('marketupdates', ['marketUpdates' => $marketsUpdates]);
    }
    // get market updates

    // update market rates
    public function marketRates(Request $request)
    {
        try {
            $user = session('user_details');
            $vlaidatedData = $request->validate([
                'market_id' => 'nullable',
                'market_rate' => 'nullable',
                'market_openrate' => 'nullable',
                'market_closerate' => 'nullable',
                'market_doc' => 'nullable',
            ]);

            $market = Market::where('market_id', $vlaidatedData['market_id'])->first();

            $marketHistory = MarketHistory::create([
                'market_id' => $vlaidatedData['market_id'],
                'user_id' => $user['id'],
                'market_rate' => $market->market_rate,
                'market_openrate' => $market->market_openrate,
                'market_closerate' => $market->market_closerate,
                'market_doc' => $market->market_doc,
            ]);

            $market->market_rate = $vlaidatedData['market_rate'] ?? 0;
            $market->market_openrate = $vlaidatedData['market_openrate'] ?? 0;
            $market->market_closerate = $vlaidatedData['market_closerate'] ?? 0;
            $market->market_doc = $vlaidatedData['market_doc'] ?? 0;

            $market->save();

            return response()->json(['success' => true, 'message' => 'Rates updated'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // update market rates

    // delete market
    public function deleteMarket(Request $request)
    {
        try {
            $user = session('user_details');

            $vlaidatedData = $request->validate([
                'market_id' => 'required',
            ]);

            $market = Market::where('market_id', $vlaidatedData['market_id'])->first();

            $market->market_status = 0;
            $market->save();

            return response()->json(['success' => true, 'message' => 'market deleted'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // delete market

    // add market
    public function addMarket(Request $request)
    {
        try {
            $user = session('user_details');
            $marketId = $request->input('market_id');
            $vlaidatedData = $request->validate([
                'city_id' => 'required',
                'market_name' => 'required',
            ]);

            if ($marketId) {
                $market = Market::where('market_id', $marketId)->first();
                if ($request->hasFile('market_image')) {
                    // Get the path of the image from the animal record
                    $imagePath = public_path($market->market_image); // Get the full image path

                    // Delete the image file if it exists
                    if (!empty($market->market_image) && file_exists($imagePath) && is_file($imagePath)) {
                        unlink($imagePath); // Delete the image from the file system
                    }

                    $image = $request->file('market_image');
                    // Store the image in the 'animal_images' folder and get the file path
                    $imagePath = $image->store('market_images', 'public'); // stored in 'storage/app/public/animal_images'
                    $imageFullPath = 'storage/' . $imagePath;
                    $market->market_image = $imageFullPath ?? null;
                }
                $market->market_name = $vlaidatedData['market_name'];
                $market->city_id = $vlaidatedData['city_id'];

                $market->update();

                return response()->json(['success' => true, 'message' => 'Market update successfully'], 200);
            } else {

                if ($request->hasFile('market_image')) {
                    $image = $request->file('market_image');
                    // Store the image in the 'animal_images' folder and get the file path
                    $imagePath = $image->store('market_images', 'public'); // stored in 'storage/app/public/animal_images'
                    $imageFullPath = 'storage/' . $imagePath;
                }
                $market = Market::create([
                    'added_user_id' => $user['id'],
                    'city_id' => $vlaidatedData['city_id'],
                    'market_name' => $vlaidatedData['market_name'],
                    'market_image' => $imageFullPath ?? null,
                ]);
                return response()->json(['success' => true, 'message' => 'Market updated successfully'], 200);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // add market
}
