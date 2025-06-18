<?php

namespace App\Http\Controllers\Flock;

use App\Http\Controllers\Controller;
use App\Mail\LoginInfoMail;
use App\Models\Flock\Flock;
use App\Models\Flock\FlockDetails;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class FlockUserController extends Controller
{
    public function insertUser(Request $request)
    {

        try {
            // if ($request->input('worker_id')) {
            //     $validatedData = $request->validate([
            //         'worker_id' => 'required',
            //         'flock_id' => 'required|integer|exists:flocks,flock_id',
            //         'role' => 'required|in:fl_supervisor,fl_accountant,fl_assistant',
            //     ]);

            //     $flock = Flock::find($validatedData['flock_id']);
            //     if (!$flock) {
            //         return response()->json(['success' => false, 'message' => 'Flock not found'], 400);
            //     }

            //     $roleToFieldMap = [
            //         'fl_supervisor' => 'flock_supervisor_user_id',
            //         'fl_accountant' => 'flock_accountant_user_id',
            //         'fl_assistant' => 'flock_assistant_user_id',
            //     ];

            //     if (isset($roleToFieldMap[$validatedData['role']])) {
            //         $flock->{$roleToFieldMap[$validatedData['role']]} = $validatedData['worker_id'];
            //     }

            //     $flock->save();

            //     return response()->json(['success' => true, 'message' => 'Flock updated successfully']);
            // } else {

            //     $userId = Auth::user()->id;
            //     $validatedData = $request->validate([
            //         'flock_id' => 'required|integer|exists:flocks,flock_id',
            //         'role' => 'required|in:fl_supervisor,fl_accountant,fl_assistant',
            //         'name' => 'required',
            //         'email' => 'required|unique:users,email',
            //         'phone' => 'nullable',
            //         'address' => 'nullable',
            //         'image' => 'nullable|image',
            //     ]);
            //     if ($request->hasFile('image')) {
            //         $image = $request->file('image');
            //         $imagePath = $image->store('user_images', 'public');
            //         $imageFullPath = 'storage/' . $imagePath;
            //     } else {
            //         $imageFullPath = null;
            //     }
            //     $flock = Flock::find($validatedData['flock_id']);
            //     if (!$flock) {
            //         return response()->json(['success' => false, 'message' => 'Flock not found'], 400);
            //     }
            //     $password = Str::random(8);
            //     $user = User::Create([
            //         'added_user_id' => $userId,
            //         'name' =>  $validatedData['name'],
            //         'user_role' =>  $validatedData['role'],
            //         'email' => $validatedData['email'],
            //         'user_phone' => $validatedData['phone'],
            //         'address' => $validatedData['address'],
            //         'password' => $password,
            //         'user_image' => $imageFullPath,
            //         'module_id' => "2,5",
            //         'user_status' => 1,
            //     ]);
            //     $roleToFieldMap = [
            //         'fl_supervisor' => 'flock_supervisor_user_id',
            //         'fl_accountant' => 'flock_accountant_user_id',
            //         'fl_assistant' => 'flock_assistant_user_id',
            //     ];

            //     if (isset($roleToFieldMap[$validatedData['role']])) {
            //         $flock->{$roleToFieldMap[$validatedData['role']]} = $user->id;
            //     }
            //     $flock->save();
            //     Mail::to($validatedData['email'])->send(new LoginInfoMail(
            //         $validatedData['name'],
            //         $validatedData['email'],
            //         $password 
            //     ));
            //     return response()->json(['success' => true, 'message' => 'Worker add successfully'], 200);

            if ($request->input('worker_id')) {
                $validatedData = $request->validate([
                    'worker_id' => 'required',
                    'flock_id' => 'required|integer|exists:flocks,flock_id',
                    'role' => 'required|in:fl_supervisor,fl_accountant,fl_assistant',
                ]);
            
                $flock = Flock::find($validatedData['flock_id']);
                if (!$flock) {
                    return response()->json(['success' => false, 'message' => 'Flock not found'], 400);
                }
            
                $roleToFieldMap = [
                    'fl_supervisor' => 'flock_supervisor_user_id',
                    'fl_accountant' => 'flock_accountant_user_id',
                    'fl_assistant' => 'flock_assistant_user_id',
                ];
            
                if (isset($roleToFieldMap[$validatedData['role']])) {
                    $flock->{$roleToFieldMap[$validatedData['role']]} = $validatedData['worker_id'];
                }
            
                $flock->save();
            
                return response()->json(['success' => true, 'message' => 'Flock updated successfully']);
            } else {
                $userId = Auth::user()->id;
                $validatedData = $request->validate([
                    'flock_id' => 'required|integer|exists:flocks,flock_id',
                    'role' => 'required|in:fl_supervisor,fl_accountant,fl_assistant',
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'nullable',
                    'address' => 'nullable',
                    'image' => 'nullable|image',
                ]);
            
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imagePath = $image->store('user_images', 'public');
                    $imageFullPath = 'storage/' . $imagePath;
                } else {
                    $imageFullPath = null;
                }
            
                $flock = Flock::find($validatedData['flock_id']);
                if (!$flock) {
                    return response()->json(['success' => false, 'message' => 'Flock not found'], 400);
                }
            
                // Check if user already exists by email
                $user = User::where('email', $validatedData['email'])->first();
            
                if ($user) {
                    // List of restricted roles
                    $restrictedRoles = ['fl_supervisor', 'fl_accountant', 'fl_assistant'];
                
                    // If the user already has a restricted role but is trying to change it, show an error
                    if (in_array($user->user_role, $restrictedRoles) && $user->user_role !== $validatedData['role']) {
                        return response()->json([
                            'success' => false, 
                            'message' => 'User already exists as a ' . $user->user_role . ' and cannot be assigned a different role.'
                        ], 400);
                    }
                
                    // Update user details (role remains the same if unchanged)
                    // $user->name = $validatedData['name'];
                    // $user->user_phone = $validatedData['phone'];
                    // $user->address = $validatedData['address'];
                    $user->user_role = $validatedData['role'];
                    // if ($imageFullPath) {
                    //     $user->user_image = $imageFullPath;
                    // }
                    $user->save();
                } else {
                    // Create new user
                   $password = collect(range(0, 9))->random(8)->implode('');
                    $user = User::create([
                        'added_user_id' => $userId,
                        'name' => $validatedData['name'],
                        'user_role' => $validatedData['role'],
                        'email' => $validatedData['email'],
                        'user_phone' => $validatedData['phone'],
                        'address' => $validatedData['address'],
                        'password' => $password,
                        'user_image' => $imageFullPath,
                        'module_id' => "2,5",
                        'user_status' => 1,
                    ]);
                
                    // Send login details only for new users
                    Mail::to($validatedData['email'])->send(new LoginInfoMail(
                        $validatedData['name'],
                        $validatedData['email'],
                        $password
                    ));
                }
                
                
            
                $roleToFieldMap = [
                    'fl_supervisor' => 'flock_supervisor_user_id',
                    'fl_accountant' => 'flock_accountant_user_id',
                    'fl_assistant' => 'flock_assistant_user_id',
                ];
            
                if (isset($roleToFieldMap[$validatedData['role']])) {
                    $flock->{$roleToFieldMap[$validatedData['role']]} = $user->id;
                }
            
                $flock->save();
            
                return response()->json(['success' => true, 'message' => $user->wasRecentlyCreated ? 'Worker added successfully' : 'Worker updated successfully'], 200);
            }
            
         
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function getUserWorkers()
    {
        $userId = Auth::user()->id;

        $roles = ['fl_supervisor', 'fl_accountant', 'fl_assistant'];
        $workers = User::select('id', 'name', 'email', 'user_image', 'user_phone', 'address', 'user_role')->whereIn('user_role', $roles)->where('added_user_id', $userId)->get();
        foreach ($workers as $worker) {
            $worker->user_image = $worker->user_image ? url($worker->user_image) : null;
        }

        $allWorkers = [
            'supervisors' => $workers->where('user_role', 'fl_supervisor')->values(),
            'accountants' => $workers->where('user_role', 'fl_accountant')->values(),
            'assistants' => $workers->where('user_role', 'fl_assistant')->values(),
        ];

        return response()->json(['success' => true, 'message' => 'Worker get successful', 'workers' => $allWorkers], 200);
    }

    public function deleteUser(Request $request ){
        try {

            $validatedData = $request->validate([
                'worker_id' => 'required|integer|exists:users,id',
                'flock_id' => 'required|integer|exists:flocks,flock_id',
            ]);
            $user = User::find($validatedData['worker_id']);
            $userRole = $user->user_role;

            $flock = Flock::where('flock_id', $validatedData['flock_id'])->first();
            $roleToFieldMap = [
                'fl_supervisor' => 'flock_supervisor_user_id',
                'fl_accountant' => 'flock_accountant_user_id',
                'fl_assistant' => 'flock_assistant_user_id',
            ];
            if (array_key_exists($userRole, $roleToFieldMap)) {
                $fieldToUpdate = $roleToFieldMap[$userRole];
                $flock->$fieldToUpdate = null; // Update the column to null
                $flock->save(); // Save the changes
            }

            $user->user_status = "0";
            $user->save();

            return response()->json(['success' => true, 'message' => 'User deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }

    }
}
