<?php

namespace App\Http\DataTransferObjects\Tenant\Financial\PaymentTerm;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class PaymentTermInstallmentDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable|integer')]
    public ?int $id,

    #[Rule('nullable|integer')]
    public ?int $payment_term_id,

    #[Rule('required|integer|exists:payment_option,id')]
    public int $payment_option_id,

    #[Rule('nullable')]
    public object|array|null $payment_option,

    #[Rule('required|integer|exists:bank_account,id')]
    public int $bank_account_id,

    #[Rule('nullable')]
    public object|array|null $bank_account,

    #[Rule('required|integer:min:0')]
    public int $range_in_days,

    #[Rule('nullable|boolean')]
    public ?bool $is_to_apply_for_funding,

    #[Rule('nullable|boolean')]
    public ?bool $bill_next_month_on_the_day,
  ) {
  }

  public static function rules(): array
  {
    return [];
  }  
}
