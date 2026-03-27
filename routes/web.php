<?php

use App\Http\Controllers\{HomeController, CampaignController, DonationController, DashboardController, AdminController, PengelolaController, MidtransController, AuthController,};
use App\Http\Controllers\AdminPayoutController;
use App\Http\Controllers\MidtransCallbackController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserBankController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;

Route::post('/midtrans/callback', [MidtransCallbackController::class, 'handle'])
    ->name('midtrans.callback');

Route::post('/campaign/{campaign}/donate', [DonationController::class, 'donate'])
    ->name('donate');
Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');



Route::middleware(['auth', 'approved'])->group(function () {

    Route::get('/campaign/create', [CampaignController::class, 'createCampaign'])
        ->name('campaign.create');

    Route::post('/campaign/{campaign}', [CampaignController::class, 'storeCampaign'])
        ->name('campaign.store');
});





// AUTH
Route::middleware('guest.custom')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/campaign/{campaign:slug}', [CampaignController::class, 'show'])
    ->name('campaign.show');








Route::middleware('auth')->group(function () {

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

    Route::get('/bank/create', [UserBankController::class, 'create'])->name('bank.create');
    Route::post('/bank/store', [UserBankController::class, 'store'])->name('bank.store');

    Route::get('/withdraw', [WithdrawController::class, 'create'])->name('withdraw.create');
    Route::post('/withdraw', [WithdrawController::class, 'store'])->name('withdraw.store');







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

        Route::get('/admin/campaign/{campaign}', [AdminController::class, 'showCampaign'])
            ->name('admin.campaign.show');

        Route::post(
            '/admin/approve-campaign/{campaign}',
            [AdminController::class, 'approveCampaign']
        )
            ->name('admin.approve.campaign');

        Route::post(
            '/admin/reject-campaign/{campaign}',
            [
                AdminController::class,
                'rejectCampaign'
            ]
        )->name('admin.reject.campaign');

        Route::get('/admin/pengelola/{user}', [AdminController::class, 'showPengelola'])
            ->name('admin.pengelola.show');

        Route::post(
            '/admin/pengelola/{id}/reject',
            [AdminController::class, 'rejectPengelola']
        )->name('admin.reject.pengelola');

        Route::get('/admin/ktp/{user}', [AdminController::class, 'viewKtp'])
            ->name('admin.pengelola.ktp');


        Route::get('/admin/active', [AdminController::class, 'active'])
            ->name('admin.campaign.active');

        Route::post(
            '/admin/campaign/{campaign}',
            [AdminPayoutController::class, 'withdraw']
        )->name('admin.withdraw');
    });
});
