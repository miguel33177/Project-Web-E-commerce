<?php

use App\Http\Controllers\Users\AdminController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Transaction\CartController;
use App\Http\Controllers\Transaction\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Transaction\OrderController;
use App\Http\Controllers\Page\PageController;
use App\Http\Controllers\Users\ProfileController;
use App\Http\Controllers\Transaction\StripePaymentController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Email_PDF\PdfEmailController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Users\ResidenceController;
use App\Http\Controllers\Wishlist\WishlistController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [PageController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

/**
 * all routes that require authentication and email verified by the user
 */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/myAccount/{user}', [PageController::class, 'myAccount'])->name('myAccount');
    Route::get('/myWishlist', [WishlistController::class, 'myWishlist'])->name('myWishlist');
    Route::get('/myCart', [CartController::class, 'myCart'])->name('myCart');
    Route::get('/myResidences/{user}', [ResidenceController::class, 'myResidences'])->name('myResidences');
    Route::post('/myResidences/{user}', [ResidenceController::class, 'addResidence'])->name('addResidence');
    Route::delete('/myResidences/{user}/{residences}', [ResidenceController::class, 'deleteResidence'])->name('deleteResidence');
    Route::get('/myProducts/{user}', [ProductController::class, 'myProducts'])->name('myProducts');
    Route::get('/addProduct/{user}', [ProductController::class, 'addProduct'])->name('addProduct');
    Route::post('/addProduct/{user}', [ProductController::class, 'storeProduct'])->name('storeProduct');
    Route::post('/product/{product}', [ProductController::class, 'doComments'])->name('doComments');
    Route::delete('/myProducts/{user}/{product}', [ProductController::class, 'deletemyProducts'])->name('deletemyProducts');
    Route::get('/editProduct/{user}/{product}', [ProductController::class, 'editProduct'])->name('editProduct');
    Route::patch('/editProduct/{user}/{product}', [ProductController::class, 'updateMyProducts'])->name('updateMyProducts');
    Route::post('/addToWishlist/{user}/{product}', [WishlistController::class, 'addToWishlist'])->name('addToWishlist');
    Route::delete('/myWishlist/{user}/{product}', [WishlistController::class, 'deleteOfWishlist'])->name('deleteOfWishlist');
    Route::delete('/product/{user}/{product}', [WishlistController::class, 'deleteOfWishlistinProduct'])->name('deleteOfWishlistinProduct');
    Route::patch('/myAccount/{user}', [ProfileController::class, 'addPhotoProfile'])->name('addPhotoProfile');
    Route::post('/myCart/{user}', [CartController::class, 'addToCart'])->name('addToCart');
    Route::delete('/myCart/{user}/{product}', [CartController::class, 'deleteOfCartProduct'])->name('deleteOfCartProduct');
    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/{user}', [CheckoutController::class, 'addResidenceinCheckout'])->name('addResidenceinCheckout');
    Route::get('/myOrders/{nickUser}', [OrderController::class, 'myOrders'])->name('myOrders');
    Route::get('/viewDetails/{order}', [OrderController::class, 'viewDetailsOrder'])->name('viewDetailsOrder');

    Route::get('/admin', [AdminController::class, 'adminView'])->name('adminView')->middleware('isAdmin');
    Route::get('/admin/banUser', [AdminController::class, 'adminBanUser'])->name('adminBanUser')->middleware('isAdmin');
    Route::get('/admin/removeProducts', [AdminController::class, 'adminRemoveProductsView'])->name('adminRemoveProductsView')->middleware('isAdmin');
    Route::delete('/admin/removeProducts/{productId}', [AdminController::class, 'deleteProductsAdmin'])->name('deleteProductsAdmin')->middleware('isAdmin');
    Route::delete('/admin/banUser/{userId}', [AdminController::class, 'deleteUsersAdmin'])->name('deleteUsersAdmin')->middleware('isAdmin');

    Route::post('add-money-stripe', [StripePaymentController::class, 'postPaymentStripe'])->name('addmoney.stripe');
    Route::get('/payment', [PageController::class, 'payment'])->name('payment');
    Route::get('/send-email/{order}', [PdfEmailController::class, 'sendMailWithPDF'])->name('sendMailWithPDF');
    Route::put('/updatePasword', [UserController::class, 'updatePassword'])->name('updatePassword');
    Route::post('/download-pdf/{idOrder}', [OrderController::class, 'downloadPdf'])->name('downloadPdf');
   
   
});
Route::post('/reviews/{idSeller}', [ProfileController::class, 'addReviewsSeller'])->name('addReviewsSeller');
Route::get('/reviews/{idSeller}', [ProfileController::class, 'reviewsSeller'])->name('reviewsSeller');
Route::get('/resetPassword', [UserController::class, 'resetPassword'])->name('resetPassword');
Route::get('/aboutUs', [PageController::class, 'aboutUs'])->name('aboutUs');
Route::get('/product/{productName}/{productId}', [ProductController::class, 'product'])->name('product');
Route::get('/myProfile/{nickUser}', [ProfileController::class, 'myProfile'])->name('myProfile');
Route::get('/category/{product}', [PageController::class, 'category'])->name('category');
Route::get('/search', [PageController::class, 'search'])->name('search');
