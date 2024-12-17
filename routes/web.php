<?php

use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\TaxesController;
use App\Http\Controllers\HomeController;
 use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionsController;
 use App\Http\Controllers\UserController;
 use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\GovermentsController;
use App\Http\Controllers\AdminController;
 use App\Http\Controllers\ChangePasswordController;
// use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingController;


// use App\Http\Controllers\HomeController;




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

// Route::get('/', function () {
//     return view('welcome');
// });
////////////////////////user ///////////////////

Route::get('/wishlist', function () {
    return view('frontend.theme2.pages.wishlist');
})->name('wishlist');

Route::post('cart/order', [OrderController::class, 'store'])->name('cart.order');
Route::get('order/pdf/{id}', [OrderController::class, 'pdf'])->name('order.pdf');
Route::get('/income', [OrderController::class, 'incomeChart'])->name('product.order.income');
// Route::get('/user/chart',[AdminController::class, 'userPieChart'])->name('user.piechart');
Route::get('/product-grids', [FrontendController::class, 'productGrids'])->name('product-grids');
Route::get('/product-lists', [FrontendController::class, 'productLists'])->name('product-lists');
Route::match(['get', 'post'], '/filter', [FrontendController::class, 'productFilter'])->name('shop.filter');
// Order Track
Route::get('/product/track', [OrderController::class, 'orderTrack'])->name('order.track');
Route::post('product/track/order', [OrderController::class, 'productTrackOrder'])->name('product.track.order');
// Blog
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog-detail/{slug}', [FrontendController::class, 'blogDetail'])->name('blog.detail');
Route::get('/blog/search', [FrontendController::class, 'blogSearch'])->name('blog.search');
Route::post('/blog/filter', [FrontendController::class, 'blogFilter'])->name('blog.filter');
Route::get('blog-cat/{slug}', [FrontendController::class, 'blogByCategory'])->name('blog.category');
Route::get('blog-tag/{slug}', [FrontendController::class, 'blogByTag'])->name('blog.tag');

// NewsLetter
Route::post('/subscribe', [FrontendController::class, 'subscribe'])->name('subscribe');

// Product Review
Route::resource('/review', 'ProductReviewController');
Route::post('product/{slug}/review', [ProductReviewController::class, 'store'])->name('review.store');

// Post Comment
Route::post('post/{slug}/comment', [PostCommentController::class, 'store'])->name('post-comment.store');
Route::resource('/comment', 'PostCommentController');
// Coupon
Route::post('/coupon-store', [CouponController::class, 'couponStore'])->name('coupon-store');
// Payment
Route::get('payment', [PayPalController::class, 'payment'])->name('payment');
Route::get('cancel', [PayPalController::class, 'cancel'])->name('payment.cancel');
Route::get('payment/success', [PayPalController::class, 'success'])->name('payment.success');

// مسیرهای جدید برای ثبت الطلب و نمایش صفحه موفقیت
Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place-order');
Route::get('/order-success', [OrderController::class, 'orderSuccess'])->name('order.success');

// Back
 
Auth::routes();
Route::get('/', [AdminController::class, 'index'])->name('admin');
Route::get('/file-manager', function () {
    return view('backend.layouts.file-manager');
})->name('file-manager');
// user route
Route::resource('users', UsersController::class);

// Route::resource('users', 'UsersController');
// Banner
Route::post('/banner/{id}', [BannerController::class, 'edit'])->name('banner');

Route::resource('banner', BannerController::class);

// Route::resource('banner', 'BannerController');
// Brand
Route::resource('brand', BrandController::class);

// Route::resource('brand', 'BrandController');
// Profile
Route::get('/profile', [AdminController::class, 'profile'])->name('admin-profile');
Route::post('/profile/{id}', [AdminController::class, 'profileUpdate'])->name('profile-update');
// Category
Route::resource('category', CategoryController::class);

// Route::resource('/category', 'CategoryController');
// Product
Route::resource('product', ProductController::class);

Route::get('product-detail/{slug}', [FrontendController::class, 'productDetail'])->name('product-detail');

// Route::resource('/product', 'ProductController');
// Ajax for sub category
Route::post('/category/{id}/child', 'CategoryController@getChildByParent');
// POST category
Route::resource('post-category', PostCategoryController::class);

// Route::resource('/post-category', 'PostCategoryController');
// Post tag
Route::resource('post-tag', PostTagController::class);

// Route::resource('/post-tag', 'PostTagController');
// Post
Route::resource('post', PostController::class);

// Route::resource('/post', 'PostController');
// Message
Route::resource('message', MessageController::class);

// Route::resource('/message', 'MessageController');
Route::get('/message/five', [MessageController::class, 'messageFive'])->name('messages.five');

// Order
Route::resource('order', OrderController::class);

// Route::resource('/order', 'OrderController');
// Shipping
Route::resource('shipping', ShippingController::class);

// Route::resource('/shipping', 'ShippingController');
// Coupon
Route::resource('coupon', CouponController::class);

// Route::resource('/coupon', 'CouponController');
// Settings
Route::get('settings', [AdminController::class, 'settings'])->name('settings');
Route::post('setting/update', [AdminController::class, 'settingsUpdate'])->name('settings.update');

// Notification
Route::get('/notification/{id}', [NotificationController::class, 'show'])->name('admin.notification');
Route::get('/notifications', [NotificationController::class, 'index'])->name('all.notification');
Route::delete('/notification/{id}', [NotificationController::class, 'delete'])->name('notification.delete');
// // Password Change
// Route::get('change-password', [AdminController::class, 'changePassword'])->name('change.password.form');
// Route::post('change-password', [AdminController::class, 'changPasswordStore'])->name('change.password');



Route::get('change-password', [ChangePasswordController::class, 'index'])->name('index.changpassword');
Route::post('change-password', [ChangePasswordController::class, 'store'])->name('changes.password');
Route::post('change-type', [HomeController::class, 'changeSessionType'])->name('changes.type');
Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::resource('sections', SectionsController::class);


Route::resource('permissions', PermissionsController::class);

Route::resource('goverments', GovermentsController::class);

Route::group(['middleware' => ['auth', 'role:owner|api']], function () {
    Route::resource('roles', RoleController::class);
    // Route::resource('users', UserController::class);
});

Route::get('/{page}', [AdminController::class, 'index']);

/////////////////////////////////////////////// logs/////////////////////////

Route::group(['prefix' => 'activity', 'namespace' => 'jeremykenedy\LaravelLogger\App\Http\Controllers', 'middleware' => ['web', 'auth', 'activity']], function () {

    // Dashboards
    Route::get('/', 'LaravelLoggerController@showAccessLog')->name('activity');
    Route::get('/cleared', 'LaravelLoggerController@showClearedActivityLog')->name('cleared');

    // Drill Downs
    Route::get('/log/{id}', 'LaravelLoggerController@showAccessLogEntry');
    Route::get('/cleared/log/{id}', 'LaravelLoggerController@showClearedAccessLogEntry');

    // Forms
    Route::delete('/clear-activity', 'LaravelLoggerController@clearActivityLog')->name('clear-activity');
    Route::delete('/destroy-activity', 'LaravelLoggerController@destroyActivityLog')->name('destroy-activity');
    Route::post('/restore-log', 'LaravelLoggerController@restoreClearedActivityLog')->name('restore-activity');
});
// User section start
// Route::group(['prefix' => '/user', 'middleware' => ['user']], function () {
    Route::group(['prefix' => '/user'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('user');
    // Profile
    Route::get('/profile', [HomeController::class, 'profile'])->name('user-profile');
    Route::post('/profile/{id}', [HomeController::class, 'profileUpdate'])->name('user-profile-update');
    //  Order
    Route::get('/order', "HomeController@orderIndex")->name('user.order.index');
    Route::get('/order/show/{id}', "HomeController@orderShow")->name('user.order.show');
    Route::delete('/order/delete/{id}', [HomeController::class, 'userOrderDelete'])->name('user.order.delete');
    // Product Review
    Route::get('/user-review', [HomeController::class, 'productReviewIndex'])->name('user.productreview.index');
    Route::delete('/user-review/delete/{id}', [HomeController::class, 'productReviewDelete'])->name('user.productreview.delete');
    Route::get('/user-review/edit/{id}', [HomeController::class, 'productReviewEdit'])->name('user.productreview.edit');
    Route::patch('/user-review/update/{id}', [HomeController::class, 'productReviewUpdate'])->name('user.productreview.update');

    // Post comment
    Route::get('user-post/comment', [HomeController::class, 'userComment'])->name('user.post-comment.index');
    Route::delete('user-post/comment/delete/{id}', [HomeController::class, 'userCommentDelete'])->name('user.post-comment.delete');
    Route::get('user-post/comment/edit/{id}', [HomeController::class, 'userCommentEdit'])->name('user.post-comment.edit');
    Route::patch('user-post/comment/udpate/{id}', [HomeController::class, 'userCommentUpdate'])->name('user.post-comment.update');

    // Password Change
    Route::get('change-password', [HomeController::class, 'changePassword'])->name('user.change.password.form');
    Route::post('change-password', [HomeController::class, 'changPasswordStore'])->name('change.password');
});
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
