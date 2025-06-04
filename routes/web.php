<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\auth\AuthUserController;
use App\Http\Controllers\admin\{UserManagementController, DashboardController, RoomController, RoomCategoryController, TrxRoomDetailController, TrxRoomBookingController};
use App\Http\Controllers\user\{DashboardUserController};


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


Route::middleware(['guest.check'])->group(function () {

    Route::match(['get', 'post'], '/', [AuthUserController::class, 'showLoginForm'])->name('login');
    Route::get('landing', [LandingPageController::class, 'index'])->name('landing.index');
    Route::get('rooms', [LandingPageController::class, 'rooms'])->name('landing.rooms');
    Route::get('detail-rooms', [LandingPageController::class, 'detailRooms'])->name('landing.detail-rooms');
    Route::get('about', [LandingPageController::class, 'about'])->name('landing.about');
    Route::get('news', [LandingPageController::class, 'news'])->name('landing.news');
    Route::get('contact', [LandingPageController::class, 'contact'])->name('landing.contact');
    Route::get('terms-of-use', [LandingPageController::class, 'termsOfUse'])->name('landing.term-of-us');
    Route::get('privacy', [LandingPageController::class, 'privacy'])->name('landing.privacy');
    Route::get('enverionmental-policy', [LandingPageController::class, 'environmentalPolicy'])->name('landing.enverionmental-policy');


    Route::get('/login', [AuthUserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthUserController::class, 'login']);
    Route::post('/register', [AuthUserController::class, 'storeregister'])->name('user.storeregister');
    Route::get('/auth/redirect', [AuthUserController::class, 'redirect']);
    Route::get('/auth/google/callback', [AuthUserController::class, 'callback']);
});
Route::post('/logout', [AuthUserController::class, 'logout'])->name('logout');


Route::middleware(['auth.check:admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('customer', [UserManagementController::class, 'index'])->name('admin.user-management');
    Route::post('customer-store', [UserManagementController::class, 'store'])->name('admin.customer-store');
    Route::post('customer-edit', [UserManagementController::class, 'edit'])->name('admin.customer-edit');
    Route::put('customer-update/{id}', [UserManagementController::class, 'update'])->name('admin.customer-update');
    Route::delete('customer-destroy/{id}', [UserManagementController::class, 'destroy'])->name('admin.user-customer-destroy');

    Route::get('admin-rooms', [RoomController::class, 'index'])->name('admin.rooms');
    Route::post('rooms-store', [RoomController::class, 'store'])->name('admin.rooms-store');
    Route::get('/rooms/{id}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{id}', [RoomController::class, 'update'])->name('rooms.update');

    Route::post('categories-store', [RoomCategoryController::class, 'store'])->name('admin.categories-store');
    Route::delete('categories-destroy{id}', [RoomCategoryController::class, 'destroy'])->name('admin.categories-destroy');

    Route::get('admin-rooms-detail', [TrxRoomDetailController::class, 'index'])->name('admin.rooms.detail');
    Route::get('admin-rooms-detail-store', [TrxRoomDetailController::class, 'store'])->name('admin.trx-room-detail.store');

    Route::get('admin-rooms-booking', [TrxRoomBookingController::class, 'index'])->name('admin.rooms.booking');
    Route::delete('admin/trx-room-booking/{TrxId}', [TrxRoomBookingController::class, 'destroy'])->name('admin.trx-room-booking.destroy');
    Route::post('admin-rooms-booking-store', [TrxRoomBookingController::class, 'store'])->name('admin.trx-room-booking.store');
});
Route::middleware(['auth.check:user'])->group(function () {
    Route::get('dashboard-user', [DashboardUserController::class, 'index'])->name('user.index');
});