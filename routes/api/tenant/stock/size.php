<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/**
 * Size (Tamanho)
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
  'namespace' => 'App\Http\Controllers\Tenant\Stock\Size',
  'prefix' => 'stock',
], function () {
  Route::get("/size",         "SizeController@index")->name("size.index");
  Route::post("/size",        "SizeController@store")->name("size.store");
  Route::get("/size/{id}",    "SizeController@show")->name("size.show");
  Route::put("/size/{id}",    "SizeController@update")->name("size.update");
  Route::delete("/size/{id}", "SizeController@destroy")->name("size.destroy");
});