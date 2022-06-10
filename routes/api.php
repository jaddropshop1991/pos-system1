<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PosController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;

if (App::environment('production')) {
    URL::forceScheme('https');
}

Route::group([

    'middleware' => 'https://laravel-pos-system.herokuapp.com/api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);

    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});

//employee routers
Route::post('/employee', [EmployeeController::class, 'store']);
Route::get('/allemployees', [EmployeeController::class, 'index']);
Route::delete('employee/delete/{id}', [EmployeeController::class, 'destroy']);
Route::get('employee/edit/{id}', [EmployeeController::class, 'show']);
Route::patch('employee/update/{id}', [EmployeeController::class, 'update']);

//supplier routers
Route::post('/supplier', [SupplierController::class, 'store']);
Route::get('/allsuppliers', [SupplierController::class, 'index']);
Route::delete('supplier/delete/{id}', [SupplierController::class, 'destroy']);
Route::get('supplier/edit/{id}', [SupplierController::class, 'show']);
Route::patch('supplier/update/{id}', [SupplierController::class, 'update']);

//category routers
Route::post('/category', [CategoryController::class, 'store']);
Route::get('/allcategories', [CategoryController::class, 'index']);
Route::delete('category/delete/{id}', [CategoryController::class, 'destroy']);
Route::get('category/edit/{id}', [CategoryController::class, 'show']);
Route::patch('category/update/{id}', [CategoryController::class, 'update']);


//product routers
Route::post('/product', [ProductController::class, 'store']);
Route::get('/allproducts', [ProductController::class, 'index']);
Route::delete('product/delete/{id}', [ProductController::class, 'destroy']);
Route::get('product/edit/{id}', [ProductController::class, 'show']);
Route::patch('product/update/{id}', [ProductController::class, 'update']);

//expense routers
Route::post('/expense', [ExpenseController::class, 'store']);
Route::get('/allexpenses', [ExpenseController::class, 'index']);
Route::delete('expense/delete/{id}', [ExpenseController::class, 'destroy']);
Route::get('expense/edit/{id}', [ExpenseController::class, 'show']);
Route::patch('expense/update/{id}', [ExpenseController::class, 'update']);

//salary routers
// Route::post('/salary', [SalaryController::class, 'store']);
// Route::get('/allsalaries', [SalaryController::class, 'index']);
// Route::delete('salary/delete/{id}', [SalaryController::class, 'destroy']);
// Route::get('salary/edit/{id}', [SalaryController::class, 'show']);
// Route::patch('salary/update/{id}', [SalaryController::class, 'update']);


Route::post('salary/paid/{id}', [SalaryController::class, 'Paid']);
Route::get('/allsalaries', [SalaryController::class, 'allSalaries']);

Route::get('/salary/view/{id}', [SalaryController::class, 'viewSalary']);

Route::get('/edit/salary/{id}', [SalaryController::class, 'editSalary']);

Route::post('/salary/update/{id}', [SalaryController::class, 'salaryUpdate']);

Route::post('/stock/update/{id}', [ProductController::class, 'stockUpdate']);


//customer routers
Route::post('/customer', [CustomerController::class, 'store']);
Route::get('/allcustomers', [CustomerController::class, 'index']);
Route::delete('customer/delete/{id}', [CustomerController::class, 'destroy']);
Route::get('customer/edit/{id}', [CustomerController::class, 'show']);
Route::patch('customer/update/{id}', [CustomerController::class, 'update']);


Route::get('getting/product/{id}', [PosController::class, 'getProduct']);

//add to cart
Route::get('addToCart/{id}', [CartController::class, 'addToCart']);


//to view all cart products on the front end
Route::get('cart/product/', [CartController::class, 'cartProduct']);


Route::get('remove/cart/{id}', [CartController::class, 'removeCart']);


Route::get('increment/{id}', [CartController::class, 'increment']);

Route::get('decrement/{id}', [CartController::class, 'decrement']);

//vat route
Route::get('vats/', [CartController::class, 'Vats']);

Route::post('/orderdone', [PosController::class, 'orderDone']);


Route::get('/allorders', [OrderController::class, 'TodayOrder']);





Route::get('order/details/{id}', [OrderController::class, 'OrderDetails']);

Route::get('order/orderdetails/{id}', [OrderController::class, 'OrderDetailsAll']);


Route::post('search/order/', [PosController::class, 'SearchOrderDate']);

//admin dashboard sells and statistics

Route::get('today/sell/', [PosController::class, 'TodaySell']);

Route::get('today/income/', [PosController::class, 'TodayIncome']);

Route::get('today/due/', [PosController::class, 'TodayDue']);

Route::get('today/expense/', [PosController::class, 'TodayExpense']);

Route::get('today/stockout/', [PosController::class, 'Stockout']);
