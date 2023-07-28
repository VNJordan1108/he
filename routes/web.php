<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminCategoriesComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\DetailComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\WishlistComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::get('/', HomeComponent::class)->name('home.index');

Route::get('/shop', ShopComponent::class)->name('shop');

Route::get('/product/{slug}', DetailComponent::class)->name('product.details');

Route::get('/search', SearchComponent::class)->name('product.search');

Route::get('/category/{slug}', CategoryComponent::class)->name('product.category');

Route::get('/wishlist', WishlistComponent::class)->name('shop.wishlist');

Route::get('/cart', CartComponent::class)->name('shop.cart');

Route::get('/checkout', CheckoutComponent::class)->name('shop.checkout');

Route::middleware(['auth'])->group(function () {
  Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
  Route::get('/user', function () {
    return redirect('/');
  });
});

Route::middleware(['auth', 'authAdmin'])->group(function () {
  Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
  Route::get('/admin/categories', AdminCategoriesComponent::class)->name('admin.categories');
  Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.category.add');
  Route::get('/admin/category/edit/{category_id}', AdminEditCategoryComponent::class)->name('admin.category.edit');
  Route::get('/admin/products', AdminProductComponent::class)->name('admin.products');
  Route::get('/admin/product/add', AdminAddProductComponent::class)->name('admin.product.add');

  Route::get('/admin', function () {
    return redirect('/');
  });
});


require __DIR__.'/auth.php';



?>
