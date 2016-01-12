<?PHP 

class kat_patti extends card_play{
			private $no_of_players;
			protected $players=array();
			protected $random_card;
			private $game_id;
			private $winner;
	function __construct($players){
	$this->players=$players;
	$this->no_of_players=count($players);
		//$this->chunk=$this->no_of_cards;
			self::cards();
			
	}
	function draw_card_from_deck(){
	  $this->random_card=$this->cards[array_rand(self::get_shuffled_cards(),1)]['face'];
	 return $this->random_card;
	}
	function get_winner(){
	//print_r($this->shuffled_cards);
	$keys=array_keys($this->shuffled_cards);
	//echo $this->random_card."</br>";
	//print_r($keys);
	$j=1;
	
		for($i=0;$i<52;$i++){
		echo $this->players[$j%2]." side ".$this->shuffled_cards[$keys[$i]]['face']."</br>";
		
		if($this->random_card!=$this->shuffled_cards[$keys[$i]]['face'])
		$j++;
		else break;
		}
		$this->winner=($j%2==0)?$this->players[0]:$this->players[1];
		return $this->winner;
	
	}
	function put_game_id_to_database(){
	
	}
function put_shuffled_cards_to_database($game_id){

}	
	
	}

?>