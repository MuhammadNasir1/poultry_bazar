<?php

namespace App\Http\Controllers\ECommerce;

use App\Http\Controllers\Controller;
use App\Models\ECommerce\EcomProducts;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EcomProductsController extends Controller
{

    public function insert(Request $request)
    {

        try {
            $user = Auth::user();
            $validatedData  =  $request->validate([
                'company_id' => 'required',
                'ecom_product_name' => 'required',
                'ecom_product_category' => 'required',
                'ecom_product_brand' => 'nullable',
                'ecom_product_price' => 'required',
                'ecom_product_unit' => 'nullable',
                'ecom_product_description' => 'nullable',
                'mediasLinks' => 'nullable|array',

            ]);


            $mediaLinks = [];

            if ($request->has('mediasLinks') && is_array($request->mediasLinks)) {
                foreach ($request->mediasLinks as $file) {
                    if ($file instanceof \Illuminate\Http\UploadedFile) {
                        $existingFilePath = public_path($file->getClientOriginalName());
                        if (!empty($existingFilePath) && file_exists($existingFilePath)) {
                            unlink($existingFilePath); // Delete the file from the file system
                        }
                        $filePath = $file->store('eCommerceMediaImages', 'public');
                        $mediaLinks[] = 'storage/' . $filePath;
                    }
                }
            }
            // Encode the media links array as JSON
            $mediaLinksJson = json_encode($mediaLinks);



            $eCommerceData = EcomProducts::create([
                'company_id' => $validatedData['company_id'],
                'user_id' => $user->id,
                'ecom_product_name' => $validatedData['ecom_product_name'],
                'ecom_product_category' => $validatedData['ecom_product_category'],
                'ecom_product_brand' => $validatedData['ecom_product_brand'],
                'ecom_product_price' => $validatedData['ecom_product_price'],
                'ecom_product_unit' => $validatedData['ecom_product_unit'],
                'ecom_product_description' => $validatedData['ecom_product_description'],
                'ecom_product_media' => $mediaLinksJson,
            ]);

            return response()->json(['success' => true, 'message' => 'Product add successfully', 'data' => $eCommerceData], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,  'message'  => $e->getMessage()], 500);
        }
    }


    public function updateProduct(Request $request, $product_id)
    {
        try {
            $product = EcomProducts::find($product_id);
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found'], 200);
            }

            $validatedData  =  $request->validate([
                'company_id' => 'required',
                'ecom_product_name' => 'required',
                'ecom_product_category' => 'required',
                'ecom_product_brand' => 'nullable',
                'ecom_product_price' => 'required',
                'ecom_product_description' => 'nullable',
                'ecom_product_unit' => 'nullable',
                'mediasLinks' => 'nullable|array',

            ]);
            $mediaLinks = [];


            if ($request->has('mediasLinks') && is_array($request->mediasLinks)) {
                foreach ($request->mediasLinks as $file) {
                    if (is_string($file)) {
                        // If it's a string (old file), check if it exists in the storage
                        $filePath = str_replace('storage/', '', $file);
                        if (Storage::disk('public')->exists($filePath)) {
                            // Add the old file path (string) to the mediaLinks array
                            $mediaLinks[] = $file;
                        }
                    } elseif ($file instanceof \Illuminate\Http\UploadedFile) {
                        // If it's a new file, handle the replacement logic
                        $fileName = $file->getClientOriginalName();
                        $existingFilePath = 'eCommerceMediaImages/' . $fileName;

                        // If an existing file with the same name is found, delete it
                        if (Storage::disk('public')->exists($existingFilePath)) {
                            Storage::disk('public')->delete($existingFilePath);
                        }

                        // Store the new file
                        $filePath = $file->store('eCommerceMediaImages', 'public');
                        $newFileUrl = Storage::url($filePath);

                        // Add the new file's URL to the mediaLinks array
                        $mediaLinks[] = $newFileUrl;
                    }
                }
            }

            // Encode the media links array as JSON
            $mediaLinksJson = json_encode($mediaLinks);





            $product->company_id = $validatedData['company_id'];
            $product->ecom_product_name = $validatedData['ecom_product_name'];
            $product->ecom_product_category = $validatedData['ecom_product_category'];
            $product->ecom_product_brand = $validatedData['ecom_product_brand'];
            $product->ecom_product_price = $validatedData['ecom_product_price'];
            $product->ecom_product_unit = $validatedData['ecom_product_unit'];
            $product->ecom_product_description = $validatedData['ecom_product_description'];
            $product->ecom_product_media = $mediaLinksJson;
            $product->update();

            return response()->json(['success' => true, 'message' => 'Product update successfully', 'data' => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function getEcomProduct(Request $request)
    {
        if ($request->has('company_id')) {
            $products = EcomProducts::where('ecom_product_status', 1)->where('company_id', $request['company_id'])->get();
        } else {
            $products = EcomProducts::where('ecom_product_status', 1)->get();
        }
        $categories = [];
        foreach ($products as $product) {
            $product->ecom_product_media = json_decode($product->ecom_product_media, true);
            if (is_array($product->ecom_product_media)) {
                $product->ecom_product_media = array_map(fn($media) => asset($media), $product->ecom_product_media);
            }
            if (!in_array($product->ecom_product_category, array_column($categories, 'category_name'))) {
                $categories[] = [
                    'category_name' => $product->ecom_product_category
                ];
            }
            $company = Company::where('company_id', $product->company_id)->first();
            $product->company = $company;
        }


        $response = [
            'products' => $products,
            'categories' => $categories,
        ];
        return response()->json(['success' => true, 'message' => 'Data get successfully', 'data' => $response], 200);
    }

    public function deleteProduct($product_id)
    {
        try {
            $product = EcomProducts::find($product_id);
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found'], 200);
            }
            $product->ecom_product_status = 0;
            $product->save();
            return response()->json(['success' => true, 'message' => 'Product delete successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function createBoostedProduct($product_id)
    {
        try {
            $product = EcomProducts::find($product_id);
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found'], 200);
            }
            $product->ecom_product_boosted = 1;
            $product->save();
            return response()->json(['success' => true, 'message' => 'Product boosted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function removeBoostedProduct($product_id)
    {
        try {
            $product = EcomProducts::find($product_id);
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found'], 200);
            }
            $product->ecom_product_boosted = 0;
            $product->save();
            return response()->json(['success' => true, 'message' => 'Product boosted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function AddEcomViews($product_id)
    {
        try {
            $product = EcomProducts::find($product_id);
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found'], 200);
            }
            $product->ecom_product_count = $product->ecom_product_count + 1;
            $product->save();
            return response()->json(['success' => true, 'message' => 'Product view  counted'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
