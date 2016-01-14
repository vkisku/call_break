<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<title>Baraja: A Plugin for Spreading Items in a Card-Like Fashion</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<meta name="description" content="Baraja: A Plugin for Spreading Items in a Card-Like Fashion" />
		<meta name="keywords" content="jquery, plugin, transform, css3, cards, spread, items, web development" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico"> 
		<link rel="stylesheet" type="text/css" href="../sandbox/css/baraja.css" />
		<link rel="stylesheet" type="text/css" href="../sandbox/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="../sandbox/css/custom.css" />
		<script type="text/javascript" src="../sandbox/js/modernizr.custom.79639.js"></script>
	</head>
	<body>

		<div class="container">
		
			<!-- Codrops top bar -->
			<div class="codrops-top clearfix">
				<a href="http://tympanus.net/Development/GammaGallery/">
					<strong>&laquo; Previous Demo: </strong>Gamma Gallery
				</a>
				<span class="right">
					<a href="http://dribbble.com/jdelamancha">Illustrations by Jason Custer</a>
					<a href="http://tympanus.net/codrops/?p=12050">
						<strong>Back to the Codrops Article</strong>
					</a>
				</span>
			</div><!--/ Codrops top bar -->
			
			<header class="clearfix">
			
				<h1>Baraja <span>A plugin for spreading items in a card-like fashion</span></h1>
				
			</header>
			
			<section class="main">

				<nav class="actions">
					<span id="nav-fan">Fan right</span>
					<span id="nav-fan2">Fan left</span>
					
					<span id="nav-fan3">Fan right (asym.)</span>
					<span id="nav-fan4">Fan left (asym.)</span>
					
					<span id="nav-fan5">Rotated spread (horizontal)</span>
					<span id="nav-fan6">Rotated spread (vertical)</span>
					
					<span id="nav-fan7">Linear spread right</span>
					<span id="nav-fan8">Linear spread left</span>
					
					<span id="nav-fan9">Linear spread right (irregular)</span>
					<span id="nav-fan10">Linear spread left (irregular)</span>

					<span id="nav-fanOther1">other</span>
					<span id="nav-fanOther2">other</span>
					<span id="nav-fanOther3">other</span>
					<span id="nav-fanOther4">other...</span>

					<span id="add">Add items</span>
				</nav>
				<?PHP
				require_once('../_includes/include_all.php');

				$players=array("vikash","pradeep");
					$ob=new kat_patti($players);
					$ob->start();
					echo "Players are $players[0] and $players[1] </br></br>";
					echo "Card Drawn by $players[1] from deck is ".$ob->draw_card_from_deck()."</br></br>";
					//$random=$ob->get_random_card_from_deck();
					echo "Winner is ".$ob->get_winner()." !!!!";

					//print_r($deck);
				?>
				<div class="baraja-demo">
					<ul id="baraja-el" class="baraja-container">
					<?PHP 
						foreach($player1 as $cards){
					?>
						<li><img src="../images/SVG/<?=$cards['value']."_of_".strtolower($cards['suit']).".svg";?>" alt="image1" /></li>
						<?PHP } ?>
					</ul>
				</div>
				<nav class="actions light">
					<span id="nav-prev">&lt;</span>
					<span id="nav-next">&gt;</span>
					<span id="close">close</span>
				</nav>
				
			</section>
			<span id="give">give</span>
				
        </div>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="../sandbox/js/jquery.baraja.js"></script>
        <script type="text/javascript">	
			$(function() {

				var $el = $( '#baraja-el' ),
					baraja = $el.baraja();

				// navigation
				$( '#nav-prev' ).on( 'click', function( event ) {

					baraja.previous();
				
				} );
				//for(i=0;i<5;i++){
				//baraja.next();
				//}
				$( '#nav-next' ).on( 'click', function( event ) {

					baraja.next();
					
				} );
						
				$( '#give' ).on( 'click', function( event ) {

									for (var start = 1; start < 10; start++)
				setTimeout(function () { baraja.next();  }, 3000 * start);
												
				} );

				// simple fan
				$( '#nav-fan' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 90,
						direction : 'right',
						origin : { x : 25, y : 100 },
						center : true
					} );
				
				} );

				$( '#nav-fan2' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 90,
						direction : 'left',
						// note that the x origin changes (symmetric)
						origin : { x : 75, y : 100 },
						center : true
					} );
				
				} );

				// more realistic fan: without common origin (means the origin changes / increments by card )
				$( '#nav-fan3' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 90,
						direction : 'right',
						origin : { minX : 20, maxX : 80, y : 100 },
						center : true,
						translation : 60
					} );
				
				} );

				$( '#nav-fan4' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 90,
						direction : 'left',
						origin : { minX : 20, maxX : 80, y : 100 },
						center : true,
						translation : 60
					} );
				
				} );

				// playing with different origins and ranges	
				$( '#nav-fan5' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 100,
						direction : 'right',
						origin : { x : 50, y : 200 },
						center : true
					} );
				
				} );

				$( '#nav-fan6' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 80,
						direction : 'left',
						origin : { x : 200, y : 50 },
						center : true
					} );
				
				} );

				// center false, playing with translation
				$( '#nav-fan7' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 20,
						direction : 'right',
						origin : { x : 50, y : 200 },
						center : false,
						translation : 300
					} );
				
				} );

				$( '#nav-fan8' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 20,
						direction : 'left',
						origin : { x : 50, y : 200 },
						center : false,
						translation : 300
					} );
				
				} );

				// using scatter : true
				$( '#nav-fan9' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 20,
						direction : 'right',
						origin : { x : 50, y : 200 },
						center : false,
						translation : 300,
						scatter : true
					} );
				
				} );

				$( '#nav-fan10' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 20,
						direction : 'left',
						origin : { x : 50, y : 200 },
						center : false,
						translation : 300,
						scatter : true
					} );
				
				} );

				$( '#nav-fanOther1' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 130,
						direction : 'left',
						origin : { x : 25, y : 100 },
						center : false
					} );
				
				} );

				$( '#nav-fanOther2' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 360,
						direction : 'left',
						origin : { x : 50, y : 90 },
						center : false
					} );
				
				} );

				$( '#nav-fanOther3' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 330,
						direction : 'left',
						origin : { x : 50, y : 100 },
						center : true
					} );
				
				} );

				$( '#nav-fanOther4' ).on( 'click', function( event ) {

					baraja.fan( {
						speed : 500,
						easing : 'ease-out',
						range : 90,
						direction : 'right',
						origin : { minX : 20, maxX : 80, y : 100 },
						center : true,
						translation : 60,
						scatter : true
					} );
				
				} );

				// close the baraja
				$( '#close' ).on( 'click', function( event ) {

					baraja.close();
				
				} );

				// example of how to add more items
				$( '#add' ).on( 'click', function( event ) {

					if( $( this ).hasClass( 'disabled' ) ) {
						return false;
					}

					$( this ).addClass( 'disabled' );

					baraja.add( $('<li><img src="images/6.jpg" alt="image6"/><h4>Serenity</h4><p>Truffaut wes anderson hoodie 3 wolf moon labore, fugiat lomo iphone eiusmod vegan.</p></li><li><img src="images/7.jpg" alt="image7"/><h4>Dark Honor</h4><p>Chillwave mustache pinterest, marfa seitan umami id farm-to-table iphone.</p></li><li><img src="images/8.jpg" alt="image8"/><h4>Nested Happiness</h4><p>Minim post-ironic banksy american apparel iphone wayfarers.</p></li><li><img src="images/9.jpg" alt="image9"/><h4>Cherry Country</h4><p>Sint vinyl Austin street art odd future id trust fund, terry richardson cray.</p></li>') );
				
				} );

			});
		</script>
    </body>
</html>
