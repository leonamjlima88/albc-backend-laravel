<?php

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/**
 * Unit (Unidade de Medida)
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
  'namespace' => 'App\Http\Controllers\Tenant\Stock\Unit',
  'prefix' => 'stock',
], function () {
  Route::get("/unit",         "UnitController@index")->name("unit.index");
  Route::get("/unit/{id}",    "UnitController@show")->name("unit.show");
});