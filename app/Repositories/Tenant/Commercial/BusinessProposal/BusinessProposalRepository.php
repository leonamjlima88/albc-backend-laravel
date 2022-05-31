<?php

namespace App\Repositories\Tenant\Commercial\BusinessProposal;

use App\Models\Tenant\Commercial\BusinessProposal\BusinessProposal;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Data;

class BusinessProposalRepository extends BaseRepository
{
  public function __construct(BusinessProposal $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new BusinessProposal);
  }

  /**
   * Método executado dentro de BaseRepository.index()
   * Adicionar join de tabelas e mostra colunas específicas
   *
   * @param Builder $queryBuilder
   * @return array
   * Retornar um array contendo queryBuilder e string de colunas a serem exibidas
   */
  public function indexInside(Builder $queryBuilder): array
  {
    return [
      $queryBuilder
        ->leftJoin('person as customer', 'customer.id', 'business_proposal.customer_id')
        ->leftJoin('person as seller', 'seller.id', 'business_proposal.seller_id')
        ->leftJoin('status', 'status.id', 'business_proposal.status_id'),
      'business_proposal.*, ' .
      'customer.business_name as customer_name, ' .
      'seller.business_name as seller_name, ' .
      'status.name as status_name, ' .
      'status.status_action as status_status_action '
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
    // Buscando apenas os campos que preciso
    $modelFound = $this->model
      ->whereId($id)
      ->with('customer:id,business_name')
      ->with('seller:id,business_name')
      ->with('status:id,name')
      ->with('businessProposalProduct.product.unit')
      ->with('businessProposalProduct.product:id,name,unit_id')
      ->first();

    return $modelFound
      ? $modelFound->getData()
      : null;
  }

  /**
   * Salvar registro e retornar DTO
   * Acrescenta createMany para salvar relacionamentos
   * 
   * @param Data $dto
   * @return Data
   */
  public function store(Data $dto): Data
  {
    $dto->id = null;
    $data = $dto->toArray();
    $executeStore = function ($data) {
      $modelFound = $this->model->create($data);
      $modelFound->businessProposalProduct()->createMany($data['business_proposal_product'] ?? []);

      return $this->show($modelFound->id);
    };

    // Controle de Transação
    return match ($this->isTransaction()) {
      true => DB::transaction(fn () => $executeStore($data)),
      false => $executeStore($data),
    };
  }

  /**
   * Atualizar Registro e retorna DTO atualizado
   *
   * @param integer $id
   * @param Data $dto
   * @return Data
   */
  public function update(int $id, Data $dto): Data
  {
    $dto->id = $id;
    $data = $dto->toArray();
    $executeUpdate = function ($id, $data) {
      $modelFound = $this->model->findOrFail($id);

      // Atualizar BusinessProposal
      tap($modelFound)->update($data);

      // Atualizar BusinessProposalProduct
      $modelFound->businessProposalProduct()->delete();
      $modelFound->businessProposalProduct()->createMany($data['business_proposal_product'] ?? []);

      // Retornar registro atualizado
      return $this->show($modelFound->id);
    };

    // Controle de Transação
    return match ($this->isTransaction()) {
      true => DB::transaction(fn () => $executeUpdate($id, $data)),
      false => $executeUpdate($id, $data),
    };
  }
}