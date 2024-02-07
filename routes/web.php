<?php

use App\Http\Controllers\FlowerController;
use App\Http\Controllers\auth\DashboardController;
use App\Http\Controllers\auth\RequestController;
use App\Http\Controllers\auth\ProfileController;
use App\Http\Controllers\AdminInventoryTblController;
use App\Http\Controllers\AdminImportController;
use App\Http\Controllers\AdminRequestController;
use App\Http\Controllers\AdminSalesTblController;
use App\Http\Controllers\AdminOverallSalesReportController;
// use Illuminate\Support\Facades\Route;

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

//ADMIN ROUTE
Route::get('/', function () {
    return redirect('admin/login');
    //return view('welcome');
});

Route::group(['middleware' => ['web']], function() {
    //INVENTORY
    Route::post(config('crudbooster.ADMIN_PATH').'/inventory_tbl/add-inventory','AdminInventoryTblController@getAddInventory')->name('add.inventory');
    Route::get('/admin/inventory_tbl/inventory-upload', [AdminInventoryTblController::class, 'UploadInventory']);
    Route::post('/admin/admin_import/upload-inventory',[AdminImportController::class, 'InventoryUpload'])->name('upload-inventory');
    Route::get('/admin/inventory_tbl/upload-inventory-template',[AdminInventoryTblController::class, 'downloadInventoryTemplate']);
    Route::post('optios-value', [AdminRequestController::class, 'optionsValue']);
    Route::post('save-inventory', [AdminRequestController::class, 'saveInventory']);
    Route::get('search',[AdminRequestController::class,'autocompleteSearch']);
    Route::post('get-search-data',[AdminRequestController::class,'getSearchData']);
    //SALES
    Route::post(config('crudbooster.ADMIN_PATH').'/sales_tbl/add-sales','AdminSalesTblController@getAddSales')->name('add.sales');
    Route::post(config('crudbooster.ADMIN_PATH').'/sales_tbl/inv-price',[AdminRequestController::class, 'invPrice'])->name('get.inventory.price');
    
    //UPLOAD BULK SALES
    Route::get('/admin/sales_tbl/sales-upload-bulk', [AdminSalesTblController::class, 'uploadBulkSales']);
    Route::post('/admin/admin_import/upload-inventory-bulk',[AdminImportController::class, 'bulkSalesUpload'])->name('upload-sales-bulk');
    Route::get('/admin/sales_tbl/upload-sales-template',[AdminSalesTblController::class, 'downloadSalesTemplate']);

    //REPORTS
    Route::post('/admin/overall_sales_report/filter-reports',[AdminOverallSalesReportController::class, 'filterReport'])->name('filter-reports');

    Route::get('/admin/clear-view', function() {
        Artisan::call('view:clear');
        return "View cache is cleared!";
    });
});

Route::group(['namespace' => 'App\Http\Controllers\auth'], function(){   
    Route::get('/flowershop',[FlowerController::class,'index'])->name('flowershop');
    /**
     * Home Routes
     */
    //

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/dashboard', 'DashboardController@index')->name('home.index');
        Route::get('/profile', [ProfileController::class,'index'])->name('profile');
        Route::get('/my-addresses', [ProfileController::class,'myAddresses'])->name('my-addresses');
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
        //see details
        Route::get('/flowershop/view-details/{id}',[DashboardController::class,'getDetails']);
        Route::post('/flowershop/add-to-cart',[RequestController::class,'addToCart'])->name('add.to.cart');
        Route::post('/flowershop/remove-to-cart',[RequestController::class,'removeToCart'])->name('remove.to.cart');
        Route::get('/flowershop/view-cart',[DashboardController::class,'getDetailsCart'])->name('view-cart');
        Route::post('/flowershop/add-qty-cart',[RequestController::class,'addQtyCart'])->name('add.qty.cart');
        Route::post('/flowershop/less-qty-cart',[RequestController::class,'lessQtyCart'])->name('less.qty.cart');
        Route::post('/flowershop/submit-checkout',[RequestController::class,'submitCheckoutCart'])->name('submit-checkout');
    });

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

});

//FLOWER INDEX
Route::get('/flowershop/details/{id}',[FlowerController::class,'getDetails']);
//Guest add to cart
Route::post('/flowershop/guest-add-to-cart',[RequestController::class,'addToCart'])->name('guest.add.to.cart');
Route::get('get_product_details/{id}', [FlowerController::class,'getProductDetails']);