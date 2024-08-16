<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\NflPlayer;


class UpdateNFLPlayers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:nflplayers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the NFL players from the sleeper API';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //advised by docs to only call once per day tops. 
        $this->info('Fetching NFL players data from the API...');
        $client = new Client();
        $response = $client->request('GET', 'https://api.sleeper.app/v1/players/nfl');
        $players = json_decode($response->getBody()->getContents(), true);

        $this->info('Updating database...');
        foreach ($players as $id => $playerData) {
            NflPlayer::updateOrCreate(
                ['player_id' => $id], // Key to check existing record
                [
                    'first_name' => $playerData['first_name'] ?? null,
                    'last_name' => $playerData['last_name'] ?? null,
                    'team' => $playerData['team'] ?? null,
                    'position' => $playerData['position'] ?? null,
                    'status' => $playerData['status'] ?? null,
                    'hashtag' => $playerData['hashtag'] ?? null,
                    'depth_chart_position' => $playerData['depth_chart_position'] ?? null,
                    'sport' => $playerData['sport'] ?? null,
                    'fantasy_positions' => json_encode($playerData['fantasy_positions'] ?? []),
                    'number' => $playerData['number'] ?? null,
                    'search_last_name' => $playerData['search_last_name'] ?? null,
                    'injury_start_date' => $playerData['injury_start_date'] ?? null,
                    'weight' => $playerData['weight'] ?? null,
                    'practice_participation' => $playerData['practice_participation'] ?? null,
                    'sportradar_id' => $playerData['sportradar_id'] ?? null,
                    'college' => $playerData['college'] ?? null,
                    'fantasy_data_id' => $playerData['fantasy_data_id'] ?? null,
                    'injury_status' => $playerData['injury_status'] ?? null,
                    'height' => $playerData['height'] ?? null,
                    'search_full_name' => $playerData['search_full_name'] ?? null,
                    'age' => $playerData['age'] ?? null,
                    'stats_id' => $playerData['stats_id'] ?? null,
                    'birth_country' => $playerData['birth_country'] ?? null,
                    'espn_id' => $playerData['espn_id'] ?? null,
                    'search_rank' => $playerData['search_rank'] ?? null,
                    'depth_chart_order' => $playerData['depth_chart_order'] ?? null,
                    'years_exp' => $playerData['years_exp'] ?? null,
                    'rotowire_id' => $playerData['rotowire_id'] ?? null,
                    'rotoworld_id' => $playerData['rotoworld_id'] ?? null,
                    'search_first_name' => $playerData['search_first_name'] ?? null,
                    'yahoo_id' => $playerData['yahoo_id'] ?? null
                ]
            );
        }

        $this->info('NFL players data has been updated successfully.');
    }
}
