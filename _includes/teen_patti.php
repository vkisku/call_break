<?PHP 

class teen_patti extends card_play{
			private $no_of_players;
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
	print_r($this->player);
	}
}
?>