<?PHP
function nav(){
	"<<<EOS<div id="nav">  
			<span id="container" class="container">
				<table  border="0" style="width:30%">  

		foreach($players as $player){ 
			if($player!=$id){  
					<tr  class="thumbnail " id=<?=($status1[$player]==1)?"ur_chance":""; >
						<td class="active" ><?="Player ".$player;  echo " value=".$winner[$player];</td>
  		if($user_id==$player){
						<td  >action</td>
   			if($status1[$player]==1){ 
		
						<td ><a href="" id="seen" value="see">See</button></td>
   			}
				}
				else{ 	
						<td>daction</td>
  	 		} 
  
				foreach($cards[$player] as $card){
						<td class="active" >
							<img src="../images/SVG/<?=($status[$player]==0 )?"card.png":strtolower($card).".svg";?>" class="img-rfesponsive thumbnail" alt="Mountain View" style="width:80px;height:100px;">
						</td>
  		}  
	
			}
		}	
  
					</tr>	
				</table>
			</span>
		</div>
}
 ?>