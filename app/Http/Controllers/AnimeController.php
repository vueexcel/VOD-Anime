<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Anime;

class AnimeController extends Controller
{
    public function show($slug){
        try {
            $anime = Anime::where('slug', $slug)->first()->makeHidden(['created_at', 'updated_at']);

            if ($anime) {
                return response()->json($anime, 200);
            }

            return response()->json(['error' => 'Anime not found'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the anime. Please try again later.'], 500);
        }
    }
}