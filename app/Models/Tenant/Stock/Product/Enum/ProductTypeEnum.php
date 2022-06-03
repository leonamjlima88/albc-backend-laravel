<?php

namespace App\Models\Tenant\Stock\Product\Enum;

use App\Traits\EnumEnhancements;

enum ProductTypeEnum: string
{
  use EnumEnhancements;

  case PRODUCT = 'product';
  case SERVICE = 'service';
}
