<?php

namespace App\Models\Tenant\General\Status;

use App\Models\Tenant\General\Status\Enum\StatusTagDomainEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class StatusTag extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'status_tag';
    protected $dates = [];
    protected $dataClass = StatusTagDto::class;
    public $timestamps = false;

    protected $hidden = [
    ];

    protected $casts = [
        'domain' => StatusTagDomainEnum::class,
    ];

    protected $fillable = [
        'status_id',
        'domain',
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
