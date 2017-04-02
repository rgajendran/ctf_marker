<?php 
session_start();
include 'template/connection.php';
if(!isset($_SESSION['USERNAME']) || !isset($_SESSION['TEAM']) || !isset($_COOKIE['TEAMCOOK'])){
	header('location:index.php');
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
	<script>
		var user = '<?php echo $_SESSION['USERNAME'];?>';
		var tm1 = '<?php echo $_SESSION['TEAM'];?>';
		window.chatscroll();
	</script>
	<script src="js/dialog.js"></script>
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
		.hintok{
			color:green;
		}
		
		.hintclose{
			color:red;
		}

	</style>
</head>
<body id="main" style="background:url('images/bgadmin.png');">

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
	<div class="scores side_item">
		<div class="side_heading">
			<h1>Score Board</h1>
		</div>
		<?php include 'template/userscoreboard.php'; ?>
		<?php include 'template/teamscoreboard.php'; ?>
	</div>
	<div class="logs side_item">
		<div class="side_heading">
			<h1>Team Activity</h1>
		</div>
		<div class="team_logs">
			<?php include 'template/viewlog.php'; ?>
		</div>
	</div>
	<div class="chat side_item">
		<div class="side_heading">
			<h1>Team Chat</h1>
		</div>
		<div class="chat_history">
			<?php include 'template/viewchat.php'; ?>
		</div>
		<div class="chat_input">
			<input id="div3_chat_input" type="text" placeholder="Enter Message and Press Enter" />
		</div>
	</div>
	<?php
	}
	?>
</div>


<div id="left_panel_background">

</div>


		<div id="wrapper">
		
		<!-- Left Menu--->
		<div id="left_panel">
			<div id="left_panel_div_heading">
				<h1 id="fg_marker">Submit Flags</h1>
			</div>
			<div id="left_panel_div_input">
				<div id="left_panel_div_input_inner">
					<input type="text" id="flag-check" placeholder="Enter Flag and Press Enter" />
				</div>
				<script src="js/loginpopup.js"></script>
			</div>
			<div id="left_panel_div_status">
				<p style="margin-left: 10px;" id="flag-status-p">&ensp;</p>
			</div>
		</div>
		
		
		
		<!-- Right Menu---->
		<div id="right_panel">
			<?php include 'template/announce.php';?>
		</div>
		<div id="right_panel_background">
		</div>

		<div class="dropdown">
			<button class="dropbtn">View Teams</button>
			<div class="dropdown-content">
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
					echo "<a href='main.php?team=$sess_team'>$team</a>";
				}else{
					echo "<a href='main.php?team=$teamno'>$team</a>";
				}
			}else{
				
			}		
		}
	?>
			</div>
		</div>

		
		<?php
		include 'template/connection.php';
		if(isset($_GET['team'])){
			$getTeam= preg_replace('[^0-9]', '', urldecode(stripslashes(htmlspecialchars(htmlentities(trim($_GET['team']))))));
			$initTeamResult = mysqli_query($connection, "SELECT DISTINCT TEAM FROM secgenflag WHERE TEAM='".$getTeam."'");
			if(mysqli_num_rows($initTeamResult) != 0){
				if(mysqli_num_rows($initTeamResult) == 1){
					$initTeam = $getTeam;
				}else{
					header('location:main.php?team='.$_SESSION['TEAM']);
				}
			}else{
				header('location:html/initialise.php');	
			}	
					
		}else{
			header('location:main.php?team='.$_SESSION['TEAM']);
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
						$sChooseMapCountSql = "SELECT FLAG_POINTS FROM secgenflag WHERE VM='$vm' AND TEAM='$initTeam'";
						$sChooseMapCountResult = mysqli_query($connection, $sChooseMapCountSql);
						$sChooseMapCount = mysqli_num_rows($sChooseMapCountResult);
						if($sChooseMapCount < 10){
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
									$secgenQuery = mysqli_query($connection, "SELECT STATUS FROM secgenflag WHERE C_ID='$sC_ID' AND TEAM='$initTeam' AND VM='$vm'");
									while($secgenStatusRow = mysqli_fetch_assoc($secgenQuery)){
										$secgenStatus = $secgenStatusRow['STATUS'];		
										$session_team = $_SESSION['TEAM'];								
										if($secgenStatus == 0){
											if($session_team == $initTeam){
												echo "<path id='$sC_ID' title='$sC_COUNTRY' d='$sC_D' onclick='Alert.menu(\"$sC_ID\",\"$vm\",\"$session_team\");'/>";
											}else{
												echo "<path id='$sC_ID' title='$sC_COUNTRY' d='$sC_D'/>";
											}
											
										}else{
											echo "<path fill='#abd17d' id='$sC_ID' title='$sC_COUNTRY' d='$sC_D'/>";										
										}	
									}	
								}
								
								?>
							</g>
						 </svg>
								<?php	
								}	
								mysqli_close($connection);	 																
																
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
<!-- Center Menu
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
</div>---->



<div id="noooo"></div>

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
		<div id="moBody">
			
		</div>
	   <div id="dialog_flag_button">
	   		<button type="fsubmit" id="fsubmit">Get Hint</button>
	   </div></br>
	   <div id="moBodyLocked">
	   	
	   </div>
    </div>
    <div class="modal-footer">
      <h3 id="flag_hint">--</h3>
    </div>
  </div>

</div>
<script src="js/dialog.js"></script>
<script>
	function alert(){
	var modal = document.getElementById('myModal');
	
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	
	// When the user clicks the button, open the modal 
	this.menu = function(cid,vm,teams) {
	    modal.style.display = "block";
	    document.getElementById('dialog-title').innerHTML = vm;
	    document.getElementById('dialog-id').innerHTML = cid;
	    //-------------------------------------------------------------------		
		$.ajax({
			method: "POST",
			url: "template/viewhint.php",
			data: {cids: cid,team:teams,vms:vm},
			success: function(status){
				$('#moBody').empty();
				$('#moBodyLocked').empty();
				var OCSplit = status.split("#~#");
				for(var i=0; i<OCSplit.length;i++){
					var split = OCSplit[i].split("~#~");
					var coun=0;
					for(var e=0; e<split.length;e++){
						if(i == OCSplit.length-1){						
							if(e == 0){
								var str = split[0];
								if(str == ""){
									document.getElementById("fsubmit").innerHTML = "No Further Hints";
								}else{
									var res = str.replace("HINT LOCKED","");
									document.getElementById("fsubmit").innerHTML = "Unlock Hint "+res;
								}
							}	
							var addh3 = document.createElement("h3");
							var text = document.createTextNode(split[e]);
							addh3.appendChild(text);
							addh3.setAttribute("class","hintclose");
						
							document.getElementById("moBodyLocked").appendChild(addh3);	
						}else{
							coun++;
							var addh3 = document.createElement("h3");
							if(split[e] == ""){
								var text = document.createTextNode(split[e]);	
							}else{
								var text = document.createTextNode(cn+") "+split[e]);	
							}
							addh3.appendChild(text);
							addh3.setAttribute("class","hintok");
							document.getElementById("moBody").appendChild(addh3);	
						}			
							
					}
				}				
			}	
		});
		
	};
	
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	    modal.style.display = "none";
    	var text = document.getElementById('flag_hint').innerText;
        //refresh();
	    document.getElementById('flag_hint').innerHTML = " ";
	    //$('#moBody').empty();
	};
	
	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	        var text = document.getElementById('flag_hint').innerText;
	       // refresh();
	        document.getElementById('flag_hint').innerHTML = " ";
	        //$('#moBody').empty();
	     
	    }
	};
}

var Alert = new alert();
</script>
<script src="js/main.js"></script>
<script src="noti/notify.js"></script>
<script src="noti/notify.min.js"></script>
</body>
</html>	