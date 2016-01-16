<?PHP 

class teen_patti extends card_play{
			//private $no_of_players;
			private $no_of_cards=3;
			protected $players=array();
			private $game_id;
			private $board_rate=1;
			private $blind_rate=1;
			private $seen_rate=2;
			private $connection;
			private $rank=array();
			private $table_name=array("game","teen_patti");
	function __construct($players,$con=null,$board_rate=null,$blind_rate=null,$seen_rate=null){
	$this->connection=$con;
	$this->players=$players;
	$this->no_of_players=count($players);
		$this->chunk=$this->no_of_cards;
			self::cards();
			//self::set_board_rate($board_rate);
			//self::set_blind_rate($blind_rate);
			//self::set_seen_rate($seen_rate);
			self::shuffle();
		self::divide_to_players($this->shuffled_cards,$this->chunk,$this->no_of_players);
			
	}
	function start(){
		self::set_game_id();
		self::set_rank();
		self::card_distribute();
}
	private function card_distribute(){
		$table=$this->table_name[1];
		$n=$this->no_of_players;
		$player=$this->players;
		$rank=$this->rank;
		$game_id=$_SESSION['game_id'];
		for($i=0;$i<$n;$i++){
			$card1=$this->player[$i][0]['face']."_of_".$this->player[$i][0]['suit'];
			$card2=$this->player[$i][1]['face']."_of_".$this->player[$i][1]['suit'];
			$card3=$this->player[$i][2]['face']."_of_".$this->player[$i][2]['suit'];
		
			$sql="insert into $table(game_id,user_id,card1,card2,card3,value,money,status,seen_id)values
				('$game_id','$player[$i]','$card1','$card2','$card3','$rank[$i]','$this->board_rate','0','')";
		 
			mysqli_query($this->connection,$sql);
		 
		}	
	}
	private function set_game_id(){
		$table=$this->table_name[0];
		$time=time();
		$total=$this->no_of_players*$this->board_rate;
		$sql="insert into $table(board_rate,blind_rate,seen_rate,total,total_player,created_on)values
			('$this->board_rate','$this->blind_rate','$this->seen_rate','$total','$this->no_of_players',$time) ";
		if (mysqli_query($this->connection, $sql)) {
			$this->game_id = mysqli_insert_id($this->connection);
			$_SESSION['game_id']=$this->game_id;
		}
	}
	function get_game_id(){
	$this->game_id=$_SESSION['game_id'];
	return $this->game_id;
	
	}
	function get_players(){
	return $this->players;
	}
	function cards_of_players(){
	 //$keys=array_keys($this->player);
	 return $this->player;
	 
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
	
	function set_board_rate($board_rate=null){
		$this->board_rate=$board_rate;
	}
	function set_blind_rate($blind_rate=null){
		$this->blind_rate=$blind_rate;
	}
	function set_seen_rate($seen_rate=null){
		$this->seen_rate=$seen_rate;
	}	
	function set_rank($array=null){
		$array=$this->player;
		 $l=count($array);//Contains the length of the array
		 $ans=array();//Contains the values for each player according to which it would be calculated
	for($i=0;$i<$l;$i++){
		 
		 if($array[$i][0]['face']==$array[$i][1]['face'] && $array[$i][1]['face']==$array[$i][2]['face']){  // condition of trio
		 
				$ans[$i]=10000+$array[$i][0]['value'];   
			}//   2 14 3
		 else if(($array[$i][0]['value']+1==$array[$i][1]['value'] && $array[$i][1]['value']+1==$array[$i][2]['value'])||  // condition for Run
				 $array[$i][2]['value']+1==$array[$i][1]['value'] && $array[$i][1]['value']+1==$array[$i][0]['value']||    
				 $array[$i][0]['value']+1==$array[$i][2]['value'] && $array[$i][2]['value']+1==$array[$i][1]['value']||
				 $array[$i][1]['value']+1==$array[$i][0]['value'] && $array[$i][0]['value']+1==$array[$i][2]['value']||
				 $array[$i][2]['value']+1==$array[$i][0]['value'] && $array[$i][0]['value']+1==$array[$i][1]['value']||
				 $array[$i][1]['value']+1==$array[$i][2]['value'] && $array[$i][2]['value']+1==$array[$i][0]['value']||
				 $array[$i][0]['value']+1==$array[$i][1]['value'] && $array[$i][2]['value']-13+1==$array[$i][0]['value']||
				 $array[$i][1]['value']+1==$array[$i][2]['value'] && $array[$i][0]['value']-13+1==$array[$i][1]['value']||
				 $array[$i][0]['value']+1==$array[$i][2]['value'] && $array[$i][1]['value']-13+1==$array[$i][1]['value']){
			if($array[$i][0]['suit']==$array[$i][1]['suit']  && $array[$i][1]['suit']==$array[$i][2]['suit'])  // Straight    Extrs condition for 14 2 3 where 14 is Ace because Ace is the Highest and also 1
				$ans[$i]=$ans[$i]=9000+($max=max($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']))-$x=($max==14)?((min($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value'])==2)?1:0):0;
			else 
				$ans[$i]=8000+($max=max($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']))-$x=($max==14)?((min($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value'])==2)?1:0):0; //Normal
			}
		 else if($array[$i][0]['suit']==$array[$i][1]['suit']  && $array[$i][1]['suit']==$array[$i][2]['suit']){ 
				// Color 
				$max=max($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']);
				$min=min($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']);
				$total=$array[$i][0]['value']+$array[$i][1]['value']+$array[$i][2]['value'];
				$ans[$i]=6000+($max)*100+($total-($max+$min))*10+$min;   //(max($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']));
			}
		 else if($array[$i][0]['face']==$array[$i][1]['face'] && $array[$i][0]['face']!=$array[$i][2]['face'] ||  // Double
				 $array[$i][0]['face']==$array[$i][2]['face'] && $array[$i][0]['face']!=$array[$i][1]['face']||
				 $array[$i][1]['face']==$array[$i][2]['face'] && $array[$i][2]['face']!=$array[$i][0]['face']){
																												// 223 232 322
				 $ans[$i]=5000+$array[$i][0]['value']+$array[$i][1]['value']+$array[$i][2]['value']; //776  778
			}
		 else {
				$max=max($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']);
				$min=min($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']);
				$total=$array[$i][0]['value']+$array[$i][1]['value']+$array[$i][2]['value'];
				
				$ans[$i]=($max)*100+($total-($max+$min))*10+$min;
			
			}
		}
		$this->rank=$ans;
	}

}
?>