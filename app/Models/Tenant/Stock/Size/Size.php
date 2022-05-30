<?php

namespace App\Models\Tenant\Stock\Size;

use App\Http\DataTransferObjects\Tenant\Stock\Size\SizeDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Size extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'size';
    protected $dates = [];
    protected $dataClass = SizeDto::class;
    public $timestamps = true;

    protected $hidden = [
    ];

    protected $casts = [
    ];

    protected $fillable = [
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
