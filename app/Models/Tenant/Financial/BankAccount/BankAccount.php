<?php

namespace App\Models\Tenant\Financial\BankAccount;

use App\Http\DataTransferObjects\Tenant\Financial\BankAccount\BankAccountDto;
use App\Models\Tenant\Financial\Bank\Bank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class BankAccount extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'bank_account';
    protected $dates = [];
    protected $dataClass = BankAccountDto::class;
    public $timestamps = true;

    protected $hidden = [
    ];

    protected $casts = [
    ];

    protected $fillable = [
        'name',
        'bank_id',
        'agency',
        'agency_digit',
        'account',
        'account_digit',
        'type',
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

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
