<?PHP 

class teen_patti extends card_play{
			private $no_of_players;
			private $no_of_cards=3;
	function __construct(){
			self::divide_to_players($cards,$no_of_players);	
	}
}
?>