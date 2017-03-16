<?php

if(isset($_POST['tm']) && isset($_POST['fg'])){
     $flag = $_POST['fg'];
	 $team = $_POST['tm'];
	
	 include 'connection.php';	
	 if(!empty($flag)){
	 	$fg = stripslashes(htmlspecialchars(htmlentities(trim(filter_var($flag,FILTER_SANITIZE_STRING)))));
		$query = "SELECT * FROM secgenflag WHERE FLAG='$fg'";
		$result = mysqli_query($connection, $query);
		$num = mysqli_num_rows($result);
		$date = new DateTime('now', new DateTimeZone('Europe/London'));
		$fdate = $date->format('Y-m-d H:i:s');
		if($num == 1)
		{
		 //-----------------------------------------------
		  while($row = mysqli_fetch_assoc($result)){
			  	 $ans = $row['FLAG'];
				 $point = $row['FLAG_POINTS'];
				 $cid = $row['C_ID'];
				 $stat = $row['STATUS'];
				 $vm = $row['VM'];
				 if($stat == 0){
					 if($fg == $ans){
					 	//update flag status
					 	$suc = 1;
					 	$update_status_sql = mysqli_query($connection,"UPDATE secgenflag SET STATUS='$suc' WHERE FLAG='$fg'");
						if($update_status_sql){
							$flag_marker_scb_sql = mysqli_query($connection,"SELECT SCORE FROM scoreboard WHERE TEAM='$team'");
							while($flag_marker_scb_row = mysqli_fetch_assoc($flag_marker_scb_sql)){
								$flag_scoreboard_points = $flag_marker_scb_row['SCORE'];
								$final_grade = $flag_scoreboard_points + $point;
								$update_points_sql = mysqli_query($connection,"UPDATE scoreboard SET SCORE='$final_grade' WHERE TEAM=$team");
								if($update_points_sql){
									$log_sql = mysqli_query($connection, "INSERT INTO logger (DATE, TEAM, LOG) VALUES ('$fdate','$team','[$vm] Captured the Flag - [$flag]')");
									if($log_sql){
										$act_update = mysqli_query($connection, "UPDATE updater SET ACTIVITY='1', FLAG='1' WHERE TEAM='$team'");
										echo "<p style='color:#d4ff00;'>Your key is Correct</p>"; 
										if(!$act_update){
											$flag_log_query = mysqli_query($connection, $log_sql);
											if(!$flag_log_query){
												$log_sql_failed = "INSERT INTO report (DATE,LOG) VALUES ('$fdate','Flag check logger failed to log for team $team')";
												$flag_log_query_failed = mysqli_query($connection, $log_sql_failed);
											}	
										}	
									}
								}
							} 
						}else{
							$log_sql_error = "INSERT INTO report (DATE,  LOG) VALUES ('$fdate','Flag Status Update Failed - $cid')";
							mysqli_query($connection, $log_sql_error);
						}
					 	//end
					 }else{
						echo "<p style='color:orange;'>Your key is Incorrent</p>"; 
						$log_sql = mysqli_query($connection,"INSERT INTO logger (DATE, TEAM, LOG) VALUES ('$fdate','$team','Incorrect Flag Entered - [$fg]')");
						mysqli_query($connection, "UPDATE updater SET ACTIVITY='1' WHERE TEAM='$team'");
					 } 
				}else{
					echo "<p style='color:orange;'>Flag already captured</p>";
				}	
		  }
		 
		 //-----------------------------------------------
		}else{
			echo "<p style='color:orange;'>Incorrect Flag</p>";
			mysqli_query($connection,"INSERT INTO logger (DATE, TEAM, LOG) VALUES ('$fdate','$team','Incorrect Flag Entered - [$fg]')");
			mysqli_query($connection, "UPDATE updater SET ACTIVITY='1' WHERE TEAM='$team'");
		}
		 
	 }else{
	 	echo "<p style='color:orange;'>Your string is empty</p>";
	 }
	
}

?>