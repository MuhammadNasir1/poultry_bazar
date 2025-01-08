<?php

namespace App\Http\Controllers\Flock;

use App\Http\Controllers\Controller;
use App\Models\Flock\Flock;
use App\Models\Flock\FlockDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Catch_;

class FlockController extends Controller
{
    // Helper function to check if a string is JSON
    private function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
    public function insertFlock(Request $request)
    {

        try {

            $user = Auth::user();

            $validatedData = $request->validate([
                'flock_site_id' => 'required',
                'flock_name' => 'required',
                'farmer_name' => 'nullable',
                'flock_image' => 'nullable|image',
            ]);

            if ($request->hasFile('flock_image')) {
                $image = $request->file('flock_image');
                $imagePath = $image->store('flock_images', 'public');
                $imageFullPath = 'storage/' . $imagePath;
            }
            $flock =  Flock::create([
                'user_id' => $user->id,
                'flock_site_id' => $validatedData['flock_site_id'],
                'flock_name' => $validatedData['flock_name'],
                'farmer_name' => $validatedData['farmer_name'],
                'flock_image' => $imageFullPath ?? null,

            ]);

            FlockDetails::Create([
                'flock_id' => $flock->flock_id,
            ]);
            return response()->json(['success' => true, 'message' => 'Flock add successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    public function insertDetails(Request $request, $type)
    {
        try {

            $validatedData = $request->validate([
                'flock_id' => 'required|exists:flock_details,flock_id',
                $type => 'required|array',
            ]);

            $newData = $validatedData[$type];

            // Normalize `newData` to remove numeric keys
            $newData = array_values($newData);

            $flock_detail = FlockDetails::where('flock_id', $validatedData['flock_id'])->first();

            $existingData = json_decode($flock_detail->$type, true) ?? [];

            // Normalize `existingData` to remove numeric keys
            $existingData = array_values($existingData);

            $updatedData = array_merge($existingData, $newData);

            $flock_detail->$type = json_encode($updatedData);
            $flock_detail->save();

            return response()->json(['success' => true, 'message' => 'Flock details add successfully', 'data' => $updatedData], 200);



            // $validatedData = $request->validate([
            //     'flock_id' => 'required|exists:flock_details,flock_id',
            //     $type => 'required|Array',
            // ]);

            // $data = json_encode($validatedData[$type], true);

            // $flock_detail = FlockDetails::where('flock_id', $validatedData['flock_id'])->first();
            // $flock_detail->$type = $data;
            // $flock_detail->save();

            // return response()->json(['success' => true, 'message' => 'Flock details added successfully', 'data' => $data], 200);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function getSiteFlocks($site_id = null)
    {
        $user = Auth::user();
        $user_role = $user->user_role;
        // if (isset($site_id)) {
        //     $flocks = Flock::where('flock_site_id', $site_id)->get();
        // } else {
        //     $flocks = Flock::all();
        // }

        if ($user_role == 'fl_supervisor') {
            $flocks = Flock::where('flock_supervisor_user_id', $user->id);
        } elseif ($user_role == 'fl_accountant') {
            $flocks = Flock::where('flock_accountant_user_id', $user->id);
        } elseif ($user_role == 'fl_assistant') {
            $flocks = Flock::where('flock_assistant_user_id', $user->id);
        } elseif ($user_role == 'appuser') {
            $flocks = Flock::where('user_id', $user->id);
        } else {
            return response()->json(['success' => false, 'message' => "Invalid user role"], 400);
        }
        if (isset($site_id)) {
            $flocks = $flocks->where('flock_site_id', $site_id);
        }

        $flocks = $flocks->get();


        if (!$flocks) {
            return response()->json(['success' => false, 'message' =>  "site not found"], 200);
        }

        $allUserIds = $flocks->pluck('flock_supervisor_user_id')->merge($flocks->pluck('flock_accountant_user_id'))->merge($flocks->pluck('flock_assistant_user_id'))->filter()
            ->unique();
        $users = User::select('id', 'name', 'user_role', 'user_image', 'email')->whereIn('id', $allUserIds)->get()->keyBy('id');

        foreach ($users as $user) {
            if (isset($user->user_image)) {
                $user->user_image = url($user->user_image);
            }
        }
        foreach ($flocks as $flock) {
            $created_at = $flock->created_at;
            if (isset($flock->flock_image)) {
                $flock->flock_image = url($flock->flock_image);
            }
            $flock->days = abs(floor($created_at ? now()->diffInDays($created_at) : 0));
            $flock->supervisor = $users->get($flock->flock_supervisor_user_id);
            $flock->accountant = $users->get($flock->flock_accountant_user_id);
            $flock->assistant = $users->get($flock->flock_assistant_user_id);
            $details  = FlockDetails::where('flock_id', $flock->flock_id)->first();

            if ($details) {
                $decodedDetails = [];

                // Iterate through each attribute of the details
                foreach ($details->toArray() as $key => $value) {
                    // Decode if the value is JSON-encoded; otherwise, keep it as is
                    $decodedDetails[$key] = is_string($value) && $this->isJson($value) ? json_decode($value, true) : $value;
                }

                // Attach decoded details to the flock object
                $flock->details = $decodedDetails;
            } else {
                $flock->details = null; // Handle the case where no details are found
            }

            // if ($user_role == 'fl_supervisor') {
            //     $details  = FlockDetails::where('flock_id', $flock->flock_id)->first();
            //     $flock->supervisor->details  = $details;
            // } elseif ($user_role == 'fl_accountant') {
            //     $details  = FlockDetails::where('flock_id', $flock->flock_id)->first();
            //     $flock->accountant->details  = $details;
            // } elseif ($user_role == 'fl_assistant') {
            //     $details  = FlockDetails::where('flock_id', $flock->flock_id)->first();
            //     $flock->assistant->details  = $details;
            // } elseif ($user_role == 'appuser') {
            //     $details  = FlockDetails::where('flock_id', $flock->flock_id)->first();
            //     $flock->details  = $details;
            // }



            // $flock->supervisor->details = $flock->supervisor->user_role;
        }
        return response()->json(['success' => true, 'message' =>  "Flocks get successfully", 'flocks' => $flocks, "role" => $user_role], 200);
        // $flock->total_birds = 0;
        // $flock->doc_birds = 0;
        // $flock->dead_birds = 0;


        // $flock->total_feed = 0;
        // $flock->purchase_feed = 0;
        // $flock->consumed_feed = 0;


        // $flock->daily_water = 0;
        // $flock->weekly_water = 0;
        // $flock->total_water = 0;
    }

    public function insertMortality(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'flock_id' => 'required|exists:flock_details,flock_id',

            ]);

            $newData = $validatedData[$type];

            $flock_detail = FlockDetails::where('flock_id', $validatedData['flock_id'])->first();

            $existingData = json_decode($flock_detail->fd_mortality, true) ?? [];

            $updatedData = array_merge($existingData, $newData);

            $flock_detail->fd_mortality = json_encode($updatedData);
            $flock_detail->save();

            return response()->json(['success' => true, 'message' => 'Flock details add successfully', 'data' => $updatedData], 200);





            $validatedData = $request->validate([
                'flock_id' => 'required|exists:flock_details,flock_id',
                'fd_mortality' => 'required|array',

            ]);

            $newData = $validatedData['fd_mortality'];

            // Normalize `newData` to remove numeric keys
            $newData = array_values($newData);

            $flock_detail = FlockDetails::where('flock_id', $validatedData['flock_id'])->first();

            $existingData = json_decode($flock_detail->fd_mortality, true) ?? [];

            // Normalize `existingData` to remove numeric keys
            $existingData = array_values($existingData);

            $updatedData = array_merge($existingData, $newData);

            $flock_detail->fd_mortality = json_encode($updatedData);
            $flock_detail->save();
            return response()->json(['success' => true, 'message' => 'Flock details add successfully', 'data' => $updatedData], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function getFlockDetails($type)
    {
        $user = Auth::user();
        $user_role = $user->user_role;
        $flocks = Flock::all();
        if ($user_role == 'fl_supervisor') {
            $flocks = Flock::where('flock_supervisor_user_id', $user->id)->get();
        } elseif ($user_role == 'fl_accountant') {
            $flocks = Flock::where('flock_accountant_user_id', $user->id)->get();
        } elseif ($user_role == 'fl_assist  ant') {
            $flocks = Flock::where('flock_assistant_user_id', $user->id)->get();
        } elseif ($user_role == 'appuser') {
            $flocks = Flock::where('user_id', $user->id)->get();
        }

        foreach ($flocks as $flock) {
            $flock_details = FlockDetails::where('flock_id', $flock->flock_id)->first();
            $flock->flock_image = url($flock->flock_image);
            $data = json_decode($flock_details->$type, true) ?? [];
            $flock->flock_details = $data;
        }
        // $flock_detail = FlockDetails::where('flock_id', $flock->flock_id)->first();
        // if(!$flock_detail){
        //     return response()->json(['success' => false, 'message' => 'Flock details not found'], 200);
        // }

        return response()->json(['success' => true, 'message' => 'Flock details get successfully', 'data' => $flocks], 200);
    }
}
