<?php

namespace App\Models\Tenant\Commercial\Order\Enum;

enum OrderApprovalEnum: int 
{
  case PENDING = 0; // Pendente
  case CLOSED = 1; // Concluído
  case CANCELED = 2; // Cancelado
}