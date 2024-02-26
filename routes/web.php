<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController; // Make sure to import the ProfileController
use App\Http\Controllers\AdminController; // Import the AdminController
use App\Http\Controllers\UserController; // Import the UserController
use App\Http\Controllers\ChartController;
use App\Http\Controllers\Admin\AuthenticatedSessionController;
use App\Http\Controllers\BarController;

/*
 * Global Routes
 *
 * Routes that are used between both frontend and backend.
 */

// Switch between the included languages
Route::get('lang/{lang}', [LocaleController::class, 'change'])->name('locale.change');

// Pie Chart Route
Route::get('/pie', [ChartController::class, 'pieChart']);

// Bar Chart Route
Route::get('/bar-chart', [ChartController::class, 'barChart']); // Added route for bar chart

Route::get('admin/login', [AuthenticatedSessionController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AuthenticatedSessionController::class, 'login']);

// Update Profile Picture Route
Route::post('/profile/update-picture', [ProfileController::class, 'updatePicture'])->name('profile.updatePicture');

/*
 * Frontend Routes
 */
Route::group(['as' => 'frontend.'], function () {
    includeRouteFiles(__DIR__.'/frontend/');
});

/*
 * Backend Routes
 *
 * These routes can only be accessed by users with type `admin`
 */
//Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    // Existing backend routes
    // Note: There seems to be a typo in your comment. Replace `DIR.’/auth.php’;` with `__DIR__.'/auth.php';`
   // require __DIR__.'/auth.php';
    // Add the admin dashboard route
    
    //Route::get('/admin/auth/admindashboard', function () {
       // return view('admin.admindashboard');
    //})->middleware(['auth:admin', 'verified'])->name('admin.admindashboard');
//});
// Note: Same typo here. Replace `DIR.’/adminauth.php’;` with `__DIR__.'/adminauth.php';`
//require __DIR__.'/adminauth.php';
//Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('frontend.user.dashboard');
