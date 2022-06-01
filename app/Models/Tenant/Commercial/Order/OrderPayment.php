<?php

namespace App\Models\Tenant\Commercial\Order;

use App\Models\Tenant\Financial\BankAccount\BankAccount;
use App\Models\Tenant\Financial\PaymentOption\PaymentOption;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $table = 'order_payment';
    public $timestamps = false;
    protected $hidden = [];

    protected $casts = [
        'amount' => 'float',
    ];

    protected $fillable = [
        'order_id',
        'bank_account_id',
        'payment_option_id',
        'expire_at',
        'amount',
        'note',
    ];

    protected static function boot()
    {
        parent::boot();

        // Formatar dados antes de salvar a informação
        static::saving(fn ($model) => $model);

        // Formatar dados após recuperar a informação
        static::retrieved(fn ($model) => $model);
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function paymentOption()
    {
        return $this->belongsTo(PaymentOption::class);
    }

}
