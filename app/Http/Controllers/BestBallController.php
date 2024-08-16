<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Inertia\Inertia;

class BestBallController extends Controller
{
    //converts underdog rankings to draftkings rankings. Resulting in ordered rankings that can then be uploaded to Draftkings.
    //this is just for myself to order by rankings for draftkings upload. 
    //This project requires a `config/custom_bestball_rankings.php` file for custom rankings. This file is not included in the repository. You can create your own `custom_bestball_rankings.php` file in the `config` directory.
    //to use add a file to config folder called custom_bestball_rankings.php
    //then define the custom rankings. Example format should be defined in:
        // return [
        //     'customRankings' => [
        //         "CeeDee Lamb", "Tyreek Hill", "Christian McCaffrey", // ...
        //     ],
        // ];


    protected $dkPlayers;
    protected $customRankings;
    public function __construct()
    {

        //refactor to service or database

        //on the nfl players database I could map the underdog and draftkings ids to the players.
        //that way I can simply take the list of underdog ids in custom rankings order, and pull the draftkings id from the database and build an equivalnt dk rankings list that way.
        //in my scheduler for updqting nfl_players may need to add additional api calls to gather the appropritate underdog and draftkings ids.
        //may need some service to maps names to ids, as the api call to get underdog player ids may name the players differently to how draftkings names and/or differently to how nfl_players table names them.
        //for each player, have a map of the common different versions of their names. For example: JK Dobbins/J.K. Dobbins 
        //Or have a fully separate linking table that has the player id as it relates to the nfl_players table and then has the underdog/draftkings ids in this separate table.
        //this is the draftkings template player => id.
        //refactor this list somewhere else. 
        
        $this->dkPlayers = [
            "Christian McCaffrey" => "830517",
            "CeeDee Lamb" => "1062020",
            "Tyreek Hill" => "823156",
            "Ja'Marr Chase" => "1109979",
            "Amon-Ra St. Brown" => "1127106",
            "Justin Jefferson" => "1069535",
            "Breece Hall" => "1162537",
            "Bijan Robinson" => "1228244",
            "Puka Nacua" => "1162128",
            "A.J. Brown" => "944826",
            "AJ Brown" => "944826",
            "Garrett Wilson" => "1164889",
            "Jahmyr Gibbs" => "1214154",
            "Marvin Harrison Jr." => "1287828",
            "Marvin Harrison" => "1287828",
            "Saquon Barkley" => "883302",
            "Drake London" => "1178741",
            "Jonathan Taylor" => "1065406",
            "Davante Adams" => "611417",
            "Chris Olave" => "1122592",
            "Brandon Aiyuk" => "1107034",
            "Nico Collins" => "1074698",
            "Kyren Williams" => "1167361",
            "De'Von Achane" => "1231820",
            "De'von Achane" => "1231820",
            "Travis Kelce" => "448240",
            "Mike Evans" => "593587",
            "Sam LaPorta" => "1168926",
            "Derrick Henry" => "732145",
            "Stefon Diggs" => "694041",
            "Deebo Samuel Sr." => "835749",
            "Deebo Samuel" => "835749",
            "DJ Moore" => "877790",
            "Cooper Kupp" => "698227",
            "Michael Pittman Jr." => "911348",
            "Michael Pittman" => "911348",
            "DeVonta Smith" => "1060262",
            "Devonta Smith" => "1060262",
            "Jaylen Waddle" => "1125749",
            "Josh Allen" => "868199",
            "Malik Nabers" => "1286059",
            "Travis Etienne Jr" => "978577",
            "Travis Etienne" => "978577",
            "Jalen Hurts" => "913271",
            "DK Metcalf" => "945633",
            "Josh Jacobs" => "944416",
            "Zay Flowers" => "1177053",
            "Lamar Jackson" => "877745",
            "Isiah Pacheco" => "1106832",
            "Patrick Mahomes" => "839031",
            "Trey McBride" => "1108161",
            "Tank Dell" => "1128222",
            "C.J. Stroud" => "1214084",
            "CJ Stroud" => "1214084",
            "Tee Higgins" => "978579",
            "Dalton Kincaid" => "1135513",
            "Amari Cooper" => "650914",
            "James Cook" => "1131012",
            "Rachaad White" => "1229343",
            "George Pickens" => "1172053",
            "Mark Andrews" => "820699",
            "Joe Mixon" => "820727",
            "Christian Kirk" => "865801",
            "Keenan Allen" => "557210",
            "Anthony Richardson" => "1215022",
            "Kyle Pitts" => "1123026",
            "Alvin Kamara" => "750846",
            "Xavier Worthy" => "1326638",
            "Terry McLaurin" => "836116",
            "Marquise Brown" => "976220",
            "Jayden Reed" => "1123398",
            "Kenneth Walker III" => "1164402",
            "Kenneth Walker" => "1164402",
            "Aaron Jones" => "741314",
            "Calvin Ridley" => "884013",
            "Keon Coleman" => "1322431",
            "George Kittle" => "733672",
            "David Montgomery" => "946739",
            "Chris Godwin" => "835127",
            "Ladd McConkey" => "1218643",
            "Joe Burrow" => "878785",
            "Zamir White" => "1110697",
            "Evan Engram" => "749185",
            "Rome Odunze" => "1213727",
            "Jordan Addison" => "1214250",
            "D'Andre Swift" => "1069808",
            "Kyler Murray" => "879799",
            "Dak Prescott" => "591816",
            "Rhamondre Stevenson" => "1174682",
            "Brian Thomas Jr." => "1286064",
            "Brian Thomas" => "1286064",
            "Jordan Love" => "912137",
            "James Conner" => "742390",
            "DeAndre Hopkins" => "560241",
            "Diontae Johnson" => "891115",
            "Jake Ferguson" => "1065361",
            "Raheem Mostert" => "606501",
            "Rashee Rice" => "1173538",
            "Christian Watson" => "1067918",
            "David Njoku" => "832098",
            "Zack Moss" => "913170",
            "Najee Harris" => "973964",
            "Jaxon Smith-Njigba" => "1214087",
            "Caleb Williams" => "1286445",
            "Tony Pollard" => "880398",
            "Jaylen Warren" => "1176443",
            "Brock Purdy" => "1121761",
            "Jameson Williams" => "1175184",
            "Jonathon Brooks" => "1326601",
            "Nick Chubb" => "822857",
            "Austin Ekeler" => "790004",
            "Brock Bowers" => "1285917",
            "Jared Goff" => "727837",
            "Jayden Daniels" => "1161228",
            "Curtis Samuel" => "821389",
            "Javonte Williams" => "1107881",
            "Mike Williams" => "733754",
            "Dallas Goedert" => "791365",
            "Romeo Doubs" => "1122653",
            "Trey Benson" => "1248031",
            "Tua Tagovailoa" => "973947",
            "Khalil Shakir" => "1130603",
            "Devin Singletary" => "916466",
            "Courtland Sutton" => "838878",
            "Tyler Lockett" => "605242",
            "Trevor Lawrence" => "1110711",
            "Gus Edwards" => "739799",
            "Brian Robinson Jr." => "973966",
            "Brian Robinson" => "973966",
            "Rashid Shaheed" => "923412",
            "Dalton Schultz" => "830523",
            "T.J. Hockenson" => "923915",
            "TJ Hockenson" => "923915",
            "Tyjae Spears" => "1169430",
            "Justin Herbert" => "910562",
            "Chase Brown" => "1123379",
            "Adonai Mitchell" => "1285908",
            "Jakobi Meyers" => "880151",
            "Blake Corum" => "1229540",
            "Brandin Cooks" => "607864",
            "Ezekiel Elliott" => "728338",
            "Kirk Cousins" => "403308",
            "Joshua Palmer" => "1059612",
            "Josh Palmer" => "1059612",
            "Jerome Ford" => "1125737",
            "Jerry Jeudy" => "973935",
            "Matthew Stafford" => "323205",
            "Cole Kmet" => "1066765",
            "Rico Dowdle" => "933480",
            "Jahan Dotson" => "1121878",
            "Gabe Davis" => "976761",
            "Aaron Rodgers" => "213957",
            "Zach Charbonnet" => "1164530",
            "Dontayvion Wicks" => "1172428",
            "Pat Freiermuth" => "1116662",
            "Josh Downs" => "1215077",
            "Xavier Legette" => "1180321",
            "Quentin Johnston" => "1213865",
            "Baker Mayfield" => "748070",
            "Jaylen Wright" => "1286513",
            "Darnell Mooney" => "912027",
            "Adam Thielen" => "733643",
            "Ben Sinnott" => "1228920",
            "J.K. Dobbins" => "976513",
            "JK Dobbins" => "976513",
            "Kendre Miller" => "1213867",
            "Luke Musgrave" => "1179790",
            "Deshaun Watson" => "828743",
            "Ty Chandler" => "1059576",
            "MarShawn Lloyd" => "1213414",
            "Ray Davis" => "1165229",
            "Ricky Pearsall" => "1161416",
            "Cade Otton" => "1049263",
            "Ja'Lynn Polk" => "1213881",
            "Geno Smith" => "513856",
            "Jermaine Burton" => "1218631",
            "Chuba Hubbard" => "1062047",
            "Troy Franklin" => "1286176",
            "Taysom Hill" => "503184",
            "Antonio Gibson" => "1107826",
            "Tyler Allgeier" => "1131198",
            "Roman Wilson" => "1229669",
            "J.J. McCarthy" => "1287599",
            "JJ McCarthy" => "1287599",
            "Hunter Henry" => "744425",
            "Kimani Vidal" => "1214824",
            "Malachi Corley" => "1215291",
            "Will Levis" => "1116663",
            "Wan'Dale Robinson" => "1164875",
            "Isaiah Likely" => "1125111",
            "Bucky Irving" => "1287923",
            "Derek Carr" => "496083",
            "Michael Wilson" => "1123529",
            "Juwan Johnson" => "884609",
            "Luke McCaffrey" => "1164846",
            "Tyrone Tracy Jr." => "1109708",
            "Tyrone Tracy" => "1109708",
            "Rashod Bateman" => "1108208",
            "Bryce Young" => "1213257",
            "Tyler Conklin" => "861278",
            "Marvin Mims Jr." => "1213799",
            "Marvin Mims" => "1213799",
            "Khalil Herbert" => "935104",
            "Zay Jones" => "746491",
            "Keaton Mitchell" => "1222789",
            "Jaleel McLaughlin" => "1271738",
            "Jonnu Smith" => "743749",
            "Daniel Jones" => "879981",
            "Roschon Johnson" => "1163265",
            "Dameon Pierce" => "1108998",
            "Drake Maye" => "1286803",
            "Justin Fields" => "1110681",
            "Darren Waller" => "600191",
            "DeMario Douglas" => "1175693",
            "Demario Douglas" => "1175693",
            "Chig Okonkwo" => "1106374",
            "Demarcus Robinson" => "727279",
            "Bo Nix" => "1161899",
            "Elijah Mitchell" => "1050833",
            "Ja'Tavion Sanders" => "1326628",
            "Javon Baker" => "1231136",
            "Odell Beckham Jr." => "589984",
            "Odell Beckham" => "589984",
            "Russell Wilson" => "401534",
            "Noah Fant" => "923911",
            "Jalen McMillan" => "1213726",
            "D'Onta Foreman" => "835443",
            "DJ Chark Jr." => "822008",
            "DJ Chark" => "822008",
            "Tyler Boyd" => "742387",
            "Will Shipley" => "1287636",
            "Mike Gesicki" => "836152",
            "Audric Estime" => "1321291",
            "Jalin Hyatt" => "1232892",
            "Devontez Walker" => "1277914",
            "Jalen Tolbert" => "1066424",
            "Darius Slayton" => "880557",
            "Alexander Mattison" => "944343",
            "Gardner Minshew II" => "867303",
            "Gardner Minshew" => "867303",
            "Tucker Kraft" => "1181874",
            "Isaac Guerendo" => "1126338",
            "Hunter Renfrow" => "841649",
            "Tank Bigsby" => "1215035",
            "Michael Mayer" => "1232592",
            "Elijah Moore" => "1128783",
            "Clyde Edwards-Helaire" => "976650",
            "Kendrick Bourne" => "754412",
            "Allen Lazard" => "837958",
            "Brenden Rice" => "1225999",
            "Tutu Atwell" => "1106760",
            "AJ Dillon" => "1060545",
            "Dylan Laube" => "1122182",
            "John Metchie III" => "1160348",
            "Rondale Moore" => "1130270",
            "Michael Gallup" => "912070",
            "Malik Washington" => "1173255",
            "Justin Watson" => "832220",
            "KaVontae Turpin" => "865958",
            "Zach Ertz" => "503177",
            "Xavier Gipson" => "1177970",
            "JuJu Smith-Schuster" => "835909",
            "Skyy Moore" => "1176730",
            "Michael Thomas" => "653699",
            "Josh Reynolds" => "822367",
            "Aidan O'Connell" => "1066811",
            "Dalvin Cook" => "824080",
            "Sam Darnold" => "880026",
            "Dawson Knox" => "884083",
            "Greg Dortch" => "910852",
            "Trenton Irwin" => "884943",
            "Justice Hill" => "923109",
            "Jauan Jennings" => "867009",
            "Cade Stover" => "1175182",
            "Michael Penix Jr." => "1107478",
            "Parris Campbell" => "836104",
            "Kalif Raymond" => "692660",
            "Kareem Hunt" => "746613",
            "Irv Smith Jr." => "944428",
            "Hayden Hurst" => "881956",
            "Marquez Valdes-Scantling" => "742382",
            "Mack Hollins" => "702808",
            "Bo Melton" => "1068803",
            "Brevin Jordan" => "1121871",
            "Jake Bobo" => "1121050",
            "Noah Brown" => "836103",
            "Darnell Washington" => "1218658",
            "Samaje Perine" => "820734",
            "Donald Parham Jr." => "875649",
            "Alec Pierce" => "1107027",
            "Jamaal Williams" => "695311",
            "Kenneth Gainwell" => "1130705",
            "Robert Tonyan" => "660151",
            "Sione Vaki" => "1381164",
            "Nelson Agholor" => "691055",
            "Ryan Flournoy" => "1393832",
            "Kylen Granson" => "921050",
            "Kenny Pickett" => "976924",
            "Treylon Burks" => "1172024",
            "Tyler Higbee" => "604176",
            "Trey Lance" => "1130975",
            "Dante Miller" => "1121220",
            "Louis Rees-Zammit" => "1506510",
            "Braelon Allen" => "1325231",
            "Evan Hull" => "1173266",
            "Brandon Powell" => "820435",
            "A.T. Perry" => "1109758",
            "AT Perry" => "1109758",
            "Jordan Mason" => "1116001",
            "Jacoby Brissett" => "607047",
            "Josh Oliver" => "881779",
            "Jeremy Ruckert" => "1122596",
            "Daniel Bellinger" => "1122035",
            "Eric Gray" => "1161798",
            "Jerick McKinnon" => "563824",
            "Kadarius Toney" => "974825",
            "Trey Sermon" => "976236",
            "Tyler Goodson" => "1168918",
            "Van Jefferson" => "884080",
            "Chris Rodriguez Jr." => "1113403",
            "Frank Gore Jr." => "1233127",
            "Cordarrelle Patterson" => "690153",
            "Colby Parkinson" => "1060312",
            "Kyle Juszczyk" => "501150",
            "Israel Abanikanda" => "1214249",
            "Miles Sanders" => "924261",
            "Jared Wiley" => "1163272",
            "Jelani Woods" => "975503",
            "Parker Washington" => "1229074",
            "Calvin Austin III" => "1062765",
            "Calvin Austin" => "1062765",
            "Deuce Vaughn" => "1228925",
            "Sam Howell" => "1168245",
            "Gerald Everett" => "838487",
            "Jamari Thrash" => "1178628",
            "Ronnie Rivers" => "976804",
            "Noah Gray" => "1056981",
            "Rashaad Penny" => "840691",
            "Tyrod Taylor" => "399579",
            "Joe Flacco" => "216342",
            "K.J. Osborn" => "881058",
            "KJ Osborn" => "881058",
            "Ty Johnson" => "877784",
            "Chase Claypool" => "946094",
            "Trey Palmer" => "1161739",
            "Will Dissly" => "837806",
            "Cornelius Johnson" => "1181659",
            "Rasheen Ali" => "1229133",
            "Jacob Cowing" => "1181861",
            "Donovan Peoples-Jones" => "1050234",
            "Greg Dulcich" => "1128085",
            "Johnny Wilson" => "1213486",
            "Jonathan Mingo" => "1176782",
            "Jaheim Bell" => "1229765",
            "Jameis Winston" => "691536",
            "D'Ernest Johnson" => "839043",
            "Ainias Smith" => "1180328",
            "Luke Schoonmaker" => "1130242",
            "Jake Browning" => "865844",
            "Bub Means" => "1172080",
            "DeVante Parker" => "602241",
            "Tre Tucker" => "1164979",
            "Keilan Robinson" => "1172173",
            "Davis Allen" => "1161664",
            "Tanner Hudson" => "1115394",
            "Andrei Iosivas" => "1124851",
            "Drew Lock" => "882345",
            "Justin Shorter" => "1121887",
            "Jawhar Jordan" => "1164137",
            "Theo Johnson" => "1214414",
            "Tim Patrick" => "838179",
            "Erick All Jr." => "1164533",
            "Blake Watson" => "1108990",
            "Jalen Coker" => "1218753",
            "Royce Freeman" => "835779",
            "Jordan Whittington" => "1163273",
            "Spencer Rattler" => "1174752",
            "Charlie Jones" => "1067132",
            "Cedric Tillman" => "1124664",
            "Adam Trautman" => "875444",
            "Zach Wilson" => "1108052",
            "Jarrett Stidham" => "865868",
            "Michael Carter" => "976329",
            "Emari Demercado" => "1116817",
            "Jeff Wilson Jr." => "834195",
            "Chase Edmonds" => "832900",
            "KJ Hamler" => "976528",
            "Ameer Abdullah" => "590796",
            "Isaiah Davis" => "1271609",
            "Justyn Ross" => "1110725",
            "Drew Sample" => "837824",
            "Phillip Dorsett II" => "596417",
            "Chris Moore" => "606551",
            "David Sills V" => "866973",
            "Chris Brooks" => "1127065",
            "Derius Davis" => "1113477",
            "Cole Turner" => "1122692",
            "Tommy Tremble" => "1130555",
            "Dyami Brown" => "1107878",
            "Deven Thompkins" => "1130833",
            "Emanuel Wilson" => "1447759",
            "Nate Adkins" => "1132517",
            "Dillon Johnson" => "1231663",
            "Cody Schrader" => "1140248",
            "Jase McClellan" => "1213251",
            "Tyler Scott" => "1214112",
            "Tay Martin" => "1065052",
            "Joshua Dobbs" => "741262",
            "Tahj Washington" => "1173032",
            "Cam Akers" => "976251",
            "Jimmy Garoppolo" => "555358",
            "Isaiah Hodgins" => "975387",
            "Mecole Hardman Jr." => "922026",
            "Tyquan Thornton" => "1110301",
            "Ray-Ray McCloud III" => "867759",
            "Ray-Ray McCloud" => "867759"
        ];
        //refactor the custom rankings to a table, then I can define them locally and won't be shared in repository.

        $this->customRankings = Config::get('custom_bestball_rankings.customRankings', []);


    }

    //function could be improved.
    public function index()
    {
        
        //dd($this->customRankings);
        $customRankingsFormatted = [];
        //dd($this->customRankings);
        //loop through the custom rankings and get the related ID
        foreach($this->customRankings as $player){
            //find key based on thing
            //echo 'player to search is ' . $player;
            if(isset($this->dkPlayers[$player])){
                //
                $customRankingsFormatted[] = ['id' => $this->dkPlayers[$player], 'player' => $player];
                
            }else{
                echo 'did not find the following player';
                dump($player);
                $customRankingsFromatted[] = ['id' => 'Not found', 'player' => $player];
                //did not find a player, still create a row with something to specify which player was
            }
            
        }
        //dd($customRankingsFormatted);
        

        //need to pass throught he custom rankiings with the id. so table will be: 1st column ids, 2nd column player names
        // Pass data to your view or Inertia response
        return Inertia::render('Bestball/Index', [
           'customRankings' => $customRankingsFormatted,
        ]); 

    }
}
