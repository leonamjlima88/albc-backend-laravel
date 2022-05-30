<?php

namespace App\Repositories\Tenant\Stock\Brand;

use App\Repositories\BaseRepository;
use App\Models\Tenant\Stock\Brand\Brand;

class BrandRepository extends BaseRepository
{
  public function __construct(Brand $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new Brand);
  }
}
