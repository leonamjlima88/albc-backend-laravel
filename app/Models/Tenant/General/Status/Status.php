<?php

namespace App\Models\Tenant\General\Status;

use App\Http\DataTransferObjects\Tenant\General\Status\StatusDto;
use App\Models\Tenant\General\Status\Enum\StatusActionEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Status extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'status';
    protected $dates = [];
    protected $dataClass = StatusDto::class;
    public $timestamps = true;

    protected $hidden = [
    ];

    protected $casts = [
        'action' => StatusActionEnum::class,
    ];

    protected $fillable = [
        'name',
        'action',
    ];

    protected static function boot()
    {
        parent::boot();

        // Formatar dados antes de salvar a informação
        static::saving(fn ($model) => $model);

        // Formatar dados após recuperar a informação
        static::retrieved(fn ($model) => $model);
    }

    public function statusTag()
    {
        return $this->hasMany(StatusTag::class);
    }
}
