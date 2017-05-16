<?php
require 'class/Validator.php';
if(!Validator::ScoreBDPermission()){
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
		<style>
			#middle, #content{
				width:500px;
				height:auto;
				background:#111;
				padding:0px;
				margin:0px auto;
				
			}
			
			#content{
				margin-top:30px;
			}
			
			#middle{
				border:solid 1px #ABD17D;
				border-radius:1em;
			}
			
			h1{
				color:#ABD17D;
				text-align:center;
				padding:10px;
			}
			
			.my_team{
				padding:20px;	
				background:#ABD17D;		
			}
			.other_team{
				color:#ABD17D;
				padding:20px;
			}
			a{
				padding:10px 20px 10px 20px;
				background:#111;
				border:1px solid #ABD17D;
				border-radius: 0.5em;
				color:#ABD17D;
				text-decoration:none;
			}
			
			a:hover, tr:hover{
				background:#ABD17D;
				color:#000000;
			}
			.sc_equal{
				width:100px;
				text-align:center;
			}
			.sc_name{
				width:200px;
				padding-left:10px;
			}
			td{
				border:0px;
				margin:0px;
				padding:0px;
			}
			
			#main > #right_panel{
				margin-left:70%;
				position:absolute;
			}
		</style>
		<script>
			setInterval(function () {
				checkS();
			}, 30000);	
			
			var checkS = function(){
				$("#content").load("template/publicscoreboard.php");
				$.notify("Score Updated",{position:"bottom center", className:"success"});
			}
		</script>
	</head>
<body id="main" style="background:url('images/bgadmin.png');">
		<!-- Right Panel-->
	<div class="floating_panel right_panel" id="right_panel">
		<?php include 'template/announce.php';?>
	</div>
	<a href="index.php">Back</a>
	<div id="middle">
		<h1>Scoreboard</h1>
	</div>
	<div id="content">
		<?php include 'template/publicscoreboard.php'; ?>
	</div>
<script src="noti/notify.js"></script>
<script src="noti/notify.min.js"></script>
</body>
</html>