<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/**
 * BusinessProposal (Proposta Comercial)
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
  'namespace' => 'App\Http\Controllers\Tenant\Commercial\BusinessProposal',
  'prefix' => 'commercial',
], function () {
  Route::get("/business-proposal",         "BusinessProposalController@index")->name("business-proposal.index");
  Route::post("/business-proposal",        "BusinessProposalController@store")->name("business-proposal.store");
  Route::get("/business-proposal/{id}",    "BusinessProposalController@show")->name("business-proposal.show");
  Route::put("/business-proposal/{id}",    "BusinessProposalController@update")->name("business-proposal.update");
  Route::delete("/business-proposal/{id}", "BusinessProposalController@destroy")->name("business-proposal.destroy");
});