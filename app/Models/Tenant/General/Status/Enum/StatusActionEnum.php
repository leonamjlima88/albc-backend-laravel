<?php

namespace App\Models\Tenant\General\Status\Enum;

use App\Traits\EnumEnhancements;

enum StatusActionEnum: string
{
  use EnumEnhancements;

  case PENDING = 'pending'; // Pendente
  case CLOSED = 'closed'; // Concluído
  case CANCELED = 'canceled'; // Cancelado
}