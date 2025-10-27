<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MailerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/debug_auth', function () {
        return [
            'isLoggedIn' => auth()->check(),
            'user' => auth()->user(),
        ];
    });

    //page control
    Route::get('/page_dashboard', [PageController::class, 'page_dashboard']);
    Route::get('/page_usermanagement', [PageController::class, 'page_UserManagement']);
    Route::get('/page_menus', [PageController::class, 'page_Menus']);
    Route::get('/page_themes', [PageController::class, 'page_Themes']);
    Route::get('/page_users', [PageController::class, 'page_Users']);
    Route::get('/page_forms', [PageController::class, 'page_Forms']);


    //mailing service
    Route::get('/page_mailer', [PageController::class, 'page_Mailer']);
    Route::post('/mailer_save', [MailerController::class, 'save'])->name('mailer_save');
    Route::post('/mailer/send', [MailerController::class, 'send'])->name('mailer.send');


    Route::resource('users', UserController::class)->middleware('can:isSuperAdmin');
    Route::get('/profile', function () {
        return view('profile.edit', [
            'user' => Auth::user(), // ✅ use Auth facade
        ]);
    })->name('profile.edit');
});
require __DIR__ . '/auth.php';
