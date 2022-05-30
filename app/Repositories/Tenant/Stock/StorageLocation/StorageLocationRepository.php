<?php

namespace App\Repositories\Tenant\Stock\StorageLocation;

use App\Repositories\BaseRepository;
use App\Models\Tenant\Stock\StorageLocation\StorageLocation;

class StorageLocationRepository extends BaseRepository
{
  public function __construct(StorageLocation $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new StorageLocation);
  }
}
