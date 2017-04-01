<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Iceland|Orbitron" rel="stylesheet">
		<link rel="stylesheet" href="css/login.css" type="text/css"/>
		<link rel="stylesheet" href="css/index.css" type="text/css"/>
		<link rel="stylesheet" href="css/map.css" type="text/css"/>
		<style>
			.indxContent{
				width:60%;
				height:60%;
				background:orange;
				float:left;
			}
		</style>
</head>
<script src="js/dialogindex.js"></script>
<body id="main" style="background:url('images/bg.png');">
	<div id="side_menu_index">
		<div id="mySidenav" class="sidenav">
		  	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<div id="div4">
			  <div id="div4_inner">
			  		<div id="div4_heading">
			  			<h3>Capture the Flag</h3>
			  		</div>
			  		<div id="div4_login_logo">
						<img class="logo" src="images/flag.svg"/>
			  		</div>
			  		<div id="div4_login_form">
			  			<input type="text" placeholder="Username" id="login_usr"/>
			  			<input type="password" placeholder="Password" id="login_psw"/>
			  			<button id="login_submit">Login</button>
			  			<h5 id="login_status"></h5>
			  		</div>
			  		<script src="js/loginpopup.js"></script>
			  </div>	
			</div>	
		</div>
		<div id="mySidenav1" class="sidenav">
		  	<a href="javascript:void(0)" class="closebtn" onclick="closeNav1()">&times;</a>
			<div id="div4">
			  <div class="container">
			  		<h1>Registration</h1><br>
			      <label><b>Username</b></label>
			      <input type="text" placeholder="Username" id="usr" required>
			
			      <label><b>Password</b></label>
			      <input type="password" placeholder="Enter Password" id="psw" required>
			
			      <label><b>Repeat Password</b></label>
			      <input type="password" placeholder="Repeat Password" id="psw-repeat" required>
			      
			      <label><b>Token</b></label>
			      <input type="text" placeholder="Registration Token" id="tkn" required>
			
					<h3 id="reg_status"></h3>
			      <div class="clearfix">     
			        <button id="signup" class="signupbtn">Sign Up</button>
			      </div>
	   		 </div>
	   		 <script src="js/register.js"></script>
			</div>	
		</div>
	</div>
	<!-- Main Content -->
	<div id="indxContent">
		<div class="index-heading-1">
			<h1>Flawed Fortress</h1>
		</div>
		<div class="index-heading-2">
			
		</div>
		<div class="index-heading-3" style="background:url('images/bgadmin.png');">
			<h1 id="ttimer">00:00:00</h1>
		</div>
		<div class="index-option">
			<div class="index-option-div">
				<div class="index-option-div-inner" onclick="openNav()">
					<span>Login</span>
				</div>
			</div>
			<div class="index-option-div">
				<div class="index-option-div-inner" id="index-option-div-inner-remove">
					
				</div>
			</div>
			<div class="index-option-div">
				<div class="index-option-div-inner" onclick="openNav1()"> <!-- document.getElementById('id01').style.display='block' -->
					<span>Registration</span>
				</div>
			</div>						
		</div>
	</div>
	<?php 
	include 'template/connection.php';
	$tRs = mysqli_query($connection, "SELECT value FROM options WHERE name='HOME_TIME'");
	if($tRs){
	while($tRs_row = mysqli_fetch_assoc($tRs)){
		?>
	<input type="hidden" id="sttimer" value="<?php echo $tRs_row['value'];?>"  />	
		<?php
	}
	}
	?>
	<script src="js/hometimer.js"></script>
</body>
</html>