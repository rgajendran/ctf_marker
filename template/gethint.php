<?php

if(isset($_POST['cid']) && isset($_POST['team'])){
	
	include 'connection.php';
	$cid = stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['cid'],FILTER_SANITIZE_STRING)))));
	$team = stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['team'],FILTER_SANITIZE_STRING)))));
	$sql = "SELECT * FROM secgenflag WHERE C_ID='$cid' AND TEAM='$team'";
	$result = mysqli_query($connection, $sql);
	while($row = mysqli_fetch_assoc($result)){
		//hint 1
		$hint1 = $row['HINT_1'];
		$hint1stat = $row['HINT_1_STATUS'];
		$hint1points = $row['HINT_1_POINTS'];
		
		//hint2 
		$hint2 = $row['HINT_2'];
		$hint2stat = $row['HINT_2_STATUS'];
		$hint2points = $row['HINT_2_POINTS'];
		
		//hint3
		$hint3 = $row['HINT_3'];
		$hint3stat = $row['HINT_3_STATUS'];
		$hint3points = $row['HINT_3_POINTS'];
		
		//int 
		$int = $hint1stat + $hint2stat + $hint3stat;
		
		//check
		if($int == 0){
			//get first hint
			$int1_sql = "SELECT SCORE,PENALTY FROM scoreboard WHERE TEAM='$team'";
			$int1_result = mysqli_query($connection, $int1_sql);
			while($int1_row = mysqli_fetch_assoc($int1_result)){
				$score = $int1_row['SCORE'];
				$penalty = $int1_row['PENALTY'];
				$updatescore = $score - $hint1points;
				$updatepenalty = $penalty + $hint1points;
				$update_points_sql = mysqli_query($connection, "UPDATE scoreboard SET SCORE='$updatescore',PENALTY='$updatepenalty' WHERE TEAM=$team");
				if($update_points_sql){
					$update_hint_status = mysqli_query($connection, "UPDATE secgenflag SET HINT_1_STATUS=1 WHERE C_ID='$cid'");
					if($update_hint_status){
						echo "<h4 style='color:green;'>Hint 1 (Disclosed) : $hint1 <span style='color:orange'>-$hint1points</span></h4>?<h4>Hint 2 (Not Disclosed)</h4>?<h4>Hint 3 (Not Disclosed)</h4>";
					}else{
						echo "<h4>Hint 1 (Not Disclosed) : Error</h4>?<h4>Hint 2 (Not Disclosed)</h4>?<h4>Hint 3 (Not Disclosed)</h4>";
					}
				}else{
					echo "<h4>Hint 1 (Not Disclosed) : Error</h4>?<h4>Hint 2 (Not Disclosed)</h4>?<h4>Hint 3 (Not Disclosed)</h4>";
				}
			}
		}else if($int == 1){
			//get second hint
			$int1_sql = "SELECT SCORE,PENALTY FROM scoreboard WHERE TEAM='$team'";
			$int1_result = mysqli_query($connection, $int1_sql);
			while($int1_row = mysqli_fetch_assoc($int1_result)){
				$score = $int1_row['SCORE'];
				$penalty = $int1_row['PENALTY'];
				$updatescore = $score - $hint2points;
				$updatepenalty = $penalty + $hint2points;
				$update_points_sql = mysqli_query($connection, "UPDATE scoreboard SET SCORE='$updatescore',PENALTY='$updatepenalty' WHERE TEAM=$team");
				if($update_points_sql){
					$update_hint_status = mysqli_query($connection, "UPDATE secgenflag SET HINT_2_STATUS=1 WHERE C_ID='$cid'");
					if($update_hint_status){
						echo "<h4 style='color:green;'>Hint 1 (Disclosed) : $hint1</h4>?<h4 style='color:green;'>Hint 2 (Disclosed) : $hint2 <span style='color:orange'>-$hint2points</span></h4>?<h4>Hint 3 (Not Disclosed)</h4>";
					}else{
						echo "<h4>Hint 1 (Not Disclosed) : Error</h4>?<h4>Hint 2 (Not Disclosed)</h4>?<h4>Hint 3 (Not Disclosed)</h4>";
					}
				}else{
					echo "<h4>Hint 1 (Not Disclosed) : Error</h4>?<h4>Hint 2 (Not Disclosed)</h4>?<h4>Hint 3 (Not Disclosed)</h4>";
				}
			}
		}else if($int == 2){
			//get third hint 
			$int1_sql = "SELECT SCORE,PENALTY FROM scoreboard WHERE TEAM='$team'";
			$int1_result = mysqli_query($connection, $int1_sql);
			while($int1_row = mysqli_fetch_assoc($int1_result)){
				$score = $int1_row['SCORE'];
				$penalty = $int1_row['PENALTY'];
				$updatescore = $score - $hint3points;
				$updatepenalty = $penalty + $hint3points;
				$update_points_sql = mysqli_query($connection, "UPDATE scoreboard SET SCORE='$updatescore',PENALTY='$updatepenalty' WHERE TEAM=$team");
				if($update_points_sql){
					$update_hint_status = mysqli_query($connection, "UPDATE secgenflag SET HINT_3_STATUS=1 WHERE C_ID='$cid'");
					if($update_hint_status){
						echo "<h4 style='color:green;'>Hint 1 (Disclosed) : $hint1</h4>?<h4 style='color:green;'>Hint 2 (Disclosed) : $hint2</h4>?<h4 style='color:green;'>Hint 3 (Disclosed) : $hint3 <span style='color:orange'>-$hint3points</span></h4>";
					}else{
						echo "<h4>Hint 1 (Not Disclosed) : Error</h4>?<h4>Hint 2 (Not Disclosed)</h4>?<h4>Hint 3 (Not Disclosed)</h4>";
					}
				}else{
					echo "<h4>Hint 1 (Not Disclosed) : Error</h4>?<h4>Hint 2 (Not Disclosed)</h4>?<h4>Hint 3 (Not Disclosed)</h4>";
				}
			}
			
		}else if($int == 3){
			//view all hints
			echo "<h4 style='color:green;'>Hint 1 (Disclosed) : $hint1</h4>?<h4 style='color:green;'>Hint 2 (Disclosed) : $hint2</h4>?<h4 style='color:green;'>Hint 3 (Disclosed) : $hint3</h4>";
		}
	}
	
}

?>