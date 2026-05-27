<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDictionaryGroup extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'image',
        'order',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
