<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SentenceDictionaryGroup extends Model
{
    protected $fillable = [
        'user_id',
        'title',
    ];

    public function categories()
    {
        return $this->hasMany(SentenceDictionaryGroupCategory::class, 'sentence_dictionary_group_id');
    }
}
