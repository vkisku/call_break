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
// simple fan
			
$( '#baraja-el' ).on( 'click', function( event ) {
		baraja.fan( {
				speed : 500,
				easing : 'ease-out',
				range : 90,
				direction : 'right',	
				origin : { x : 25, y : 40 },
				center : true
			} );
				
		} );

$( '#quit' ).on( 'click', function( event )({
});
<script>
 $(document).ready(function(){
    $("button#quit").click(function(){
	bootbox.confirm("Are you sure?", function(result) {
  Example.show("Confirm result: "+result);
});
        //alert("hello");
        });
});
 </script>