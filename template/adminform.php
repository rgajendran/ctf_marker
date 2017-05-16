<?php
include 'connection.php';
if(isset($_POST['home_date'])){
		if(!empty($_POST['home_date'])){
			$home_date = $_POST['home_date'];
			$timestamp = strtotime($home_date);
			$new_date_format = date('Y-m-d H:i:s', $timestamp);		
			$home_date_result = mysqli_query($connection, "UPDATE options SET value='$new_date_format' WHERE name='HOME_TIME'");
			if($home_date_result){
					echo "Time Set : <b style='color:green;'>Home Time Successful</b>";

			}else{
				echo "<b style='color:red;'>Failed to update hometime</b>";
			}

		}else{
			echo "<b style='color:red;'>Time is empty</b>";
		}
}else if(isset($_POST['ctf_date'])){
		if(!empty($_POST['ctf_date'])){
			$ctf_date = $_POST['ctf_date'];
			$timestamp = strtotime($ctf_date);
			$new_date_format = date('Y-m-d H:i:s', $timestamp);								
			$ctf_date_result = mysqli_query($connection, "UPDATE options SET value='$new_date_format' WHERE name='END_TIME'");
			if($ctf_date_result){
				$ctf_date_updater = mysqli_query($connection, "UPDATE updater SET TIME='1'");
				if($ctf_date_updater){
					echo "<b style='color:green;'>CTF Time Successful</b>";
				}else{
					echo "<b style='color:red;'>Failed to update CTF time updater</b>";
				}

			}else{
				echo "<b style='color:red;'>Failed to update CTF time</b>";
			}

		}else{
			echo "<b style='color:red;'>Time is empty</b>";
		}
}else if(isset($_POST['ctf_login'])){
	$sql = mysqli_query($connection, "SELECT value FROM options WHERE name='LOGIN'");
	while($row = mysqli_fetch_assoc($sql)){
		$val = $row['value'];
		if($val == "ALLOW"){
			$val = "DENY";
			$up = mysqli_query($connection, "UPDATE options SET value='DENY' WHERE name='LOGIN'");
		}else{
			$val = "ALLOW";
			$up = mysqli_query($connection, "UPDATE options SET value='ALLOW' WHERE name='LOGIN'");
		}
		if($up){
			if($val == "ALLOW"){
				echo "<b style='color:green;'>$val</b>";
			}else{
				echo "<b style='color:red;'>$val</b>";
			}
		}else{
			echo "<b style='color:red;'>Failed to Updated</b>";
			}
		}
}else if(isset($_POST['adminedit'])){
	$sql = mysqli_query($connection, "SELECT value FROM options WHERE name='ADMINEDIT'");
	while($row = mysqli_fetch_assoc($sql)){
		$val = $row['value'];
		if($val == "ALLOW"){
			$val = "DENY";
			$up = mysqli_query($connection, "UPDATE options SET value='DENY' WHERE name='ADMINEDIT'");
		}else{
			$val = "ALLOW";
			$up = mysqli_query($connection, "UPDATE options SET value='ALLOW' WHERE name='ADMINEDIT'");
		}
		if($up){
			if($val == "ALLOW"){
				echo "<b style='color:green;'>$val</b>";
			}else{
				echo "<b style='color:red;'>$val</b>";
			}
		}else{
			echo "<b style='color:red;'>Failed to Updated</b>";
			}
		}
}else if(isset($_POST['hscore'])){
	$sql = mysqli_query($connection, "SELECT value FROM options WHERE name='SCOREBOARD'");
	while($row = mysqli_fetch_assoc($sql)){
		$val = $row['value'];
		if($val == "ALLOW"){
			$val = "DENY";
			$up = mysqli_query($connection, "UPDATE options SET value='DENY' WHERE name='SCOREBOARD'");
		}else{
			$val = "ALLOW";
			$up = mysqli_query($connection, "UPDATE options SET value='ALLOW' WHERE name='SCOREBOARD'");
		}
		if($up){
			if($val == "ALLOW"){
				echo "<b style='color:green;'>$val</b>";
			}else{
				echo "<b style='color:red;'>$val</b>";
			}
		}else{
			echo "<b style='color:red;'>Failed to Updated</b>";
			}
		}
}else{
	echo "Invalid";
}

?>