<?php 
session_start();
if(!isset($_SESSION['USERNAME']) && !isset($_SESSION['TEAM'])){
	header('location:index.php');
	session_destroy();
}else{
	if(!isset($_GET['team']) || empty($_GET['team'])){	
		if(!isset($_SESSION['USERNAME'])){
			header('location:index.php');
		}else{
			$no = $_SESSION['TEAM'];
			header('location:main.php?team='.$no);
		}	
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Iceland|Orbitron" rel="stylesheet"> 	
		<link href="css/secgen.css" rel="stylesheet" type="text/css">
		<link href="css/map.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="css/login.css" type="text/css"/>
		<link rel="stylesheet" href="css/score.css" type="text/css"/>
	 	<script src="noti/notify.js"></script>
		<script src="noti/notify.min.js"></script>
</head>
	<script>
		var user = '<?php echo $_SESSION['USERNAME'];?>';
		var tm1 = '<?php echo $_SESSION['TEAM'];?>';
		window.chatscroll();
	</script>
	<script src="js/dialog.js"></script>
	<script src="js/main.js"></script>
	<script src="js/divcheck.js"></script>
	<script src="js/jquery_form.js"></script>
	<style>
		.modal-content{
			width:30%;
			height:auto;
		}
				
		::-webkit-scrollbar {
		  width: 6px;
		  height: 6px;
		}
		::-webkit-scrollbar-button {
		  width: 0px;
		  height: 0px;
		}
		::-webkit-scrollbar-thumb {
		  background: #ceb342;
		  border: 0px none #ffffff;
		  border-radius: 50px;
		}
		::-webkit-scrollbar-thumb:hover {
		  background: #faf434;
		}
		::-webkit-scrollbar-thumb:active {
		  background: #000000;
		}
		::-webkit-scrollbar-track {
		  background: #abd17d;
		  border: 0px none #ffffff;
		  border-radius: 90px;
		}
		::-webkit-scrollbar-track:hover {
		  background: #41a428;
		}
		::-webkit-scrollbar-track:active {
		  background: #ffff00;
		}
		::-webkit-scrollbar-corner {
		  background: transparent;
		}

	</style>
<body id="main" style="background:url('images/bgadmin.png');">
		<div id="wrapper">
		<?php
		include 'template/connection.php';
		if(isset($_GET['team'])){
			$initTeamResult = mysqli_query($connection, "SELECT DISTINCT TEAM FROM secgenflag WHERE TEAM='".$_GET['team']."'");
			if(mysqli_num_rows($initTeamResult) == 1){
				$initTeam = $_GET['team'];
			}else{
				header('location:main.php?team='.$_SESSION['TEAM']);
			}
		}else{
			$initTeam = $_GET['team'];
		}
		$ssql = "SELECT DISTINCT VM, IP FROM secgenflag WHERE TEAM='$initTeam'";
		$sresult = mysqli_query($connection, $ssql);
		$ii = 0;
		while($srow = mysqli_fetch_assoc($sresult)){
			$vm = $srow['VM'];
			$ip = $srow['IP'];	
			$ii+=1;
		?>
		<div class="grouper">
			<div class="grouper_heading">
				<p class="vm"><?php echo $vm; ?></p>
				<p class="ip"><?php echo $ip; ?></p>
			</div>
			<div class="grouper_map" id="<?php echo "grouperId".$ii; ?>">
				<?php
					include 'template/connection.php';
					$sChooseMapCountSql = "SELECT * FROM secgenflag WHERE VM='$vm'";
					$sChooseMapCountResult = mysqli_query($connection, $sChooseMapCountSql);
					$sChooseMapCount = mysqli_num_rows($sChooseMapCountResult);
					if($sChooseMapCount > 3 && $sChooseMapCount < 13){
						$sSelectMapDistinct = "SELECT DISTINCT W, H FROM secgen WHERE C_NO='$sChooseMapCount'";
						$sSelectMapDistinctResult = mysqli_query($connection, $sSelectMapDistinct);
						while($sSelectMRow = mysqli_fetch_assoc($sSelectMapDistinctResult)){
							$w = $sSelectMRow['W'];
							$h = $sSelectMRow['H'];
							?>
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.2" viewBox="0 0 <?php echo $w." ".$h?>">
						<g>
							<?php
							$sSelectMapSql = "SELECT * FROM secgen WHERE C_NO='$sChooseMapCount'";
							$sSelectMapResult = mysqli_query($connection, $sSelectMapSql);
							while($sChooseRow = mysqli_fetch_assoc($sSelectMapResult)){
								$sC_ID = $sChooseRow['C_ID'];
								$sC_COUNTRY= $sChooseRow['C_COUNTRY'];
								$sC_TITLE = $sChooseRow['C_TITLE'];
								$sC_D = $sChooseRow['C_D'];
								$sSelectStatus = "SELECT * FROM secgenflag WHERE C_ID='$sC_ID'";
								$sSelectStatusResult = mysqli_query($connection, $sSelectStatus);
								while($sSelectStatusRow = mysqli_fetch_assoc($sSelectStatusResult)){
									$sSelectSCode = $sSelectStatusRow['STATUS'];
									$hint1 = $sSelectStatusRow['HINT_1'];
									$hint1stat = $sSelectStatusRow['HINT_1_STATUS'];
									$hint2 = $sSelectStatusRow['HINT_2'];
									$hint2stat = $sSelectStatusRow['HINT_2_STATUS'];
									$hint3 = $sSelectStatusRow['HINT_3'];
									$hint3stat = $sSelectStatusRow['HINT_3_STATUS'];
									if($sSelectSCode == 1){
										echo "<path fill='#abd17d' id='$sC_ID' title='$sC_COUNTRY' d='$sC_D'/>";
									}else {
										if($hint1stat == 0){
											$hint1_msg = "Hint 1 (Not Disclosed)";
										}else{
											$hint1_msg = "Hint 1 (Disclosed) : $hint1";
										}
										if($hint2stat == 0){
											$hint2_msg = "Hint 2 (Not Disclosed)";
										}else{
											$hint2_msg = "Hint 2 (Disclosed) : $hint2";
										}
										if($hint3stat == 0){
											$hint3_msg = "Hint 3 (Not Disclosed)";
										}else{
											$hint3_msg = "Hint 3 (Disclosed) : $hint3";
										}
										echo "<path id='$sC_ID' title='$sC_COUNTRY' d='$sC_D' onclick='Alert.menu(\"$sC_ID\",\"$sC_TITLE\",\"$hint1_msg\",\"$hint2_msg\",\"$hint3_msg\");'/>";
									}
								}
							}
							?>
						</g>
					 </svg>
							<?php																			
						}									
					}else{
						echo "<p class='map_init' id='tssst'>Map Not Initialised</p>";
					}

				?>	
			</div>
		</div>
		<?php
		}
		?>
	</div>
<!--Dialog Code -->
<!-- Left Menu -->
<div id="info_menu" onclick="openNav()">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
</div>
<div id="mySidenav" class="sidenav">
  	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  	<?php
  	if(isset($_SESSION['USERNAME']) && isset($_SESSION['TEAM']))
  	{
  	?>
    <a href="template/logout.php" id="main_logout">Logout</a>
	<div id="div1">
		<div id="div1_inner">
			<div id="div1_inner_heading">
				<h1>Score Board</h1>
			</div>
			<div class="div1_inner_body">				
				<span id="div1_inner_body_1"><?php include 'template/userscoreboard.php'; ?></span>
				<span id="div1_inner_body_2"><?php include 'template/teamscoreboard.php'; ?></span>				
			</div>
		</div>	  
	</div>
	<div id="div2">
	  <div id="div2_inner">
			<div id="div2_inner_border">
				<?php include 'template/viewlog.php'; ?>
			</div>
	  </div>	
	</div>
	<div id="div3">
	  <div id="div3_inner">
			<div id="div3_inner_chat_history">
				<?php include 'template/viewchat.php'; ?>
			</div>
			<div id="div3_inner_chat_input">
				<input id="div3_chat_input" type="text" placeholder="Enter Message and Press Enter" />
			</div>
	  </div>
	</div>
	<?php
	}
	?>
</div>
<!-- Left Menu--->
<div id="left_panel">
	<div id="left_panel_div_heading">
		<h1 id="fg_marker">Marker</h1>
	</div>
	<div id="left_panel_div_input">
		<div id="left_panel_div_input_inner">
			<input type="text" id="flag-check" placeholder="Enter Flag and Press Enter" />
		</div>
		<script src="js/loginpopup.js"></script>
	</div>
	<div id="left_panel_div_status">
		<p style="margin-left: 10px;" id="flag-status-p">Status</p>
	</div>
</div>

<div id="left_panel_background">

</div>
<!-- Center Menu---->
<div id="center_panel">
	<div id="center_panel_div">
		<?php
		include 'template/connection.php';
		$center_panel_sql = "SELECT * FROM team";
		$center_panel_result = mysqli_query($connection, $center_panel_sql);
		while($center_row = mysqli_fetch_assoc($center_panel_result)){
			$team = $center_row['TEAMNAME'];
			$teamno = $center_row['TEAM'];
			if(isset($_SESSION['TEAM'])){
				$sess_team = $_SESSION['TEAM'];
				if($teamno == $sess_team){
					echo "<a href='main.php?team=$teamno' class='center_panel_count' style='background-color:#ABD17D;color:black;'>$team</a>";
				}else{
					echo "<a href='main.php?team=$teamno' class='center_panel_count'>$team</a>";
				}
			}else{
				//dont show team list
			}		
		}
		
		?>
	</div>
</div>
<div id="noooo"></div>
<!-- Right Menu---->
<div id="right_panel">
<?php include 'template/announce.php';?>
</div>
<div id="right_panel_background">
</div>
<div class="notti"></div>
<?php 
$tRs = mysqli_query($connection, "SELECT value FROM options WHERE name='END_TIME'");
while($tRs_row = mysqli_fetch_assoc($tRs)){
	$_SESSION['ENDTIME'] = $tRs_row['value'];

}
?>
<script>var endtime = '<?php echo $_SESSION['ENDTIME'];?>';	</script>
<script src="js/timer.js"></script>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h3 id="dialog-id" class="modal_info"></h3>
      <h3 id="dialog-title" class="modal_info"></h3>
    </div>
    <div class="modal-body">
	   <h3 id="hint1">Hint 1 (Not Disclosed)</h3>
	   <h3 id="hint2">Hint 2 (Not Disclosed)</h3>
	   <h3 id="hint3">Hint 3 (Not Disclosed)</h3>
	   <div id="dialog_flag_button">
	   		<button type="fsubmit" id="fsubmit">Get Hint</button>
	   </div>
    </div>
    <div class="modal-footer">
      <h3 id="flag_hint">Status</h3>
    </div>
  </div>

</div>
<script src="js/dialog.js"></script>
</body>
</html>	