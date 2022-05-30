<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/**
 * PaymentOption (Documento (Pagamento))
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
  'namespace' => 'App\Http\Controllers\Tenant\Financial\PaymentOption',
  'prefix' => 'financial',
], function () {
  Route::get("/payment-option",         "PaymentOptionController@index")->name("payment-option.index");
  Route::post("/payment-option",        "PaymentOptionController@store")->name("payment-option.store");
  Route::get("/payment-option/{id}",    "PaymentOptionController@show")->name("payment-option.show");
  Route::put("/payment-option/{id}",    "PaymentOptionController@update")->name("payment-option.update");
  Route::delete("/payment-option/{id}", "PaymentOptionController@destroy")->name("payment-option.destroy");
});