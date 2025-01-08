<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductVariations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function getProducts()
    {
        try {
            $user = Auth::user();
            $products = Products::where('product_status', 1)->where('user_id', $user->id)->get();

            foreach ($products as $product) {
                if (str_contains($product->product_image, 'storage/product_images')) {
                    $product->product_image = asset($product->product_image);
                }

                $variation = ProductVariations::where('product_id', $product->product_id)->where('variation_status', 1)->first();
                if ($variation) {
                    if (str_contains($variation->variation_image, 'storage/variation_images')) {
                        $variation->variation_image = asset($variation->variation_image);
                    }
                    $product->variation = $variation;
                } else {
                    $product->variation = [];
                }
            }
            return response()->json(['success' => true, 'message' => ' Product Get Successfully', 'products' => $products], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    public function getVariations($product_id = null)
    {
        try {
            if ($product_id) {

                $variations = ProductVariations::where('product_id', $product_id)->where('variation_status', 1)->get();
            } else {
                $variations = ProductVariations::where('variation_status', 1)->get();
            }

            foreach ($variations as $variation) {
                if (str_contains($variation->variation_image, 'storage/variation_images')) {
                    $variation->variation_image = asset($variation->variation_image);
                }
            }
            return response()->json(['success' => true, 'message' => ' Product Get Successfully', 'variations' => $variations], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    public function addProduct(Request $request)
    {
        try {
            $user = Auth::user();
            $validatedData = $request->validate([
                'product_name'  => 'required',
                'product_sec_name'  => 'nullable',
                'product_description'  => 'nullable',
                'product_image'  => 'nullable',
                'product_unit'  => 'required',
                'product_sale_rate'  => 'required',
                'product_stock'  => 'required',
            ]);

            if ($request->hasFile('product_image')) {
                $image = $request->file('product_image');
                $imagePath = $image->store('product_images', 'public');
                $imageFullPath = 'storage/' . $imagePath;
            } else {
                $imageFullPath = $validatedData['product_image'];
            }

            $product = Products::create([
                'user_id' => $user->id,
                'product_name' => $validatedData['product_name'],
                'product_sec_name' => $validatedData['product_sec_name'],
                'product_description' => $validatedData['product_description'],
                'product_unit' => $validatedData['product_unit'],
                'product_purchase_rate' => $request['product_purchase_rate'],
                'product_sale_rate' => $validatedData['product_sale_rate'],
                'product_stock' => $validatedData['product_stock'],
                'product_image' => $imageFullPath,
            ]);



            return response()->json(['success' => true, 'message' => 'Product Add Successfully'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function addVariation(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'product_id'  => 'required',
                'variation_name'  => 'required',
                'variation_sale_rate'  => 'required',
                'variation_consumed'  => 'nullable',
                'variation_wastage'  => 'nullable',
                'variation_image'  => 'nullable',

            ]);
            $product  = Products::select('product_name')->where('product_id', $validatedData['product_id'])->first();
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Variation Add Successfully'], 422);
            }

            if ($request->hasFile('variation_image')) {
                $image = $request->file('variation_image');
                $imagePath = $image->store('variation_images', 'public');
                $imageFullPath = 'storage/' . $imagePath;
            } else {
                $imageFullPath = $validatedData['variation_image'];
            }

            $ProductVariations =    ProductVariations::create([
                'product_id' => $validatedData['product_id'],
                'product_name' => $product->product_name,
                'variation_name' => $validatedData['variation_name'],
                'variation_sale_rate' => $validatedData['variation_sale_rate'],
                'variation_consumed' => $validatedData['variation_consumed'],
                'variation_wastage' => $validatedData['variation_wastage'],
                'variation_image' => $imageFullPath,
            ]);
            return response()->json(['success' => true, 'message' => 'Variation Add Successfully', 'productVariation' => $ProductVariations], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }


    public function deleteProduct($product_id)
    {
        try {
            $product = Products::find($product_id);
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'product not found'], 422);
            }
            if ($product) {
                ProductVariations::where('product_id', $product->id)->update(['variation_status' => 0]);
            }

            $product->product_status  = 0;
            $product->update();
            return response()->json(['success' => true, 'message' => 'Product delete successfully'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    public function deleteVariation($variation_id)
    {
        try {
            $variation = ProductVariations::find($variation_id);
            if (!$variation) {
                return response()->json(['success' => false, 'message' => 'Variation not found'], 422);
            }
            $variation->variation_status  = 0;
            $variation->update();
            return response()->json(['success' => true, 'message' => 'Variation delete successfully',], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }


    public function updateProduct(Request $request, $product_id)
    {
        try {
            $product = Products::find($product_id);
            if (!$product) {
                return response()->json(['success' => false, 'message' => 'Product not found'], 404);
            }
            $product->product_sec_name = $request['product_sec_name'] ?? $product->product_sec_name;
            $product->product_description = $request['product_description'] ?? $product->product_description;
            $product->product_unit = $request['product_unit'] ?? $product->product_unit;
            $product->product_purchase_rate = $request['product_purchase_rate'] ?? $product->product_purchase_rate;
            $product->product_sale_rate = $request['product_sale_rate'] ?? $product->product_sale_rate;
            $product->product_stock = $request['product_stock'] ?? $product->product_stock;

            if ($request->hasFile('product_image')) {
                $image = $request->file('product_image');
                if ($product->variation_image && file_exists(public_path($product->product_image))) {
                    unlink(public_path($product->variation_image));
                }
                $imagePath = $image->store('product_images', 'public');
                $product->product_image = 'storage/' . $imagePath;
            }
            // if ($request->has('product_image')) {
            //     $product->product_image = $request->product_image;
            // }

            $product->update();


            return response()->json(['success' => true, 'message' => 'Product updated successfully'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    public function updateVariation(Request $request, $variation_id)
    {
        try {
            $variation = ProductVariations::find($variation_id);
            if (!$variation) {
                return response()->json(['success' => false, 'message' => 'Variation not found'], 404);
            }

            if ($request->hasFile('variation_image')) {
                $image = $request->file('variation_image');
                if ($variation->variation_image && file_exists(public_path($variation->variation_image))) {
                    unlink(public_path($variation->variation_image));
                }
                $imagePath = $image->store('variation_images', 'public');
                $variation->variation_image = 'storage/' . $imagePath;
            }
            // if ($request->has('variation_image')) {
            //     $variation->variation_image = $request->variation_image;
            // }

            $variation->product_id = $request['product_id'] ??  $variation->product_id;
            $variation->product_name = $request['product_name'] ?? $variation->product_name;
            $variation->variation_name = $request['variation_name'] ?? $variation->variation_name;
            $variation->variation_sale_rate = $request['variation_sale_rate'] ?? $variation->variation_sale_rate;
            $variation->variation_consumed = $request['variation_consumed'] ?? $variation->variation_consumed;
            $variation->variation_wastage = $request['variation_wastage'] ?? $variation->variation_wastage;
            $variation->is_fav = $request->is_fav ?? $variation->is_fav;



            $variation->update();

            return response()->json(['success' => true, 'message' => 'Variation updated successfully'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
