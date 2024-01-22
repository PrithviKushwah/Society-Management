<?php

use App\Http\Livewire\Auth\ForgotPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\ResetPassword;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\ExampleLaravel\UserProfile;
use App\Http\Livewire\Profile;
use App\Http\Livewire\User\UserDetail;
use App\Http\Livewire\Admin\AdminManagement;
use App\Http\Controllers\Controller;
use App\Http\Livewire\Maintenance\Maintenance;
use App\Http\Controllers\EmailController;
use App\Http\Livewire\Invoice\Invoice;
use App\Http\Livewire\Property\Properties;
use App\Http\Livewire\FlatManagement\FlatManagement;
use App\Http\Livewire\MaintanenceHistory\MaintanenceHistory;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return redirect('sign-in');
});

Route::get('forgot-password', ForgotPassword::class)->middleware('guest')->name('password.forgot');
Route::get('reset-password/{id}', ResetPassword::class)->middleware('signed')->name('reset-password');



// Route::get('sign-up', Register::class)->middleware('guest')->name('register');
Route::get('sign-in', Login::class)->middleware('guest')->name('login');

Route::get('user-profile', UserProfile::class)->middleware('auth')->name('user-profile');

Route::get('user_export', [UserDetail::class, 'export'])->middleware('auth')->name('user_export');
Route::get('admin_export', [AdminManagement::class, 'export'])->middleware('auth')->name('admin_export');


// Route::group(['middleware' => 'auth'], function () {
// Route::get('dashboard', Dashboard::class)->name('dashboard');
// Route::get('profile', Profile::class)->name('profile');


// });

Route::group(['middleware' => ['web', 'auth:admins' , 'admin']], function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('profile', Profile::class)->name('profile');
    Route::get('users', UserDetail::class)->middleware('auth')->name('User Detail');
    Route::get('admin-management', AdminManagement::class)->middleware('auth')->name('admin_management');
    Route::get('maintenance', Maintenance::class)->middleware('auth')->name('bulk-maintenance');
    Route::get('maintenance_export', [Maintenance::class, 'export'])->middleware('auth')->name('maintenance_export');
    Route::get('invoices', Invoice::class)->middleware('auth')->name('invoices');
    Route::get('properties', Properties::class)->middleware('auth')->name('properties');
    Route::get('property_export', [Maintenance::class, 'export'])->middleware('auth')->name('property_export');

});

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('maintanence-history', MaintanenceHistory::class)->middleware('auth')->name('maintanence-history');
    Route::get('sub-user', FlatManagement::class)->middleware('auth')->name('user');
});
