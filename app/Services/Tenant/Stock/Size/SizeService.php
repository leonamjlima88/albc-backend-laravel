<?php

namespace App\Services\Tenant\Stock\Size;

use App\Http\DataTransferObjects\Tenant\Stock\Size\SizeDto;
use App\Repositories\Tenant\Stock\Size\SizeRepository;
use App\Services\Tenant\User\RoleService;

class SizeService
{
  public function __construct(
    protected SizeRepository $repository
  ) {
  }

  public static function make(): Self
  {
    return new self(SizeRepository::make());
  }

  public function destroy(int $id): bool
  {
    return $this->repository->destroy($id);
  }

  public function index(array|null $page = [], array|null $filter = [], array|null $filterEx = []): array
  {
    return $this->repository->index($page, $filter, $filterEx);
  }

  public function show(int $id): SizeDto|null
  {
    return $this->repository->show($id);
  }

  public function store(SizeDto $dto): SizeDto
  {
    return $this->repository->setTransaction(false)->store($dto);
  }

  public function update(int $id, SizeDto $dto): SizeDto
  {
    return $this->repository->setTransaction(false)->update($id, $dto);
  }

  public static function permissionTemplate(): array
  {
    return RoleService::permissionTemplateDefault('size', 'Tamanho');
  }
}
