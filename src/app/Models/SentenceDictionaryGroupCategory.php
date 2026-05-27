<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SentenceDictionaryGroupCategory extends Model
{
    protected $fillable = [
        'sentence_dictionary_group_id',
        'title',
    ];

    public function group()
    {
        return $this->belongsTo(SentenceDictionaryGroup::class, 'sentence_dictionary_group_id');
    }
}
