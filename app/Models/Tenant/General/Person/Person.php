<?php

namespace App\Models\Tenant\General\Person;

use App\Http\DataTransferObjects\Tenant\General\Person\PersonDto;
use App\Models\Tenant\General\City\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Person extends Model
{
    use HasFactory;
    use WithData;
        
    protected $table = 'person';
    protected $dates = [];
    protected $dataClass = PersonDto::class;
    public $timestamps = true;

    protected $hidden = [
    ];

    protected $casts = [
        'icms_taxpayer' => 'boolean',
        'is_customer' => 'boolean',
        'is_seller' => 'boolean',
        'is_supplier' => 'boolean',
        'is_carrier' => 'boolean',
        'is_technician' => 'boolean',
        'is_employee' => 'boolean',
        'is_other' => 'boolean',
        'is_final_customer' => 'boolean',
    ];

    protected $fillable = [
        'business_name',
        'alias_name',
        'ein',
        'state_registration',
        'municipal_registration',
        'zipcode',
        'address',
        'address_number',
        'complement',
        'district',
        'city_id',
        'reference_point',
        'phone_1',
        'phone_2',
        'phone_3',
        'company_email',
        'financial_email',
        'internet_page',
        'general_note',
        'bank_note',
        'commercial_note',
        'is_customer',
        'is_seller',
        'is_supplier',
        'is_carrier',
        'is_technician',
        'is_employee',
        'is_other',
        'is_final_customer',
    ];

    protected static function boot()
    {
        parent::boot();
        
        // Antes de salvar a informação
        static::saving(fn ($model) => $model);

        // Após recuperar a informação
        static::retrieved(fn ($model) => $model);        
    }    

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function personAddress()
    {
        return $this->hasMany(PersonAddress::class);
    }

    public function personContact()
    {
        return $this->hasMany(PersonContact::class);
    }
}
