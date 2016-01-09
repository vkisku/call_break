<?PHP 
require_once('../_includes/call_break.php');
$ob=new call_break();
//$deck=$ob->get_cards();
$ob->start();
$player1=$ob->get_players("player1");
$player2=$ob->get_players("player2");
print_r($ob->get_card_by_suit('spades'));
echo "</br> -------------------------------------</br>";
?>
  <table  border="2" style="width:30%">
  <tr>
    <th>Card</th>
    <th>Type</th>
	<th>Image</th>
    <th>Value</th>
  </tr>
  <?PHP
		foreach($player1 as $cards){
  ?>
  <tr>
    &nbsp;<td><?=$cards['face'];?></td>
    <td><?=$cards['suit'];?></td>
	<td><img src="../images/SVG/<?=$cards['value']."_of_".strtolower($cards['suit']).".svg";?>" alt="Mountain View" style="width:100px;height:100px;"></td>
    <td><?=$cards['value'];}?></td>
  </tr>
</table> 
 <table  border="2" style="width:30%">
  <tr>
    <th>Card</th>
    <th>Type</th>
    <th>Value</th>
  </tr>
  <?PHP
		foreach($player2 as $cards){
  ?>
  <tr>
    &nbsp;<td><?=$cards['face'];?></td>
    <td><?=$cards['suit'];?></td>
    <td><?=$cards['value'];}?></td>
  </tr>
</table> 

<img src="../images/SVG/2_of_clubs.svg" alt="Mountain View" style="width:304px;height:228px;">