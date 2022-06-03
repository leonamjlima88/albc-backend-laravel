<?php

namespace App\Services\Tenant\Financial\PaymentTerm;

use App\Http\DataTransferObjects\Tenant\Financial\PaymentTerm\PaymentTermDto;
use App\Repositories\Tenant\Financial\PaymentTerm\PaymentTermRepository;
use App\Services\Tenant\User\RoleService;

class PaymentTermService
{
  public function __construct(
    protected PaymentTermRepository $repository
  ) {
  }

  public static function make(): Self
  {
    return new self(PaymentTermRepository::make());
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

  public function show(int $id): PaymentTermDto|null
  {
    return $this->repository->show($id);
  }

  public function store(PaymentTermDto $dto): PaymentTermDto|null
  {
    return $this->repository->setTransaction(true)->store($dto);
  }

  public function update(int $id, PaymentTermDto $dto): PaymentTermDto
  {
    return $this->repository->setTransaction(true)->update($id, $dto);
  }

  public static function permissionTemplate(): array
  {
    return RoleService::permissionTemplateDefault('payment_term', 'Condição de pagamento');
  }  
}