<?php

namespace App\Repositories\Tenant\Financial\BankAccount;

use App\Repositories\BaseRepository;
use App\Models\Tenant\Financial\BankAccount\BankAccount;
use Illuminate\Database\Eloquent\Builder;
use Spatie\LaravelData\Data;

class BankAccountRepository extends BaseRepository
{
  public function __construct(BankAccount $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new BankAccount);
  }

  /**
   * Método executado dentro de BaseRepository.index()
   * Adicionar join de tabelas e mostrar colunas específicas
   *
   * @param Builder $queryBuilder
   * @return array
   * Retornar um array contendo queryBuilder e string de colunas a serem exibidas
   */
  public function indexInside(Builder $queryBuilder): array
  {
    return [
      $queryBuilder
        ->leftJoin('bank', 'bank.id', 'bank_account.bank_id'),
      'bank_account.*, ' .
      'bank.code     as bank_code, ' .
      'bank.name     as bank_name '
    ];
  }

  /**
   * Localizar um único registro por ID
   * Acrescenta with para mostrar relacionamentos
   *
   * @param integer $id
   * @return Data|null
   */
  public function show(int $id): Data|null
  {
    $modelFound = $this->model
      ->whereId($id)
      ->with('bank')
      ->first();

    return $modelFound
      ? $modelFound->getData()
      : null;
  }  
}
