<?php

namespace App\Http\Controllers\ECommerce;

use App\Http\Controllers\Controller;
use App\Models\ECommerce\EcomProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                'ecom_product_brand' => 'required',
                'ecom_product_price' => 'required',
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
                'ecom_product_description' => $validatedData['ecom_product_description'],
                'ecom_product_media' => $mediaLinksJson,
            ]);

            return response()->json(['success' => true, 'message' => 'Product add successfully', 'data' => $eCommerceData], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false,  'message'  => $e->getMessage()], 500);
        }
    }

    public function getEcomProduct()
    {
        $products = EcomProducts::where('ecom_product_status', 1)->get();
        $categories = [];

        foreach ($products as $product) {
            $product->ecom_product_media = json_decode($product->ecom_product_media);
            if (!in_array($product->ecom_product_category, $categories)) {
                $categories[] = $product->ecom_product_category;
            }
        }

        $response = [
            'products' => $products,
            'categories' => $categories,
        ];
        return response()->json(['success' => true, 'message' => 'Data get successfully', 'data' => $response], 200);
    }
}
