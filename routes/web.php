<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Web\ProductsController;
use App\Http\Controllers\Web\CategoriesController;
use App\Http\Controllers\Web\SubCategoriesController;
use App\Http\Controllers\Admin\AdminList\UsersController;
use App\Http\Controllers\Admin\AdminList\AdminsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\AdminList\AdminProductsController;
use App\Http\Controllers\Admin\AdminList\AdminRequestsController;
use App\Http\Controllers\Admin\AdminList\CategoriesAdminController;
use App\Http\Controllers\Admin\AdminList\AdminSubCategoriesController;
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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function(){

        Route::group([
                'name' => 'web.',
                'Middleware' => 'guest:web,admin',
        ],function () {
            Route::get('/',[HomeController::class,'index'])->name('Home');
            Route::get('/search',[HomeController::class,'getsearch'])->name('Search');
            Route::get('/back',[HomeController::class,'returnBack'])->name('Back');
            Route::prefix('categories')->group(function () {
                Route::get('/{category:route}',[CategoriesController::class,'index'])->name('Category');
            });
            Route::prefix('subcategories')->group(function () {
                Route::get('/{subcategory:route}',[SubCategoriesController::class,'index'])->name('Subcategory');
            });
            Route::prefix('products')->group(function () {
                Route::get('/',[ProductsController::class,'indexProducts'])->name('Products');
                Route::get('/{product:route}',[productsController::class,'indexProduct'])->name('Product');
            });

        });

        Route::group([
            'prefix' => 'admin',
            'middleware' => 'auth:admin',
       ],function () {
           Route::get('/', [AdminController::class , 'index'])->name('Dashboard');
           Route::get('/users', [UsersController::class , 'index'])->name('Users');
           Route::group([
               'prefix' => 'categories',
           ],function(){
               Route::get('/',[CategoriesAdminController::class,'index'])->name('indexCategory');
               Route::get('/{category:route}/info',[CategoriesAdminController::class,'show'])->name('showCategory');
               Route::get('/create',[CategoriesAdminController::class,'create'])->name('CreateCategory');
               Route::post('/store',[CategoriesAdminController::class,'store'])->name('StoreCategory');
               Route::get('/{category:route}/edit',[CategoriesAdminController::class,'edit']);
               Route::patch('/{category:route}/update',[CategoriesAdminController::class,'update']);
               Route::delete('/{category:route}/delete',[CategoriesAdminController::class,'destroy'])->name('DeleteCategory');
               Route::get('/softDelete',[CategoriesAdminController::class,'softDelete'])->name('SoftDeleteCategory');
               Route::get('/{category:route}/restore',[CategoriesAdminController::class,'restore']);
               Route::delete('/{category:route}/forceDelete',[CategoriesAdminController::class,'forceDelete'])->name('ForceDeleteCategory');
               Route::get('/downloadcsv', [CategoriesAdminController::class, 'downloadcsv'])->name('downloadcsvCategory');
               Route::get('/downloadxlsx', [CategoriesAdminController::class, 'downloadxlsx'])->name('downloadxlsxCategory');
           });

           Route::group([
            'prefix' => 'subCategories',
        ],function(){
            Route::get('/',[AdminSubCategoriesController::class,'index'])->name('indexSubCategory');
            Route::get('/{subcategory:route}/info',[AdminSubCategoriesController::class,'show'])->name('showSubCategory');
            Route::get('/create',[AdminSubCategoriesController::class,'create'])->name('CreateSubCategory');
            Route::post('/store',[AdminSubCategoriesController::class,'store'])->name('StoreSubCategory');
            Route::get('/{subcategory:route}/edit',[AdminSubCategoriesController::class,'edit']);
            Route::patch('/{subcategory:route}/update',[AdminSubCategoriesController::class,'update']);
            Route::delete('/{subcategory:route}/delete',[AdminSubCategoriesController::class,'destroy'])->name('DeleteSubcategory');
            Route::get('/softDelete',[AdminSubCategoriesController::class,'softDelete'])->name('SoftDeleteSubCategory');
            Route::get('/{subcategory:route}/restore',[AdminSubCategoriesController::class,'restore']);
            Route::delete('/{subcategory:route}/forceDelete',[AdminSubCategoriesController::class,'forceDelete'])->name('ForceDeleteSubcategory');
            Route::get('/downloadcsv', [AdminSubCategoriesController::class, 'downloadcsv'])->name('downloadcsvSubCategory');
            Route::get('/downloadxlsx', [AdminSubCategoriesController::class, 'downloadxlsx'])->name('downloadxlsxSubCategory');
        });

        Route::group([
            'prefix' => 'Products',
        ],function(){
            Route::get('/',[AdminProductsController::class,'index'])->name('indexProduct');
            Route::get('/{product:route}/info',[AdminProductsController::class,'show'])->name('showProduct');
            Route::get('/create',[AdminProductsController::class,'create'])->name('CreateProduct');
            Route::post('/store',[AdminProductsController::class,'store'])->name('StoreProduct');
            Route::get('/{product:route}/edit',[AdminProductsController::class,'edit']);
            Route::patch('/{product:route}/update',[AdminProductsController::class,'update']);
            Route::delete('/{product:route}/delete',[AdminProductsController::class,'destroy'])->name('DeleteProduct');
            Route::get('/softDelete',[AdminProductsController::class,'softDelete'])->name('SoftDeleteProduct');
            Route::get('/{product:route}/restore',[AdminProductsController::class,'restore']);
            Route::delete('/{product:route}/forceDelete',[AdminProductsController::class,'forceDelete'])->name('ForceDeleteProduct');
            Route::get('/downloadcsv', [AdminProductsController::class, 'downloadcsv'])->name('downloadcsvProduct');
            Route::get('/downloadxlsx', [AdminProductsController::class, 'downloadxlsx'])->name('downloadxlsxProduct');
        });

        Route::group([
            'prefix' => 'account',
        ],function(){
            Route::group([
                'prefix' => 'users',
            ],function(){
                Route::get('/',[UsersController::class,'index'])->name('indexUser');
                Route::get('/{user:id}/info',[UsersController::class,'show'])->name('showUser');
                Route::get('/create',[UsersController::class,'create'])->name('CreateUser');
                Route::post('/store',[UsersController::class,'store'])->name('StoreUser');
                Route::get('/{user:id}/edit',[UsersController::class,'edit']);
                Route::patch('/{user:id}/update',[UsersController::class,'update'])->name('UpdateUser');
                Route::delete('/{user:id}/delete',[UsersController::class,'destroy'])->name('DeleteUser');
                Route::get('/softDelete',[UsersController::class,'softDelete'])->name('SoftDeleteUser');
                Route::get('/{user:id}/restore',[UsersController::class,'restore']);
                Route::delete('/{user:id}/forceDelete',[UsersController::class,'forceDelete'])->name('ForceDeleteUser');
                Route::get('/downloadcsv', [UsersController::class, 'downloadcsv'])->name('downloadcsvUser');
                Route::get('/downloadxlsx', [UsersController::class, 'downloadxlsx'])->name('downloadxlsxUser');
            });

            Route::group([
                'prefix' => 'admins',
            ],function(){
                Route::get('/',[AdminsController::class,'index'])->name('indexAdmin');
                Route::get('/{admin:id}/info',[AdminsController::class,'show'])->name('showAdmin');
                Route::get('/create',[AdminsController::class,'create'])->name('CreateAdmin');
                Route::post('/store',[AdminsController::class,'store'])->name('StoreAdmin');
                Route::get('/{admin:id}/edit',[AdminsController::class,'edit']);
                Route::patch('/{admin:id}/update',[AdminsController::class,'update']);
                Route::delete('/{admin:id}/delete',[AdminsController::class,'destroy'])->name('DeleteAdmin');
                Route::get('/softDelete',[AdminsController::class,'softDelete'])->name('SoftDeleteAdmin');
                Route::get('/{admin:id}/restore',[AdminsController::class,'restore']);
                Route::delete('/{admin:id}/forceDelete',[AdminsController::class,'forceDelete'])->name('ForceDeleteAdmin');
                Route::get('/downloadcsv', [AdminsController::class, 'downloadcsv'])->name('downloadcsvAdmin');
                Route::get('/downloadxlsx', [AdminsController::class, 'downloadxlsx'])->name('downloadxlsxAdmin');
            });

        });

        Route::group([
            'prefix' => 'requests',
        ],function(){
            Route::get('/',[AdminRequestsController::class,'index'])->name('indexRequest');
            Route::get('/{request:id}/info',[AdminRequestsController::class,'show'])->name('showRequest');
            Route::get('/create',[AdminRequestsController::class,'create'])->name('CreateRequest');
            Route::post('/store',[AdminRequestsController::class,'store'])->name('StoreRequest');
            Route::get('/{request:id}/edit',[AdminRequestsController::class,'edit']);
            Route::patch('/{request:id}/update',[AdminRequestsController::class,'update']);
            Route::get('/downloadcsv', [AdminRequestsController::class, 'downloadcsv'])->name('downloadcsvRequest');
            Route::get('/downloadxlsx', [AdminRequestsController::class, 'downloadxlsx'])->name('downloadxlsxRequest');
        });

       });

});

// ->
require __DIR__.'/auth.php';
