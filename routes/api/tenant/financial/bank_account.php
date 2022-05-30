<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/**
 * BankAccount (Conta Bancária)
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
  'namespace' => 'App\Http\Controllers\Tenant\Financial\BankAccount',
  'prefix' => 'financial',
], function () {
  Route::get("/bank-account",         "BankAccountController@index")->name("bank-account.index");
  Route::post("/bank-account",        "BankAccountController@store")->name("bank-account.store");
  Route::get("/bank-account/{id}",    "BankAccountController@show")->name("bank-account.show");
  Route::put("/bank-account/{id}",    "BankAccountController@update")->name("bank-account.update");
  Route::delete("/bank-account/{id}", "BankAccountController@destroy")->name("bank-account.destroy");
});