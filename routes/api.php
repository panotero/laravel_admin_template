<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\MailerController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\MenusController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//middle ware deployed
Route::middleware(['web', 'auth'])->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/debug_auth', function () {
        return [
            'isLoggedIn' => auth()->check(),
            'user' => auth()->user(),
        ];
    });

    Route::get('/load_menu', [MenusController::class, 'index']);
});

Route::post('/users/store', [UserController::class, 'store']);
Route::get('/users', [UserController::class, 'index']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);


Route::post('/send-mail', [MailerController::class, 'send']);


//no middleware for testing
Route::get('/roles', function () {
    return \DB::table('setting_role')->get();
});

Route::get('/nav_menus_list', [MenusController::class, 'menulist']);
Route::post('/nav_menus', [MenusController::class, 'store']);
Route::put('/nav_menus/{id}', [MenusController::class, 'update']);
Route::delete('/nav_menus/{id}', [MenusController::class, 'destroy']);

Route::post('/test-api', function (Request $request) {
    \Log::info('Test API triggered', $request->all());

    return response()->json([
        'success' => true,
        'message' => 'API successfully triggered!',
    ]);
});


// Store listing (used by modal form)
Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');
Route::get('/listings', [ListingController::class, 'index']); // fetch all
Route::get('/listings/{id}', [ListingController::class, 'show']); // fetch one
Route::put('/listings/{id}', [ListingController::class, 'update']);

// Optional API routes
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listings.destroy');
