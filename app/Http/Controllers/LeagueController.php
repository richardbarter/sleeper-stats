<?php

namespace App\Http\Controllers;

use App\Services\LeagueService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class LeagueController extends Controller
{
    //

    protected $leagueService;

    public function __construct(LeagueService $leagueService)
    {
        $this->leagueService = $leagueService;
    }

    //if I am going to use pinia state, in some cases, I may want to only return the json rather than an Inertia view. Could implement this by using a check on the request type -  if ($request->wantsJson()) { then it returns a json:  // If the request expects JSON, return data as JSON, other wise it returns an Inertia response..
    // return response()->json([
    //     'leagueData' => $leagueData
    // ]);


    public function show($leagueId)
    {

        //dd('in show leauge controller');
        $leagueData = $this->leagueService->getLeagueData($leagueId);
        $rostersData = $this->leagueService->getRostersData($leagueId);
        //dd($rostersData);
        $leagueUsers = $this->leagueService->getLeagueUsers($leagueId);
        $userRosterData = $this->leagueService->enrichRostersWithUserData($rostersData, $leagueUsers);

        $powerRankings = $this->leagueService->sortPowerRankings($userRosterData);

        //dd($leagueData, $userRosterData);

        //now I want to get the users of this leage. or actually I want an object for each user of the leage. And each object contains that users roster etc.
        //based of the rosters data. will need to loop through each roster and then get the user. This will give use their display nam,e username and avatar.
        //can be found based on their user id or their username. we will do the api call based on their user id. The user object avatar will then be an id, which will need to call the avatar endpoint with teh ID to get it

        //i want to send back the league details in one object, and then an array of objects? Each object will be the users team information. Including the player names and matchups etc?
        //then on each player, you can click a Link to go into that players profile page where it shows more stats related to that player.

        //do I need to combine all of these different datapoints, into a limited response object that only contains the data that I need to use?


        //dd($leagueData, $rostersData, $leagueUsers);
        // Pass data to your view or Inertia response
        return Inertia::render('League/Show', [
            'league' => $leagueData,
            'userRosterData' => $userRosterData,
            'powerRankings' => $powerRankings
        ]); 

    }

    // $leagueUrl = "https://api.sleeper.app/v1/league/{$leagueId}";
        // $rostersUrl = "{$leagueUrl}/rosters";

        // // Fetch league data
        // $leagueResponse = Http::get($leagueUrl);
        // $leagueData = $leagueResponse->json();

        // // Fetch rosters data
        // $rostersResponse = Http::get($rostersUrl);
        // $rostersData = $rostersResponse->json();

        // // Optionally, you can fetch more data as needed
        // // $usersData = Http::get("{$leagueUrl}/users")->json();
        // // $matchupsData = Http::get("{$leagueUrl}/matchups")->json();
        // // Process other endpoints similarly

        // // Extract player IDs from rosters
        // $playerIds = collect($rostersData)->flatMap(function ($roster) {
        //     return $roster['players'] ?? [];
        // })->unique()->all();

        // // Query local database for player details
        // $players = NflPlayer::whereIn('player_id', $playerIds)->get();

        // // Prepare data for the view or as a response
        // return view('leagues.show', [
        //     'league' => $leagueData,
        //     'rosters' => $rostersData,
        //     'players' => $players,
        //     // Include other necessary data
        // ]);
}
