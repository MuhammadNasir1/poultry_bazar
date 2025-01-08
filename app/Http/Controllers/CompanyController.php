<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\Company;
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
            Company::create([
                'user_id' => $user->id,
                'company_name' => $validatedData['company_name'],
                'company_address' => $validatedData['company_address'],
                'company_phone' => $validatedData['company_phone'],
                'company_logo' => $imageFullPath,
             ]);
            return response()->json(['success' => true, 'message' => 'Company Add Successfully'], 200);

            $user->company_id = $company->company_id;
            $user->save();

            return response()->json(['success' => true, 'message' => 'Company Add Successfully' , 'company' => $company], 200);
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
            return response()->json(['success' => true, 'message' => 'Company update successfully' , 'company' => $company], 200);
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
}
