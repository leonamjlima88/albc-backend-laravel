<?php

namespace App\Services\Tenant\Stock\StorageLocation;

use App\Http\DataTransferObjects\Tenant\Stock\StorageLocation\StorageLocationDto;
use App\Repositories\Tenant\Stock\StorageLocation\StorageLocationRepository;
use App\Services\Tenant\User\RoleService;

class StorageLocationService
{
  public function __construct(
    protected StorageLocationRepository $repository
  ) {
  }

  public static function make(): Self
  {
    return new self(StorageLocationRepository::make());
  }

  public function destroy(int $id): bool
  {
    return $this->repository->destroy($id);
  }

  public function index(array|null $page = [], array|null $filter = [], array|null $filterEx = []): array
  {
    return $this->repository->index($page, $filter, $filterEx);
  }

  public function show(int $id): StorageLocationDto|null
  {
    return $this->repository->show($id);
  }

  public function store(StorageLocationDto $dto): StorageLocationDto
  {
    return $this->repository->setTransaction(false)->store($dto);
  }

  public function update(int $id, StorageLocationDto $dto): StorageLocationDto
  {
    return $this->repository->setTransaction(false)->update($id, $dto);
  }

  public static function permissionTemplate(): array
  {
    return RoleService::permissionTemplateDefault('storage_location', 'Local de Armazenamento');
  }
}
