<?php

//if(isset($_POST['submit'])){
	
	if(isset($_POST['uname']) && isset($_POST['psw']))
	{
		session_start();
		$username = stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['uname']),FILTER_SANITIZE_STRING))));
		$password = stripslashes(htmlspecialchars(htmlentities(trim(filter_var(($_POST['psw']),FILTER_SANITIZE_STRING)))));
		
		$hash = md5($password."CTF");
		
		include 'connection.php';		

		$query = "SELECT * FROM users WHERE USERNAME='$username' AND PASSWORD='$hash'";
		$result = mysqli_query($connection, $query);
		$num = mysqli_num_rows($result);
		if($num === 1)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$user = $row['USERNAME'];
				$auth = $row['TEAM'];
				$level = $row['TYPE'];
				
				$_SESSION['USERNAME'] = $user;
				$_SESSION['TEAM'] = $auth;
				$_SESSION['TYPE'] = $level; 
				if($level == "A"){
					echo "<h3 style='color:green;'>Admin Login</h3>";
				}else{
					setcookie("TEAMCOOK",$auth,time()+(86400*3),"/");
					echo "<h3 style='color:green;'>Login Success</h3>";
				}
			}	
		}else{
			echo "<h3 style='color:orange;'>Login Fail</h3>";
		}
		
	}
//}						
?>