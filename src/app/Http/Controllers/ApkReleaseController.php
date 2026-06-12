<?php

namespace App\Http\Controllers;

use App\Models\ApkRelease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApkReleaseController extends Controller
{
    public function index()
    {
        $releases = ApkRelease::latest()->get();
        return view('pages.apk.index', compact('releases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'version' => 'required|string|max:50',
            'apk'     => 'required|file|mimes:apk',
        ]);

        $file     = $request->file('apk');
        $filename = 'lingoaz-' . $request->version . '.apk';
        $path     = $file->storeAs('apk', $filename, 'public');
        $sizeKb   = (int) round($file->getSize() / 1024);

        ApkRelease::create([
            'version'   => $request->version,
            'filename'  => $filename,
            'path'      => $path,
            'size_kb'   => $sizeKb,
            'is_active' => false,
        ]);

        return redirect()->route('apk.index')->with('success', 'APK uğurla yükləndi.');
    }

    public function activate($id)
    {
        ApkRelease::query()->update(['is_active' => false]);
        ApkRelease::findOrFail($id)->update(['is_active' => true]);

        return redirect()->route('apk.index')->with('success', 'Aktiv APK dəyişdirildi.');
    }

    public function destroy($id)
    {
        $release = ApkRelease::findOrFail($id);
        Storage::disk('public')->delete($release->path);
        $release->delete();

        return redirect()->route('apk.index')->with('success', 'APK silindi.');
    }
}
