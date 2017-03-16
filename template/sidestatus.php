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
		}
		if($row['ACTIVITY'] == 1){
			echo "ACTIVITY".";";
		}
		if($row['SCORE'] == 1){
			echo "SCORE".";";
		}
		if($row['ANNOUNCE'] == 1){
			echo "ANNOUNCE".";";
		}
		if($row['FLAG'] == 1){
			echo "FLAG".";";
		}
	}
}

?>