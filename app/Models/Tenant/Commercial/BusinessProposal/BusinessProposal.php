<?php

namespace App\Models\Tenant\Commercial\BusinessProposal;

use App\Http\DataTransferObjects\Tenant\Commercial\BusinessProposal\BusinessProposalDto;
use App\Models\Tenant\Commercial\BusinessProposal\BusinessProposalProduct;
use App\Models\Tenant\General\Person\Person;
use App\Models\Tenant\General\Status\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class BusinessProposal extends Model
{
    use HasFactory;
    use WithData;
        
    protected $table = 'business_proposal';
    protected $dates = [];
    protected $dataClass = BusinessProposalDto::class;
    public $timestamps = true;

    protected $hidden = [
    ];

    protected $casts = [
        'business_proposal_product_sum_total' => 'float',
    ];

    protected $fillable = [
        'customer_id',
        'seller_id',
        'status_id',
        'private_note',
        'public_note',
        'offer_valid_until',
        'delivery_forecast_until',
        'business_proposal_product_sum_total',
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

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function businessProposalProduct()
    {
        return $this->hasMany(BusinessProposalProduct::class);
    }    
}
