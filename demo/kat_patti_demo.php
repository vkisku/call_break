<?PHP 
require_once('../_includes/include_all.php');

 $players=array("vikash","pradeep");
$ob=new kat_patti($players);
$ob->start();
echo "Players are $players[0] and $players[1] </br></br>";
echo "Card Drawn by $players[1] from deck is ".$ob->draw_card_from_deck()."</br></br>";
//$random=$ob->get_random_card_from_deck();
echo "Winner is ".$ob->get_winner()." !!!!";


?>