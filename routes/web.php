<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\OverviewController;

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

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth'])->group(function () {

    Route::get('/signup-pending', [UserController::class, 'pending']);
    Route::get('/signup-declined', [UserController::class, 'declined']);
    Route::post('/signup-declined/message', [UserController::class, 'message']);
});

Route::middleware(['auth', 'activated'])->group(function () {

    Route::get('/logged-in', function() { return redirect('/'); });
    
    //Shop
    Route::get('/shop', [ShopController::class, 'index']); //featured products
    Route::get('/shop/categories/{category:slug}/{subcategory:slug}', [ShopController::class, 'category']); //products per category
    Route::get('/shop/products/{product:slug}', [ShopController::class, 'product']); //product page
    
    //Cart
    Route::get('/cart', [CartController::class, 'index']); 
    Route::post('/cart', [CartController::class, 'add']);
    Route::delete('/cart', [CartController::class, 'remove']);

    //Checkout
    Route::get('/checkout', [CheckoutController::class, 'index']);
    Route::post('/checkout', [CheckoutController::class, 'checkout']);

    //Profile
    Route::get('/profile', [ProfileController::class, 'profile']);
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::post('/profile/image', [ProfileController::class, 'addImage']);
    Route::delete('/profile/image', [ProfileController::class, 'removeImage']);
    
    //Visit Profile & Reviews
    Route::get('/profile/{profile:uuid}', [ProfileController::class, 'merchant']); //Visit Merchant Profile
    Route::post('/profile/{profile:uuid}', [ReviewController::class, 'create']); //Review Merchant Profile

    //Form Steps for Product-Create
    Route::get('/products/create/first-step', [StepController::class, 'firstStep']);
    Route::get('/products/create/second-step', [StepController::class, 'secondStep']);
    Route::get('/products/create/third-step', [StepController::class, 'thirdStep']);
    Route::post('/products/create/first-step', [ProductController::class, 'initialize']);
    Route::post('/products/complete', [ProductController::class, 'complete']);

    //Products
    Route::get('/profile/products/{product:slug}', [ProductController::class, 'show']);
    Route::patch('/profile/products/{product}', [ProductController::class, 'update']);
    Route::delete('/profile/products/{product}', [ProductController::class, 'delete']);
    
    //Options (Products)
    Route::post('/products/{product}/options', [OptionController::class, 'create']);
    Route::patch('/products/{product}/options/{option}', [OptionController::class, 'update']);
    Route::delete('/products/{product}/options/{option}', [OptionController::class, 'delete']);
    
    //Choices (Products)
    Route::post('/options/{option}/choices', [ChoiceController::class, 'create']);
    Route::patch('/options/{option}/choices/{choice}', [ChoiceController::class, 'update']);
    Route::delete('/options/{option}/choices/{choice}', [ChoiceController::class, 'delete']);

    //Images (Products)
    Route::post('/products/{product}/images/create', [ImageController::class, 'create']);
    Route::delete('/products/{product}/images/{image}', [ImageController::class, 'delete']);
});

//ADMIN ROUTES
Route::middleware(['auth', 'admin'])->group(function () {
    //General Metrics
    Route::get('/admin/home', [AdminController::class, 'index']);

    //Singup approvals
    Route::get('/admin/signups', [SignupController::class, 'index']);
    Route::get('/admin/signups/declined', [SignupController::class, 'blockedUsers']);
    Route::patch('/admin/signups/{user}/accept', [SignupController::class, 'accept']);
    Route::patch('/admin/signups/{user}/decline', [SignupController::class, 'decline']);

    //Categories
    Route::get('/admin/categories', [CategoryController::class, 'index']);
    Route::post('/admin/categories', [CategoryController::class, 'create']);
    Route::get('/admin/categories/{category:slug}', [CategoryController::class, 'show']);
    Route::patch('/admin/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/admin/categories/{category}', [CategoryController::class, 'delete']);
    Route::post('/admin/categories/position', [CategoryController::class, 'position']);

    //Subcategories
    Route::get('/admin/subcategories/not-owned', [SubcategoryController::class, 'notOwned']);
    Route::post('/admin/subcategories', [SubcategoryController::class, 'create']);
    Route::patch('/admin/subcategories/{subcategory}', [SubcategoryController::class, 'update']);
    Route::delete('/admin/subcategories/{subcategory}', [SubcategoryController::class, 'delete']);

    //Merchants Overview
    Route::get('/admin/merchants', [OverviewController::class, 'merchants']);
    Route::get('/admin/merchants/{profile:uuid}', [OverviewController::class, 'merchant']);
    Route::delete('/admin/merchants/{profile:uuid}', [OverviewController::class, 'blockMerchant']);
    Route::delete('/admin/reviews/delete/{review}', [OverviewController::class, 'deleteReview']);

    //Products Overview
    Route::get('/admin/products', [OverviewController::class, 'products']);
    Route::get('/admin/products/{product:slug}', [OverviewController::class, 'product']);
    Route::delete('/admin/products/{product:slug}', [OverviewController::class, 'deleteProduct']);
});
