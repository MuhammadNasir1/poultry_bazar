<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\JsonResponse;

class ModuleController extends Controller
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

    // delete module
    public function deleteModule(Request $request)
    {
        try {

            $validatedData = $request->validate([
                'module_id' => 'required',
            ]);

            $module = Module::where('module_id', $validatedData['module_id'])->first();

            $module->module_status = 0;
            $module->save();

            return response()->json(['success' => true, 'message' => 'Module deleted'], 200);
        } catch (\Exception $e) {
            return $this->errorResponse($e);
        }
    }
    // delete module

    // addModule
    public function addModule(Request $request)
    {
        try {

            $moduleId = $request->input('module_id');

            $validatedData = $request->validate([
                'module_name' => 'required',
                'module_description' => 'required',
            ]);

            if ($moduleId != null) {

                $module = Module::where('module_id', $moduleId)->first();

                if ($request->hasFile('module_image')) {
                    // Get the path of the image from the animal record
                    $imagePath = public_path($module->module_image); // Get the full image path

                    // Delete the image file if it exists
                    if (!empty($module->module_image) && file_exists($imagePath) && is_file($imagePath)) {
                        unlink($imagePath); // Delete the image from the file system
                    }

                    $image = $request->file('module_image');
                    // Store the image in the 'animal_images' folder and get the file path
                    $imagePath = $image->store('module_images', 'public'); // stored in 'storage/app/public/animal_images'
                    $imageFullPath = 'storage/' . $imagePath;
                    $module->module_image = $imageFullPath;
                }

                $module->module_name = $validatedData['module_name'];
                $module->module_description = $validatedData['module_description'];

                $module->save();
                return response()->json(['success' => true, 'message' => 'Module update successfully'], 200);
            } else {

                if ($request->hasFile('module_image')) {
                    $image = $request->file('module_image');
                    // Store the image in the 'animal_images' folder and get the file path
                    $imagePath = $image->store('module_images', 'public'); // stored in 'storage/app/public/animal_images'
                    $imageFullPath = 'storage/' . $imagePath;
                } else {
                    return response()->json(['success' => false, 'message' => 'Module Image is required'], 400);
                }

                $module = Module::create([
                    'module_name' => $validatedData['module_name'],
                    'module_description' => $validatedData['module_description'],
                    'module_image' => $imageFullPath,
                ]);

                return response()->json(['success' => true, 'message' => 'Module added successfully'], 200);
            }
        } catch (\Exception $e) {
            $this->errorResponse($e);
        }
    }
    // addModule

    // get Modules
    public function getModules()
    {
        $modules = Module::where('module_status', 1)->get();

        return view('module', ['modules' => $modules]);
    }
    // get Modules

    // get modules for login page
    public function loginData()
    {

        $modules = Module::where('module_status' , 1)->get();
        return view('auth.login', compact('modules'));
    }
}
