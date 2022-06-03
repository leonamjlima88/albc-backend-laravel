<?php

namespace App\Models\Tenant\Stock\Product\Enum;

use App\Traits\EnumEnhancements;

enum ProductGenreEnum: string
{
  use EnumEnhancements;

  case NONE = 'none';
  case MASCULINE = 'masculine';
  case FEMININE = 'feminine';
  case UNISEX = 'unissex'; 
}
