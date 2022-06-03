<?php

namespace App\Models\Tenant\General\Person\Enum;

use App\Traits\EnumEnhancements;

enum PersonAddressTypeEnum: string
{
  use EnumEnhancements;

  case DELIVERY = 'delivery';
  case BILLING = 'billing';
}
