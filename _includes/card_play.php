<?PHP
class card_play{
		protected $cards=array();
		//private $black_sparrow=array();
		//private $spaids=array();
		//private $diamond=array();
		//private $hearts=array();
		protected $player=array();//this array contains the arrays of players and their cards
		protected $chunk=4;
		
		private $no_of_players=6;
		//private $type_of_game;
function __construct(){
		self::cards();
		//$this->cards=self::add_to_array($this->black_sparrow,$this->spaids,$this->diamond,$this->hearts);
}
function start(){
		self::divide_to_players(self::shuffle_assoc($this->cards),$this->chunk,$this->no_of_players);
}

function cards(){
$suits=array("Hearts","Diamonds","Clubs","Spades");
$faces=array("Two","Three","Four","Five","Six","Seven","Eight","Nine","Ten","Jack","Queen","King","Ace");
$values=array(1,2,3,4,5,6,7,8,9,10,11,12,13);

foreach($suits as $suit ){
	foreach($faces as $value=>$face){
		
		$this->cards[]=array("face"=>$face,"suit"=>$suit,"value"=>$value+2);
	}
}
	
}
function get_cards(){
return $this->cards;
}
protected function divide_to_players($cards,$chunk,$no_of_players){
$players=array();
		if(count($cards)!=52)
		return false;
		$players=array_chunk($cards,$chunk,true);
		/* $this->player1=$players[0];
		$this->player2=$players[1];
		$this->player3=$players[2];
		$this->player4=$players[3]; */
		
		//$this->player=array("player1"=>$this->player1);
		//$this->player=array("player1"=>$players[0],"player2"=>$players[1],"player3"=>$players[2],"player4"=>$players[3]);
		for($i=0;$i<$no_of_players;$i++)
		array_push($this->player,array("player".($i+1)=>$players[$i]));//,array("player2"=>$players[1]),array("player3"=>$players[2]),array("player4"=>$players[3]));
	//print_r($this->player);

	}

private function shuffle_assoc($array){
       $shuffled_array = array();

    // Get array's keys and shuffle them.
        $shuffled_keys = array_keys($array);
        shuffle($shuffled_keys);

    // Create same array, but in shuffled order.
        foreach ( $shuffled_keys AS $shuffled_key ) {

            $shuffled_array[  $shuffled_key  ] = $array[  $shuffled_key  ];

        } // foreach
		
    // Return
        return $shuffled_array;
	}
function get_card_by_suit($option=null){
$cards_chunks=array_chunk($this->cards,13,true);
		if($option==null){
			return  $cards_chunks[0]+$cards_chunks[1]+$cards_chunks[2]+$cards_chunks[3];
			
		}
		else if(strtolower($option)=="h"||strtolower($option)=="hearts")return $cards_chunks[0];
		else if(strtolower($option)=="d"||strtolower($option)=="diamond")return $cards_chunks[1];
		else if(strtolower($option)=="c"||strtolower($option)=="clubs")return $cards_chunks[2];
		else if(strtolower($option)=="s"||strtolower($option)=="spades")return $cards_chunks[3];
		else return false;
	}
function get_players($player_no=null){
		if($player_no==null || $player_no<0 || $player_no>$this->no_of_players)return false;
			
			return $this->player[$player_no-1]['player'.$player_no];
			
		/* if($player_no==1 || $player_no=="player1" )return $this->player[0]['player1'];
		if($player_no==2 || $player_no=="player2")return $this->player[1]['player2'];
		if($player_no==3 || $player_no=="player3")return $this->player[2]['player3'];
		if($player_no==4 || $player_no=="player4")return $this->player[3]['player4']; */
	}
}
?>