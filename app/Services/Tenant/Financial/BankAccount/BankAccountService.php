<?php

namespace App\Services\Tenant\Financial\BankAccount;

use App\Http\DataTransferObjects\Tenant\Financial\BankAccount\BankAccountDto;
use App\Repositories\Tenant\Financial\BankAccount\BankAccountRepository;
use App\Services\Tenant\User\RoleService;

class BankAccountService
{
  public function __construct(
    protected BankAccountRepository $repository
  ) {
  }

  public static function make(): Self
  {
    return new self(BankAccountRepository::make());
  }

  public function destroy(int $id): bool
  {
    // Bloquear exclusão de registros que são necessários para uso do sistema
    throw_if(($id <= 1), new \Exception(trans('message_lang.this_is_system_control_cannot_delete')));
    return $this->repository->destroy($id);
  }

  public function index(array|null $page = [], array|null $filter = [], array|null $filterEx = []): array
  {
    return $this->repository->index($page, $filter, $filterEx);
  }

  public function show(int $id): BankAccountDto|null
  {
    return $this->repository->show($id);
  }

  public function store(BankAccountDto $dto): BankAccountDto
  {
    return $this->repository->setTransaction(false)->store($dto);
  }

  public function update(int $id, BankAccountDto $dto): BankAccountDto
  {
    return $this->repository->setTransaction(false)->update($id, $dto);
  }

  public static function permissionTemplate(): array
  {
    return RoleService::permissionTemplateDefault('bank_account', 'Conta Bancária');
  }
}
