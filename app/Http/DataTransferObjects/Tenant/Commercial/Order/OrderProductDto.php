<?php

namespace App\Http\DataTransferObjects\Tenant\Commercial\Order;

use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class OrderProductDto extends Data
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

    #[Rule('required|integer|exists:person,id')]
    public int $seller_id,

    #[Rule('nullable')]
    public object|array|null $seller,

    #[Rule('required|string|max:120')]
    public string $hist_product_name,

    #[Rule('required|numeric|min:0')]
    public float $hist_product_cost_price,

    #[Rule('required|numeric|min:0')]
    public float $hist_product_cost_total,    
  ){
  }

  public static function rules(): array
  {
    return [];
  }
}
