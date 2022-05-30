<?php

namespace App\Services\Tenant\General\Person;

use App\Http\DataTransferObjects\Tenant\General\Person\PersonDto;
use App\Repositories\Tenant\General\Person\PersonRepository;
use App\Services\Tenant\User\RoleService;

class PersonService
{
  public function __construct(
    protected PersonRepository $repository
  ) {
  }

  public static function make(): Self
  {
    return new self(PersonRepository::make());
  }

  public function destroy(int $id): bool
  {
    return $this->repository->destroy($id);
  }

  public function index(array|null $page = [], array|null $filter = [], array|null $filterEx = []): array
  {
    return $this->repository->index($page, $filter, $filterEx);
  }

  public function show(int $id): PersonDto|null
  {
    return $this->repository->show($id);
  }

  public function store(PersonDto $dto): PersonDto|null
  {
    $this->beforeSave($dto);
    return $this->repository->setTransaction(true)->store($dto);
  }

  public function update(int $id, PersonDto $dto): PersonDto
  {
    $this->beforeSave($dto);
    return $this->repository->setTransaction(true)->update($id, $dto);
  }

  public static function permissionTemplate(): array
  {
    return RoleService::permissionTemplateDefault('person', 'Pessoa');
  }
  
  public function beforeSave(PersonDto $dto)
  {
    // Formatar CPF/CNPJ antes de salvar
    $dto->ein = formatCpfCnpj($dto->ein);    
  }
}