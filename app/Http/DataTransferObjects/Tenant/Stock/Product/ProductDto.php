<?php

namespace App\Http\DataTransferObjects\Tenant\Stock\Product;

use App\Models\Tenant\Stock\Product\Enum\ProductGenreEnum;
use App\Models\Tenant\Stock\Product\Enum\ProductTypeEnum;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Validation\Rules\Enum;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class ProductDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable|integer')]
    public ?int $id,

    #[Rule('required|string|max:120')]
    public string $name,

    public ?string $type,

    public ?string $sku_code,

    public ?string $ean_code,

    #[Rule('nullable|string|max:36')]
    public ?string $manufacturing_code,

    #[Rule('nullable|string|max:36')]
    public ?string $identification_code,

    #[Rule('nullable|numeric|min:0')]
    public ?float $cost_price,

    #[Rule('nullable|numeric|min:0')]
    public ?float $sale_price,

    #[Rule('nullable|numeric|min:0')]
    public ?float $current_quantity,

    #[Rule('nullable|numeric|min:0')]
    public ?float $minimum_quantity,

    #[Rule('nullable|numeric|min:0')]
    public ?float $maximum_quantity,

    #[Rule('nullable|numeric|min:0')]
    public ?float $gross_weight,

    #[Rule('nullable|numeric|min:0')]
    public ?float $net_weight,

    #[Rule('nullable|numeric|min:0')]
    public ?float $packing_weight,

    #[Rule('required|boolean')]
    public bool $is_to_move_the_stock,

    #[Rule('required|boolean')]
    public bool $is_product_for_scales,

    #[Rule('nullable|string|max:80')]
    public ?string $complement_note,

    #[Rule('nullable|string')]
    public ?string $internal_note,

    #[Rule('required|boolean')]
    public bool $is_discontinued,

    #[Rule('required|integer|exists:unit,id')]
    public int $unit_id,

    #[Rule('nullable')]
    public object|array|null $unit,

    #[Rule('nullable|integer|exists:category,id')]
    public ?int $category_id,

    #[Rule('nullable')]
    public object|array|null $category,

    #[Rule('nullable|integer|exists:brand,id')]
    public ?int $brand_id,

    #[Rule('nullable')]
    public object|array|null $brand,

    #[Rule('nullable|integer|exists:size,id')]
    public ?int $size_id,

    #[Rule('nullable')]
    public object|array|null $size,

    #[Rule('nullable|integer|exists:storage_location,id')]
    public ?int $storage_location_id,

    #[Rule('nullable')]
    public object|array|null $storage_location,

    public ?string $genre,

    #[Rule('nullable|string|min:10')]
    public ?string $created_at,

    #[Rule('nullable|string|min:10')]
    public ?string $updated_at,
  ) {
  }

  // Preparar dados para validação
  public static function prepareForValidation(): void
  {
    request()->merge([
      'type' =>  request('type', '')  ?: 'product',
      'genre' => request('genre', '') ?: 'none',
    ]);
  }

  // Regras de validação
  public static function rules(): array
  {
    static::prepareForValidation();
    return [
      'type' => [
        'required',
        new Enum(ProductTypeEnum::class)
      ],
      'sku_code' => [
        'nullable',
        'string',
        'max:36',
        ValidationRule::unique('product', 'sku_code')->where(function ($query) {
          return $query->where('sku_code', '>', '');
        }),
      ],
      'ean_code' => [
        'nullable',
        'string',
        'max:36',
        ValidationRule::unique('product', 'ean_code')->where(function ($query) {
          return $query->where('ean_code', '>', '');
        }),
      ],
      'genre' => [
        'required',
        new Enum(ProductGenreEnum::class)
      ],
    ];
  }

  public static function withValidator(Validator $validator): void
  {
    $validator->after(function ($validator) {
      // $validator->errors()->add('filed', 'error');
    });
  }

  public static function messages(): array
  {
    return [
      'type.Illuminate\Validation\Rules\Enum' => trans(
        'request_validation_lang.enum_is_not_valid', ['value' => ProductTypeEnum::valueList()]
      ),
      'genre.Illuminate\Validation\Rules\Enum' => trans(
        'request_validation_lang.enum_is_not_valid', ['value' => ProductGenreEnum::valueList()]
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
