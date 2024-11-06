<?php

namespace App\Console\Commands;

use App\Services\AnimeService;
use Illuminate\Console\Command;

class ImportAnimeData extends Command
{
    protected $signature = 'anime:import';
    protected $description = 'Import top 100 anime from Jikan API into the database';

    protected $animeService;

    public function __construct(AnimeService $animeService){
        parent::__construct();
        $this->animeService = $animeService;
    }

    public function handle(){
        $this->info('Fetching anime data...');

        if ($this->animeService->fetchPopularAnimes()) {
            $this->info('Anime data imported successfully.');
        } else {
            $this->error('Failed to fetch anime data.');
        }
    }
}