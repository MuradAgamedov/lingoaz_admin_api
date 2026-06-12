<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApkRelease extends Model
{
    protected $fillable = ['version', 'filename', 'path', 'size_kb', 'is_active'];

    public function getSizeLabel(): string
    {
        $mb = round($this->size_kb / 1024, 1);
        return $mb . ' MB';
    }
}
