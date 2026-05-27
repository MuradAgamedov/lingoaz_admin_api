<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteGroup extends Model
{
    protected $fillable = ['user_id', 'title'];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
