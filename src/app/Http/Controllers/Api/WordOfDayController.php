<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\JsonResponse;
use App\Http\Resources\Api\DictionaryWordResource;
use App\Models\WordOfDay;

class WordOfDayController extends Controller
{
    public function show()
    {
        $wordOfDay = WordOfDay::with('dictionary')
            ->where('date', today())
            ->first();

        if (!$wordOfDay || !$wordOfDay->dictionary) {
            return JsonResponse::error('Bugün üçün günün sözü tapılmadı', 404);
        }

        return JsonResponse::success(
            new DictionaryWordResource($wordOfDay->dictionary)
        );
    }
}
