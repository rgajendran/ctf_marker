<?php
	$connection = mysqli_connect('localhost', 'root', '', 'ctff');
	//include './template/connection.php'; 
	if(isset($_COOKIE['TEAMCOOK'])){
		$chatlog_team = $_COOKIE['TEAMCOOK'];
		$chatlog_sql = "SELECT * FROM `chat` WHERE TEAM=$chatlog_team ORDER BY DATE ASC";
		$chatlog_result = mysqli_query($connection, $chatlog_sql);
		while($chatlog_row = mysqli_fetch_assoc($chatlog_result)){
			$chatlog_user = $chatlog_row['USERNAME'];
			$chatlog_log = $chatlog_row['CHAT'];
			echo "<p>$chatlog_user => $chatlog_log</p>";
		}
	}else{
		header('location:../main.php');
	}
?>