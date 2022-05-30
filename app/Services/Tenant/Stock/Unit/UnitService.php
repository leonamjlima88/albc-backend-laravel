<?php

namespace App\Services\Tenant\Stock\Unit;

use App\Http\DataTransferObjects\Tenant\Stock\Unit\UnitDto;
use App\Repositories\Tenant\Stock\Unit\UnitRepository;

class UnitService
{
  public function __construct(
    protected UnitRepository $repository
  ) {
  }

  public static function make(): Self
  {
    return new self(UnitRepository::make());
  }

  public function index(array|null $page = [], array|null $filter = [], array|null $filterEx = []): array
  {
    return $this->repository->index($page, $filter, $filterEx);
  }

  public function show(int $id): UnitDto|null
  {
    return $this->repository->show($id);
  }
}