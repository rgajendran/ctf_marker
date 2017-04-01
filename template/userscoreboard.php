<?php
include 'connection.php';
if(!isset($_SESSION)){
	session_start();
}
if(isset($_SESSION['TEAM'])){
	$score_sql = "SELECT * FROM scoreboard ORDER BY SCORE DESC";
	$score_result = mysqli_query($connection, $score_sql);
	$rank = 0;
	while($score_row = mysqli_fetch_assoc($score_result))
	{
		$score_team = $score_row['TEAM'];
		$score_score = $score_row['SCORE'];
		$score_penalty = $score_row['PENALTY'];
		$score_team_session = $_SESSION['TEAM'];
		$rank+=1;
		
		if($score_team_session == $score_team){
			
	?>
	<div class="div1_inner_team">
		<div class="div1_inner_team_logo">
			<img src="images/blue_flag.svg"/>
		</div>
		<div class="div1_inner_team_content">
			<div class="div1_inner_team_content_subs">
				<h3>#Rank <?php echo $rank;?> ( <?php echo "My Team"; ?> )</h3>
			</div>
			<div class="div1_inner_team_content_subs">
				<table class="tg">
					  <tr>
					    <th class="tg-yw4l">Points</th>
					    <th class="tg-yw4l"><?php echo $score_score; ?></th>
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