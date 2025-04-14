<?php

namespace App\Http\Controllers;

use App\Models\Catching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\Node\FunctionNode;

class CatchingController extends Controller
{


    public function createPreCatching(Request $request)
    {

        try {
            $user = Auth::user();
            $validatedData = $request->validate([
                'flock_id' => 'required',
                'cat_date' => 'required',
                'cat_receipt' => 'required',
                'cat_driver_info' => 'required',
                'cat_broker_info' => 'required',
                'cat_cp_rate' => 'nullable',
                'cat_healthy_rate' => 'nullable',
                'cat_weight_booked' => 'required',
                'cat_f_online' => 'required',
                'cat_f_cash' => 'required',
                'cat_advance' => 'required',
                'cat_f_cash_notes' => 'required',
                'cat_f_receipt' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',

            ]);


            if ($request->hasFile('cat_f_receipt')) {

                $image = $request->file('cat_f_receipt');
                $imagePath = $image->store('catching_images/receipt', 'public');
                $imageFullPath = 'storage/' . $imagePath;
                $image = $imageFullPath;
            }

            $catching = Catching::create([
                'user_id' => $user->id,
                'flock_id' => $validatedData['flock_id'],
                'cat_date' => $validatedData['cat_date'],
                'cat_receipt' => $validatedData['cat_receipt'],
                'cat_driver_info' => json_encode($validatedData['cat_driver_info'], true),
                'cat_broker_info' => json_encode($validatedData['cat_broker_info'], true),
                'cat_cp_rate' => $validatedData['cat_cp_rate'],
                'cat_healthy_rate' => $validatedData['cat_healthy_rate'],
                'cat_weight_booked' => $validatedData['cat_weight_booked'],
                'cat_f_online' => $validatedData['cat_f_online'],
                'cat_f_cash' => $validatedData['cat_f_cash'],
                'cat_f_cash_notes' => json_encode($validatedData['cat_f_cash_notes'], true),
                'cat_f_receipt' => $image ?? null,
                'cat_advance' => $validatedData['cat_advance'],

            ]);

            return response()->json(['success' => true, 'message' => 'Pre catching created successfully', 'data' => $catching], 200);
        } catch (\Exception $e) {
            return response(['success' => false, 'message' => 'Error in creating pre catching', 'error' => $e->getMessage()], 500);
        }
    }

    public function getDrivers()
    {
        try {
            // $userId = Auth::user()->id;
            // $drivers = Catching::select('cat_driver_info')->where('user_id', $userId)->get();
            $userId = Auth::user()->id;

            $rawDrivers = DB::table('catching')
                ->select('cat_driver_info')
                ->where('user_id', $userId)
                ->get();

            // Decode each JSON object and filter duplicates
            $drivers = collect($rawDrivers)
                ->map(function ($item) {
                    return json_decode($item->cat_driver_info, true);
                })
                ->unique(function ($info) {
                    return $info['driver_id'] . '_' . $info['name'] . '_' . $info['contact'];
                })
                ->values(); // reset the index

            return response()->json(['success' => true, 'data' => $drivers], 200);
        } catch (\Exception $e) {
            return response(['success' => false, 'message' => 'Error in fetching drivers', 'error' => $e->getMessage()], 500);
        }
    }

    public function getBrokers()
    {

        try {
            // $userId = Auth::user()->id;
            // $brokers = Catching::select('cat_broker_info')->where('user_id', $userId)->get();
            $userId = Auth::user()->id;

            $rawBrokers = DB::table('catching')
                ->select('cat_broker_info')
                ->where('user_id', $userId)
                ->get();

            // Decode JSON and remove duplicates by name
            $brokers = collect($rawBrokers)
                ->map(function ($item) {
                    return json_decode($item->cat_broker_info, true);
                })
                ->unique('name')
                ->values();

            return response()->json(['success' => true, 'data' => $brokers], 200);
        } catch (\Exception $e) {
            return response(['success' => false, 'message' => 'Error in fetching brokers', 'error' => $e->getMessage()], 500);
        }
    }

    public function getSingleData($driver_id)
    {
        try {
            $driverId = $driver_id;
            if (!$driverId) {
                return response()->json(['success' => false, 'message' => 'Driver ID is required'], 422);
            }

            // $catchings = Catching::whereJsonContains('cat_driver_info->driver_id', $driverId)->get();
            $catching = Catching::whereJsonContains('cat_driver_info->driver_id', $driverId)->orderByDesc('created_at')->first();

            return response()->json(['success' => true, 'data' => $catching], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error in fetching catchings by driver ID', 'error' => $e->getMessage()], 500);
        }
    }


    public function addDuringCatching(Request $request, $catching_id)
    {
        try {

            $validatedData = $request->validate([
                'cat_empty_weight' => 'required',

            ]);
            $catching = Catching::find($catching_id);
            if (!$catching) {
                return response()->json(['success' => false, 'message' => 'Catching not found'], 404);
            }
            $catching->cat_empty_weight = $validatedData['cat_empty_weight'];
            $catching->update();
            return response()->json(['success' => true, 'data' => $catching], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error in fetching catchings by driver ID', 'error' => $e->getMessage()], 500);
        }
    }

    public function createCatchingGatePass(Request $request, $catching_id)
    {
        try {

            $validatedData = $request->validate([
                'cat_total' => 'required',
                'cat_grand_total' => 'required',
                'cat_load_weight' => 'required',
                'cat_mound_type' => 'required',
                'cat_mound_type' => 'required',
                'cat_second_payment' => 'required',
                'cat_second_cash' => 'nullable',
                'cat_second_online' => 'nullable',
                'cat_second_cash_notes' => 'nullable',
                'cat_remaining' => 'required',
                'cat_second_receipt' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            ]);
            if ($request->hasFile('cat_second_receipt')) {

                $image = $request->file('cat_second_receipt');
                $imagePath = $image->store('catching_images/receipt', 'public');
                $imageFullPath = 'storage/' . $imagePath;
                $image = $imageFullPath;
            }

            $gatePass = Catching::find($catching_id);
            if (!$gatePass) {
                return response()->json(['success' => false, 'message' => 'Catching not found'], 404);
            }
            $gatePass->cat_load_weight = $validatedData['cat_load_weight'];
            $gatePass->cat_mound_type = $validatedData['cat_mound_type'];
            $gatePass->cat_second_payment = $validatedData['cat_second_payment'];
            $gatePass->cat_second_cash = $validatedData['cat_second_cash'];
            $gatePass->cat_second_online = $validatedData['cat_second_online'];
            $gatePass->cat_second_cash_notes = json_encode($validatedData['cat_second_cash_notes'], true);
            $gatePass->cat_remaining = $validatedData['cat_remaining'];
            $gatePass->cat_second_receipt = $image ?? null;
            $gatePass->cat_total = $validatedData['cat_total'];
            $gatePass->cat_grand_total = $validatedData['cat_grand_total'];
            $gatePass->update();
            return response()->json(['success' => true, 'message' => 'GatePass added successfully', 'data' => $gatePass], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error in fetching catchings by driver ID', 'error' => $e->getMessage()], 500);
        }
    }
}
