<?PHP
session_start();
require_once('../_includes/include_all.php');
$con=mysqli_connect("localhost","vikash","kisku","play_cards");
if(!isset($_SESSION['game_id'])){
 ?>
 <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
 <input name="players" type="text"/>
 <input type="submit" value="start the game"/>
 </form>
 <?PHP 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
$players_name=explode(" ",$_POST['players']);
$ob=new teen_patti($con);
 $ob->start($players_name);
}
 }
 else {
 ?>
<?PHP

//$players=array("110","111","112");
 //$ob=new teen_patti($players,$con);
 //$ob->start();
 //$ob->card_distribute();
 //$ob->set_game_id();
 //$ob->action('blind');
 echo "game_id".$ob->get_game_id();
 //$ob->cards_of_players();
 //print_r($ob->get_players());
//$ob->get_cards_by_game_id();
//$ob->set_session_to_database();
  /* $array=array(array(
 array('face'=>'Two','value'=>2,'suit'=>'Clubs'),//8 9 10   8 10 9  9 8 10 9 10 8 // 10 8 9 // 10 9 8
 array('face'=>'Five','value'=>4,'suit'=>'Clubs'),
 array('face'=>'Ace','value'=>14,'suit'=>'Clubs')
 ),
 array(
 array('face'=>'Nine','value'=>13,'suit'=>'Hearts'),
 array('face'=>'Ten','value'=>12,'suit'=>'Hearts'),  
 array('face'=>'Seven','value'=>10,'suit'=>'Hearts')  
 )
 ); 
 print_r($array);
 $winner=$ob->get_winner($array)); */
 $id=100;
 $con=mysqli_connect("localhost","vikash","kisku","play_cards");
 $ob=new teen_patti($con);
 $winner=$ob->get_rank();
 $players=$ob->get_players();
 $cards=$ob->get_cards_by_game_id();
$status=$ob->get_status();
  ?>
   <table  border="0" style="width:30%">
  <tr>
    <th>Player</th>
    <th>Cards</th>
  </tr>
  <?PHP
	$ob->get_right_of_the_player();
  foreach($players as $value=>$player){?>
  <tr><td><?="Player ".$player;  echo " value=".$winner[$value];?></td>
  <td></td>
  <?PHP
	//foreach(1)
		//foreach($cards as $cards){ 		
		foreach($cards[$value] as $key=>$card){
		
  ?>
	<td><img src="../images/SVG/<?=($player==$id)?strtolower($card).".svg":"card.png";?>" alt="Mountain View" style="width:90px;height:80px;"></td>
	<?php   }
	
			}		?>
  </tr>
</table> 
 <?PHP }?>
 