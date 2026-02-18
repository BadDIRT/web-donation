<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    CampaignController,
    DonationController,
    DashboardController,
    AdminController,
    PengelolaController,
    MidtransController,
    AuthController,
};

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

    Route::post('/register-pengelola', [PengelolaController::class, 'request'])
        ->name('pengelola.request');

    Route::middleware('role:pengelola')->group(function () {
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

        Route::post('/admin/approve-pengelola/{user}',
            [AdminController::class, 'approvePengelola']);

        Route::get('/admin/campaign', [AdminController::class, 'campaignList'])
            ->name('admin.campaign');

        Route::post('/admin/approve-campaign/{campaign}',
            [AdminController::class, 'approveCampaign']);
    });
});
