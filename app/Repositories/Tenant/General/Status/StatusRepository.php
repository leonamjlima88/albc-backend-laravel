<?php

namespace App\Repositories\Tenant\General\Status;

use App\Repositories\BaseRepository;
use App\Models\Tenant\General\Status\Status;

class StatusRepository extends BaseRepository
{
  public function __construct(Status $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new Status);
  }
}
