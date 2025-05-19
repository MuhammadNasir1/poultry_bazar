<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Market;
use App\Models\Media;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\ForgotPasswordMail;
use App\Mail\otpMail;
use App\Models\requestAccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class UserController extends Controller
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

    public function getModuleUsers($moduleId = null, $view = null)
    {
        if ($moduleId == null && $view == null) {
            return response()->json(['success' => false, 'message' => 'Module ID or View is missing'], 400);
        }
        $users = User::where('module_id', 'like', '%' . $moduleId . '%')->get();
        return view($view, ['users' => $users]);
    }

    public function resetPasswordView()
    {
        return view('resetpassword');
    }

    // reset password
    public function resetPassword(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required',
                'password' => 'required|confirmed',
            ]);

            $hashedUserId = $validatedData['user_id'];
            // Decrypt the hashed user_id
            $user = User::all()->first(function ($user) use ($hashedUserId) {
                return Hash::check($user->id, $hashedUserId);
            });

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            }
            $user->password = $validatedData['password'];
            $user->save();

            return response()->json(['success' => true, 'message' => 'Password has been reset'], 200);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['success' => false, 'message' => 'Invalid user ID'], 400);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // reset password

    // forgot password
    public function forgotPassword(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required',
            ]);

            $user = User::where('email', $validatedData['email'])->where('user_status', 1)->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Please contact your admin'], 400);
            }

            Mail::to($validatedData['email'])->send(new ForgotPasswordMail(Hash::make($user->id)));

            return response()->json(['success' => true, 'message' => 'A mail has been sent to gmail account to reset your password.'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // forgot password
    // get dashboard
    public function getDashboard()
    {
        $user = session('user_details');

        if ($user['user_role'] == 'superadmin') {
            $totalOperators = User::where('user_role', 'operator')->where('user_status', 1)->count();
            $totalCities = City::where('city_status', 1)->count();
            $totalBlogs = Media::where('media_type', 'blogs')->where('media_status', 1)->count();
            $totalDiseases = Media::where('media_type', 'diseases')->where('media_status', 1)->count();

            return view('dashboard', ['totalOperators' => $totalOperators, 'totalCities' => $totalCities, 'totalBlogs' => $totalBlogs, 'totalDiseases' => $totalDiseases]);
        } elseif ($user['user_role'] == 'operator') {
            $totalMarkets = Market::where('market_status', 1)->count();
            $totalBlogs = Media::where('media_type', 'blogs')->where('media_status', 1)->count();
            $totalDiseases = Media::where('media_type', 'diseases')->where('media_status', 1)->count();
            $pendingQuries = 25;
            $blogs = Media::where('media_type', 'blogs')->where('media_status', 1)->orderBy('media_id', 'DESC')->limit(5)->get();
            $diseases = Media::where('media_type', 'diseases')->where('media_status', 1)->orderBy('media_id', 'DESC')->limit(5)->get();
            $consultancy = Media::where('media_type', 'consultancy')->where('media_status', 1)->orderBy('media_id', 'DESC')->limit(5)->get();

            return view('dashboard', ['totalMarkets' => $totalMarkets, 'totalBlogs' => $totalBlogs, 'totalDiseases' => $totalDiseases, 'pendingQuries' => $pendingQuries, 'blogs' => $blogs, 'diseases' => $diseases, 'consultancy' => $consultancy]);
        }
    }
    // get dashboard

    // update user password
    public function updateUserPassword(Request $request)
    {
        try {
            $userDetails = session('user_details');

            // Validate the request data
            $validatedData = $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ]);

            $user = User::where('id', $userDetails['id'])->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            }

            if (!Hash::check($validatedData['old_password'], $user->password)) {
                return response()->json(['success' => false, 'message' => 'The old password is incorrect'], 400);
            }
            $user->password = Hash::make($validatedData['new_password']);
            $user->save();
            return response()->json(['success' => true, 'message' => "Password change successfully"], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // update user password

    // update user details
    public function updateUserDetails(Request $request)
    {
        try {
            $userDetails = session('user_details');
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'nullable',
                'address' => 'nullable',
            ]);
            $user = User::where('id', $userDetails['id'])->first();

            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->user_phone = $validatedData['phone'];
            $user->address = $validatedData['address'];
            if ($request->hasFile('user_image')) {
                // Get the path of the image from the animal record
                $imagePath = public_path($user->user_image); // Get the full image path

                if (!empty($user->user_image) && file_exists($imagePath) && is_file($imagePath)) {
                    unlink($imagePath); // Safely delete the old image
                }


                $image = $request->file('user_image');
                // Store the image in the 'animal_images' folder and get the file path
                $imagePath = $image->store('user_images', 'public'); // stored in 'storage/app/public/animal_images'
                $imageFullPath = 'storage/' . $imagePath;
                $user->user_image = $imageFullPath;
                $userDetails['user_image'] = $imageFullPath;
            }
            $userDetails['name'] = $validatedData['name'];
            $userDetails['email'] = $validatedData['email'];
            session()->put('user_details', $userDetails);

            $user->save();

            return response()->json(['success' => true, 'message' => 'user details updated'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // update user details

    // update user status
    public function updateUserStatus(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'user_id' => 'required',
                'user_status' => 'required',
            ]);

            $user = User::where('id', $validatedData['user_id'])->first();

            $user->user_status = $validatedData['user_status'];
            if ($user->user_verified == 0) {
                $user->user_verified = 1;
            }
            $user->save();

            if ($validatedData['user_status'] == 1) {
                return response()->json(['success' => true, 'message' => 'User activated successfully'], 200);
            } elseif ($validatedData['user_status'] == 0) {
                return response()->json(['success' => true, 'message' => 'User deactivated successfully'], 200);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // update user status

    // get user
    public function getUser($id = null)
    {

        $loggedInUser = session('user_details');

        if ($id != null) {
            $user = User::where('user_id', $id)->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            }

            return view('priveleges', ['user' => $user]);
        } else {
            $user = User::where('id', '<>', $loggedInUser['id'])->where('user_role', 'operator')->get();

            return view('operators', ['users' => $user]);
        }
    }
    // get user

    // verify User and give privileges
    public function addUserPrivileges(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'userId' => 'required',
                'userPrivileges' => 'nullable',
            ]);

            $user = User::where('id', $validatedData['userId'])->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            }

            $user->user_privileges = json_encode($validatedData['userPrivileges']);
            if ($user->user_verified == 0) {
                $user->user_status = 1;
                $user->user_verified = 1;
            }
            $user->save();

            return response()->json(['success' => true, 'message' => 'User verified and activated'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // verify User and give privileges

    // Request for service
    public function RequestForService(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'fullName' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'password' => 'required',
                'module_id' => 'required|array',
                'module_id.*' => 'integer',
            ]);

            $moduleIds = implode(',', $validatedData['module_id']);

            $existingRequest = User::where('email', $validatedData['email'])->where('user_verified', 0)->first();
            $existingUser = User::where('email', $validatedData['email'])->where('user_verified', 1)->first();

            if ($existingRequest) {
                return response()->json(['success' => false, 'message' => 'Request already sent'], 400);
            } elseif ($existingUser) {
                return response()->json(['success' => false, 'message' => 'User already exist'], 400);
            }

            $requestedUser = User::create([
                'name' => $validatedData['fullName'],
                'email' => $validatedData['email'],
                'user_phone' => $validatedData['phone'],
                'password' => $validatedData['password'],
                'module_id' => $moduleIds,
                'user_role' => 'operator',
            ]);

            return response()->json(['success' => true, 'message' => 'Request Sent'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // Request for service

    public function login(Request $request)
    {
        try {

            $email = $request->input('email');
            $token = Str::random(60);
            $password = $request->input('password');
            $user = User::with('city:city_name,city_province')->where('email', $email)->first();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Email or password not found'], 401);
            }
            if ($user && Hash::check($password, $user->password) && $user->user_status == 1) {
                // Create a session for the user
                session(['user_details' => [
                    'token' => $token, // Set token value if needed
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'user_role' => $user->user_role,
                    'city_id' => $user->city_id,
                    'user_image' => $user->user_image ?? null,
                    'city_name' => $user->city->city_name ?? null,
                    'city_province' => $user->city->city_province ?? null,
                    'user_privileges' => json_decode($user->user_privileges) ?? null,
                ]]);

                return response()->json(['success' => true, 'message' => 'Login successful', 'user_details' => session('user_details')]);
            } elseif ($user->user_status != 1) {
                return response()->json(['success' => false, 'message' => 'Please contact your admin'], 400);
            } else {
                // Authentication failed
                return response()->json(['success' => false, 'message' => 'Email or password not found'], 401);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_details');
        $request->session()->regenerate();

        return redirect('/login');
    }

    // get user privileges for view page

    public function getPriveleges($id)
    {
        $user_id = $id;
        $userPrivileges = User::select('user_privileges')->where('id', $user_id)->first();
        $user = User::where('id', $user_id)->first();
        $privileges = json_decode($userPrivileges->user_privileges, true); // First decode
        return view('priveleges', compact('privileges', 'user_id', 'user'));
    }

    // get  user data for profile and settings
    public function settings()
    {
        $user = User::where('id', session('user_details')['id'])->first();
        // return response()->json($user);
        return view('setting', compact('user'));
    }

    // get admin role user
    public function getAdmins()
    {
        $users = User::where('user_role', 'superadmin')->get();
        return view('admins', compact('users'));
    }

    // get pos user

    public function posUsers()
    {

        $users = User::where('module_id', 'like', '%' . 3 . '%')->get();
        return view("pos.users", ['users' => $users]);
    }


    // send forgot mail with otp

    public function sendOtpMail(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);
            $otp = rand(100000, 999999);
            $user = User::where('email', $validatedData['email'])->first();

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            }

            $encryptedUserId = Crypt::encryptString($user->id);

            Mail::to($validatedData['email'])->send(new otpMail($user->email, $otp, $user->id));


            return response()->json(['success' => true, 'message' => "OTP mail sent", 'otp' => $otp, 'key' => $encryptedUserId], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function resetAppPassword(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'password' => 'required|min:8', // Added minimum password length
                'key' => 'required',
            ]);

            try {
                // Decrypt the key to get the user ID
                $user_id = Crypt::decryptString($validatedData['key']);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                return response()->json(['success' => false, 'message' => 'Invalid key provided'], 400);
            }

            // Fetch user by ID
            $user = User::find($user_id);

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            }

            // Update user's password
            $user->password = Hash::make($validatedData['password']);
            $user->save();

            return response()->json(['success' => true, 'message' => 'Password updated successfully'], 200);
            return response()->json(['success' => true, 'message' => "Password Reset"], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // public function insertAccessRequest(Request $request)
    // {
    //     try {
    //         $user = Auth::user();
    //         $validatedData = $request->validate([
    //             'access_module' => 'required|array',
    //             'access_module.*' => 'integer',
    //         ]);


    //         $moduleIds = implode(',', $validatedData['access_module']);

    //         $access = requestAccess::create([
    //             'user_name' => $user->name,
    //             'user_id' => $user->id,
    //             'user_email' => $user->email,
    //             'user_phone' => $user->user_phone ?? null,
    //             'access_module' => $moduleIds,
    //             'access_status' => 0,
    //         ]);

    //         return response()->json(['success' => true, 'message' => 'Your request has been sent. Please wait for approval. It takes 1 to 2 working days', 'data' => $access], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    //     }
    // }

    public function insertAccessRequest(Request $request)
    {
        try {
            $user = Auth::user();

            $validatedData = $request->validate([
                'access_module' => 'required|array',
                'access_module.*' => 'integer',
            ]);

            $moduleIds = implode(',', $validatedData['access_module']);

            // Delete any existing request from the same user for the same module(s)
            requestAccess::where('user_id', $user->id)
                ->where('access_module', $moduleIds)
                ->delete();

            // Create a new access request
            $access = requestAccess::create([
                'user_name' => $user->name,
                'user_id' => $user->id,
                'user_email' => $user->email,
                'user_phone' => $user->user_phone ?? null,
                'access_module' => $moduleIds,
                'access_status' => 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your request has been sent. Please wait for approval. It takes 1 to 2 working days',
                'data' => $access
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function accessRequest()
    {
     $access_requests = requestAccess::with(['module:module_id,module_name'])
    ->orderBy('created_at', 'desc')
    ->get();

        return view("accessRequest", compact("access_requests"));
    }
    public function changeAccessRequest(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|integer',
                'module_id' => 'required|integer',
                'access_id' => 'required|integer',
                'access_start_date' => 'nullable',
                'access_end_date' => 'nullable',
                'status' => 'required|integer|in:0,1,2', // 0: pending, 1: approved, 2: cancel
            ]);

            $user = User::find($validatedData['user_id']);
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 400);
            }

            $access_request = requestAccess::find($validatedData['access_id']);
            if (!$access_request) {
                return response()->json(['success' => false, 'message' => "Request not found"], 400);
            }
            $access_request->access_status = $validatedData['status'];
            $access_request->access_start_date = $validatedData['access_start_date'] ?? null;
            $access_request->access_end_date = $validatedData['access_end_date'] ?? null;

            $access_request->update();

            // Handle user's module_id update
            $existingModules = $user->module_id ? explode(',', $user->module_id) : [];

            if ($validatedData['status'] == 1) {
                // APPROVED: Add module if not already added
                if (!in_array($validatedData['module_id'], $existingModules)) {
                    $existingModules[] = $validatedData['module_id'];
                    sort($existingModules);
                    $user->module_id = implode(',', $existingModules);
                    $user->update();
                }
            } elseif ($validatedData['status'] == 2) {
                // CANCELED: Remove module if exists
                if (in_array($validatedData['module_id'], $existingModules)) {
                    $existingModules = array_filter($existingModules, function ($mod) use ($validatedData) {
                        return $mod != $validatedData['module_id'];
                    });
                    $user->module_id = implode(',', $existingModules);
                    $user->update();
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Access status updated successfully',
                'data' => $user,
                'access' => $access_request
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
