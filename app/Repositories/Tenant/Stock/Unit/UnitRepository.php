<?php

namespace App\Repositories\Tenant\Stock\Unit;

use App\Repositories\BaseRepository;
use App\Models\Tenant\Stock\Unit\Unit;

class UnitRepository extends BaseRepository
{
  public function __construct(Unit $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new Unit);
  }
}
