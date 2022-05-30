<?php

namespace App\Models\Tenant\Financial\PaymentOption;

use App\Http\DataTransferObjects\Tenant\Financial\PaymentOption\PaymentOptionDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class PaymentOption extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'payment_option';
    protected $dates = [];
    protected $dataClass = PaymentOptionDto::class;
    public $timestamps = true;

    protected $hidden = [
    ];

    protected $casts = [
        'is_automatic_conference' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'is_automatic_conference',
    ];

    protected static function boot()
    {
        parent::boot();

        // Formatar dados antes de salvar a informação
        static::saving(fn ($model) => $model);

        // Formatar dados após recuperar a informação
        static::retrieved(fn ($model) => $model);
    }
}
