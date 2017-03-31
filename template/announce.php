<div id="right_panel_div_heading">
	<h1>Timer</h1>
</div>
<div id="right_panel_div_timer">
	<h1 id="timer"></h1>
</div>
<?php 
	include 'connection.php';
	$tRs = mysqli_query($connection, "SELECT value FROM options WHERE name='END_TIME'");
	while($tRs_row = mysqli_fetch_assoc($tRs)){
		$_SESSION['ENDTIME'] = $tRs_row['value'];
	
	}
?>
<div id="right_panel_div_announce">
	<marquee><p><?php
	include 'connection.php';
	$ann_res = mysqli_query($connection,"SELECT value FROM options WHERE name='ANNOUNCE'");
	while($ann_row = mysqli_fetch_assoc($ann_res)){
	echo $ann_row['value'];
	}
	
	?></p></marquee>
	<script>var endtime = '<?php echo $_SESSION['ENDTIME'];?>';</script>
	<script src="js/timer.js"></script>
</div>