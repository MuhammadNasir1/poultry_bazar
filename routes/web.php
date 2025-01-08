<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\UserController;
use App\Models\Market;
use App\Models\Media;
use Illuminate\Support\Facades\Route;


Route::middleware(['custom_auth'])->group(function () {

    Route::get('/dashboard', [UserController::class, 'getDashboard']);


    Route::get('/notification', [NotificationController::class, 'getNotification']);
    Route::post('/addNotification', [NotificationController::class, 'createNotification']);

    Route::post('/updateUserDetails', [UserController::class, 'updateUserDetails']);
    Route::post('/updateUserPassword', [UserController::class, 'updateUserPassword']);

    Route::get('/setting', [UserController::class, 'settings']);

    Route::middleware(['check_privileges'])->group(function () {
        Route::get('/admins', [UserController::class, 'getAdmins']);

        Route::get('/modules', [ModuleController::class, 'getModules']);
        Route::post('/saveModule', [ModuleController::class, 'addModule']);
        Route::post('/deleteModule', [ModuleController::class, 'deleteModule']);

        Route::get('/operators/{id?}', [UserController::class, 'getUser']);
        Route::post('/addPrivileges', [UserController::class, 'addUserPrivileges']);
        Route::post('/updateUserStatus', [UserController::class, 'updateUserStatus']);

        Route::get('/subscription', function () {
            return view('subscription');
        });
        Route::get('/queries', [QueryController::class, 'getQueries']);
        Route::post('/answerQuery', [QueryController::class, 'answerQuery']);

        Route::get('/Logout', [UserController::class, 'logout']);
        Route::get('/priveleges/{id}', [UserController::class, 'getPriveleges']);
        Route::get('/Cities', [CityController::class, 'getCities']);
        Route::post('/saveCities', [CityController::class, 'addCities']);
        Route::post('/deleteCities', [CityController::class, 'deleteCities']);

        Route::get('/markets', [MarketController::class, 'getMarkets']);
        Route::post('/saveMarket', [MarketController::class, 'addMarket']);
        Route::get('/marketupdates', [MarketController::class, 'getMarketUpdates']);
        Route::post('/updateMarketRates', [MarketController::class, 'marketRates']);
        Route::post('/deleteMarket', [MarketController::class, 'deleteMarket']);

        Route::get('/media/{type?}', [MediaController::class, 'getMedia']);
        Route::post('/saveMedia', [MediaController::class, 'addMedia']);
        Route::post('/deleteMedia', [MediaController::class, 'deleteMedia']);
        Route::post('/approveMedia', [MediaController::class, 'approveMedia']);

        Route::get('/categories/{type?}', [CategoryController::class, 'getCategory']);
        Route::post('/deleteCategory', [CategoryController::class, 'deleteCategory']);
        Route::post('/saveCategory', [CategoryController::class, 'addCategory']);

        Route::get('/FAQs', [FAQController::class, 'getFAQs']);
        Route::post('/addFAQs', [FAQController::class, 'addFAQs']);
        Route::post('/deleteFAQ', [FAQController::class, 'deleteFAQ']);
    });

    Route::get('/getModuleUsers/{module_id}/{view}', [UserController::class, 'getModuleUsers']);

    // pos
    Route::get('/pos/users', [UserController::class, 'posUsers']);
    Route::get('/pos/shops', [CompanyController::class, 'shops']);
});
Route::post('/register', [UserController::class, 'RequestForService']);
Route::get('/login', [ModuleController::class, 'loginData']);
Route::post('/Login', [UserController::class, 'login']);
Route::post('/forgotPassword', [UserController::class, 'forgotPassword']);
Route::post('/resetPassword', [UserController::class, 'resetPassword']);
Route::get('/resetPassword', [UserController::class, 'resetPasswordView']);

Route::match(['get', 'post'], '/logout', [UserController::class, 'logout']);

Route::get('/',  [MediaController::class, 'homeData']);
Route::get('/knowledgeCenter', [MediaController::class, 'knowledgeCenter']);
Route::get('pendingMedia/{type?}', [MediaController::class, 'getMedia']);


Route::get('privacy_policy', function(){

    return view('landingPage.privacy_policy');
});
