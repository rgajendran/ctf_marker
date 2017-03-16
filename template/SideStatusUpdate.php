<?php

if(isset($_POST['update']) && isset($_POST['team'])){
	include 'connection.php';
	$team = $_POST['team'];
	$sv = $_POST['update'];
	$username = $_POST['username'];
	$result = mysqli_query($connection, "UPDATE updater SET $sv='0' WHERE TEAM='$team' AND USERNAME='$username'");
	if($result){
		echo "Success";
	}else{
		echo "Failed";
	}
}
?>