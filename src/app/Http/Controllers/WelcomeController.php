<?php

namespace App\Http\Controllers;

use App\Models\ApkRelease;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function index()
    {
        $apk = ApkRelease::where('is_active', true)->latest()->first();

        $apkUrl     = $apk ? Storage::url($apk->path) : null;
        $apkVersion = $apk ? $apk->version : null;
        $apkSize    = $apk ? $apk->getSizeLabel() : null;

        return view('pages.welcome', compact('apkUrl', 'apkVersion', 'apkSize'));
    }
}
