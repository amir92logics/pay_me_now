<?php

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'checkStatus']], function () {
    Route::resource('/notifications', NotificationController::class)->only('index', 'store');
});

