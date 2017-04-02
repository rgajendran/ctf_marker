<h1>Timer</h1>
<h1 id="timer"></h1>
<?php 
	include 'connection.php';
	$tRs = mysqli_query($connection, "SELECT value FROM options WHERE name='END_TIME'");
	while($tRs_row = mysqli_fetch_assoc($tRs)){
		$_SESSION['ENDTIME'] = $tRs_row['value'];
	
	}
?>
<div class="status">
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