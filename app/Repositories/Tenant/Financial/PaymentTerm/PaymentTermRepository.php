<?php

namespace App\Repositories\Tenant\Financial\PaymentTerm;

use App\Models\Tenant\Financial\PaymentTerm\PaymentTerm;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\Data;

class PaymentTermRepository extends BaseRepository
{
  public function __construct(PaymentTerm $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new PaymentTerm);
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
      ->with('paymentTermInstallment.bankAccount.bank')      
      ->with('paymentTermInstallment.paymentOption')      
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
      $modelFound->paymentTermInstallment()->createMany($data['payment_term_installment'] ?? []);

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

      // Atualizar PaymentTerm
      tap($modelFound)->update($data);

      // Atualizar PaymentTermInstallment
      $modelFound->paymentTermInstallment()->delete();
      $modelFound->paymentTermInstallment()->createMany($data['payment_term_installment'] ?? []);

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