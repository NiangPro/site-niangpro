<?php

use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use Gloudemans\Shoppingcart\Facades\Cart;

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

Route::get('/', function () {

    Alert::success("Bonjour");

    return view('welcome', [
        'current_page' => 'home'

    ]);
})->name("welcom");


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Product route

Route::get('/boutique', 'ProductController@index')->name('product.index');
Route::get('/produit/{slug}', 'ProductController@show')->name('product.show');
Route::get('/recherche', 'ProductController@search')->name('product.search');
Route::get('/commandes', 'ProductController@command')->name('product.command');

// Cart Route
Route::get('/panier', 'CartController@index')->name('cart.index');
Route::post('/panier/ajouter', 'CartController@store')->name('cart.store');
Route::delete('/panier/{rowId}', 'CartController@destroy')->name('cart.destroy');
Route::patch('/panier/{rowId}', 'CartController@update')->name('cart.update');


// Checkout routes
Route::get('/paiement', 'CheckoutController@index')->name('checkout.index');
Route::post('/paiement', 'CheckoutController@store')->name('checkout.store');
Route::get('/merci', 'CheckoutController@thankyou')->name('checkout.thankyou');
