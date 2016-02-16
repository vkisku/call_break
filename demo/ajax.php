<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("button#blind").click(function(){
        var txt = "seen";
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

<p>Start typing a name in the input field below:</p>
First name:

<input type="text">

<p>Suggestions: <span></span></p>
<button id="blind">button</button>
<button id="blind1">button</button>
<p>The file used in this example (<a href="demo_ajax_gethint.txt" target="_blank">demo_ajax_gethint</a>) is explained in our Ajax tutorial</p>

</body>
</html>
