<?PHP
require_once('../_includes/include_all.php');
$players=array("vikash","gulshan","vijay","ajay","player","priyanka");
//$ob1=new card_play();
$ob=new teen_patti($players);
$ob->start();
print_r($ob->cards_of_players());
 ?>
  <table  border="0" style="width:30%">
  <tr>
    <th>Player</th>
    <th>Cards</th>
  </tr>
  <?PHP
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