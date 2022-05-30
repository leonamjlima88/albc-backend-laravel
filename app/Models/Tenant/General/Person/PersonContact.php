<?php

namespace App\Models\Tenant\General\Person;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonContact extends Model
{
    use HasFactory;

    protected $table = 'person_contact';
    public $timestamps = false;

    protected $casts = [
    ];

    protected $fillable = [
        'person_id',
        'name',
        'ein',
        'type',
        'general_note',
        'phone',
        'email',
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
