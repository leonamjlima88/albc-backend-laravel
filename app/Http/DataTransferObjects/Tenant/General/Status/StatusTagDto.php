<?php

namespace App\Http\DataTransferObjects\Tenant\General\Status;

use App\Models\Tenant\General\Status\Enum\StatusTagDomainEnum;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Illuminate\Validation\Rules\Enum;

class StatusTagDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable|integer')]
    public ?int $id,

    #[Rule('nullable|integer')]
    public ?int $status_id,

    public string $domain,   
  ) {
  }

  // Regras de validação
  public static function rules(): array
  {
    return [
      'domain' => [
        'required',
        new Enum(StatusTagDomainEnum::class)
      ],
    ];
  }
}
