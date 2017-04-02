<div class="scoreboard">
	<?php
	include 'connection.php';
	if(!isset($_SESSION)){
		session_start();
	}
	$score_sql_1 = "SELECT * FROM scoreboard ORDER BY SCORE DESC";
		$score_result_1 = mysqli_query($connection, $score_sql_1);
		$ranks = 0;
		while($score_row_1 = mysqli_fetch_assoc($score_result_1)){
			$score_team_1 = $score_row_1['TEAM'];
			$score_score_1 = $score_row_1['SCORE'];
			$score_penalty_1 = $score_row_1['PENALTY'];
			$score_teamname_1 = $score_row_1['TEAMNAME'];
			$score_team_session_1 = $_SESSION['TEAM'];
			$ranks+=1;
			
			if($score_team_session_1 != $score_team_1){
                        	$team_class="other_team";
			} else {
                        	$team_class="my_team";
			}
                        
		?>
		<!-- -->
		<div class="scoreboard_row <?php echo $team_class; ?>">
			<div class="team_score">
				<span class="team_logo"><img class="team_logo" src="images/flag.svg"/></span>
				<span><?php echo $score_teamname_1; ?></span>
				<span>#<?php echo $ranks; ?></span>
				<span><?php echo $score_score_1; ?></span>
			</div>
		</div>
		<?php
		}
		?>
		<!-- -->
	</div>