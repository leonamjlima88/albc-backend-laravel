<?php

namespace App\Models\Tenant\Commercial\BusinessProposal;

use App\Models\Tenant\Stock\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProposalProduct extends Model
{
    use HasFactory;

    protected $table = 'business_proposal_product';
    public $timestamps = false;
    protected $hidden = [];

    protected $casts = [
        'quantity' => 'float',
        'sale_price' => 'float',
        'unit_discount' => 'float',
        'total' => 'float',
    ];

    protected $fillable = [
        'business_proposal_id',
        'product_id',
        'complement_note',
        'quantity',
        'sale_price',
        'unit_discount',
        'total',
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
}
