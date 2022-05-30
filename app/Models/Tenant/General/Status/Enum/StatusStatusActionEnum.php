<?php

namespace App\Models\Tenant\General\Status\Enum;

enum StatusStatusActionEnum: int
{
  case PENDING = 0; // Pendente
  case CLOSED = 1; // Concluído
  case CANCELED = 2; // Cancelado
}