<?php

namespace App\Repositories\Tenant\Financial\Bank;

use App\Repositories\BaseRepository;
use App\Models\Tenant\Financial\Bank\Bank;

class BankRepository extends BaseRepository
{
  public function __construct(Bank $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new Bank);
  }
}
