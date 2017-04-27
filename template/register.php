<?php
if(isset($_POST['usr']) && isset($_POST['ps1']) && isset($_POST['ps2']) && isset($_POST['tkn'])){
	
	$usr = urldecode(stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['usr'],FILTER_SANITIZE_STRING))))));
	$ps1 = urldecode(stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['ps1'],FILTER_SANITIZE_STRING))))));
	$ps2 = urldecode(stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['ps2'],FILTER_SANITIZE_STRING))))));
	$tkn = preg_replace('/[^A-Za-z0-9\-]/', '', urldecode(stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['tkn'],FILTER_SANITIZE_STRING)))))));
	
	//$string));
	
	include 'connection.php';
	$error = "ERROR";
	$success = "SUCCESS";

	if(!empty($usr) && !empty($ps1) && !empty($ps2) && !empty($tkn)){
		if(strlen($usr) >= 5 && strlen($usr) <= 10){
			if(ctype_alpha($usr)){
				if($ps1 == $ps2){
					if(strlen($ps2) >= 4 && strlen($ps2) <=20){
						if(mysqli_num_rows(mysqli_query($connection, "SELECT USERNAME FROM users WHERE USERNAME='$usr'")) == 0){
							if(strlen($tkn) == 8){
								$h = md5($tkn);
								if((mysqli_num_rows(mysqli_query($connection, "SELECT TOKEN FROM users WHERE TOKEN_HASH='$h'")) == 1)){
									if(mysqli_num_rows(mysqli_query($connection, "SELECT TOKEN_ACT FROM users WHERE TOKEN_HASH='$h' AND TOKEN_ACT='0'"))){
										$pass = md5($ps2."CTF");
										$sql = mysqli_query($connection, "UPDATE users SET USERNAME='$usr', PASSWORD='$pass', TOKEN_ACT='1' WHERE TOKEN_HASH='$h'");
										$getTeam = mysqli_query($connection, "SELECT TEAM FROM users WHERE TOKEN_HASH='$h' AND USERNAME='$usr'");
										if($sql){
											if(mysqli_num_rows($getTeam) == 1){
												while($row = mysqli_fetch_assoc($getTeam)){
													$team = $row['TEAM'];
													$updater = mysqli_query($connection, "INSERT INTO updater (TEAM, USERNAME) VALUES ('$team','$usr')");
													if($updater){
														$success = "Successfully Registered";
													}else{
														$error = "Registration Error, Contact Admin [1003]";
													}
												}											
											}else{
												$error = "Registration Error, Contact Admin [1002]";
											}
										}else{
											$error = "Registration Error, Contact Admin [1001]";
										}
									}else{
										$error = "This token has been registered";
									}			
								}else{
									$error = "Invalid Token, Contact Administrator";
								}
							}else{
								$error = "Invalid Token, Contact Administrator";
							}
	
						}else{
							$error = "Username already exists, Try someother name";
						}
	
					}else{
						$error = "Password should be between 4-20 characters";
					}
				}else{
					$error = "Your password doesn't match";
				}
			}else{
				$error = "Username should only include alphabets";	
			}	
		}else{
			$error = "Username should be between 5-10 characters";
		}
	}else{
		$error = "Please fill all the above fields";
	}
	
	if($error == "ERROR"){
		echo "<span style='color:green'>$success</span>";	
	}else if($success == "SUCCESS"){
		echo "<span style='color:orange'>$error</span>";
	}
}

?>