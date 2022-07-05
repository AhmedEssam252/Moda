<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\ProductsController;
use App\Http\Controllers\Web\FavoritesController;
use App\Http\Controllers\Web\ShoppingBagController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Web\CustomerRequestsController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath',]
], function(){

    Route::group(['middleware' => 'guest:web,admin'],function () {
        Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

        Route::post('register', [RegisteredUserController::class, 'store']);

        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('/admin/login', [AdminAuthenticatedSessionController::class, 'create'])
        ->name('AdminLogin');

        Route::post('/admin/login', [AdminAuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.update');
    });

    Route::group(['middleware' => 'auth:web,admin'], function(){

        Route::group(['middleware' => 'verified'],function () {
            Route::get('/checkout',[CheckoutController::class,'index'])
            ->name('Checkout');
            Route::post('/checkout/store',[CheckoutController::class,'store'])
            ->name('StoreCheckout');

            Route::get('/requests',[CustomerRequestsController::class,'index'])->name('CustomerRequests');
            Route::get('/requests/{request:id}',[CustomerRequestsController::class,'show']);

            Route::get('/favorites',[FavoritesController::class,'index'])->name('Favorites');
            Route::post('/product/favorite/add',[ProductsController::class,'AddToFavorite'])->name('StoreProductInFavorite');
            Route::post('/product/favorite/delete',[ProductsController::class,'RemoveFormFavorite'])->name('RemoveProductFromFavorite');
            Route::get('/shopping-bag',[ShoppingBagController::class,'index'])->name('ShoppingBag');
            Route::post('/product/bag',[ProductsController::class,'AddToBag'])->name('StoreProductInBag');
            Route::post('/product/bag/delete',[ProductsController::class,'RemoveFormBag'])->name('RemoveProductFromBag');
        });

        Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                    ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                    ->middleware(['signed', 'throttle:6,1'])
                    ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                    ->middleware('throttle:6,1')
                    ->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                    ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                    ->name('logout');

        Route::post('/admin/logout', [AdminAuthenticatedSessionController::class, 'destroy'])
        ->name('AdminLogout');
    });

});
