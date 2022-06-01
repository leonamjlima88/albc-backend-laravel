<?php
// Como configurar arquivo helper? 
// Adicione o caminho em composer.json na seção autoload, files. 
// Depois rodar comando composer dump-autoload -o

use Illuminate\Support\Facades\Cache;

/**
 * Obter token da requisição atual
 *
 * @return string
 */
function tokenFromCurrentRequest(): string
{
  if (!$authorization = request()->header('Authorization')) {
    $authorization = request()->input('Authorization', '');
  }

  return str_replace("Bearer ", "", $authorization ?? '');
}

/**
 * Obter informações do usuário atual
 *
 * @return array
 */
function currentUser(): array
{
  return Cache::get(tokenFromCurrentRequest()) ?? [];
}

/**
 * Obter parâmetro da rota atual
 *
 * @param [type] $route
 * @return void
 */
function getRouteParameter($route = null)
{
  if (!$route) 
    $route = request()->route();
  
  $parameters = $route->parameters ?? [];
  return array_shift($parameters);
}
