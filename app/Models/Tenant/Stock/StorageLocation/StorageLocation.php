<?php

namespace App\Models\Tenant\Stock\StorageLocation;

use App\Http\DataTransferObjects\Tenant\Stock\StorageLocation\StorageLocationDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class StorageLocation extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'storage_location';
    protected $dates = [];
    protected $dataClass = StorageLocationDto::class;
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
