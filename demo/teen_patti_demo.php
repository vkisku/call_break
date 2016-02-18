<!DOCTYPE html>
<html lang="en">
<head>
  <title>Game|Teen Patti</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/modernizr.custom.79639.js"></script>
		<script type="text/javascript" src="js/teen_patti.js"></script>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="css/baraja.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/custom.css" />
		<style>
#header {
    background-color:black;
    color:white;
    text-align:center;
    padding:5px;
}
#ur_chance {
    background-color:hsla(190, 66%, 51%, 0.9);
	
}
#nav {
    line-height:70%;
    height:30%;
	<!--background-color:black;-->
    width:25%;
    float:left;
    padding:5px;
}#nav1 {
    line-height:70%;
    height:30%;
	background-color:black;
    width:25%;
    float:right;
    padding:5px;
}
#section {
    width:350px;
	 height:30%;
    float:left;
    padding:10px;
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
 ?>
 <div id="nav">  
<span id="container" class="container">
<?PHP
 //$con=mysqli_connect("localhost","vikash","kisku","play_cards");
 $ob=new teen_patti($con);
 $winner=$ob->get_rank();
 $players=$ob->get_players();
 $cards=$ob->get_cards_by_game_id();
$status=$ob->get_status();

print_r($ob->show());
  ?>


   <table  border="0" style="width:30%">  
  <?PHP
  $user_id=100;
	//$ob->queue(102);
	$st=$ob->get_status();
	$status=$st['status'];
	$status1=$st['queue_status'];

	$i=0;
  foreach($players as $player){ if($player!=$id){   	?>
	<tr  class="thumbnail " id=<?=($status1[$player]==1)?"ur_chance":""; ?> >
		<td class="active" ><?="Player ".$player;  echo " value=".$winner[$player];?></td>
  <?PHP if($user_id==$player){ ?>
		<td  >action</td>
  <?PHP 	if($status1[$player]==1){ ?>
		
		<td ><a href="" id="seen" value="see">See</button></td>
  <?PHP 	}
		}else
			{ ?>
		<td>daction</td>
  <?php	 } ?>
  <?PHP	
		foreach($cards[$player] as $card){
		
  ?>	
		<td class="active" >
		<img src="../images/SVG/<?=($status[$player]==0 )?"card.png":strtolower($card).".svg";?>" class="img-rfesponsive thumbnail" alt="Mountain View" style="width:80px;height:100px;">
		</td>
  <?php  }  
	
		}
	}	?>
  
  </tr></table>
  </div>
  <div id="nav1">
<h1>London</h1>
<p>
London is the capital city of England. It is the most populous city in the United Kingdom,
with a metropolitan area of over 13 million inhabitants.
</p>
<p>
Standing on the River Thames, London has been a major settlement for two millennia,
its history going back to its founding by the Romans, who named it Londinium.
</p>
</div>
  <div id="section">
  
  <table>
  <?PHP 
  $cards=$ob->get_cards_by_game_id($id);
  $st=$ob->get_status();
	$status=$st['status'];
	$status1=$st['queue_status'];
  //print_r($cards);
  //print_r($status);
  ?>
  <?PHP	
		foreach($cards as $key=>$cards){
		
		?>
		<tr  class="thumbnail " id=<?=($status1[$key]==1)?"ur_chance":""; ?> >
		<?PHP foreach($cards as $card){
  ?>	
		<td  >
		<img src="../images/SVG/<?=($status[$player]==0 )?"card.png":strtolower($card).".svg";?>" class="img-rfesponsive thumbnail" alt="Mountain View" style="width:100%;height:100%;">
		</td>
  <?php  }  }
	?>
	</tr><tr>Me</tr></table></span>
  <button type="button" id="start" class="btn btn-default disabled">Start</button>
  <button type="button" id="blind" class="btn btn-primary ">Blind</button>
  <button type="button" id="seen" class="btn btn-success disabled ">Seen</button>
  <button type="button" id="pack" value= "pack"class="btn btn-info active">Pack</button>
  <button type="button" id="quit" class="btn btn-danger disabled">Quit</button>
</div>  
</div>
<d></d>
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
 