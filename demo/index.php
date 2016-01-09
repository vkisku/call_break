<?PHP 
require_once('../_includes/card_play.php');
$ob=new card_play();
$deck=$ob->get_cards();
$ob->start();
$player1=$ob->get_players("player1");
$player2=$ob->get_players("player2");
//print_r($ob->get_card_by_suit('spades'));
//echo "</br> -------------------------------------</br>";
?>
  <table  border="0" style="width:30%">
  <tr>
    <th>Player</th>
    <th>Cards</th>
  </tr>
  <?PHP
		$string="Player";
	$players=array("vikash","gulshan","vijay","ajay");

  foreach($players as $value=>$player){?>
  <tr><td><?="Player ".$player;?></td>
  <td></td>
  <?PHP
	//foreach(1)
		foreach($ob->get_players($value+1) as $cards){
  ?>
	<td><img src="../images/SVG/<?=$cards['value']."_of_".strtolower($cards['suit']).".svg";?>" alt="Mountain View" style="width:90px;height:80px;"></td>
<?php }}?>
  </tr>
</table> 
 