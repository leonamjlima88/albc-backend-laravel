<?php

namespace App\Repositories\Tenant\Stock\Size;

use App\Repositories\BaseRepository;
use App\Models\Tenant\Stock\Size\Size;

class SizeRepository extends BaseRepository
{
  public function __construct(Size $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new Size);
  }
}
