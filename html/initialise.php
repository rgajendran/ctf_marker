<!DOCTYPE html>
<html>
	<head>
		<title>Error</title>
		<link href="https://fonts.googleapis.com/css?family=Iceland|Orbitron" rel="stylesheet"> 
		<style>
			body{
				font-family: 'Iceland', cursive;
			}
			#error_div{
				width:50%;
				height:50%;
				margin:10% auto;
				background:#1a260d;
				border:solid 1px #ABD17D;
				border-radius:1em;
			}
			h1, h3{
				text-align:center;
				color:#ABD17D;
			}
			button{
				width:15%;
				height:10%;
				padding:1%;
				margin-bottom:5%;
				background:inherit;
				border:solid 1px #ABD17D;
				border-radius: 1em;
				color:#ABD17D;
				font-family: 'Iceland', cursive;
				font-size:large;
				cursor:pointer;
			}
			
			button:hover{
				background:#ABD17D;
				color:#000000;
			}
			button:focus {outline:0;}
		</style>
	</head>
	
	<body style="background:url('../images/bg.png');">
		<div id="error_div">
			<h1>Invalid Request</h1>
			<h3>Contact Administator</h3>
			<form method="post" action="initialise.php" align="center">
				<button name="submit">Reload</button>
				<button name="logout">Logout</button>
			</form>
			<?php
			if(isset($_POST['submit'])){
				header('location:../main.php');
			}else if(isset($_POST['logout'])){
				include '../template/logout.php';
			}
			?>
		</div>
	</body>
</html>