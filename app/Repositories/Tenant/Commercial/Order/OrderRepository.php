<?php

namespace App\Repositories\Tenant\Commercial\Order;

use App\Models\Tenant\Commercial\Order\Order;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Data;

class OrderRepository extends BaseRepository
{
  public function __construct(Order $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new Order);
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
        ->leftJoin('person as customer', 'customer.id', 'order.customer_id')
        ->leftJoin('person as seller', 'seller.id', 'order.seller_id'),
      '`order`.*, ' . // order é uma palavra reservada, necessário escrever com ` ` 
      'customer.business_name as customer_name, ' .
      'seller.business_name as seller_name '
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
      ->with('customer:id,business_name')
      ->with('seller:id,business_name')
      ->with('orderProduct.product.unit')
      ->with('orderProduct.product:id,name,unit_id')      
      ->with('orderPayment.bankAccount:id,name')
      ->with('orderPayment.paymentOption:id,name,is_automatic_conference')
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
      $modelFound->orderProduct()->createMany($data['order_product'] ?? []);
      $modelFound->orderPayment()->createMany($data['order_payment'] ?? []);

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

      // Atualizar Order
      tap($modelFound)->update($data);

      // Atualizar OrderProduct
      $modelFound->orderProduct()->delete();
      $modelFound->orderProduct()->createMany($data['order_product'] ?? []);

      // Atualizar OrderPayment
      $modelFound->orderPayment()->delete();
      $modelFound->orderPayment()->createMany($data['order_payment'] ?? []);

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