<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Journals\JournalController;
use App\Http\Controllers\Journals\RegistrationController;
use App\Http\Controllers\Journals\TransactionController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\PaymentMethodController;
use App\Http\Controllers\Users\ClientController;

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
  return redirect(RouteServiceProvider::HOME);
});

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'permission', 'verified'])->group(function () {
  Route::prefix('settings')->group(function () {
    // Role management.
    Route::resource('roles', RoleController::class)->except('show');

    // Management password users.
    Route::get('users/password/{user}', [PasswordController::class, 'showChangePasswordForm'])->name('users.password');
    Route::post('users/password', [PasswordController::class, 'store']);

    // User management.
    Route::patch('users/status/{user}', [UserController::class, 'status'])->name('users.status');
    Route::post('users/image/delete/{user}', [UserController::class, 'image'])->name('users.image');
    Route::resource('users', UserController::class);

    // Payment Method management.
    Route::resource('payment-methods', PaymentMethodController::class)
      ->parameters([
        'payment-methods' => 'paymentMethod',
      ])
      ->except('show');

    // Participant and Pemakalah management.
    Route::prefix('users')->group(function () {
      Route::resource('clients', ClientController::class)->except('index', 'destroy', 'show');
    });
  });

  Route::prefix('journals')->group(function () {
    Route::resource('journals', JournalController::class);
    Route::resource('transactions', TransactionController::class)->except('edit');
    Route::resource('registrations', RegistrationController::class)->except('show');
  });
});
