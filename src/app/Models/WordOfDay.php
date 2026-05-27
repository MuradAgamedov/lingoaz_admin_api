<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordOfDay extends Model
{
    protected $fillable = ['dictionary_id', 'date'];

    protected $casts = ['date' => 'date'];

    public function dictionary()
    {
        return $this->belongsTo(Dictionary::class);
    }
}
