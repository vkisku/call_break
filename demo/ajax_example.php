<?Php
if(!isset($_SESSION['game_id']))session_start();
require_once('../_includes/include_all.php');
$con=mysqli_connect("localhost","vikash","kisku","play_cards");
$ob=new teen_patti($con);
$action=$_POST['action'];
$user_id=100;
$ob->action($action,$user_id);
//require_once('teen_patti_demo.php');

?>