<?php
$connection = mysqli_connect('localhost', 'root', '', 'ctff');
if(isset($_COOKIE['TEAMCOOK'])){
	$score_sql = "SELECT * FROM scoreboard ORDER BY SCORE DESC";
	$score_result = mysqli_query($connection, $score_sql);
	$rank = 0;
	while($score_row = mysqli_fetch_assoc($score_result))
	{
		$score_team = $score_row['TEAM'];
		$score_score = $score_row['SCORE'];
		$score_penalty = $score_row['PENALTY'];
		$score_team_session = $_COOKIE['TEAMCOOK'];
		$rank+=1;
		
		if($score_team_session == $score_team){
			
	?>
	<div class="div1_inner_team">
		<div class="div1_inner_team_logo">
			<img src="images/anon1.png"/>
		</div>
		<div class="div1_inner_team_content">
			<div class="div1_inner_team_content_subs">
				<h3>#Rank <?php echo $rank;?></h3>
			</div>
			<div class="div1_inner_team_content_subs">
				<table class="tg">
					  <tr>
					    <th class="tg-yw4l">Points</th>
					    <th class="tg-yw4l"><?php echo $score_score; ?></th>
					  </tr>
				</table>
			</div>
			<div class="div1_inner_team_content_subs">
				<table class="tg">
					  <tr>
					    <th class="tg-yw4l">Penalty</th>
					    <th class="tg-yw4l"><?php echo $score_penalty; ?></th>
					  </tr>
				</table>
			</div>												
		</div>
	</div>
	

		<?php
			}
		}

}else{
	echo "<p>Scoreboard Session Error => Try Logging In Again</p>";
}
?>