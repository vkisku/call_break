<?PHP
class call_break{
		private $cards=array();
		//private $black_sparrow=array();
		//private $spaids=array();
		//private $diamond=array();
		//private $hearts=array();
		private $player1=array();
		private $player2=array();
		private $player3=array();
		private $player4=array();
function __construct(){
		self::cards();
		//$this->cards=self::add_to_array($this->black_sparrow,$this->spaids,$this->diamond,$this->hearts);
}
function start(){
		self::divide_to_players(self::shuffle_assoc($this->cards));
}

function cards(){
$suits=array("Hearts","Diamond","Clubs","Spades");
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
function get_card($option=null){
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
$ob=new call_break();
$deck=$ob->get_cards();
$ob->start();
$player=$ob->get_players(2);

//$ob->start();
//;
 //$ob->start();
?>
  <table  border="2" style="width:30%">
  <tr>
    <th>Card</th>
    <th>Type</th>
    <th>Value</th>
  </tr>
  <?PHP
		foreach($deck as $cards){
  ?>
  <tr>
    &nbsp;<td><?=$cards['face'];?></td>
    <td><?=$cards['suit'];?></td>
    <td><?=$cards['value'];}?></td>
  </tr>
</table> 