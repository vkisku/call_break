<?PHP 
/*
Status 0=Card just distributed and  the game is yet to start not visible to any user
Status 1=Put to Blind that means user does not want to see its cards yet
Status 2=Seen and hence user can see his cards and bid for the same
Status 3=Packed the cards mean he does not want to play this particular game

*/
class teen_patti extends card_play{
			//private $no_of_players;
			private $no_of_cards=3;
			protected $players=array();
			private $game_id;
			private $board_rate=1;
			private $blind_rate=1;
			private $seen_rate=2;
			private $connection;
			private $user_id;
			private $users=array();
			private $rank=array();
			private $right_player;
			private $left_player;
			private $table_name=array("game","teen_patti","game_session");
	function __construct($con=null,$user_id=null){
	$this->connection=$con;
	$this->user_id=$user_id;
	$this->chunk=$this->no_of_cards;		
	}
	function start($players){
		$this->players=$players;
		$this->no_of_players=count($players);
		self::cards();
			//self::set_board_rate($board_rate);
			//self::set_blind_rate($blind_rate);
			//self::set_seen_rate($seen_rate);
			self::shuffle();
		self::divide_to_players($this->shuffled_cards,$this->chunk,$this->no_of_players);
		self::set_game_id();
		self::set_rank();
		self::card_distribute();
		self::set_session_to_database();
}
	private function set_session_to_database(){
		$table=$this->table_name[2];
		$game_id=self::get_game_id();
		$player=$this->players;
		$next_player=self::get_left_or_right($this->user_id)['right'];
			for($i=0;$i<$this->no_of_players;$i++){
				$sql1="insert into $table(user_id,game_session_id,status)values('$player[$i]','$game_id','1') ";// 1=game active  0=game complete;
				$sql2="update $table set status_queue=1 where game_session_id=$game_id and user_id=$next_player ";
				mysqli_query($this->connection,$sql1);
				mysqli_query($this->connection,$sql2);
			}
		
		
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
	
	function set_players(){
	$players=array();
	$game_id=self::get_game_id();
	$table=$this->table_name[1];
	$sql="select * from $table where game_id=$game_id";
	$result=mysqli_query($this->connection,$sql);
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row=mysqli_fetch_assoc($result)) {
			  $players[]=$row['user_id'];
			  
			}
		}
			
	$this->users=$players;
	}
	function get_players(){
		self::set_players();
	return $this->users;
	}
	function get_left_or_right($user_id=null){
			//$user_id=($user_id==null)?
			$users=self::get_players();
			$key=array_search($user_id,$users);
			 $this->right_player=$users[(($key=array_search($user_id,$users))==0)?count($users)-1:$key-1];
			 $this->right_player=$users[(($key=array_search($user_id,$users))==count($users)-1)?0:$key+1];
			 $direction['right']=$this->right_player;
			 $direction['left']=$this->right_player;
			 return $direction;
	}
	function cards_of_players(){
	 //$keys=array_keys($this->player);
	 return $this->player;
	 
	}
	function show(){
	$winner=array();
	$table1=$this->table_name[0];
	$table2=$this->table_name[1];
	$table3=$this->table_name[2];
	$game_id=self::get_game_id();
	$sql="select * from $table2 where game_id=$game_id and status<3";
	$result=mysqli_query($this->connection, $sql);
	while($row = mysqli_fetch_assoc($result)){
		$winner[$row['value']]=$row['user_id'];
	
	}
	$keys=array_keys($winner);
	if(count($winner)==1)return $winner[max($keys)];
	if(count($winner)==2)return $winner[max($keys)];
	}
	function get_rank($user_id=null){
		$rank=array();
		$table1=$this->table_name[0];//game
		$table2=$this->table_name[1];//teen_patti
		$game_id=self::get_game_id();//game_session
		$replace_string=($user_id!=null)?"and user_id=$user_id":"";
		$sql="select * from $table1,$table2 where $table1.game_id=$table2.game_id and $table1.game_id=$game_id $replace_string";
		$result=mysqli_query($this->connection, $sql);
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				
			  $rank[$row['user_id']]=$row['value'];
			  
			}
		}
		
		return $rank;
	}
	function get_status($user_id=null){
		$status=array();
		$table1=$this->table_name[0];
		$table2=$this->table_name[1];
		$table3=$this->table_name[2];
		$game_id=self::get_game_id();
		$replace_string=($user_id!=null)?"and $table2.user_id=$user_id":"";
		$sql="select distinct $table2.user_id,$table3.queue_status,$table2.status from $table2,$table3 where $table2.game_id=$table3.game_session_id and 
				   $table2.user_id=$table3.user_id and $table2.game_id=$game_id $replace_string group by $table2.id";
		$result=mysqli_query($this->connection, $sql);
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			  $status['status'][$row['user_id']]=$row['status'];
			  $status['queue_status'][$row['user_id']]=$row['queue_status'];
			}
		}
		
		return $status;
	}
	
	function action($action=null,$user_id1,$user_id2=null){
	if($action=='blind')self::blind($user_id1);
	else if($action=='seen')self::seen($user_id1);
	else if($action=='side_seen')self::side_seen($user_id1,$user_id2);
	else if($action=='pack')self::pack($user_id1);
	}
	private function blind($user_id){
		$table=$this->table_name[1];
		$game_id=self::get_game_id();
		//$user_id=111;//sesson id
		
		$sql="update $table set status=1 where game_id=$game_id and user_id=$user_id";
		mysqli_query($this->connection, $sql);
	}
	private function seen($user_id){
		$table=$this->table_name[1];
		$game_id=self::get_game_id();
		//$user_id=111;//session_id
	
		$sql="update $table set status=2 where game_id=$game_id and user_id=$user_id";
		mysqli_query($this->connection, $sql);
	}
	private function side_seen($user_id1,$user_id2){
		$table=$this->table_name[1];
		$game_id=self::get_game_id();
		//$user_id1=111;//session id
		//$user_id2=112;//id on click to  on the left
		
		$sql="update $table set status=3,seen_id=$user_id2 where game_id=$game_id and user_id=$user_id1";
		mysqli_query($this->connection, $sql);
	}
	private function pack($user_id){
		$table=$this->table_name[1];
		$game_id=self::get_game_id();
		//$user_id=111;//sesson id
		
		$sql="update $table set status=4 where game_id=$game_id and user_id=$user_id";
		mysqli_query($this->connection, $sql);
	}
	function queue($user_id){
		$users=self::get_players();
		//print_r($users);
		$table=$this->table_name[2];
		$game_id=self::get_game_id();
		//$user_id=111;//sesson id
		$direction=self::get_left_or_right($user_id);
		$id=$direction['right'];
		
		$sql1="update $table set queue_status=0 where game_session_id=$game_id and user_id=$user_id";
		$sql2="update $table set queue_status=1 where game_session_id=$game_id and user_id=$id";
		mysqli_query($this->connection, $sql1);
		mysqli_query($this->connection, $sql2);
	}
	function get_cards_by_game_id($user_id=null){
			$temp=array();
			$table1=$this->table_name[0];
			$table2=$this->table_name[1];
			$game_id=self::get_game_id();
			$replace_string=($user_id!=null)?"and user_id=$user_id":"";

			$sql="select * from $table1,$table2 where $table1.game_id=$table2.game_id and $table1.game_id=$game_id $replace_string";
			$result = mysqli_query($this->connection, $sql);

		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				
			  $temp[$row['user_id']]=array($row['card1'],$row['card2'],$row['card3']);
			  
			}
		}
			
			//mysqli_close($this->connection);
		return $temp;	
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
			}
		 else if(($array[$i][0]['value']+1==$array[$i][1]['value'] && $array[$i][1]['value']+1==$array[$i][2]['value'])  || // Condition for Run
				  $array[$i][2]['value']+1==$array[$i][1]['value'] && $array[$i][1]['value']+1==$array[$i][0]['value']   ||    
				  $array[$i][0]['value']+1==$array[$i][2]['value'] && $array[$i][2]['value']+1==$array[$i][1]['value']   ||
				  $array[$i][1]['value']+1==$array[$i][0]['value'] && $array[$i][0]['value']+1==$array[$i][2]['value']   ||
				  $array[$i][2]['value']+1==$array[$i][0]['value'] && $array[$i][0]['value']+1==$array[$i][1]['value']   ||
				  $array[$i][1]['value']+1==$array[$i][2]['value'] && $array[$i][2]['value']+1==$array[$i][0]['value']   ||
				  $array[$i][0]['value']+1==$array[$i][1]['value'] && $array[$i][2]['value']-13+1==$array[$i][0]['value']||
				  $array[$i][1]['value']+1==$array[$i][2]['value'] && $array[$i][0]['value']-13+1==$array[$i][1]['value']||
				  $array[$i][0]['value']+1==$array[$i][2]['value'] && $array[$i][1]['value']-13+1==$array[$i][1]['value']){
				  
				   // Straight    Extra condition for 14 2 3 where 14 is Ace because Ace is the Highest and also 1
			if($array[$i][0]['suit']==$array[$i][1]['suit']  && $array[$i][1]['suit']==$array[$i][2]['suit']) 
				
				$ans[$i]=$ans[$i]=9000+($max=max($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']))-$x=($max==14)?((min($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value'])==2)?1:0):0;
				
			else     ////Normal Condition
				$ans[$i]=8000+($max=max($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']))-$x=($max==14)?((min($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value'])==2)?1:0):0; 
			}
		 else if($array[$i][0]['suit']==$array[$i][1]['suit']  && $array[$i][1]['suit']==$array[$i][2]['suit']){ 
				// Condition for Color 
				
				$max=max($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']);
				$min=min($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']);
				$total=$array[$i][0]['value']+$array[$i][1]['value']+$array[$i][2]['value'];
				
				$ans[$i]=6000+($max)*100+($total-($max+$min))*10+$min;   //(max($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']));
			}
		 else if($array[$i][0]['face']==$array[$i][1]['face'] && $array[$i][0]['face']!=$array[$i][2]['face'] ||  // Condtion for Double
				 $array[$i][0]['face']==$array[$i][2]['face'] && $array[$i][0]['face']!=$array[$i][1]['face']||
				 $array[$i][1]['face']==$array[$i][2]['face'] && $array[$i][2]['face']!=$array[$i][0]['face']){
																												
				 $ans[$i]=5000+$array[$i][0]['value']+$array[$i][1]['value']+$array[$i][2]['value']; 
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
	public static function game_end(){
	//session_start();
		if(isset($_SESSION['game_id']))
			unset($_SESSION['game_id']);
	}
	function Accept_game_request($user_id){
	//$table1=$this->table_name[0];
	//$table2=$this->table_name[1];
	$table3=$this->table_name[2];
	
	$sql="select * from $table3 where user_id=$user_id and status=1 ORDER BY id DESC LIMIT 1";
	$result=mysqli_query($this->connection,$sql);
	$row=mysqli_fetch_array($result);
	$game_id=$row['game_session_id'];
	$_SESSION['game_id']=$game_id;
	}
	public static function Redirect($redirect_to){
		if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	//header('Location: '.$uri.'/xampp/');
	header('Location: '.$redirect_to);
	exit;
	}
}
?>