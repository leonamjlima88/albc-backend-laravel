<?php

namespace App\Services\Tenant\Financial\PaymentOption;

use App\Http\DataTransferObjects\Tenant\Financial\PaymentOption\PaymentOptionDto;
use App\Repositories\Tenant\Financial\PaymentOption\PaymentOptionRepository;
use App\Services\Tenant\User\RoleService;

class PaymentOptionService
{
  public function __construct(
    protected PaymentOptionRepository $repository
  ) {
  }

  public static function make(): Self
  {
    return new self(PaymentOptionRepository::make());
  }

  public function destroy(int $id): bool
  {
    // Bloquear exclusão de registros que são necessários para uso do sistema
    throw_if(($id <= 8), new \Exception(trans('message_lang.this_is_system_control_cannot_delete')));
    
    return $this->repository->destroy($id);
  }

  public function index(array|null $page = [], array|null $filter = [], array|null $filterEx = []): array
  {
    return $this->repository->index($page, $filter, $filterEx);
  }

  public function show(int $id): PaymentOptionDto|null
  {
    return $this->repository->show($id);
  }

  public function store(PaymentOptionDto $dto): PaymentOptionDto
  {
    return $this->repository->setTransaction(false)->store($dto);
  }

  public function update(int $id, PaymentOptionDto $dto): PaymentOptionDto
  {
    return $this->repository->setTransaction(false)->update($id, $dto);
  }

  public static function permissionTemplate(): array
  {
    return RoleService::permissionTemplateDefault('payment_option', 'Documento (pagamento)');
  }
}
