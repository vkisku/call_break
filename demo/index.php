<?PHP 
require_once('../_includes/call_break.php');
$ob=new call_break();
$ob->start();
echo "Player 1 </br>";
print_r($ob->get_players(1));
echo "</br></br>Player 2</br> ";
print_r($ob->get_players(2));
echo "</br></br>Player 3</br>";
print_r($ob->get_players(3));
echo "</br></br>Player 4</br> ";
print_r($ob->get_players(4));

?>