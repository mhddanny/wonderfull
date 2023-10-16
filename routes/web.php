<?php

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
Route::get('/', 'Web\ControlerCover@index')->name('home_web');
Route::get('/produks', 'Web\ControlerCover@produk')->name('produks_web');
Route::get('produks/{id}', 'Web\ControlerCover@show')->name('show_produk_web');
Route::get('/kategories/{slug}', 'web\ControlerCover@kategoriProduk')->name('kategori_web');

Route::get('/produks/ref/{user}/{produk}', 'Web\ControlerCover@referalProduct')->name('front.afiliasi');

Route::post('cart', 'Web\CartController@addToCart')->name('addToCart');
Route::get('/cart', 'Web\CartController@listCart')->name('listcart');
Route::post('/cart/update', 'Web\CartController@updateCart')->name('update_cart');
Route::get('/cart/remove/{id}', 'Web\CartController@remove')->name('remove_card');

Route::get('/checkout','Web\CartController@checkout')->name('checkout');
Route::post('/checkout', 'Web\CartController@processCheckout')->name('store_checkout');
Route::get('/checkout/{invoice}', 'Web\CartController@checkoutFinish')->name('finish_checkout');

Route::group(['prefix' => 'member', 'namespace' => 'Web'], function() {
    Route::get('login', 'LoginController@loginForm')->name('customer.login'); //TAMBAHKAN ROUTE INI
    Route::post('login', 'LoginController@login')->name('customer.post_login');
    Route::get('verify/{token}', 'ControlerCover@verifyCustomerRegistration')->name('customer.verify');
});

Route::group(['middleware' => 'customer', 'namespace' => 'Web'], function() {
    Route::get('/dashboard', 'LoginController@dashboard')->name('customer.dashboard');
    Route::get('/logout', 'LoginController@logout')->name('customer.logout'); //TAMBAHKAN BARIS INI

    Route::get('orders', 'OrderController@index')->name('customer.orders');
    Route::get('orders/{invoice}', 'OrderController@view')->name('customer.view_order');

    Route::get('orders/pdf/{invoice}', 'OrderController@pdf')->name('customer.order_pdf');

    Route::get('payment/{invoice}', 'OrderController@paymentForm')->name('customer.paymentForm');
    Route::post('payment', 'OrderController@storePayment')->name('customer.savePayment');

    Route::get('setting', 'ControlerCover@customerSettingForm')->name('customer.settingForm');
    Route::post('setting', 'ControlerCover@customerUpdateProfile')->name('customer.setting');

    Route::post('orders/accept', 'OrderController@acceptOrder')->name('customer.order_accept');
    Route::get('orders/return/{invoice}', 'OrderController@returnForm')->name('customer.order_return');
    Route::put('orders/return/{invoice}', 'OrderController@processReturn')->name('customer.return');

    Route::get('/afiliasi', 'ControlerCover@listCommission')->name('customer.affiliate');
});

// Route::group(['prefix' => 'orders'], function() {
//     Route::get('manager_controller', 'OrderController@index')->name('orders.index');
//     Route::delete('manager_controller/{id}', 'OrderController@destroy')->name('orders.destroy');
//     Route::get('manager_controller/{invoice}', 'OrderController@view')->name('orders.view');
//     Route::get('manager_controller/payment/{invoice}', 'OrderController@acceptPayment')->name('orders.approve_payment');
//     Route::post('manager_controller/shipping', 'OrderController@shippingOrder')->name('orders.shipping');
//     //SEMUA ROUTE BARU SEPANJANG ARTIKEL INI AKAN DISIMPAN DI DALAM BLOCK CODE INI
//  });

// Route::get('/addcard/{id}','Web\ShopController@addcard')->name('addcard');
// Route::get('/cart', 'Web\ShopController@cart')->name('cart');
// Route::patch('update-cart', 'Web\ShopController@update');
// Route::delete('remove-from-cart', 'Web\ShopController@remove');


route::get('shop', 'Web\ShopController@shop')->name('shop');
route::get('/shop/{id}/add_card', 'Web\ShopController@add_card')->name('add_card');

Route::get('/login', function () {
    return redirect('login');
});

Route::match(["get","post"],"/register", function(){
    return redirect('login');
})->name("register");

Auth::routes();
// Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function() {
// Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function() {
 Route::group(['prefix' => 'administrator','middleware' => ['auth', 'checkrole:admin']], function () {
	//isi dari routing
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('user','UserController');
    Route::resource('customer', 'CustomerController');
    Route::resource('supplier','SupplierController')->except(['show']);
    Route::resource('pegawai','PegawaiController')->except(['show']);
    Route::resource('kategori','KategoriController')->except(['show']);
    Route::resource('produk','ProdukController')->except(['show']);
    Route::get('/produk/bulk', 'ProdukController@massUploadForm')->name('produk.bulk');
    Route::post('/produk/bulk', 'ProdukController@massUpload')->name('produk.saveBulk');
    Route::resource('transaksi_masuk','TransaksiMasukController')->only(['index','create','store','destroy']);

    Route::post('/product/marketplace', 'ProdukController@uploadViaMarketplace')->name('produk.marketplace');

    Route::get('agen','AgenController@index')->name('agen');
    Route::get('report_penjualan','ReportPenjualanController@index')->name('report_penjualan');
    Route::get('cetak_pdf','ReportPenjualanController@cetak_pdf')->name('cetak_pdf');
    Route::get('cetak_excel','ReportPenjualanController@cetak_excel')->name('cetak_excel');

    Route::group(['prefix' => 'orders'], function() {
        Route::get('manager_controller', 'OrderController@index')->name('orders.index');
        Route::delete('manager_controller/{id}', 'OrderController@destroy')->name('orders.destroy');
        Route::get('manager_controller/{invoice}', 'OrderController@view')->name('orders.view');
        Route::get('manager_controller/payment/{invoice}', 'OrderController@acceptPayment')->name('orders.approve_payment');
        Route::post('manager_controller/shipping', 'OrderController@shippingOrder')->name('orders.shipping');

        Route::get('/return/{invoice}', 'OrderController@return')->name('orders.return');
        Route::post('/return', 'OrderController@approveReturn')->name('orders.approve_return');
        });

    Route::group(['prefix' => 'reports'], function() {
        Route::get('/order', 'ReportPenjualanController@orderReport')->name('report.order');
        Route::get('/order/pdf/{daterange}', 'ReportPenjualanController@orderReportPdf')->name('report.order_pdf');
        Route::get('/return', 'ReportPenjualanController@returnReport')->name('report.return');
        Route::get('/return/pdf/{daterange}', 'ReportPenjualanController@returnReportPdf')->name('report.return_pdf');
        // [.. ROUTING LAINNYA ..]
        });
 });
