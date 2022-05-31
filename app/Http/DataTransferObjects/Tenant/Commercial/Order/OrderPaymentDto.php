<?php

namespace App\Http\DataTransferObjects\Tenant\Commercial\BusinessProposal;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class BusinessProposalProductDto extends Data
{
  public static function authorize(): bool
  {
    return true;
  }  

  public function __construct(
    #[Rule('nullable|integer')]
    public ?int $id,

    #[Rule('nullable|integer')]
    public ?int $business_proposal_id,

    #[Rule('required|integer|exists:product,id')]
    public int $product_id,

    #[Rule('nullable')]
    public object|array|null $product,

    #[Rule('nullable|string|max:80')]
    public ?string $complement_note,

    #[Rule('required|numeric|min:0')]
    public float $quantity,

    #[Rule('nullable|numeric|min:0')]
    public ?float $price,

    #[Rule('nullable|numeric|min:0')]
    public ?float $unit_discount,

    #[Rule('nullable|numeric|min:0')]
    public ?float $total,
  ) {
  }

  public static function rules(): array
  {
    return [];
  }
}
