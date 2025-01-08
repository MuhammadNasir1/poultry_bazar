<?php

namespace App\Http\Controllers\Flock;

use App\Http\Controllers\Controller;
use App\Models\Flock\Sites;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SitesController extends Controller
{
    public function insert(Request $request)
    {
        try {
            $user = Auth::user();

            $validatedData = $request->validate([
                'site_name' => 'required',
                'site_manager' => 'nullable',
                'site_phone' => 'nullable',
                'site_location' => 'nullable',
                'site_closing_date' => 'nullable',
            ]);
            Sites::create([
                'user_id' => $user->id,
                'site_name' => $validatedData['site_name'],
                'site_manager' => $validatedData['site_manager'],
                'site_phone' => $validatedData['site_phone'],
                'site_location' => $validatedData['site_location'],
                'site_closing_date' => $validatedData['site_closing_date'],

            ]);

            return response()->json(['success' => true, 'message' => 'Site add successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function getSites(){
    $userId = Auth::user()->id;
    $sites = Sites::Where('user_id' , $userId)->get();
    return response()->json(['success' => true, 'sites' => $sites] , 200);
    }
}
