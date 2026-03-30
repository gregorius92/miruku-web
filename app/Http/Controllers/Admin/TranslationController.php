<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Log;

class TranslationController extends Controller
{
    public function translate(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'target' => 'nullable|string|max:10',
        ]);

        try {
            $tr = new GoogleTranslate();
            $tr->setSource('id');
            $tr->setTarget($request->target ?? 'en');
            
            $translated = $tr->translate($request->text);

            return response()->json([
                'success' => true,
                'translatedText' => $translated,
            ]);
        } catch (\Exception $e) {
            Log::error('Translation Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menerjemahkan teks.',
                'originalText' => $request->text,
            ], 500);
        }
    }
}
