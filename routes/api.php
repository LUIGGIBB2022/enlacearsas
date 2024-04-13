<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\OnlyInvoiceController;
use App\Http\Controllers\api\VentasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('test', function () {
    return "Hola Estoy Aqui";
});

Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::group(['middleware'=>['auth:sanctum']],function()
{
    // Rutas Información de Ventas
    Route::post('update-sales', [VentasController::class,'UpdateSales']);
    Route::get('consolidated-sales-center', [VentasController::class,'ConsolidatdeSalesCenter']);

    // Rutas Información de sólo una factura
    Route::post('only-invoice', [OnlyInvoiceController::class,'OnlyInvoice']);
    Route::post('only-client', [OnlyInvoiceController::class,'OnlyClient']);
    Route::post('only-detinvoice', [OnlyInvoiceController::class,'OnlyDetInvoice']);
});

