<?php

namespace App\Models\Tenant\Stock\Product;

use App\Http\DataTransferObjects\Tenant\Stock\Product\ProductDto;
use App\Models\Tenant\Stock\Brand\Brand;
use App\Models\Tenant\Stock\Category\Category;
use App\Models\Tenant\Stock\Product\Enum\ProductGenreEnum;
use App\Models\Tenant\Stock\Product\Enum\ProductTypeEnum;
use App\Models\Tenant\Stock\Size\Size;
use App\Models\Tenant\Stock\StorageLocation\StorageLocation;
use App\Models\Tenant\Stock\Unit\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Product extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'product';
    protected $dates = [];
    protected $dataClass = ProductDto::class;
    public $timestamps = true;

    protected $hidden = [
    ];

    protected $casts = [
        'type' => ProductTypeEnum::class,
        'cost_price' => 'float',
        'sale_price' => 'float',
        'current_quantity' => 'float',        
        'minimum_quantity' => 'float',
        'maximum_quantity' => 'float',
        'gross_weight' => 'float',
        'net_weight' => 'float',
        'packing_weight' => 'float',
        'is_to_move_the_stock' => 'boolean',
        'is_product_for_scales' => 'boolean',
        'is_discontinued' => 'boolean',
        'genre' => ProductGenreEnum::class,
    ];

    protected $fillable = [
        'name',
        'type',
        'sku_code',
        'ean_code',
        'manufacturing_code',
        'identification_code',
        'cost_price',
        'sale_price',
        'current_quantity',
        'minimum_quantity',
        'maximum_quantity',
        'gross_weight',
        'net_weight',
        'packing_weight',
        'is_to_move_the_stock',
        'is_product_for_scales',
        'note',
        'internal_note',
        'is_discontinued',
        'unit_id',
        'category_id',
        'brand_id',
        'size_id',
        'storage_location_id',
        'genre',
    ];

    protected static function boot()
    {
        parent::boot();

        // Formatar dados antes de salvar a informação
        static::saving(fn ($model) => $model);

        // Formatar dados após recuperar a informação
        static::retrieved(fn ($model) => $model);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
    
    public function storage_location()
    {
        return $this->belongsTo(StorageLocation::class);
    }
}
