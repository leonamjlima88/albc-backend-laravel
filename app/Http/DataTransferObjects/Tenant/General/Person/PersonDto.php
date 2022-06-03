<?php

namespace App\Http\DataTransferObjects\Tenant\General\Person;

use App\Models\Tenant\General\Person\Enum\PersonAddressTypeEnum;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Validation\Validator;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PersonDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }

  public function __construct(
    #[Rule('nullable|integer')]
    public ?int $id,

    #[Rule('required|string|max:80')]
    public string $business_name,

    #[Rule('required|string|max:80')]
    public string $alias_name,

    public ?string $ein,

    #[Rule('nullable|string|max:20')]
    public ?string $state_registration,

    #[Rule('nullable|string|max:20')]
    public ?string $municipal_registration,

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

    #[Rule('nullable|string|max:40')]
    public ?string $phone_1,

    #[Rule('nullable|string|max:40')]
    public ?string $phone_2,

    #[Rule('nullable|string|max:40')]
    public ?string $phone_3,

    #[Rule('nullable|string|email|max:100')]
    public ?string $company_email,

    #[Rule('nullable|string|email|max:100')]
    public ?string $financial_email,

    #[Rule('nullable|string|max:255')]
    public ?string $internet_page,

    #[Rule('nullable|string')]
    public ?string $note,

    #[Rule('nullable|string')]
    public ?string $bank_note,

    #[Rule('nullable|string')]
    public ?string $commercial_note,

    #[Rule('nullable|boolean')]
    public ?bool $is_customer,

    #[Rule('nullable|boolean')]
    public ?bool $is_seller,

    #[Rule('nullable|boolean')]
    public ?bool $is_supplier,

    #[Rule('nullable|boolean')]
    public ?bool $is_carrier,

    #[Rule('nullable|boolean')]
    public ?bool $is_technician,

    #[Rule('nullable|boolean')]
    public ?bool $is_employee,

    #[Rule('nullable|boolean')]
    public ?bool $is_other,

    #[Rule('nullable|boolean')]
    public ?bool $is_final_customer,

    #[Rule('nullable|string|min:10')]
    public ?string $created_at,

    #[Rule('nullable|string|min:10')]
    public ?string $updated_at,

    /** @var PersonAddressDto[] */
    public ?DataCollection $person_address,

    /** @var PersonContactDto[] */
    public ?DataCollection $person_contact,
  ) {
  }

  // Preparar dados para validação
  public static function prepareForValidation(): void
  {
    request()->merge([
      'alias_name' =>  request('alias_name', '') ?: request('business_name', ''),
      'ein' => formatCpfCnpj(request('ein', '')),
    ]);
  }  

  public static function rules(): array
  {
    static::prepareForValidation();
    return [
      'ein' => [
        'required',
        'string',
        ValidationRule::unique('person', 'ein')->ignore(getRouteParameter()),
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

  public static function withValidator(Validator $validator): void
  {
    $validator->after(function ($validator) {
      // Person - Tipo de Pessoa é obrigatório
      if ((!request('is_customer') ?? false)
      &&  (!request('is_seller') ?? false)
      &&  (!request('is_supplier') ?? false)
      &&  (!request('is_carrier') ?? false)
      &&  (!request('is_technician') ?? false)
      &&  (!request('is_employee') ?? false)
      &&  (!request('is_other') ?? false)
      ) {
        $validator->errors()->add('is_customer|is_seller|is_supplier|...', trans('request_validation_lang.at_least_one_field_must_be_filled'));
      }
    });
  }

  public static function messages(): array
  {
    return [
      'person_address.*.type.Illuminate\Validation\Rules\Enum' => trans(
        'request_validation_lang.enum_is_not_valid', ['value' => PersonAddressTypeEnum::valueList()]
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
