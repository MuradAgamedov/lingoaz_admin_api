<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DictionaryMeaning extends Model
{
    protected $fillable = [
        'dictionary_id',
        'part_of_speech',
    ];

    public function dictionary()
    {
        return $this->belongsTo(Dictionary::class);
    }

    public function definitions()
    {
        return $this->hasMany(DictionaryDefinition::class, 'dictionary_meaning_id');
    }
}
