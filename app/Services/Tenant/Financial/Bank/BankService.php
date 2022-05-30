<?php

namespace App\Services\Tenant\Financial\Bank;

use App\Http\DataTransferObjects\Tenant\Financial\Bank\BankDto;
use App\Repositories\Tenant\Financial\Bank\BankRepository;
use App\Services\Tenant\User\RoleService;

class BankService
{
  public function __construct(
    protected BankRepository $repository
  ) {
  }

  public static function make(): Self
  {
    return new self(BankRepository::make());
  }

  public function destroy(int $id): bool
  {
    // Bloquear exclusão de registros que são necessários para uso do sistema
    throw_if(($id <= 131), new \Exception(trans('message_lang.this_is_system_control_cannot_delete')));
    return $this->repository->destroy($id);
  }

  public function index(array|null $page = [], array|null $filter = [], array|null $filterEx = []): array
  {
    return $this->repository->index($page, $filter, $filterEx);
  }

  public function show(int $id): BankDto|null
  {
    return $this->repository->show($id);
  }

  public function store(BankDto $dto): BankDto
  {
    return $this->repository->setTransaction(false)->store($dto);
  }

  public function update(int $id, BankDto $dto): BankDto
  {
    return $this->repository->setTransaction(false)->update($id, $dto);
  }

  public static function permissionTemplate(): array
  {
    return RoleService::permissionTemplateDefault('bank', 'Banco');
  }
}
