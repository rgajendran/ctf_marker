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
<script src="js/dialog.js"></script>
<body id="main" style="background:url('images/bg.png');">
	<div id="side_menu_index">
		<div id="mySidenav" class="sidenav">
		  	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<div id="div4">
			  <div id="div4_inner">
			  		<div id="div4_heading">
			  			<h3>Catch the Flag</h3>
			  		</div>
			  		<div id="div4_login_logo">
						<img src="images/anon1.png"/>
			  		</div>
			  		<div id="div4_login_form">
			  			<input type="text" placeholder="Username" id="login_usr"/>
			  			<input type="password" placeholder="Password" id="login_psw"/>
			  			<button id="login_submit">Log In</button>
			  			<h5 id="login_status"></h5>
			  		</div>
			  		<script src="js/loginpopup.js"></script>
			  </div>	
			</div>	
		</div>
	</div>
	<!-- Main Content -->
	<div id="indxContent">
		<div class="index-heading-1">
			<h1>Catch the Flag</h1>
		</div>
		<div class="index-heading-2">
			<h1>Leeds Beckett University</h1>
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
				<div class="index-option-div-inner" onclick="document.getElementById('id01').style.display='block'">
					<span>Registration</span>
				</div>
			</div>
			<div class="index-option-div">
				<div class="index-option-div-inner">
					<span>FAQ</span>
				</div>
			</div>						
		</div>
	</div>
	<!--Registration Start -->
	<div id="id01" class="modal">
	  <form class="modal-content animate" action="/action_page.php">
	    <div class="container">
		      <label><b>Email</b></label>
		      <input type="text" placeholder="Enter Email" name="email" required>
		
		      <label><b>Password</b></label>
		      <input type="password" placeholder="Enter Password" name="psw" required>
		
		      <label><b>Repeat Password</b></label>
		      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
		      <input type="checkbox" checked="checked"> Remember me
		      <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
		
		      <div class="clearfix">
		        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
		        <button type="submit" class="signupbtn">Sign Up</button>
		      </div>
	    </div>
	  </form>
	</div>
	<!--Registration End -->
	<?php 
	include 'template/connection.php';
	$tRs = mysqli_query($connection, "SELECT value FROM options WHERE name='HOME_TIME'");
	while($tRs_row = mysqli_fetch_assoc($tRs)){
		?>
	<input type="hidden" id="sttimer" value="<?php echo $tRs_row['value'];?>"  />	
		<?php
	}
	?>
	<script src="js/hometimer.js"></script>
</body>
</html>