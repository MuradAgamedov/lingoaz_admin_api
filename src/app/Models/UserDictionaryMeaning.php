<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDictionaryMeaning extends Model
{
    protected $fillable = [
        'user_dictionary_id',
        'part_of_speech',
    ];

    public function dictionary()
    {
        return $this->belongsTo(UserDictionary::class, 'user_dictionary_id');
    }

    public function definitions()
    {
        return $this->hasMany(UserDictionaryDefinition::class, 'user_dictionary_meaning_id');
    }
}
