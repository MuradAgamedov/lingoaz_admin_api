<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DictionaryCategory extends Model
{
    protected $fillable = [
        'title',
        'image',
    ];

    public function dictionaries()
    {
        return $this->belongsToMany(Dictionary::class, 'dictionary_dictionary_category', 'dictionary_category_id', 'dictionary_id');
    }
}
