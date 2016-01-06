<?PHP
class call_break{
		private $cards=array();
		private $black_sparrow=array();
		private $spaids=array();
		private $diamond=array();
		private $hearts=array();
		private $player1=array();
		private $player2=array();
		private $player3=array();
		private $player4=array();
function __construct(){
		self::cards();
		$this->cards=self::add_to_array($this->black_sparrow,$this->spaids,$this->diamond,$this->hearts);
}
function start(){
		self::divide_to_players(self::shuffle_assoc($this->cards));
}

function add_to_array($array1=null,$array2=null,$array3=null,$array4=null){
		$new_array=array();
			if($array1!=null){
				foreach($array1 as $key=>$val){
					$new_array[$key]=$val;
				}
			}
			if($array2!=null){
				foreach($array2 as $key=>$val){
					$new_array[$key]=$val;
				}
			}
			if($array3!=null){
				foreach($array3 as $key=>$val){
					$new_array[$key]=$val;
				}
			}
			if($array4!=null){
				foreach($array4 as $key=>$val){
					$new_array[$key]=$val;
				}
			}
		return $new_array;
}
function cards(){

	$this->hearts=array(
				"H2"=>0,
				"H3"=>1,
				"H4"=>2,
				"H5"=>3,
				"H6"=>4,
				"H7"=>5,
				"H8"=>6,
				"H9"=>7,
				"H10"=>8,
				"HJ"=>9,
				"HQ"=>10,
				"HK"=>11,
				"HA"=>12
	);    $this->diamond=array(
				"D2"=>0,
				"D3"=>1,
				"D4"=>2,
				"D5"=>3,
				"D6"=>4,
				"D7"=>5,
				"D8"=>6,
				"D9"=>7,
				"D10"=>8,
				"DJ"=>9,
				"DQ"=>10,
				"DK"=>11,
				"DA"=>12
	);  $this->black_sparrow=array(
				"B2"=>0,
				"B3"=>1,
				"B4"=>2,
				"B5"=>3,
				"B6"=>4,
				"B7"=>5,
				"B8"=>6,
				"B9"=>7,
				"B10"=>8,
				"BJ"=>9,
				"BQ"=>10,
				"BK"=>11,
				"BA"=>12
	);$this->spaids=array(
				"S2"=>0,
				"S3"=>1,
				"S4"=>2,
				"S5"=>3,
				"S6"=>4,
				"S7"=>5,
				"S8"=>6,
				"S9"=>7,
				"S10"=>8,
				"SJ"=>9,
				"SQ"=>10,
				"SK"=>11,
				"SA"=>12
	);
}
function divide_to_players($cards){
$players=array();
		if(count($cards)!=52)
		return false;
			$players=array(array());
		$players=array_chunk($cards,13,true);
		$this->player1=$players[0];
		$this->player2=$players[1];
		$this->player3=$players[2];
		$this->player4=$players[3];
}

function shuffle_assoc($array){
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
function get_cards($option=null){
		if($option==null){
			return  $this->hearts+$this->diamond+$this->spaids+$this->black_sparrow;
			
		}
		else if($option=="H" || $option=="h")return $this->hearts;
		else if($option=="D" || $option=="d")return $this->diamond;
		else if($option=="S" || $option=="s")return $this->spaids;
		else if($option=="B" || $option=="b")return $this->black_sparrow;
		else return false;
	}
	function get_players($player_no=null){
			if($player_no==null)return false;
			if($player_no==1)return $this->player1;
			if($player_no==2)return $this->player2;
			if($player_no==3)return $this->player3;
			if($player_no==4)return $this->player4;
	}
}
//$ob=new call_break();
//$ob->start();
//;
 //$ob->start();
?>