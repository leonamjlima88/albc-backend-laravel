<?php

namespace App\Http\DataTransferObjects\Tenant\General\Person;

use App\Models\Tenant\General\Person\Enum\PersonAddressTypeEnum;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Validation\Rules\Enum;

class PersonAddressDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable|integer')]
    public ?int $id,

    #[Rule('nullable|integer')]
    public ?int $person_id,

    public string $type,

    #[Rule('nullable|string|max:80')]
    public ?string $recipient,

    public ?string $ein,

    #[Rule('nullable|string|max:10')]
    public ?string $zipcode,

    #[Rule('required|string|max:100')]
    public string $address,

    #[Rule('nullable|string|max:15')]
    public ?string $address_number,

    #[Rule('nullable|string|max:100')]
    public ?string $complement,

    #[Rule('required|string|max:100')]
    public string $district,

    #[Rule('nullable|string|max:100')]
    public ?string $reference_point,

    #[Rule('required|integer|exists:city,id')]
    public int $city_id,

    #[Rule('nullable')]
    public object|array|null $city,
  ) {
  }

  // Preparar dados para validação
  public static function prepareForValidation(): void
  {
    $isCpf = strlen(onlyNumbers(request('ein', ''))) <= 11;
    request()->merge([
      'is_final_customer' => $isCpf,
    ]);
  }

  public static function rules(): array
  {
    static::prepareForValidation();
    return [
      'type' => [
        'required',
        new Enum(PersonAddressTypeEnum::class)
      ],
      'ein' => [
        'nullable',
        'string',
        fn ($att, $value, $fail) => static::rulesEin($att, $value, $fail),
      ],
    ];
  }

  // Validar CPF/CNPJ
  public static function rulesEin($att, $value, $fail)
  {
    if ($value && (!cpfOrCnpjIsValid($value))) {
      $fail(trans('request_validation_lang.field_is_not_valid', ['value' => $value]));
    }
  }

  // public static function messages(): array
  // {
  //   return [
  //     'person_address.*.type.required' => 'A dsadsasa type title is required',
  //     // 'person_address.*.type.required' => 'A dsadsasa type title is required',
  //   ];
  // }
}
