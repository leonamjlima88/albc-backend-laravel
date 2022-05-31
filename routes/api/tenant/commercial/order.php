<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/**
 * Order (Venda) 
 */
Route::group([
  'middleware' => [
    'api', 
    InitializeTenancyByDomain::class, 
    PreventAccessFromCentralDomains::class,
    'jwt', 
    'acl', 
    'X-Locale'
  ],
  'namespace' => 'App\Http\Controllers\Tenant\Commercial\Order',
  'prefix' => 'commercial',
], function () {
  Route::get("/order",         "OrderController@index")->name("order.index");
  Route::post("/order",        "OrderController@store")->name("order.store");
  Route::get("/order/{id}",    "OrderController@show")->name("order.show");
  Route::put("/order/{id}",    "OrderController@update")->name("order.update");
  Route::delete("/order/{id}", "OrderController@destroy")->name("order.destroy");
});