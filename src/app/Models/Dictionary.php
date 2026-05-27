<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    protected $fillable = [
        'word',
        'phonetic',
        'audio_urls',
        'translation',
        'translation_json',
        'part_of_speech',
        'definition',
        'example',
        'phonetics',
        'meanings',
        'user_id',
        'image',
    ];

    protected $casts = [
        'audio_urls' => 'array',
        'phonetics' => 'array',
        'meanings' => 'array',
        'translation_json' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function synonyms()
    {
        return $this->belongsToMany(
            Dictionary::class,
            'dictionary_synonyms',
            'dictionary_id',
            'synonym_id'
        );
    }

    public function antonyms()
    {
        return $this->belongsToMany(
            Dictionary::class,
            'dictionary_antonyms',
            'dictionary_id',
            'antonym_id'
        );
    }

    public function meaningsRelation()
    {
        return $this->hasMany(DictionaryMeaning::class);
    }

    public function categories()
    {
        return $this->belongsToMany(DictionaryCategory::class, 'dictionary_dictionary_category', 'dictionary_id', 'dictionary_category_id');
    }
}
