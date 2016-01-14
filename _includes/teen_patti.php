<?PHP 

class teen_patti extends card_play{
			//private $no_of_players;
			private $no_of_cards=3;
			protected $players=array();
	function __construct($players){
	$this->players=$players;
	$this->no_of_players=count($players);
		$this->chunk=$this->no_of_cards;
			self::cards();
			
	}
	function get_player(){
	return $this->players;
	}
	function cards_of_players(){
	 $keys=array_keys($this->player);
	 print_r($this->player);
	
	 
	}
	function get_rank_by_card($player_name){
	print_r($card=$this->player[$player_name]['player'.($player_name+1)]);
	
	$keys=array_keys($card);
	 $card1=$card[$keys[0]]['face']."_of_".$card[$keys[0]]['suit'];
	 $card2=$card[$keys[1]]['face']."_of_".$card[$keys[1]]['suit'];
	 $card3=$card[$keys[2]]['face']."_of_".$card[$keys[2]]['suit'];
	echo $sql="select * from cards_play where
			 card1 in('$card1','$card2','$card3') and
			 card2 in('$card1','$card2','$card3') and
			 card3 in('$card1','$card2','$card3')";
	
	}
}
?>