<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDictionary extends Model
{
    protected $fillable = [
        'word',
        'audio_urls',
        'translation',
        'user_dictionary_group_id',
        'user_id',
    ];

    protected $casts = [
        'audio_urls' => 'array',
    ];

    public function group()
    {
        return $this->belongsTo(UserDictionaryGroup::class, 'user_dictionary_group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(
            UserDictionaryCategory::class,
            'user_dictionary_user_dictionary_category',
            'user_dictionary_id',
            'user_dictionary_category_id'
        );
    }
}
