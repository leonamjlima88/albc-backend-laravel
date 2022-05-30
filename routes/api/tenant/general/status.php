<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/**
 * Status (status)
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
  'namespace' => 'App\Http\Controllers\Tenant\General\Status',
  'prefix' => 'general',
], function () {
  Route::get("/status",         "StatusController@index")->name("status.index");
  Route::post("/status",        "StatusController@store")->name("status.store");
  Route::get("/status/{id}",    "StatusController@show")->name("status.show");
  Route::put("/status/{id}",    "StatusController@update")->name("status.update");
  Route::delete("/status/{id}", "StatusController@destroy")->name("status.destroy");
});