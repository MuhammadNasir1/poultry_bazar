<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Market;
use App\Models\MarketHistory;
use App\Models\Media;
use App\Models\PosPurchase;
use App\Models\Products;
use App\Models\Queries;
use App\Models\User;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    // get Notifications
    // public function getNotifications()
    // {
    //     $notifications = Queries::get();
    // }
    // get Notifications

    // delete pos purchase
    public function deletePosPurchase(Request $request)
    {
        try {
            $purchaseId = $request->input('purchase_id');
            $posPurchase = PosPurchase::where('purchase_id', $purchaseId)->first();
            $product = Products::where('product_id', $posPurchase->product_id)->first();
            if ($product) {
                $product->product_stock -= $posPurchase->purchase_weight_quantity; // Deduct stock
                $product->save();
            }
            $posPurchase->delete();

            return response()->json(['success' => true, 'message' => 'Purchase deleted'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // delete pos purchase

    // get pos purchase
    public function getPosPurchase()
    {
        $user = Auth::user();
        $posPurchase = PosPurchase::with('product')->where('user_id', $user->id)->where('purchase_status', 1)->get();

        return response()->json(['success' => true, 'data' => $posPurchase], 200);
    }
    // get pos purchase

    // add pos purchase
    public function createPosPurchase(Request $request)
    {
        try {
            $user = Auth::user();
            $purchaseId = $request->input('purchase_id');
            $validatedData = $request->validate([
                'product_id' => 'required|integer',
                'supplier_name' => 'nullable|string',
                'purchase_date' => 'required|date',
                'purchase_weight_quantity' => 'required|numeric',
                'purchase_rate' => 'required|numeric',
                'purchase_amount' => 'required|numeric',
                'purchase_comments' => 'nullable|string',
            ]);

            $validatedData['purchase_date'] = date('Y-m-d', strtotime($validatedData['purchase_date']));

            if ($purchaseId != null) {
                $recentPurchase = PosPurchase::where('purchase_id', $purchaseId)->first();
                  // Step 1: Rollback old stock (subtract the previously added stock)
            $product = Products::where('product_id', $recentPurchase->product_id)->first();
            if ($product) {
                $product->product_stock -= $recentPurchase->purchase_weight_quantity;
                $product->save();
            }


                $recentPurchase->update([
                    'user_id' => $user->id,
                    'product_id' => $validatedData['product_id'],
                    'supplier_name' => $validatedData['supplier_name'],
                    'purchase_date' => $validatedData['purchase_date'],
                    'purchase_weight_quantity' => $validatedData['purchase_weight_quantity'],
                    'purchase_rate' => $validatedData['purchase_rate'],
                    'purchase_amount' => $validatedData['purchase_amount'],
                    'purchase_comments' => $validatedData['purchase_comments'],
                ]);
                $products = Products::select('product_id', 'product_stock')->where('product_id', $validatedData['product_id'])->first();

                if ($products) {
                    $products->product_stock += $validatedData['purchase_weight_quantity']; 
                    $products->save(); 
                }
            return response()->json(['success' => true, 'message' => 'Purchase updated'], 200);
                
            } else {
                $posPurchase = PosPurchase::create([
                    'user_id' => $user->id,
                    'product_id' => $validatedData['product_id'],
                    'supplier_name' => $validatedData['supplier_name'],
                    'purchase_date' => $validatedData['purchase_date'],
                    'purchase_weight_quantity' => $validatedData['purchase_weight_quantity'],
                    'purchase_rate' => $validatedData['purchase_rate'],
                    'purchase_amount' => $validatedData['purchase_amount'],
                    'purchase_comments' => $validatedData['purchase_comments'],
                ]);

                $products = Products::select('product_id', 'product_stock')->where('product_id', $validatedData['product_id'])->first();
            
            if ($products) {
                $products->product_stock += $validatedData['purchase_weight_quantity']; 
                $products->save(); 
            }
                return response()->json(['success' => true, 'message' => 'Purchase added'], 200);
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // add pos purchase

    // get FAQs
    public function getFAQs()
    {
        $FAQs = FAQ::get();

        return response()->json(['success' => true, 'data' => $FAQs], 200);
    }
    // get FAQs

    // update User
    public function updateUser(Request $request)
    {
        try {
            $loggedInUser = Auth::user();

            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255',
                'email' => 'nullable|email',
                'address' => 'nullable|string|max:500',
                'password' => 'nullable|string|min:8',
            ]);

            $user = User::where('id', $loggedInUser->id)->first();

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
            }

            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->address = $validatedData['address'];
            $user->password = hash::make($validatedData['password']);
            $user->save();

            return response()->json(['success' => true, 'message' => 'User updated'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // update User

    // get User
    public function getUser()
    {
        $user = Auth::user();

        return response()->json(['success' => true, 'data' => $user, 'company' => $user->company, 'modules' => $user->modules], 200);
    }
    // get User

    // logout
    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json(['success' => true, 'message' => 'Logged out successfully'], 200);
    }
    // logout

    // login
    public function login(Request $request)
    {
        try {
            $email = $request->input('email');
            $password = $request->input('password');
            $user = User::where('email', $email)->first();

            if (!$user || !Hash::check($password, $user->password) && $user->user_role != 'appuser') {
                return response()->json(['success' => false, 'message' => 'Invalid credentials'], 401);
            }

            // Generate a personal access token for the user
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json(['success' => true, 'message' => 'Login successful!', 'token' => $token, 'company' => $user->company, 'modules' => $user->modules, 'user_details' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
    // login

    // register
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'address' => 'required|string|max:500',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
                'password' => $validatedData['password'],
                'user_role' => 'appuser',
                'module_id' => '2',
                'user_status' => 1,
            ]);

            return response()->json(['success' => true, 'message' => 'Registration successfull'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // register

    // add query
    public function addQuery(Request $request)
    {
        try {
            $user = Auth::user();
            $validatedData = $request->validate([
                'query_subject' => 'required',
                'query_message' => 'required',
            ]);

            $query = Queries::create([
                'added_user_id' => $user->id,
                'query_subject' => $validatedData['query_subject'],
                'query_message' => $validatedData['query_message'],
            ]);

            return response()->json(['success' => true, 'message' => 'Query has been sent to our team. You will get the notification soon.'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // add query

    // get media
    public function getMedia($type = null)
    {
        if ($type == 'blogs') {
            $media = Media::with('category:category_id,category_name')->where('media_type', $type)->where('media_status', 1)->get();
            foreach($media as $value) {
                $value->user_name = user::where('id', $value->added_user_id)->value('name');
                $value->user_image = asset(user::where('id', $value->added_user_id)->value('user_image'));
                $value->media_description = json_decode($value->media_description);
            }
        } elseif ($type == 'diseases') {
            $media = Media::with('category:category_id,category_name')->where('media_type', $type)->where('media_status', 1)->get();
            foreach($media as $value) {
                $value->user_name = user::where('id', $value->added_user_id)->value('name');
                $value->user_image =  asset(user::where('id', $value->added_user_id)->value('user_image'));
                $value->media_description = json_decode($value->media_description);
            }
        } elseif ($type == 'consultancy') {
            $media = Media::with('category:category_id,category_name')->where('media_type', $type)->where('media_status', 1)->get();
            foreach($media as $value) {
                $value->user_name = user::where('id', $value->added_user_id)->value('name');
                $value->user_image =  asset(user::where('id', $value->added_user_id)->value('user_image'));
                $value->media_description = json_decode($value->media_description);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Please select type']);
        }

        if ($media->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No media found.',
                'data' => [],
            ], 404);
        }

        return response()->json(['success' => true, 'data' => $media], 200);
    }
    // get media

    // get market rates
    public function getMarketRates(Request $request)
    {
        try {
            // Validate the incoming request
            $validatedData = $request->validate([
                'market_ids' => 'nullable|array', // Allow market_ids to be nullable
            ]);

            // Retrieve the markets based on the provided IDs or fetch all markets if IDs are null
            if ($request->input('key') === 'all') {
                $markets = Market::where('market_status', 1)->get();
            } elseif ($request->input('key') === null) {
                $markets = Market::where('market_status', 1)->limit(4)->get();
            } else {
                $markets = isset($validatedData['market_ids']) && !empty($validatedData['market_ids'])
                    ? Market::whereIn('market_id', $validatedData['market_ids'])->where('market_status', 1)->get()
                    : Market::where('market_status', 1)->limit(4)->get();
            }

            // Check if markets were found
            if ($markets->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No markets found.',
                    'data' => [],
                ], 404);
            }

            // Return the markets as a JSON response
            return response()->json([
                'success' => true,
                'data' => $markets,
            ], 200);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., validation errors)
            return $this->errorResponse($e);
        }
    }
    // get market rates

    // get market history
    public function getMarketHistory(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'marketId' => 'required|integer',
                'filterBy' => 'nullable|string|in:daily,weekly,monthly',
                'from_date' => 'nullable|date',
                'to_date' => 'nullable|date'
            ]);

            $query = MarketHistory::where('market_id', $validatedData['marketId']);

            if (isset($validatedData['filterBy'])) {
                switch ($validatedData['filterBy']) {
                    case 'daily':
                        $query->whereDate('created_at', now()->toDateString());
                        break;
                    case 'weekly':
                        $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                        break;
                    case 'monthly':
                        $query->whereMonth('created_at', now()->month)
                              ->whereYear('created_at', now()->year);
                        break;
                }
            }

            if (!empty($validatedData['from_date']) && !empty($validatedData['to_date'])) {
                $query->whereBetween('created_at', [$validatedData['from_date'], $validatedData['to_date']]);
            }

            $marketHistory = $query->get();

            foreach ($marketHistory as $history) {
                $market_name = Market::where('market_id', $history->market_id)->value('market_name');
                $history->market_name = $market_name;
            }

            return response()->json(['success' => true, 'data' => $marketHistory], 200);

        } catch (\Exception $e) {
            $this->errorResponse($e);
        }
    }
    // get market history

    // get markets
    public function getMarkets()
    {
        $markets = Market::select('market_id', 'market_name')->where('market_status', 1)->get();

        return response()->json(['success' => true, 'markets' => $markets], 200);
    }
    // get markets
}
