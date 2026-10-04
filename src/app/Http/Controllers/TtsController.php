<?php

namespace App\Http\Controllers;

use App\Services\TtsService;
use Illuminate\Http\Request;

class TtsController extends Controller
{
    public function __invoke(Request $request, TtsService $tts)
    {
        $file = $tts->ensure((string) $request->query('text', ''), $request->query('voice'));

        abort_if($file === null, 503);

        return response()->file($file, [
            'Content-Type' => 'audio/wav',
            'Cache-Control' => 'private, max-age=31536000, immutable',
        ]);
    }
}
