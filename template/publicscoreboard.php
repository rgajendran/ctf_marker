<?php
include 'connection.php';
echo "<table cellspacing='0' cellpadding='0'>";
$score_sql_1 = "SELECT * FROM scoreboard ORDER BY SCORE DESC";
	$score_result_1 = mysqli_query($connection, $score_sql_1);
	$ranks = 0;
	while($score_row_1 = mysqli_fetch_assoc($score_result_1)){
		$score_team_1 = $score_row_1['TEAM'];
		$score_score_1 = $score_row_1['SCORE'];
		$score_penalty_1 = $score_row_1['PENALTY'];
		$score_teamname_1 = $score_row_1['TEAMNAME'];
		$ranks+=1;
		
		if($ranks == 1){
			$team_class="my_team";
		} else {
            $team_class="other_team";                        	
		}                
	?>
	<tr class="scoreboard_row <?php echo $team_class; ?>">
			<div class="team_score">
				<td class="sc_equal"><span class="team_logo"><img class="team_logo" src="images/flag.svg" align="center"/></span></td>
				<td class="sc_name"><span><?php echo $score_teamname_1; ?></span></td>
				<td class="sc_equal"><span>#<?php echo $ranks; ?></span></td>
				<td class="sc_equal"><span><?php echo $score_score_1; ?></span></td>
			</div>
	</tr>
	<?php
	}
	echo "</table>"
	?>