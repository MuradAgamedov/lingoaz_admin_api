<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDictionaryCategory extends Model
{
    protected $fillable = [
        'user_id',
        'title',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dictionaries()
    {
        return $this->belongsToMany(
            UserDictionary::class,
            'user_dictionary_user_dictionary_category',
            'user_dictionary_category_id',
            'user_dictionary_id'
        );
    }
}
