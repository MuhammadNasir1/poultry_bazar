<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function getCustomers()
    {
        $Customers = Customers::where('customer_status', 1)->get();
        return response(['success' => true, 'message' => 'Customers get successfully', "Customers" => $Customers], 200);
    }

    public function addCustomer(Request $request)
    {
        try {
            $user = Auth::user();
            $validatedData = $request->validate([
                'customer_name' => 'required',
                'customer_email' => 'nullable',
                'customer_phone' => 'nullable',
                'customer_address' => 'nullable',
            ]);

            Customers::create([
                'user_id' => $user->id,
                'customer_name' => $validatedData['customer_name'],
                'customer_email' => $validatedData['customer_email'],
                'customer_phone' => $validatedData['customer_phone'],
                'customer_address' => $validatedData['customer_address'],
            ]);
            return response()->json(['success' => true, 'message' => 'Customer Add Successfully'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function updateCustomer(Request $request, $customer_id)
    {
        try {

            $Customer = Customers::find($customer_id);
            if (!$Customer) {
                return response()->json(['success' => false, 'message' => 'Customer not found'], 200);
            }
            $Customer->update($request->all());
            return response()->json(['success' => true, 'message' => 'Customer update Successfully'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function deleteCustomer($customer_id)
    {
        try {

            $Customer = Customers::find($customer_id);
            if (!$Customer) {
                return response()->json(['success' => false, 'message' => 'Customer not found'], 200);
            }
            $Customer->customer_status = 0;
            $Customer->update();
            return response()->json(['success' => true, 'message' => 'Customer delete Successfully'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
}
