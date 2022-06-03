<?php

namespace App\Models\Tenant\Commercial\Order\Enum;

use App\Traits\EnumEnhancements;

enum OrderApprovalEnum: string
{
  use EnumEnhancements;

  case PENDING = 'pending';
  case CLOSED = 'closed';
  case CANCELED = 'canceled';
}