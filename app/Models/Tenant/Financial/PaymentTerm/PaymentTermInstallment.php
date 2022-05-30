<?php

namespace App\Models\Tenant\Financial\PaymentTerm;

use App\Models\Tenant\Financial\BankAccount\BankAccount;
use App\Models\Tenant\Financial\PaymentOption\PaymentOption;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTermInstallment extends Model
{
    use HasFactory;

    protected $table = 'payment_term_installment';
    public $timestamps = false;
    protected $hidden = [];

    protected $casts = [
        'is_to_apply_for_funding' => 'boolean',
    ];

    protected $fillable = [
        'payment_term_id',
        'range_in_days',
        'bill_next_month_on_the_day',
        'bank_account_id',
        'payment_option_id',
        'is_to_apply_for_funding',
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
