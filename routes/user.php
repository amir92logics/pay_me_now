<?php

use App\Http\Controllers\User as User;

Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User', 'middleware' => ['auth', 'checkStatus']], function () {
    Route::resource('transfers', TransferController::class);
    Route::resource('loans', LoanController::class)->except('edit', 'destroy');

    // Deposit
    Route::resource('/deposits', DepositController::class);

    // Withdrawal
    Route::get('withdraws', 'WithdrawController@index')->name('withdraws.index');
    Route::resource('withdraw-methods', WithdrawMethodController::class)->only('index', 'show', 'update');
    Route::get('make-withdraw/{method_id}', [User\WithdrawMethodController::class, 'makewithdraw'])->name('make-withdraw');

    Route::group(['as' => 'payout.'], function () {
        Route::get('payouts/list', [User\WithdrawMethodController::class, 'list'])->name('list');
        Route::get('/', [User\WithdrawMethodController::class, 'index'])->name('index');
        Route::get('payout/otp/{method_id}', [User\WithdrawMethodController::class, 'otp'])->name('otp');
        Route::post('update/{method_id}', [User\WithdrawMethodController::class, 'update'])->name('update');
        Route::post('getotp/{method_id}', [User\WithdrawMethodController::class, 'getotp'])->name('get-otp');
        Route::post('success/{method_id}', [User\WithdrawMethodController::class, 'success'])->name('success');
        Route::get('/payout/setup/{method_id}', [User\WithdrawMethodController::class, 'setup'])->name('setup');
        Route::get('/payoutmethod/{method_id}/edit', [User\WithdrawMethodController::class, 'edit'])->name('edit');
        Route::get('make-payout/{method_id}', [User\WithdrawMethodController::class, 'makepayout'])->name('make-payout');
    });
});
