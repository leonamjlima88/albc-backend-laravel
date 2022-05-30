<?php

namespace App\Repositories\Tenant\Financial\PaymentOption;

use App\Repositories\BaseRepository;
use App\Models\Tenant\Financial\PaymentOption\PaymentOption;

class PaymentOptionRepository extends BaseRepository
{
  public function __construct(PaymentOption $model)
  {
    parent::__construct($model);
  }

  public static function make(): Self
  {
    return new self(new PaymentOption);
  }
}
