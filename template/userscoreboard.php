<?php
include 'connection.php';
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
	<div class="my_score my_team">
		<div class="team_score">
			<span class="team_logo"><img src="images/flag.svg"/></span>
			<span>Your team</span>
			<span>#<?php echo $rank;?></span>
			<span><?php echo $score_score; ?></span>
		</div>
	</div>
	

		<?php
			}
		}

}else{
	echo "<p>Scoreboard Session Error => Try Logging In Again</p>";
}
?>