<?php

use App\Http\Controllers\{HomeController, CampaignController, DonationController, DashboardController, AdminController, PengelolaController, MidtransController, AuthController,};
use App\Http\Controllers\AdminPayoutController;
use App\Http\Controllers\MidtransCallbackController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Pengelola\CampaignUpdateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserBankController;
use App\Http\Controllers\WithdrawController;
use Illuminate\Support\Facades\Route;

Route::post('/midtrans/callback', [MidtransCallbackController::class, 'handle'])
    ->name('midtrans.callback');

Route::post('/campaign/{campaign}/donate', [DonationController::class, 'donate'])
    ->name('donate');
Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');

Route::get('/campaign/{campaign:slug}/updates', [CampaignController::class, 'updatesIndex'])->name('campaign.updates.index');
// YANG BENAR
Route::get('/campaign/{campaign:slug}/updates/{update}', [CampaignController::class, 'updateShow'])->name('campaign.updates.show');

Route::get('/kabar-terbaru', [CampaignController::class, 'latestUpdates'])->name('updates.latest');

Route::post('/campaign/{campaign:slug}/updates/{update}/comment', [CampaignController::class, 'commentStore'])->name('campaign.updates.comment.store');
Route::delete('/campaign/{campaign:slug}/updates/{update}/comment/{comment}', [CampaignController::class, 'commentDestroy'])->name('campaign.updates.comment.destroy');
// Route Update (Edit) Komentar
Route::patch('/campaign/{campaign:slug}/updates/{update}/comments/{comment}', [CampaignController::class, 'commentUpdate'])
    ->name('campaign.updates.comment.update');



Route::middleware(['auth', 'approved'])->group(function () {

    Route::get('/campaign/create', [CampaignController::class, 'createCampaign'])
        ->name('campaign.create');

    Route::post('/campaign', [CampaignController::class, 'storeCampaign'])
        ->name('campaign.store');

    Route::get('/campaign/success', function () {
        return view('campaign.success');
    })->name('campaign.success');

    Route::get('/withdraw/success', function () {
        return view('withdraw.success');
    })->name('withdraw.success');

    Route::get('/withdraw/history', [WithdrawController::class, 'history'])
        ->name('withdraw.history');

    Route::get('/withdraw/{id}', [WithdrawController::class, 'show'])->name('withdraw.show');

    Route::get('pengelola/campaign/{campaign:slug}', [CampaignController::class, 'showCampaignPengelola'])->name('pengelola.campaign.show');
    Route::put('pengelola/campaign/{campaign}', [CampaignController::class, 'update'])->name('pengelola.campaign.update');

    // Di dalam route group pengelola
    Route::get('pengelola/campaign/{campaign}/updates', [CampaignUpdateController::class, 'create'])->name('pengelola.updates.create');
    Route::post('pengelola/campaign/{campaign}/updates', [CampaignUpdateController::class, 'store'])->name('pengelola.updates.store');
    Route::delete('pengelola/campaign/{campaign}/updates/{update}', [CampaignUpdateController::class, 'destroy'])->name('pengelola.updates.destroy');
    Route::get('pengelola/campaigns', [PengelolaController::class, 'indexCampaignPengelola'])->name('pengelola.campaigns.index');
    Route::get('pengelola/income', [CampaignController::class, 'incomeHistory'])->name('pengelola.income.index');
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

    // =============================================
    // PROFILE
    // =============================================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfileController::class, 'removePhoto'])->name('profile.photo.remove');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

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
    Route::get('/bank/success', function () {
        return view('bank.success');
    })->name('bank.success');
    Route::delete('/banks/{userBank}', [UserBankController::class, 'destroy'])
        ->name('bank.destroy');

    Route::get('/withdraw', [WithdrawController::class, 'create'])->name('withdraw.create');
    Route::post('/withdraw', [WithdrawController::class, 'store'])->name('withdraw.store');

    Route::get('/pengelola/success', function () {
        return view('pengelola.success');
    })->name('pengelola.success');

    Route::get('/manage-banks', [UserBankController::class, 'manage'])->name('admin.banks.manage');
    Route::put('/manage-banks/{userBank}/set-primary', [UserBankController::class, 'setPrimary'])->name('admin.banks.set-primary');

    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])
        ->name('notifications.read-all');

    Route::get('/donasi-saya', [DashboardController::class, 'myDonations'])->name('my.donations');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');






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

        Route::get('/admin/campaign/{campaign:slug}', [AdminController::class, 'showCampaign'])
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

        Route::get('/admin/withdrawals', [WithdrawController::class, 'adminIndex'])
            ->name('admin.withdrawals');
        Route::get('/admin/withdrawals/{id}', [WithdrawController::class, 'adminShow'])->name('admin.withdrawals.show');
        Route::post('/admin/withdrawals/{id}/approve', [WithdrawController::class, 'approve'])->name('admin.withdrawals.approve');
        Route::post('/admin/withdrawals/{id}/reject', [WithdrawController::class, 'reject'])
            ->name('admin.withdrawals.reject');

        Route::post('/admin/campaign/{id}/change-status', [CampaignController::class, 'changeStatus'])
            ->name('admin.campaign.changeStatus');

        Route::get('/admin/activities', [AdminController::class, 'activities'])
            ->name('admin.activities');

        Route::get('/admin/activities/{notification}', [AdminController::class, 'activityDetail'])
            ->name('admin.activities.show');

        // Tampilkan Form
        Route::get('/admin/buat-campaign', [CampaignController::class, 'createCampaignForAdmin'])->name('admin.campaign.create');

        // Proses Submit
        Route::post('/admin/buat-campaign', [CampaignController::class, 'storeCampaignForAdmin'])->name('admin.campaign.store');

        // ROUTE KELOLA USER (CRUD)
        Route::get('/admin/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
        Route::get('/admin/users/create', [AdminController::class, 'usersCreate'])->name('admin.users.create');
        Route::post('/admin/users', [AdminController::class, 'usersStore'])->name('admin.users.store');
        Route::get('/admin/users/{user}/edit', [AdminController::class, 'usersEdit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [AdminController::class, 'usersUpdate'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [AdminController::class, 'usersDestroy'])->name('admin.users.destroy');
        Route::get('/admin/users/{user}', [AdminController::class, 'userDetail'])
            ->name('admin.users.show');
        Route::put('/admin/users/{user}/role', [AdminController::class, 'updateRole'])
            ->name('admin.users.updateRole');

        // Di dalam group admin routes
        Route::get('/admin/donations', [AdminController::class, 'donationsIndex'])
            ->name('admin.donations.index');

        Route::get('/admin/donations/{donation}', [AdminController::class, 'donationDetail'])
            ->name('admin.donations.show');
    });





    Route::middleware('role:pengelola')->group(function () {
        Route::get('/dashboard/pengelola', [DashboardController::class, 'pengelolaDashboard'])
            ->name('dashboard.pengelola');
    });


    Route::middleware('role:donatur')->group(function () {
        Route::get('/dashboard/donatur', [DashboardController::class, 'donaturDashboard'])
            ->name('dashboard.donatur');
    });
});
