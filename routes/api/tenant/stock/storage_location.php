<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/**
 * StorageLocation (Local de Armazenamento)
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
  'namespace' => 'App\Http\Controllers\Tenant\Stock\StorageLocation',
  'prefix' => 'stock',
], function () {
  Route::get("/storage-location",         "StorageLocationController@index")->name("storage-location.index");
  Route::post("/storage-location",        "StorageLocationController@store")->name("storage-location.store");
  Route::get("/storage-location/{id}",    "StorageLocationController@show")->name("storage-location.show");
  Route::put("/storage-location/{id}",    "StorageLocationController@update")->name("storage-location.update");
  Route::delete("/storage-location/{id}", "StorageLocationController@destroy")->name("storage-location.destroy");
});