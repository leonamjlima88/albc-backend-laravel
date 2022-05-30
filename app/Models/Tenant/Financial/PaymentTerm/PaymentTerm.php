<?php

namespace App\Models\Tenant\Financial\PaymentTerm;

use App\Http\DataTransferObjects\Tenant\Financial\PaymentTerm\PaymentTermDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class PaymentTerm extends Model
{
    use HasFactory;
    use WithData;
        
    protected $table = 'payment_term';
    protected $dates = [];
    protected $dataClass = PaymentTermDto::class;
    public $timestamps = true;

    protected $hidden = [
    ];

    protected $casts = [
        'is_cents_in_the_last_installment' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'is_cents_in_the_last_installment',
    ];

    protected static function boot()
    {
        parent::boot();
        
        // Antes de salvar a informação
        static::saving(fn ($model) => $model);

        // Após recuperar a informação
        static::retrieved(fn ($model) => $model);        
    }
    
    public function paymentTermInstallment()
    {
        return $this->hasMany(PaymentTermInstallment::class);
    }
}
