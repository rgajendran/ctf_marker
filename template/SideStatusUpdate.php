<?php

if(isset($_POST['update']) && isset($_POST['team'])){
	include 'connection.php';
	$team = $_POST['team'];
	$sv = $_POST['update'];
	$username = $_POST['username'];
	$result = mysqli_query($connection, "UPDATE updater SET $sv='0' WHERE TEAM='$team' AND USERNAME='$username'");
	$chooseHint = mysqli_query($connection, "SELECT HINT_UPDATE FROM updater WHERE TEAM='$team' AND USERNAME='$username'");
	if($result){
		if($sv == "HINT"){
			if($chooseHint){
				while($row = mysqli_fetch_assoc($chooseHint)){
					$hint = $row['HINT_UPDATE'];
					echo $hint;
				}
			}else{
				echo "Failed";
			}
		}else{
			echo "Success";
		}		
	}else{
		echo "Failed";
	}
}
?>