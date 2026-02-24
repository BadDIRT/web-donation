<?php

use App\Http\Controllers\{HomeController, CampaignController, DonationController, DashboardController, AdminController, PengelolaController, MidtransController, AuthController,};
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

// AUTH
Route::middleware('guest.custom')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');
Route::get('/campaign/{campaign}', [CampaignController::class, 'show'])->name('campaign.show');


Route::post('/midtrans/callback', [MidtransController::class, 'callback']);







Route::middleware('auth')->group(function () {

    Route::post('/donate/{campaign}', [DonationController::class, 'donate'])
        ->name('donate');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/pengelola/terms', [PengelolaController::class, 'terms'])
        ->name('pengelola.terms');

    Route::get('/pengelola/form', [PengelolaController::class, 'showForm'])
        ->name('pengelola.form');

    Route::post('/pengelola/submit', [PengelolaController::class, 'submit'])
        ->name('pengelola.submit');

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::post('/notifications/{notification}/read', [NotificationController::class, 'read'])
        ->name('notifications.read');

    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])
        ->name('notifications.destroy');







    Route::middleware('approved')->group(function () {
        Route::get('/campaign/create', [CampaignController::class, 'create'])
            ->name('campaign.create');

        Route::post('/campaign', [CampaignController::class, 'store'])
            ->name('campaign.store');
    });







    Route::middleware('role:admin')->group(function () {

        Route::get('/admin', [AdminController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/admin/pengelola', [AdminController::class, 'pengelolaList'])
            ->name('admin.pengelola');

        Route::post(
            '/admin/approve-pengelola/{user}',
            [AdminController::class, 'approvePengelola']
        )
            ->name('admin.approve.pengelola');

        Route::get('/admin/campaign', [AdminController::class, 'campaignList'])
            ->name('admin.campaign');

        Route::post(
            '/admin/approve-campaign/{campaign}',
            [AdminController::class, 'approveCampaign']
        )
            ->name('admin.approve.campaign');

        Route::get('/admin/pengelola/{user}', [AdminController::class, 'showPengelola'])
            ->name('admin.pengelola.show');

        Route::post(
            '/admin/pengelola/{id}/reject',
            [AdminController::class, 'rejectPengelola']
        )->name('admin.reject.pengelola');

        Route::post(
            '/admin/pengelola/{id}/Approve',
            [AdminController::class, 'approvePengelola']
        )->name('admin.approve.pengelola');
    });
});
