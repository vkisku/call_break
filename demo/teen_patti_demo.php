<?PHP
require_once('../_includes/include_all.php');
$players=array("vikash");
 $ob=new teen_patti($players);
 $ob->start();
 //$ob->cards_of_players();
 //print_r($ob->get_players());
 $array=array(array(
 array('face'=>'Seven','value'=>14,'suit'=>'Clubs'),//8 9 10   8 10 9  9 8 10 9 10 8 // 10 8 9 // 10 9 8
 array('face'=>'Eight','value'=>8,'suit'=>'Diamonds'),
 array('face'=>'Ten','value'=>10,'suit'=>'Clubs')
 ),
 array(
 array('face'=>'Ace','value'=>14,'suit'=>'Clubs'),
 array('face'=>'Jack','value'=>7,'suit'=>'Diamonds'),  
 array('face'=>'King','value'=>6,'suit'=>'Clubs')  
 )
 );
// print_r($array);
 get_winner($array);
 function get_winner($array){
 $l=count($array);
 //echo $l;
 $ans=array();
 for($i=0;$i<$l;$i++){
 
 if($array[$i][0]['face']==$array[$i][1]['face'] && $array[$i][1]['face']==$array[$i][2]['face']){  // condition of trio
 
 $ans[$i]=10000+$array[$i][0]['value'];
 }//10 8 9
 else if(($array[$i][0]['value']+1==$array[$i][1]['value'] && $array[$i][1]['value']+1==$array[$i][2]['value'])||  // condition for Run
 $array[$i][2]['value']+1==$array[$i][1]['value'] && $array[$i][1]['value']+1==$array[$i][0]['value']||    
 $array[$i][0]['value']+1==$array[$i][2]['value'] && $array[$i][2]['value']+1==$array[$i][1]['value']||
 $array[$i][1]['value']+1==$array[$i][0]['value'] && $array[$i][0]['value']+1==$array[$i][2]['value']||
 $array[$i][2]['value']+1==$array[$i][0]['value'] && $array[$i][0]['value']+1==$array[$i][1]['value']||
 $array[$i][1]['value']+1==$array[$i][2]['value'] && $array[$i][2]['value']+1==$array[$i][0]['value']){
 if($array[$i][0]['suit']==$array[$i][1]['suit']  && $array[$i][1]['suit']==$array[$i][2]['suit'])  // Straight
 $ans[$i]=9000+(max($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']));
 else $ans[$i]=8000+(max($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value'])); //Normal
 }
 else if($array[$i][0]['suit']==$array[$i][1]['suit']  && $array[$i][1]['suit']==$array[$i][2]['suit']){   // Color
 $ans[$i]=7000+(max($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']));
 }
 else if($array[$i][0]['face']==$array[$i][1]['face'] && $array[$i][0]['face']!=$array[$i][2]['face'] ||  // Double
 $array[$i][0]['face']==$array[$i][2]['face'] && $array[$i][0]['face']!=$array[$i][1]['face']||
 $array[$i][1]['face']==$array[$i][2]['face'] && $array[$i][2]['face']!=$array[$i][0]['face']){ // 223 232 322
$ans[$i]=6000+$array[$i][0]['value']+$array[$i][1]['value']+$array[$i][2]['value']; //776  778
 }
 else  $ans[$i]=(max($array[$i][0]['value'],$array[$i][1]['value'],$array[$i][2]['value']))*10-($array[$i][0]['value']+$array[$i][1]['value']+$array[$i][2]['value']);
 }
 print_r($ans);
 }
 ?>