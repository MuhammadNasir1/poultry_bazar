<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CatchingController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ECommerce\EcomProductsController;
use App\Http\Controllers\Flock\FlockController;
use App\Http\Controllers\Flock\FlockUserController;
use App\Http\Controllers\Flock\SitesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/createAccessRequest', [UserController::class, 'insertAccessRequest']);
    Route::post('/addQuery', [ApiController::class, 'addQuery']);

    Route::get('/getUser', [ApiController::class, 'getUser']);
    Route::match(['get', 'post'], '/logout', [ApiController::class, 'logout']);
    Route::post('/updateUser', [ApiController::class, 'updateUser']);

    // pos purchase
    Route::post('/createPosPurchase', [ApiController::class, 'createPosPurchase']);
    Route::get('/getPosPurchase', [ApiController::class, 'getPosPurchase']);
    Route::post('/deletePosPurchase', [ApiController::class, 'deletePosPurchase']);
    // pos purchase

    // product

    Route::controller(ProductController::class)->group(function () {
        Route::post('/addProduct',  'addProduct');
        Route::get('/getProducts',  'getProducts');
        Route::match(['get', 'post'], '/deleteProduct/{product_id}',  'deleteProduct');
        Route::post('/updateProduct/{product_id}',  'updateProduct');
        // Variations
        Route::post('/addVariation', 'addVariation');
        Route::get('/getVariation/{product_id?}', 'getVariations');
        Route::match(['get', 'post'], '/deleteVariation/{variation_id}',  'deleteVariation');
        Route::post('/updateVariation/{variation_id}', 'updateVariation');
        Route::get('/getProductStock', 'getProductStock');
    });
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/getCustomers', 'getCustomers');
        Route::post('/addCustomer', 'addCustomer');
        Route::post('/updateCustomer/{customer_id}', 'updateCustomer');
        Route::match(['get', 'post'], '/deleteCustomer/{customer_id}', 'deleteCustomer');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/getOrders', 'getOrders');
        Route::post('/addOrder', 'addOrder');
        Route::match(['get', 'post'], '/saleReport', 'saleReport');
        Route::match(['get', 'post'], '/dashboardData', 'dashboardData');
    });

    Route::controller(CompanyController::class)->group(function () {
        Route::post('/addCompany', 'addCompany');
        Route::post('/updateCompany/{company_id}', 'updateCompany');
    });

    // flocks api's
    Route::post('/addSite', [SitesController::class, 'insert']);
    Route::get('/getSites', [SitesController::class, 'getSites']);

    Route::controller(FlockController::class)->group(function () {
        Route::post('/addFlock', 'insertFlock');
        Route::post('/addDetails/{type}', 'insertDetails');
        Route::post('/addDetails/fd_mortality', 'insertMortality');
        Route::get('/getFlock/{site_id?}', 'getSiteFlocks');
        Route::get('/getDetails/{type}', 'getFlockDetails');
    });
    Route::controller(FlockUserController::class)->group(function () {
        Route::post('/addWorker', 'insertUser');
        Route::get('/getWorkers', 'getUserWorkers');
        Route::post('/deleteWorkers', 'deleteUser');
    });

    Route::controller(CatchingController::class)->group(function () {
        Route::post('/addPreCatching', 'createPreCatching');
        Route::get('/getCatchingDrivers', 'getDrivers');
        Route::get('/getCatchingBrokers', 'getBrokers');
        Route::get('/getCatchingData/{driver_id}', 'getCatchingData');
        Route::post('/addDuringCatching/{catching_id}', 'addDuringCatching');
        Route::post('/addCatchingGatePass/{catching_id}', 'createCatchingGatePass');
    });

    // E-commerce Api
    Route::post('/addEcomProduct', [EcomProductsController::class, 'insert']);
    Route::match(['get', 'post'],  '/deleteEcomProduct/{product_id}', [EcomProductsController::class, 'deleteProduct']);
    Route::post('/updateEcomProduct/{product_id}', [EcomProductsController::class, 'updateProduct']);

    Route::post('/createBoostedProduct/{product_id}', [EcomProductsController::class, 'createBoostedProduct']);
    Route::post('/removeBoostedProduct/{product_id}', [EcomProductsController::class, 'removeBoostedProduct']);
});
Route::get('/getMarkets', [ApiController::class, 'getMarkets']);
Route::post('/getMarketHistory', [ApiController::class, 'getMarketHistory']);
Route::post('/getMarketRates', [ApiController::class, 'getMarketRates']);
Route::get('/getMedia/{type?}', [ApiController::class, 'getMedia']);
Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);
Route::get('/getFAQs', [ApiController::class, 'getFAQs']);

// get ecommerce products
Route::get('/getEcomProduct', [EcomProductsController::class, 'getEcomProduct']);
Route::post('/AddEcomViews/{product_id}', [EcomProductsController::class, 'AddEcomViews']);


Route::post('/sendOtpMail', [UserController::class, 'sendOtpMail']);
Route::post('/resetPassword', [UserController::class, 'resetAppPassword']);

Route::post('/sendLeads/{company_id}', [CompanyController::class, 'addLeads']);
