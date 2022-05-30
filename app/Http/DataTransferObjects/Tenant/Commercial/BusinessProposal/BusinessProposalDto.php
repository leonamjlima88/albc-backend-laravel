<?php

namespace App\Http\DataTransferObjects\Tenant\Commercial\BusinessProposal;

use Illuminate\Validation\Validator;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

// TODO: Precisa melhorar comando exists de persons (customer, seller ...)
class BusinessProposalDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }

  public function __construct(
    #[Rule('nullable|integer')]
    public ?int $id,

    #[Rule('nullable|integer|exists:person,id')]
    public ?int $customer_id,

    #[Rule('nullable')]
    public object|array|null $customer,

    #[Rule('required|integer|exists:person,id')]
    public int $seller_id,

    #[Rule('nullable')]
    public object|array|null $seller,

    #[Rule('required|integer|exists:status,id')]
    public int $status_id,

    #[Rule('nullable')]
    public object|array|null $status,

    #[Rule('nullable|string')]
    public ?string $private_note,

    #[Rule('nullable|string')]
    public ?string $public_note,

    #[Rule('nullable|string|min:10')]
    public ?string $offer_valid_until,

    #[Rule('nullable|string|min:10')]
    public ?string $delivery_forecast_until,

    #[Rule('nullable|numeric')]
    public ?float $business_proposal_product_sum_total,

    #[Rule('nullable|string|min:10')]
    public ?string $created_at,

    #[Rule('nullable|string|min:10')]
    public ?string $updated_at,

    /** @var BusinessProposalProductDto[] */
    public ?DataCollection $business_proposal_product,
  ) {
  }

  // Preparar dados para validação
  public static function prepareForValidation(): void
  {
    request()->merge([]);
  }  

  public static function rules(): array
  {
    static::prepareForValidation();
    return [];
  }

  public static function withValidator(Validator $validator): void
  {
    $validator->after(function ($validator) {
        // $validator->errors()->add('field', 'message');
    });
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
