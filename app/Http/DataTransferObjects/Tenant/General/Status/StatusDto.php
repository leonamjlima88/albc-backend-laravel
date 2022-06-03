<?php

namespace App\Http\DataTransferObjects\Tenant\General\Status;

use App\Models\Tenant\General\Status\Enum\StatusActionEnum;
use App\Models\Tenant\General\Status\Enum\StatusTagDomainEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Validator;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class StatusDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable|integer')]
    public ?int $id,

    #[Rule('required|string|max:80|unique:status,name')]
    public string $name,

    public string $action,

    #[Rule('nullable|string|min:10')]
    public ?string $created_at,

    #[Rule('nullable|string|min:10')]
    public ?string $updated_at,

    /** @var StatusTagDto[] */
    public DataCollection $status_tag,
  ) {
  }

  // Preparar dados para validação
  public static function prepareForValidation(): void
  {
    // dd($hasDuplicateDomain);
    // dd(request('status_tag', []));
    // dd(array_count_values(request('status_tag', [])));
    
    // request()->merge([
    //   'status_tag' => array_unique(request('status_tag', [])),
    // ]);
  }

  // Regras de validação
  public static function rules(): array
  {
    static::prepareForValidation();
    return [
      'action' => [new Enum(StatusActionEnum::class)],      
    ];
  }

  public static function withValidator(Validator $validator): void
  {
    $validator->after(function ($validator) {
      // Não permtiir coluna domain duplicada em array status_tag
      $arrayCountDomain = array_count_values(array_column(request('status_tag', []), 'domain'));
      $hasDuplicateDomain = array_filter($arrayCountDomain, fn ($value) => $value > 1);
      if ($hasDuplicateDomain) {
        $validator->errors()->add('status_tag',  
          trans('request_validation_lang.array_cannot_have_duplicate_records', ['value' => 'domain'])
        );
      }
    });
  }
  
  public static function messages(): array
  {
    return [
      'action.Illuminate\Validation\Rules\Enum' => trans(
        'request_validation_lang.enum_is_not_valid', ['value' => StatusActionEnum::valueList()]
      ),
      'status_tag.*.domain.Illuminate\Validation\Rules\Enum' => trans(
        'request_validation_lang.enum_is_not_valid', ['value' => StatusTagDomainEnum::valueList()]
      ),
    ];
  }

  /**
   * Utilizado para formatar os dados caso seja necessário
   *
   * @return array
   */
  public function toResource(): array
  {
    return parent::toArray();
  }
}
