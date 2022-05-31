<?php

namespace App\Models\Tenant\Commercial\Order;

use App\Http\DataTransferObjects\Tenant\Commercial\Order\OrderDto;
use App\Models\Tenant\Commercial\Order\Enum\OrderApprovalEnum;
use App\Models\Tenant\Commercial\Order\OrderProduct;
use App\Models\Tenant\Commercial\Order\OrderPayment;
use App\Models\Tenant\General\Person\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Order extends Model
{
    use HasFactory;
    use WithData;
        
    protected $table = 'order';
    protected $dates = [];
    protected $dataClass = OrderDto::class;
    public $timestamps = true;

    protected $hidden = [
    ];

    protected $casts = [
        'approval' => OrderApprovalEnum::class,
        'order_product_sum_total' => 'float',
        'discount' => 'float',
        'total' => 'float',
        'order_product_sum_historical_product_cost_total' => 'float',
    ];

    protected $fillable = [
        'customer_id',
        'seller_id',
        'approval',
        'note',
        'internal_note',
        'order_product_sum_total',
        'discount',
        'total',
        'order_product_sum_historical_product_cost_total',
    ];

    protected static function boot()
    {
        parent::boot();
        
        // Antes de salvar a informação
        static::saving(fn ($model) => $model);

        // Após recuperar a informação
        static::retrieved(fn ($model) => $model);        
    }    

    public function customer()
    {
        return $this->belongsTo(Person::class, 'customer_id', 'id');
    }

    public function seller()
    {
        return $this->belongsTo(Person::class, 'seller_id', 'id');
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }    

    public function orderPayment()
    {
        return $this->hasMany(OrderPayment::class);
    }    
}
