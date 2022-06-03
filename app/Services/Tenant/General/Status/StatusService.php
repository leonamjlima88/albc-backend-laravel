<?php

namespace App\Services\Tenant\General\Status;

use App\Http\DataTransferObjects\Tenant\General\Status\StatusDto;
use App\Repositories\Tenant\General\Status\StatusRepository;
use App\Services\Tenant\User\RoleService;

class StatusService
{
  public function __construct(
    protected StatusRepository $repository
  ) {
  }

  public static function make(): Self
  {
    return new self(StatusRepository::make());
  }

  public function destroy(int $id): bool
  {
    // Bloquear exclusão de registros que são necessários para uso do sistema
    throw_if(($id <= 7), new \Exception(trans('message_lang.this_is_system_control_cannot_delete')));
    return $this->repository->destroy($id);
  }

  public function index(array|null $page = [], array|null $filter = [], array|null $filterEx = []): array
  {
    return $this->repository->index($page, $filter, $filterEx);
  }

  public function show(int $id): StatusDto|null
  {
    return $this->repository->show($id);
  }

  public function store(StatusDto $dto): StatusDto
  {
    return $this->repository->setTransaction(true)->store($dto);
  }

  public function update(int $id, StatusDto $dto): StatusDto
  {
    return $this->repository->setTransaction(true)->update($id, $dto);
  }

  public static function permissionTemplate(): array
  {
    return RoleService::permissionTemplateDefault('status', 'Status');
  }
}
