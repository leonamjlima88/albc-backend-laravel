<?php

namespace App\Models\Tenant\Commercial\Order;

use App\Models\Tenant\General\Person\Person;
use App\Models\Tenant\Stock\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'order_product';
    public $timestamps = false;
    protected $hidden = [];

    protected $casts = [
        'quantity' => 'float',
        'price' => 'float',
        'unit_discount' => 'float',
        'total' => 'float',
        'hist_product_cost_price' => 'float',
        'hist_product_cost_total' => 'float',
    ];

    protected $fillable = [
        'order_id',
        'product_id',
        'complement_note',
        'quantity',
        'price',
        'unit_discount',
        'total',
        'seller_id',
        'hist_product_name',
        'hist_product_cost_price',
        'hist_product_cost_total',
    ];

    protected static function boot()
    {
        parent::boot();

        // Formatar dados antes de salvar a informação
        static::saving(fn ($model) => $model);

        // Formatar dados após recuperar a informação
        static::retrieved(fn ($model) => $model);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }    

    public function seller()
    {
        return $this->belongsTo(Person::class, 'seller_id', 'id');
    }
}
