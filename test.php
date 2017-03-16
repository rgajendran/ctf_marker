<?php
/*
$xml = simplexml_load_file("D:\\xampp\\htdocs\\secgen\\example\\books.xml") or die("Error cannot create");

foreach($xml->book as $val){
	echo $val->title."<br><br><br>";
}

for($int = 0; $int<10; $int++){
	echo strtoupper(md5(bin2hex(openssl_random_pseudo_bytes(16)).time()))."<br>";
}
echo "<br>".md5("gaju"."CTF");
 * */
 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hello World Test</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
	 	<script src="noti/notify.js"></script>
		<script src="noti/notify.min.js"></script>
</head>
<body>
	<script>
	$.notify.addStyle('NewT', {
  html: "<div>&#10004; <span data-notify-text/></div>",
  classes: {
    base: {
      "white-space": "nowrap",
      "background-color": "#abd17d",
      "color":"#354b1b",
      "border-radius":"0.5em",
      "padding": "15px"
    },
    superblue: {
      "color": "white",
      "background-color": "blue",
      "margin-top":"50%"
    }
  }
});

	var n = function(){
		$.notify("New Message Received",{position:"top center", className:"success"});
	}
	</script>
	<p id="submit"><button onclick="n();">Click Me</button></p>
	
	<form method="post" action="test.php">
		<input type="submit" name="sus" value="Submit"/>
	</form>
	<?php
	if(isset($_POST['sus'])){
		$connection = mysqli_connect("localhost", "root", "", "ctff");
		$r = mysqli_query($connection, "UPDATE updater SET ACTIVITY='1', FLAG='1' WHERE TEAM='1'");
		if($r){
			echo "Success";
		}else{
			echo "Fail";
		}
	}
	?>
</body>
</html>