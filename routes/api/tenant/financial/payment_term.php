<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/**
 * PaymentTerm (Condição de Pagamento)
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
  'namespace' => 'App\Http\Controllers\Tenant\Financial\PaymentTerm',
  'prefix' => 'financial',
], function () {
  Route::get("/payment-term",         "PaymentTermController@index")->name("payment-term.index");
  Route::post("/payment-term",        "PaymentTermController@store")->name("payment-term.store");
  Route::get("/payment-term/{id}",    "PaymentTermController@show")->name("payment-term.show");
  Route::put("/payment-term/{id}",    "PaymentTermController@update")->name("payment-term.update");
  Route::delete("/payment-term/{id}", "PaymentTermController@destroy")->name("payment-term.destroy");
});