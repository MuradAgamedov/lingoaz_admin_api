<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDictionaryDefinition extends Model
{
    protected $fillable = [
        'user_dictionary_meaning_id',
        'definition',
        'example',
    ];

    public function meaning()
    {
        return $this->belongsTo(UserDictionaryMeaning::class, 'user_dictionary_meaning_id');
    }
}
