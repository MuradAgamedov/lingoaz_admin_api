<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['user_id', 'note_group_id', 'title', 'content'];

    public function group()
    {
        return $this->belongsTo(NoteGroup::class, 'note_group_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
