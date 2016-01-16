<?PHP
session_start();
require_once('../_includes/include_all.php');
$con=mysqli_connect("localhost","vikash","kisku","play_cards");
$players=array("vikash","kisku","vijay");
 $ob=new teen_patti($players,$con);
 $ob->start();
 //$ob->card_distribute();
 //$ob->set_game_id();
 echo "game_id".$ob->get_game_id();
 //$ob->cards_of_players();
 //print_r($ob->get_players());

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
 // print_r($ob->get_winner());
 $cards=$ob->cards_of_players();
$players=$ob->get_players();
$winner=$ob->set_rank();
 
//print_r($cards);
foreach($cards as $key=>$card){
foreach($card as $keys=>$try){
echo $try['suit'];
}
echo "</br>";
}

  ?>
   <table  border="0" style="width:30%">
  <tr>
    <th>Player</th>
    <th>Cards</th>
  </tr>
  <?PHP
	// 	$string="Player";
	//$players=array("vikash","gulshan","vijay","ajay","player","heloo");
 
  foreach($players as $value=>$player){?>
  <tr><td><?="Player ".$player;  echo " value=".$winner[$value];?></td>
  <td></td>
  <?PHP
	//foreach(1)
		//foreach($cards as $cards){ 
		
		foreach($cards[$value] as $key=>$card){
		
  ?>
	<td><img src="../images/SVG/<?=$card['value']."_of_".strtolower($card['suit']).".svg";?>" alt="Mountain View" style="width:90px;height:80px;"></td>
	<?php   }
	
			}		?>
  </tr>
</table> 
 
 