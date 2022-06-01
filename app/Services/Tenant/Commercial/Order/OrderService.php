<?php

namespace App\Services\Tenant\Commercial\Order;

use App\Exceptions\CustomValidationException;
use App\Http\DataTransferObjects\Tenant\Commercial\Order\OrderDto;
use App\Repositories\Tenant\Commercial\Order\OrderRepository;
use App\Services\Tenant\User\RoleService;

class OrderService
{
  public function __construct(
    protected OrderRepository $repository
  ) {
  }

  public static function make(): Self
  {
    return new self(OrderRepository::make());
  }

  public function destroy(int $id): bool
  {
    return $this->repository->destroy($id);
  }

  public function index(array|null $page = [], array|null $filter = [], array|null $filterEx = []): array
  {
    return $this->repository->index($page, $filter, $filterEx);
  }

  public function show(int $id): OrderDto|null
  {
    return $this->repository->show($id);
  }

  public function store(OrderDto $dto): OrderDto|null
  {
    $this->beforeSave($dto);
    return $this->repository->setTransaction(true)->store($dto);
  }

  public function update(int $id, OrderDto $dto): OrderDto
  {
    $this->beforeSave($dto);
    return $this->repository->setTransaction(true)->update($id, $dto);
  }

  public static function permissionTemplate(): array
  {
    return RoleService::permissionTemplateDefault('order', 'Venda');
  }  

  /**
   * Antes de salvar (Insert/Update)
   *
   * @param OrderDto $dto
   * @return void
   */
  private function beforeSave(OrderDto $dto)
  {
    $error = [];
    $this->calculateOrder($dto);
    $this->validateOrder($dto, $error);
    throw_if($error, new CustomValidationException($error));
  }

  /**
   * Calcular valores da Venda
   *
   * @param OrderDto $dto
   * @return void
   */
  private function calculateOrder(OrderDto $dto)
  {
    $dto->order_product_sum_total = 0;
    $dto->order_product_sum_hist_product_cost_total = 0;
    foreach ($dto->order_product as $value) {
      $value->total = ($value->price - $value->unit_discount) * $value->quantity;
      $value->product_cost_total = $value->hist_product_cost_price * $value->quantity;
      
      $dto->order_product_sum_total += $value->total;
      $dto->order_product_sum_hist_product_cost_total += $value->product_cost_total;
    }  

    $dto->total = $dto->order_product_sum_total - $dto->discount;
  }

  /**
   * Validar Venda
   *
   * @param OrderDto $dto
   * @param array $error
   * @return void
   */
  private function validateOrder(OrderDto $dto, array &$error)
  {
    if (!$dto->total)
      return;
      
    // Calcular valor total de pagamentos
    $order_payment_sum_amount = 0;
    foreach ($dto->order_payment ?? [] as $value) {
      $order_payment_sum_amount += $value->amount;
    }

    // Verificar se valor do pagamento confere com o total da venda
    if (!numbersAreEqual($dto->total, $order_payment_sum_amount, true, 0.004)) {      
      $error['order_payment'][] = "Total do pagamento não confere com total da venda.";
    }    
  }
}