<?php

namespace App\Http\Controllers;

use App\Models\Catching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Node\FunctionNode;

class CatchingController extends Controller
{


    public function createPreCatching(Request $request)
    {

        try {
            $user = Auth::user();
            $validatedData = $request->validate([
                'user_id' => 'required',
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

                $image = $request->file('category_image');
                // Store the image in the 'animal_images' folder and get the file path
                $imagePath = $image->store('catching_images/receipt', 'public'); // stored in 'storage/app/public/animal_images'
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
            $userId = Auth::user()->id;
            $drivers = Catching::select('cat_driver_info')->where('user_id' , $userId )->get();
            return response()->json(['success' => true, 'data' => $drivers], 200);
        } catch (\Exception $e) {
            return response(['success' => false, 'message' => 'Error in fetching drivers', 'error' => $e->getMessage()], 500);
        }
    }

    public function getSingleData($driver_id)
    {
        try {
            $driverId = (int) $driver_id;
            if (!$driverId) {
                return response()->json(['success' => false, 'message' => 'Driver ID is required'], 422);
            }

            $catchings = Catching::whereJsonContains('cat_driver_info->driver_id', $driverId)->get();

            return response()->json(['success' => true, 'data' => $catchings], 200);
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
}
