<?PHP 

class call_break{
		private $cards=array();
		private $black_sparrow=array();
		private $spads=array();
		private $diamond=array();
		private $hearts=array();
function __construct(){
		self::cards();
		$this->cards=self::add_to_array($this->black_sparrow,$this->spads,$this->diamond,$this->hearts);
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
	);

}
function divide_to_players($cards){
		if(count($cards)!=52)
		return false;
			$players=array(array());
		print_r(array_chunk($cards,13,true));
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

}
$ob=new call_break();
$ob->start();

?>