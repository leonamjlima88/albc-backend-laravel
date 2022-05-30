<?php

namespace App\Services\Tenant\Commercial\BusinessProposal;

use App\Http\DataTransferObjects\Tenant\Commercial\BusinessProposal\BusinessProposalDto;
use App\Repositories\Tenant\Commercial\BusinessProposal\BusinessProposalRepository;
use App\Services\Tenant\User\RoleService;

class BusinessProposalService
{
  public function __construct(
    protected BusinessProposalRepository $repository
  ) {
  }

  public static function make(): Self
  {
    return new self(BusinessProposalRepository::make());
  }

  public function destroy(int $id): bool
  {
    return $this->repository->destroy($id);
  }

  public function index(array|null $page = [], array|null $filter = [], array|null $filterEx = []): array
  {
    return $this->repository->index($page, $filter, $filterEx);
  }

  public function show(int $id): BusinessProposalDto|null
  {
    return $this->repository->show($id);
  }

  public function store(BusinessProposalDto $dto): BusinessProposalDto|null
  {
    return $this->repository->setTransaction(true)->store($dto);
  }

  public function update(int $id, BusinessProposalDto $dto): BusinessProposalDto
  {
    return $this->repository->setTransaction(true)->update($id, $dto);
  }

  public static function permissionTemplate(): array
  {
    return RoleService::permissionTemplateDefault('business_proposal', 'Proposta Comercial');
  }  
}