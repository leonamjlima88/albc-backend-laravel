<?php

namespace App\Models\Tenant\General\Person;

use App\Models\Tenant\General\City\City;
use App\Models\Tenant\General\Person\Enum\PersonAddressTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonAddress extends Model
{
    use HasFactory;

    protected $table = 'person_address';
    public $timestamps = false;
    protected $hidden = [];

    protected $casts = [
        'type' => PersonAddressTypeEnum::class,
    ];

    protected $fillable = [
        'person_id',
        'type',
        'recipient',
        'ein',
        'zipcode',
        'address',
        'address_number',
        'complement',
        'district',
        'city_id',
        'reference_point',
    ];

    protected static function boot()
    {
        parent::boot();

        // Formatar dados antes de salvar a informação
        static::saving(fn ($model) => $model);

        // Formatar dados após recuperar a informação
        static::retrieved(fn ($model) => $model);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
