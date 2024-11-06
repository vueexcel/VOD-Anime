<?php

namespace App\Services;

use App\Models\Anime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Exception;

class AnimeService
{
    protected $baseUrl = 'https://api.jikan.moe/v4'; 

    public function fetchPopularAnimes($limit = 100)
    {
        $animes = [];
        $page = 1;
        $pagesRequired = ceil($limit / 25); //* Used this as API only allows 25 records per page

        while ($page <= $pagesRequired) {
            $cacheKey = 'jikan_api_rate_limit';
            $rateLimit = Cache::get($cacheKey, 0);

            //* If rate limit exceeds the 25, then wait for 60 seconds
            if ($rateLimit >= 25) {
                sleep(60);
                Cache::put($cacheKey, 0, now()->addMinutes(1)); 
            }

            try {
                $response = Http::get("{$this->baseUrl}/top/anime", [
                    'page' => $page,    
                    'limit' => 25,      
                    'filter' => 'bypopularity',  
                ]);

                if ($response->successful()) {
                    $responseData = $response->json();

                    if (isset($responseData['data'])) {
                        $animes = array_merge($animes, $responseData['data']);
                    }

                    //* Storing the rate limit from the response header in cache
                    $rateLimit = $response->header('X-RateLimit-Remaining');
                    Cache::put($cacheKey, $rateLimit, now()->addMinutes(1)); 
                } else {
                    //* If rate limit (status 429) is exceeded, wait for the duration specified in 'Retry-After' header
                    if ($response->status() == 429) {
                        $retryAfter = $response->header('Retry-After', 60);  
                        sleep($retryAfter);  
                    } else {
                        throw new Exception("Failed to fetch data from Jikan API. Status code: " . $response->status());
                    }
                }
            } catch (Exception $e) {
                break; 
            }

            $page++;  
        }

        if (count($animes) > 0) {
            foreach ($animes as $animeData) {
                Anime::updateOrCreate(
                    ['mal_id' => $animeData['mal_id']], 
                    [
                        'slug' => $animeData['title'],
                        'title' => $animeData['title'],
                        'synopsis' => $animeData['synopsis'],
                        'image_url' => $animeData['images']['jpg']['image_url'],
                        'url' => $animeData['url'],
                    ]
                );
            }
            return true; 
        }

        return false;  
    }
}