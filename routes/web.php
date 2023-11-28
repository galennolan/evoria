<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesReportController;

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
    return redirect()->route('login');
});

Route::get('/test', function () {
    return view('testaja');
});

Route::get('/edit', function () {
    return view('admin.user');
});

Route::middleware(['role:user|admin'])->group(function() {
    Route::get('/customer','CustomerController@prodfunct')->name('customer');
    Route::get('/findProductName','CustomerController@findProductName');
    Route::post('/customer', 'CustomerController@store');
    Route::get('/customer/{id}/edit', 'CustomerController@edit')->name('customer.edit');
    Route::put('/customer/{id}', 'CustomerController@update')->name('customer.update');
    Route::get('/customer/hapus/{id}','CustomerController@destroy');
});


Route::middleware(['role:admin|adminarea'])->group(function() {
    Route::resource('/admin', 'UserController');
    // The 'create' route is automatically handled by Route::resource
    // Route::get('/admin/create', 'UserController@create'); // Remove this line
    // Instead, use the following line to display the create view
    // Route::get('/admin/create', 'UserController@store')->name('admin.store');
    // // The 'store' route is automatically handled by Route::resource
    // // Route::post('/admin/user', 'UserController@store'); // Remove this line
    // Route::get('/admin/edit/{id}', 'UserController@edit');
    Route::get('/admin/hapus/{id}', 'UserController@destroy');
});

    Route::middleware(['role:user|TL'])->group(function() {
    Route::resource('/sales','SalesController');
    //spg biasa
   Route::get('/dailyreport','DailyReportController@index')->name('dailyreport');
    Route::post('/dailyreport/penjualan', 'DailyReportController@loadData')->name('dailyreport.penjualan');   
});

    //admin
    Route::middleware(['role:admin|TL|adminarea'])->group(function() {
    Route::get('/dailyreportall','DailyReportAllController@index')->name('dailyreportall');
    Route::post('/dailyreportall/penjualan', 'DailyReportAllController@loadData')->name('dailyreportall.penjualan');

    Route::get('/reportefektivitas','ReportEfektivitasController@index')->name('reportefektivitas');
    Route::post('/reportefektivitas/penjualan', 'ReportEfektivitasController@loadData')->name('reportefektivitas.penjualan');

    Route::get('/customerreport','CustReportController@index')->name('customerreport');
    Route::post('/customerreport/penjualan', 'CustReportController@loadData')->name('customerreport.penjualan');

    Route::get('/salesreport','SalesReportController@index')->name('salesreport');
    Route::match(['GET', 'POST'], '/salesreport/penjualan', 'SalesReportController@loadData')->name('salesreport.penjualan');

 
    Route::get('/salesreport/export', [SalesReportController::class, 'export'])->name('salesreport.export');


        Route::get('/reportsalesall','ReportSalesAllController@index')->name('reportsalesall');
        Route::post('/reportsalesall/penjualan', 'ReportSalesAllController@loadData')->name('reportsalesall.penjualan');
    
        
    });


    

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
