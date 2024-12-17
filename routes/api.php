<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Api\Mobile\ProductApiController;
use App\Http\Controllers\Store\StoreCategoryController;
use App\Http\Controllers\Store\StoreOrderController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BranchController;

use App\Http\Controllers\WishlistController;
 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user99', function (Request $request) {
    return '2555';
});
Route::get('city/search',[CityController::class, 'search'])->name('search');
Route::get('/city',  [CityController::class, 'index']);
Route::get('/all_city',  [CityController::class, 'AllCity']);
Route::post('/city/store', [CityController::class, 'store']);
Route::put('/city/update', [CityController::class, 'update']);
Route::delete('/city/delete', [CityController::class, 'destroy']);


Route::get('country/search',[CountryController::class, 'search'])->name('search');
Route::get('/country',  [CountryController::class, 'index']) ;
Route::get('/all_country',  [CountryController::class, 'AllCountry']);
Route::post('/country/store', [CountryController::class, 'store']);
Route::put('/country/update', [CountryController::class, 'update']);
Route::delete('/country/delete', [CountryController::class, 'destroy']);

Route::get('/products/{id}', [ProductController::class, 'show']);

Route::get('/products/most-sold', [ProductController::class, 'mostSold']);
Route::get('/products/new', [ProductController::class, 'newProducts']);
Route::get('/products/discounted', [ProductController::class, 'discountedProducts']);
Route::get('/vendor/{vendorId}/reviews', [BranchController::class, 'getVendorReviews']);


/** Mobile Api**/
Route::group(['middleware' => 'auth:sanctum'], function () {

////////////////follow and unfollow mtgar ////////////////
Route::post('/branch/{branch}/follow', [BranchController::class, 'followBranch']);
Route::delete('/branch/{branch}/unfollow', [BranchController::class, 'unfollowBranch']);
Route::get('/vendor/search',  [BranchController::class, 'vendorSearch']);

////////
Route::post('/product/{product}/like', [ProductController::class, 'likeProduct']);
Route::delete('/product/{product}/unlike', [ProductController::class, 'unlikeProduct']);
Route::get('/product/search',  [ProductController::class, 'productSearch']);


 Route::get('/review/edit/{id}',  [ProductReviewController::class, 'edit']);
 Route::post('/review/store', [ProductReviewController::class, 'store']);
 Route::put('/review/update/{id}', [ProductReviewController::class, 'update']);
 Route::resource('review', ProductReviewController::class);


 ////////////////////get new -best - beside vendor //////////////////
 Route::get('/vendors',  [UsersController::class, 'allVendor']);





 ////////////////////////////////////////////////
 Route::get('/wishlist/{slug}', [WishlistController::class, 'wishlist'])->name('add-to-wishlist');
Route::get('wishlist-delete/{id}', [WishlistController::class, 'wishlistDelete'])->name('wishlist-delete');

});

Route::get('cityt', function (Request $request) {
    return 'hiii';
});


Route::get('city/search',[CityController::class, 'search'])->name('search');
Route::get('/city',  [CityController::class, 'index']);
Route::post('/city/store', [CityController::class, 'store']);
Route::put('/city/update', [CityController::class, 'update']);
Route::delete('/city/delete', [CityController::class, 'destroy']);


Route::get('country/search',[CountryController::class, 'search'])->name('search');
Route::get('/country',  [CountryController::class, 'index']) ;
Route::post('/country/store', [CountryController::class, 'store']);
Route::put('/country/update', [CountryController::class, 'update']);
Route::delete('/country/delete', [CountryController::class, 'destroy']);




Route::group(['middleware' => 'auth:store'], function () {
   
   /////////////// category api ///////////
   Route::get('/AllCategoryForStore',  [StoreCategoryController::class, 'AllCategoryForStore'])->name('dashboard.AllCategoryForStore');
   Route::get('/getSubCategories/{category}', [StoreCategoryController::class, 'getSubCategories'] )->name('dashboard.getSubCategories');

   Route::post('/category/getCategoryOnSearchInProduct', [StoreCategoryController::class, 'getCategoryOnSearchInProduct'] );
   Route::post('/category/getCategoryForSelect', [StoreCategoryController::class, 'getCategoryForSelect'] );
   Route::post('/category/search', [StoreCategoryController::class, 'search'] );
   Route::post('/category/destroy_all', [StoreCategoryController::class, 'destroy_all'] )->name('category.destroy_all');
//    Route::apiResource('category',StoreCategoryController::class);
Route::get('/category',  [StoreCategoryController::class, 'index'])->name('dashboard.AllCategoryForStore');

Route::post('/category/store', [StoreCategoryController::class, 'store']);
Route::put('/category/update', [StoreCategoryController::class, 'update']);
Route::put('/category/update_admin', [StoreCategoryController::class, 'update_admin']);
Route::delete('/category/delete', [StoreCategoryController::class, 'destroy']);

   /////////////// order store//////////////
   Route::get('/orders', [StoreOrderController::class, 'index']);
   Route::post('/orders/show', [StoreOrderController::class, 'show']);
   Route::delete('/orders/delete', [StoreOrderController::class, 'destroy']);
   Route::put('/orders/cancel', [StoreOrderController::class, 'cancel']);
   Route::put('/orders/markAsActive', [StoreOrderController::class, 'markAsActive']);
   Route::get('/orders/search', [StoreOrderController::class, 'search']);
   Route::get('/orders/tracking', [StoreOrderController::class, 'tracking']);
   Route::get('orders/item', [StoreOrderController::class, 'deleteItem'])->name('order.deleteItem');
   
   Route::post('/orders/send', [StoreOrderController::class, 'emailSend'])->name('order.emailSend');
   Route::post('/orders/sendToDriver/{order}', [StoreOrderController::class, 'sendToDriver'])->name('order.sendToDriver');
  

 
 
 

   Route::get('orders/invoicePrint/{order}', 'StoreOrderController@invoicePrint')->name('order.invoicePrint');
   Route::get('orders/invoicePrint/pdf_print/{order}', 'StoreOrderController@invoicePrintPDF')->name('order.invoicePrintPDF');
   // Route::delete('orders/item/{order}', 'StoreOrderController@deleteItem')->name('order.deleteItem');
//    Route::Resource('orders', 'StoreOrderController');
   //////////////
   
    Route::get('/categories','Api\Mobile\GeneralApiController@Categories');
    Route::get('/categories/search','Api\Mobile\GeneralApiController@search');
    Route::post('/fcmSend', 'Api\Mobile\AuthApiController@fcmSend');

    Route::post('/product/ImageUpload', [ProductApiController::class, 'ImageUpload']);
    Route::post('/product/ImageUploadDelete', [ProductApiController::class, 'ImageUploadDelete']);
    Route::put('/product/update', [ProductApiController::class, 'update']);
    Route::get('/product/show',[ProductApiController::class, 'show']);
    Route::post('/product/store', [ProductApiController::class, 'store']);
    Route::delete('/product/delete', [ProductApiController::class, 'delete']);

    // Route::get('/product/search',[ProductApiController::class, 'search']);
    Route::get('/product/getProductByCategory',[ProductApiController::class, 'getProductByCategory']);



});


////////////login api stor and client 
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::post('user/logout', [LoginController::class, 'logout'])->name('userlogout');
Route::post('user/login',[LoginController::class, 'UserLogin'])->name('userLogin');
Route::post('user/forget',  [LoginController::class, 'UserForget'])->name('UserForget');


Route::post('admin/login',  [LoginController::class, 'AdminLogin'])->name('adminLogin');

Route::post('user/updatecode',[RegisterController::class, 'UpdateCode'])->name('UpdateCode');
Route::post('user/register',[RegisterController::class, 'createStore'])->name('createStore');
Route::post('user/login', [RegisterController::class, 'loginUser'])->name('storeLogin');
Route::post('user/forget',[LoginController::class, 'storeForget'])->name('storeForget');


// PostController
Route::get('/post/{id}',);

Route::group(['middleware' => ['auth.basic:user_name', 'activity']], function() {
    Route::post('sessions', [App\Http\Controllers\Api_Controllers\ExamSessionController::class, 'sessions']);
    Route::get('results', [App\Http\Controllers\Api_Controllers\ExamResultController::class, 'results']);
});

 
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

 