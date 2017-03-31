<?php

/*if(isset($_POST['status'])){
	include 'connection.php';
	$team = $_POST['team'];
	$result = mysqli_query($connection, "SELECT * FROM settings");
	while($row = mysqli_fetch_assoc($result)){
		$key= $row['SETTING'];
		$value = $row['VALUE'];
		if($value == 1){
			echo $key.";";
		}
	}	
}*/


if(isset($_POST['status'])){
	include 'connection.php';
	$team = $_POST['team'];
	$user = $_POST['username'];
	$result = mysqli_query($connection, "SELECT * FROM updater WHERE USERNAME='$user'");
	while($row = mysqli_fetch_assoc($result)){
		if($row['CHAT'] == 1){
			echo "CHAT".";";
		}else if($row['ACTIVITY'] == 1){
			echo "ACTIVITY".";";
		}else if($row['SCORE'] == 1){
			echo "SCORE".";";
		}else if($row['ANNOUNCE'] == 1){
			echo "ANNOUNCE".";";
		}else if($row['FLAG'] == 1){
			echo "FLAG".";";
		}else if($row['TIME'] == 1){
			echo "TIME".";";
		}else if($row['HINT'] == 1){
			echo "HINT".";";
		}		
	}
}

?>