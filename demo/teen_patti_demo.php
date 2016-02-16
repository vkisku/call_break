<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("a#seen").click(function(){
        var txt ="seen";
        $.post("ajax_example.php", {action: txt}, function(result){
            $("span").html(result);
        });
    });
});
$(document).ready(function(){
    $("button#blind1").click(function(){
        alert("hello");
        $.post("ajax_example.php", {suggest: txt}, function(result){
            $("span").html(result);
        });
    });
});
</script>
</head>
<body>
<?PHP
$id=101;
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
$ob=new teen_patti($con,$id);
 $ob->start($players_name);
}
 }
 else {
 ?>
<?PHP
 //$con=mysqli_connect("localhost","vikash","kisku","play_cards");
 $ob=new teen_patti($con);
 $winner=$ob->get_rank();
 $players=$ob->get_players();
 $cards=$ob->get_cards_by_game_id();
$status=$ob->get_status();
print_r($ob->show());
  ?>
   <span><table  border="0" style="width:30%">
  <tr>
    <th>Player</th>
    <th>Cards</th>
  </tr>
  <?PHP
  $user_id=101;
	//$ob->queue(102);
	$st=$ob->get_status();
	$status=$st['status'];
	$status1=$st['queue_status'];
	//print_r($status);
  foreach($players as $value=>$player){	?>
	<tr>
		<td><?="Player ".$player;  echo " value=".$winner[$value];?></td>
  <?PHP if($user_id==$player){ ?>
		<td>action</td>
  <?PHP 	if($status1[$player]==1){ ?>
		<td >
		
		<a href="" id="seen" value="see">See</button></td>
  <?PHP 	}
		}else
			{ ?>
		<td>daction</td>
  <?php	 } ?>
  <?PHP	
		foreach($cards[$value] as $key=>$card){
  ?>
		<td><img src="../images/SVG/<?=($status[$player]==0 )?"card.png":strtolower($card).".svg";?>" alt="Mountain View" style="width:90px;height:80px;"></td>
  <?php  }  
	
	}	?>
  </tr>
</table></span> 
 <?PHP }?>
 