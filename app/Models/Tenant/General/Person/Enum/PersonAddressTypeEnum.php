<?php

namespace App\Models\Tenant\General\Person\Enum;

enum PersonAddressTypeEnum: int
{
  case DELIVERY = 0; // Entrega
  case BILLING = 1; // Cobrança       
}
