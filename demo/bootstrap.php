<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Case</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <style>
  #section {
 
	 height:30%;
    float:left;
	position:center;
	text-align:center;
	text-align:center;
    padding:5px;
	align:center;
}
#footer {
    background-color:black;
    color:white;
    clear:both;
    text-align:center;
    padding:5px;
}
  </style>
</head>
<body>
<?PHP
$id=100;
session_start();
require_once('../_includes/include_all.php');
if(isset($_GET['logout']))teen_patti::game_end();

$con=mysqli_connect("localhost","vikash","kisku","play_cards");
if(isset($_GET['set']))(new teen_patti($con))->Accept_game_request($id);
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
		teen_patti::Redirect($_SERVER['PHP_SELF']);
	}
 }
 else {
 //$con=mysqli_connect("localhost","vikash","kisku","play_cards");
		$ob=new teen_patti($con);
		$winner=$ob->get_rank();
		$players=$ob->get_players();
		$cards=$ob->get_cards_by_game_id();
		$status=$ob->get_status();
		//print_r($ob->show());
		$user_id=100;
		//$ob->queue(102);
		$st=$ob->get_status();
		$status=$st['status'];
		$status1=$st['queue_status'];
		//echo $ob->get_left_or_right(103)['right'];
		//$ob->action("blind",101);
		

	 ?><div class="container">
	 <ul class="nav nav-tabs nav-pills nav-justified">
	 <?php foreach($players as $player){ ?>
		<li class="<?=($status1[$player]==1)?"active":"disabled";?>"><a data-toggle="tab" href=<?="#".($status1[$player]==1)?$player:"disabled";?>><?=$player?></a></li> 
  
	<?php } ?>
		</ul>
			</div>
			<div class="tab-content">
<?php	foreach($players as $player){
			//if($player!=$id){  ?>
				<div id=<?=$player?> class="tab-pane fade in <?=($status1[$player]==1)?"active":"";?>">
					<table  border="0" style="width:30%">
						<tr  class="thumbnail " id=<?=($status1[$player]==1)?"ur_chance":""; ?> >
							<!--<td class="active" ><?="Player ".$player;  echo " value=".$winner[$player];?></td>-->
<?php 		if($user_id==$player){ ?>
							<!--<td>action</td>-->
<?php 			if($status1[$player]==1){ ?>
							<!--<td><a href="" id="seen" value="see">See</button></td>-->
<?php 			}
			}
			else{ 	                ?>
							<td>daction</td>
<?php	 		}                   ?>
<?php			foreach($cards[$player] as $card){ 
?>
							<td class="active" >
								<img src="../images/SVG/<?=($status[$player]==0 )?"card.png":strtolower($card).".svg";?>" class="img-rfesponsive thumbnail" alt="Mountain View" style="width:80px;height:100px;">
							</td>
<?php 			}       
?>  					</tr>
					</table>					
				</div>
<?php		 
		}
?>			</div>
			<div id="section">
				<table>
<?PHP 
		$cards=$ob->get_cards_by_game_id($id);
		$st=$ob->get_status();
		$status=$st['status'];
		$status1=$st['queue_status'];
		$p=$ob->get_status(100);
		print_r($p);
  //print_r($cards);
  //print_r($status);	
		foreach($cards as $key=>$cards){
?>					<tr  class="thumbnail " id=<?=($status1[$key]==1)?"ur_chance":""; ?> >
<?PHP 		foreach($cards as $card){
?>	
						<td>
							<img src="../images/SVG/<?=($status[$key]==0)?"card.png":strtolower($card).".svg";?>" class="img-responsive thumbnail" alt="Mountain View" style="width:50%;height:50%;">
						</td>
  <?php  	}  
		}
?>					</tr>
					<tr>Me</tr>
				</table>
			  <button type="button" id="start" class="btn btn-default disabled">Start</button>
			  <button type="button" id="blind" class="btn btn-primary ">Blind</button>
			  <button type="button" id="seen" class="btn btn-success disabled ">Seen</button>
			  <button type="button" id="pack" value= "pack"class="btn btn-info active">Pack</button>
			  <button type="button" id="quit" class="btn btn-danger disabled">Quit</button>
			</div>  
</body>
 <?PHP }?>
 <script>
 $(document).ready(function(){
    $("button#quit").click(function(){
	bootbox.confirm("Are you sure?", function(result) {
  Example.show("Confirm result: "+result);
  alert("j");
	});
        alert("hello");
        });
});

$(document).ready(function(){
    $("button").click(function(){
        var txt=this.id;
		//alert(txt);
		
        $.post("ajax_example.php", {action: txt}, function(result){
						var url = 'teen_patti_demo.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'         
                        $('#container').load(url + ' #container'); //note: the space before #div1 is very important
			                     $("d").html(result);
			   

        });
    });
});
 </script>
 </html>