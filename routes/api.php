
<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarehouseController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    ['prefix' => 'v1'],
    function () use ($router) {
        $router->get('/warehouses', WarehouseController::class);
        $router->post('/warehouses/add', [WarehouseController::class,'add']);
        $router->get('/warehouses/getProductByTotal', [WarehouseController::class,'getProductByTotal']);
        $router->post('/products/add', [ProductController::class,'add']);
        $router->post('/stocks/add', [StockController::class,'add']);
        $router->post('/warehouses/move', [WarehouseController::class,'move']);
    }
);
