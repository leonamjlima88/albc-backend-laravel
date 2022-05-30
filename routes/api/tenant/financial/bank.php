<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/**
 * Bank (Banco)
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
  'namespace' => 'App\Http\Controllers\Tenant\Financial\Bank',
  'prefix' => 'financial',
], function () {
  Route::get("/bank",         "BankController@index")->name("bank.index");
  Route::post("/bank",        "BankController@store")->name("bank.store");
  Route::get("/bank/{id}",    "BankController@show")->name("bank.show");
  Route::put("/bank/{id}",    "BankController@update")->name("bank.update");
  Route::delete("/bank/{id}", "BankController@destroy")->name("bank.destroy");
});