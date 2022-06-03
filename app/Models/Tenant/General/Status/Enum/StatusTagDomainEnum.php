<?php

namespace App\Models\Tenant\General\Status\Enum;

use App\Traits\EnumEnhancements;

enum StatusTagDomainEnum: string
{
  use EnumEnhancements;

  case BUSINESS_PROPOSAL = 'business_proposal';
  case ORDER = 'order'; 
  case PURCHASE_ORDER = 'purchase_order';
  case PURCHASE = 'purchase';
  case SERVICE_ORDER = 'service_order';
}