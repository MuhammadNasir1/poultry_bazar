<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Company;
use App\Models\ECommerce\EcomProducts;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function addCompany(Request $request)
    {
        try {
            $user = Auth::user();
            $validatedData = $request->validate([
                'company_name' => 'required',
                'company_address' => 'required',
                'company_phone' => 'required',
                'company_logo' => 'nullable',
            ]);

            if ($request->hasFile('company_logo')) {
                $image = $request->file('company_logo');
                $imagePath = $image->store('company_logos', 'public');
                $imageFullPath = 'storage/' . $imagePath;
            } else {
                $imageFullPath = null;
            }
            $company = Company::create([
                'user_id' => $user->id,
                'company_name' => $validatedData['company_name'],
                'company_address' => $validatedData['company_address'],
                'company_phone' => $validatedData['company_phone'],
                'company_logo' => $imageFullPath,
                'company_whatsapp_no' => $request['company_whatsapp_no'],
                'company_terms_conditions' => $request['company_terms_conditions'],
            ]);
            $user->company_id = $company->company_id;
            $user->update();

            return response()->json(['success' => true, 'message' => 'Company Add Successfully', 'company' => $company], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }

    public function updateCompany(Request $request, $company_id)
    {

        try {
            $company  = Company::find($company_id);
            if (!$company) {
                return response()->json(['success' => false, 'message' => 'Company not found'], 422);
            }
            if ($request->hasFile('company_logo')) {
                $image = $request->file('company_logo');
                $imagePath = $image->store('company_logos', 'public');
                $imageFullPath = 'storage/' . $imagePath;
            }

            $company->company_name = $request['company_name'] ?? $company->company_name;
            $company->company_address = $request['company_address'] ?? $company->company_address;
            $company->company_phone = $request['company_phone'] ?? $company->company_phone;
            $company->company_logo = $imageFullPath ?? $company->company_logo;
            $company->company_whatsapp_no = $request['company_whatsapp_no'] ?? $company->company_whatsapp_no;
            $company->company_terms_conditions = $request['company_terms_conditions'] ?? $company->company_terms_conditions;
            $company->update();
            return response()->json(['success' => true, 'message' => 'Company update successfully', 'company' => $company], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // get shops
    public function shops()
    {
        $companies = Company::whereNot('company_status', 0)->get();
        foreach ($companies as  $company) {
            $company->company_owner = User::where('id', $company->user_id)->value('name');
        }
        return view('pos.shops', compact('companies'));
    }

    public function addLeads(Request $request, $company_id)
    {
        try {
            // Find the company by ID
            $company = Company::find($company_id);
            if (!$company) {
                return response()->json(['success' => false, 'message' => 'Company not found'], 400);
            }

            // Validate the incoming request for 'lead_type'
            $request->validate([
                'lead_type' => 'required|string',
                'product_id' => 'required|integer',
            ]);

            // Check the type of lead (view or lead)
            if ($request->lead_type == 'view') {
                // Increment the company_views count
                $company->increment('company_views');
            } elseif ($request->lead_type == 'lead') {
                // Increment the company_leads count
                $company->increment('company_leads');
            } else {
                // Return an error if lead_type is invalid
                return response()->json(['success' => false, 'message' => 'Invalid lead type'], 400);
            }

            $ecom_product = EcomProducts::find($request->product_id);

            if(!$ecom_product) {
                return response()->json(['success' => false, 'message' => 'Product not found'], 400);
            }

            $ecom_product->increment('product_whatsapp_count');
            // Return a success response
            return response()->json(['success' => true, 'message' => "Lead/view count updated successfully"], 200);
        } catch (\Exception $e) {
            // Return an error response in case of exception
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
