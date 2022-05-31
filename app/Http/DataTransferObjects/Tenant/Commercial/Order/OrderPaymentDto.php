<?php

namespace App\Http\DataTransferObjects\Tenant\Commercial\Order;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class OrderPaymentDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable|integer')]
    public ?int $id,

    #[Rule('nullable|integer')]
    public ?int $order_id,

    #[Rule('required|integer|exists:bank_account,id')]
    public int $bank_account_id,

    #[Rule('nullable')]
    public object|array|null $bank_account,

    #[Rule('required|integer|exists:payment_option,id')]
    public int $payment_option_id,

    #[Rule('nullable')]
    public object|array|null $payment_option,

    #[Rule('required|date_format:Y-m-d')]
    public string $expire_at,

    #[Rule('required|numeric|min:0')]
    public float $amount,

    #[Rule('nullable|string')]
    public ?string $note,
  ) {
  }

  public static function rules(): array
  {
    return [];
  }
}
