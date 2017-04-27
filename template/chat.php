<?php
  
require '../class/Validator.php';
  
  if(isset($_POST['team']) && isset($_POST['chat']) && isset($_POST['user'])){
     $creditional = new Creditional();
	 $team = $creditional->getTeam();
	 $user = $creditional->getUsername();  
	 $chat = Validator::filterString($_POST['chat']);
	 include 'connection.php';
	 if(!empty($chat) && strlen($chat) > 1){
	 	 $date = new DateTime('now', new DateTimeZone('Europe/London'));
		 $fdate = $date->format('Y-m-d H:i:s');
		 $log_sql = "INSERT INTO chat (DATE, USERNAME, TEAM, CHAT) VALUES ('$fdate','$user','$team','$chat')";
		 if(mysqli_query($connection, $log_sql)){
		 	 echo 1;
			 mysqli_query($connection, "UPDATE updater SET CHAT='1' WHERE TEAM='$team'");
		 }else{
		 	echo 0;
		 }	
	 }	
  }	 
	 
?>