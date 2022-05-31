<?php

namespace App\Http\DataTransferObjects\Tenant\Commercial\Order;

use App\Models\Tenant\Commercial\Order\Enum\OrderApprovalEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Validator;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

// TODO: Precisa melhorar comando exists de persons (customer, seller ...)
class OrderDto extends Data
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

    public ?int $approval,

    #[Rule('nullable|string')]
    public ?string $note,

    #[Rule('nullable|string')]
    public ?string $internal_note,

    #[Rule('nullable|numeric|min:0')]
    public ?float $order_product_sum_total,

    #[Rule('nullable|numeric|min:0')]
    public ?float $order_product_sum_historical_product_cost_total,

    #[Rule('nullable|numeric|min:0')]
    public ?float $discount,

    #[Rule('nullable|numeric|min:0')]
    public ?float $total,

    #[Rule('nullable|string|min:10')]
    public ?string $created_at,

    #[Rule('nullable|string|min:10')]
    public ?string $updated_at,

    /** @var OrderProductDto[] */
    public DataCollection $order_product,

    /** @var OrderPaymentDto[] */
    public ?DataCollection $order_payment,
  ) {
  }

  // Preparar dados para validação
  public static function prepareForValidation(): void
  {
    request()->merge([]);
  }  

  // Regras de validação
  public static function rules(): array
  {
    static::prepareForValidation();
    return [
      'approval' => [
        'nullable',
        new Enum(OrderApprovalEnum::class)
      ],
    ];
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
