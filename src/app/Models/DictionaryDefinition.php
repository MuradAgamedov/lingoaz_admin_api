<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DictionaryDefinition extends Model
{
    protected $fillable = [
        'dictionary_meaning_id',
        'definition',
        'example',
    ];

    public function meaning()
    {
        return $this->belongsTo(DictionaryMeaning::class, 'dictionary_meaning_id');
    }
}