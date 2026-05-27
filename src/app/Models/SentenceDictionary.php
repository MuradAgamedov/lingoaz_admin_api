<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SentenceDictionary extends Model
{
    protected $fillable = [
        'user_id',
        'sentence_dictionary_group_category_id',
        'word',
        'translation',
        'audio_urls',
    ];

    protected $casts = [
        'audio_urls' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(SentenceDictionaryGroupCategory::class, 'sentence_dictionary_group_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
