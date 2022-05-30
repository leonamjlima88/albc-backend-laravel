<?php

namespace App\Models\Tenant\Financial\Bank;

use App\Http\DataTransferObjects\Tenant\Financial\Bank\BankDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Bank extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'bank';
    protected $dates = [];
    protected $dataClass = BankDto::class;
    public $timestamps = true;

    protected $hidden = [
    ];

    protected $casts = [
    ];

    protected $fillable = [
        'code',
        'name',
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
