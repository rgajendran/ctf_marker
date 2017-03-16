<div class="div1_inner_other_team">
	<?php
	$connection = mysqli_connect('localhost', 'root', '', 'ctff');
	$score_sql_1 = "SELECT * FROM scoreboard ORDER BY SCORE DESC";
		$score_result_1 = mysqli_query($connection, $score_sql_1);
		$ranks = 0;
		while($score_row_1 = mysqli_fetch_assoc($score_result_1)){
			$score_team_1 = $score_row_1['TEAM'];
			$score_score_1 = $score_row_1['SCORE'];
			$score_penalty_1 = $score_row_1['PENALTY'];
			$score_team_session_1 = $_COOKIE['TEAMCOOK'];
			$ranks+=1;
			
			if($score_team_session_1 != $score_team_1){
		?>
		<!-- -->
		<div class="div1_inner_team_logo">
			<img src="images/anon1.png"/>
		</div>
		<div class="div1_inner_team_content">
			<div class="div1_inner_team_content_subs">
				<h3>#Rank <?php echo $ranks;?></h3>
			</div>
			<div class="div1_inner_team_content_subs">
				<table class="tg">
					  <tr>
					    <th class="tg-yw4l">Points</th>
					    <th class="tg-yw4l"><?php echo $score_score_1; ?></th>
					  </tr>
				</table>
			</div>
			<div class="div1_inner_team_content_subs">
				<table class="tg">
					  <tr>
					    <th class="tg-yw4l">Penalty</th>
					    <th class="tg-yw4l"><?php echo $score_penalty_1; ?></th>
					  </tr>
				</table>
			</div>												
		</div>
		<?php
			}
		}
		?>
		<!-- -->
	</div>