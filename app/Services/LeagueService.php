<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class LeagueService
{
    /**
     * Fetch league data from the external API.
     *
     * @param  string  $leagueId
     * @return array
     */
    public function getLeagueData($leagueId)
    {
        //league ID is for a specific league within a specific season. 
        return Cache::remember("league_data_{$leagueId}", 3600, function () use ($leagueId) {
            $response = Http::get("https://api.sleeper.app/v1/league/{$leagueId}");
            return $response->json();
        });
    }

    /**
     * Fetch rosters data from the external API.
     *
     * @param  string  $leagueId
     * @return array
     */
    public function getRostersData($leagueId)
    {
        return Cache::remember("rosters_data_{$leagueId}", 10000, function () use ($leagueId) {
            $response = Http::get("https://api.sleeper.app/v1/league/{$leagueId}/rosters");
            return $response->json();
        });
    }

    public function getLeagueUsers($leagueId)
    {
        return Cache::remember("league_users_{$leagueId}", 10000, function () use ($leagueId) {
            $response = Http::get("https://api.sleeper.app/v1/league/{$leagueId}/users");
            return $response->json();
        });
    }

    //store the matchups in pinia? Where will matchups be displayed? Will they be displayed. Really, if I want stats to include the average of points scored at each position
    //then I may want to get all regular season weeks, and do some calculation on them to get the points average.
    //then on the main league page, it will show the rankings of avereage points scored at each position. 1-12 for QB.
    //so can see who scored more at what position. who had below average. 
    public function getMatchupWeek($leagueId, $weekNumber){
        return Cache::remember("matchup_week_{$leagueId}", 10000, function () use ($leagueId, $weekNumber) {
            $response = Http::get("https://api.sleeper.app/v1/league/{$leagueId}/matchups/{$weekNumber}");
            return $response->json();
        });
    }


    public function enrichRostersWithUserData($rostersData, $leagueUsers) 
    {
        $indexedUsers = collect($leagueUsers)->keyBy('user_id');
        //should get the matchup for each players here?
        //the matchup
        return collect($rostersData)->map(function ($roster) use ($indexedUsers) {
            $user = $indexedUsers->get($roster['owner_id']);
            return [
                'roster_data' => $roster,
                'user_data' => $user
            ];
            // return [
            //     'roster_id' => $roster['roster_id'],
            //     'owner_name' => $user['display_name'] ?? 'Unknown',
            //     // 'owner_avatar' => $this->getUserAvatar($user['avatar']), //leave the avatar for now
            //     'players' => $roster['players'],
            //     'starters' => $roster['starters'],
            //     'settings' => $roster['settings'],
            // ];
        });
    }

    public function sortPowerRankings($userRosterData){
        //for each of the user roster data, I want to build and then return the power rankings power rankings should return an array of objects each object in the following sstructure:  teamName, wins, losses, pts for, pts against, rank
        // dd($userRosterData);
        // $powerRankings = [];
        // foreach($userRosterData as $userRoster){
        //     foreach($userRoster['settings'] as $setting){

        //     }
        // }


        //convert to a collection.
        //reduce or map through the collection 




        
        // Step 1: Transform the data using map
        $powerRankings = $userRosterData->map(function ($userRoster)  {
            return [
                'teamName' => $userRoster['user_data']['display_name'],
                'wins' => $userRoster['roster_data']['settings']['wins'],
                'losses' => $userRoster['roster_data']['settings']['losses'],
                'pts_for' => $userRoster['roster_data']['settings']['fpts'] + $userRoster['roster_data']['settings']['fpts_decimal'] / 100,
                'pts_against' => $userRoster['roster_data']['settings']['fpts_against'] + $userRoster['roster_data']['settings']['fpts_against_decimal'] / 100,
                'rank' => 0 // Placeholder, will be calculated after sorting
            ];
        });

        // Step 2: Sort the power rankings by wins and then by points for
        $powerRankings = $powerRankings->sort(function ($a, $b) {
            if ($a['wins'] === $b['wins']) {
                return $b['pts_for'] <=> $a['pts_for'];
            }
            return $b['wins'] <=> $a['wins'];
        })->values(); // Reindex the sorted collection
    
        //dd($powerRankings);
        // Step 3: Assign ranks
        $powerRankings = $powerRankings->map(function ($team, $index) {
            // dump($team);
            // echo 'index is ' . $index;
            //calculate wins--losses-ties
            $ties = $team['ties'] ?? 0;
            
            $team['wlt'] = $team['wins'] . '-' . $team['losses'] . '-' . $ties;

            $team['rank'] = $index + 1;
            return $team;
        });

        //dd($powerRankings);
        return $powerRankings;




    }


}
