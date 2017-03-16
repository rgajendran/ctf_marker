<?php
if(!isset($_GET['option'])){
	header('location:admin.php?option=team');
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
		<link href="css/admin.css" type="text/css" rel="stylesheet" />
</head>
<body style="background:url('images/bgadmin.png');">
	
	<div id="wrapper">	
		<h1 id="head">Admin Portal</h1>
		<div id="menu">
			<h1>Options</h1>
			<a href="admin.php?option=team"><span>TEAM</span></a>
			<a href="admin.php?option=team-members"><span>TEAM MEMBERS</span></a>
			<a href="admin.php?option=token"><span>CREATE & VIEW TOKENS</span></a>
			<a href="admin.php?option=flags"><span>FLAGS</span></a>
			<a href="admin.php?option=options"><span>OPTIONS</span></a>
			<a href="admin.php?option=announce"><span>ANNOUNCE</span></a>
			<a href="admin.php?option=import-secgen"><span>IMPORT SECGEN</span></a>
			<a href="template/logout.php"><span>LOGOUT</span></a>
		</div>
		<div id="content">
			<!-- <h1>Manage Flags and Options</h1> -->
			<?php
			
			
			if(isset($_GET['option'])){
				$command = $_GET['option'];
				include 'template/connection.php';
				switch($command){
					case "announce":
							?>
							<h1>Announce</h1>
							<form method="post" action="admin.php?option=announce">
								<textarea rows="10" placeholder="Enter your message for announcement" name="team_announce"></textarea>
								<input id="ann_submit" type="submit" value="Send" name="a_send"/>
							</form>
							<?php
							if(isset($_POST['a_send'])){
								if(!empty($_POST['team_announce'])){
									$ann_post = $_POST['team_announce'];
									$announce_insert = mysqli_query($connection, "UPDATE options SET value='$ann_post' WHERE name='ANNOUNCE'");
									if($announce_insert){
										$ann_updater = mysqli_query($connection, "UPDATE updater SET ANNOUNCE='1'");
										if($ann_updater){
											echo "<p style='color:green;margin-left:10%;'>Announcement Successful</p>";
										}else{
											echo "<p style='color:maroon;margin-left:10%;'>Failed to set updater</p>";
										}
									}else{
										echo "<p style='color:maroon;margin-left:10%;'>Failed to Announce</p>";
									}
		
								}else{
									echo "<p style='color:maroon;margin-left:10%;'>Textarea is empty</p>";
								}
							}
						break;
						
					case "team":
							?>
							<h1>Team</h1>
							<table>
							  <tr class="table_heading">
							    <th>Team Code</th>
							    <th>Team Name</th> 
							    <th>Logo</th>
							  </tr>
							<?php
							$team_list = mysqli_query($connection, "SELECT * FROM team");
							while($team_list_row = mysqli_fetch_assoc($team_list)){
								?>
								  <tr>
								    <td><?php echo $team_list_row['TEAM'];?></td>
								    <td><?php echo $team_list_row['TEAMNAME'];?></td> 
								    <td><?php echo $team_list_row['LOGO'];?></td>
								  </tr>
								<?php
							}
							echo "</table>";?>
							<div id="token-div-add">
							<form method="post" action="admin.php?option=team">
								<table style="width:100%;">
									<tr>
										    <th>
										    	<h1>Create Team</h1>
											</th>
										    <th>
												<input type="text" name="team-create" placeholder="Team Name"/>
											</th> 
										    <th id="team-submit-btn">
										    	<input type="submit" name="team-create-submit" value="Create"/>
										    </th> 
									</tr>
								</table>
							</form>
							</div>
							<?php
							if(isset($_POST['team-create-submit'])){
								if(!empty($_POST['team-create'])){
									$team_create = $_POST['team-create'];
									$team_create_count = mysqli_num_rows(mysqli_query($connection, "SELECT TEAM FROM team")) + 1;
									$team_create_res = mysqli_query($connection, "INSERT INTO team (TEAM, TEAMNAME) VALUES ('$team_create_count','$team_create')");
									if($team_create_res){
											echo "<p style='color:green;margin-left:10%;'>Team Creation Successful</p>";

									}else{
										echo "<p style='color:maroon;margin-left:10%;'>Failed to create team</p>";
									}
		
								}else{
									echo "<p style='color:maroon;margin-left:10%;'>Team name is empty</p>";
								}
							}
						break;
						
					case "team-members":
							?>
							<h1>Team Members</h1>
							<div id="team1-div">
								<table>
									<tr class="table_heading">
									    <th>Team Code</th>
									    <th>Team Members</th> 
								    </tr>
								    <tr> 		    
								    <?php

										$team_members_res = mysqli_query($connection, "SELECT DISTINCT TEAM FROM users ORDER BY TEAM ASC");
										while($team_members_row = mysqli_fetch_assoc($team_members_res)){
											$team_mem_code = $team_members_row['TEAM'];
											$team_members_list = mysqli_query($connection, "SELECT USERNAME FROM users WHERE TEAM='$team_mem_code'");
											$count_members = mysqli_num_rows($team_members_list);	
											$team_name_getter = mysqli_query($connection, "SELECT TEAMNAME FROM team WHERE TEAM='$team_mem_code'");
											while($team_name_getter_row = mysqli_fetch_assoc($team_name_getter)){									
											echo "<td rowspan='$count_members'>".$team_name_getter_row['TEAMNAME']."</td>";
											}
											while($team_members_list_row = mysqli_fetch_assoc($team_members_list)){
												$username = $team_members_list_row['USERNAME'];
												if(empty($username)){
													echo "<td>Not Registered</td></tr>";
												}else{
													echo "<td>".$username."</td></tr>";
												}
												
											}
										}
									
								    ?>
										
								</table>
							</div>
							<?php
						break;
						
					case "token":
						?>
						<h1>Generate Token</h1>
						<div id="token-div-add">
							<form method="post" action="admin.php?option=token">
							<table style="width:100%;">
								<tr>
									    <th>
									    	<input type="hidden" value="token" name="option" />
											<select name="token_gen_team">
												<?php
												$token_team_list = mysqli_query($connection, "SELECT TEAM, TEAMNAME FROM team");
												while($token_team_list_row = mysqli_fetch_assoc($token_team_list)){
													$token_team = $token_team_list_row['TEAM'];
													$token_team_name = $token_team_list_row['TEAMNAME'];
													echo "<option value='$token_team'>$token_team_name</option>";
												}
												?>
											</select>
										</th>
									    <th>
											<input type="number" name="token_gen_num" placeholder="Number of Token" id="token-input-1" maxlength="2"/>
										</th> 
									    <th>
									    	<input type="submit" name="token_gen_submit" value="Generate" id="token-input-2"/>
									    </th> 
								</tr>
							</table>
							</form>
							<?php
							if(isset($_POST['token_gen_submit'])){
								if(isset($_POST['option']) && isset($_POST['token_gen_team']) && isset($_POST['token_gen_num'])){
									$token_counter = $_POST['token_gen_num'];
									$token_team = $_POST['token_gen_team'];
									if($token_counter > 0 && $token_counter < 10){
										for($int = 0; $int <$token_counter; $int++){
											$randomKey = strtoupper(md5(bin2hex(openssl_random_pseudo_bytes(16)).time()));
											$insertToken = mysqli_query($connection, "INSERT INTO users (TEAM, TYPE, TOKEN, TOKEN_ACT) VALUES ('$token_team','N','$randomKey','0')");
											if($insertToken){

											}else{
												echo "<p style='color:maroon;'>Failed to Insert</p>";
											}
										}
									}else{
										echo "<p style='color:maroon;'>Team should be between 1-10</p>";
									}
								}
							}							
							?>
						</div>
						<h1>Available & Registered Token</h1>
						<div id="token-div">
								<table>
									<tr class="table_heading">
									    <th>Team Code</th>
									    <th>Username</th> 
									    <th>Token</th> 
								    </tr>
								    <tr> 		    
								    <?php
								    $team_members_res = mysqli_query($connection, "SELECT DISTINCT TEAM FROM users ORDER BY TEAM ASC");
									while($team_members_row = mysqli_fetch_assoc($team_members_res)){
										$team_mem_code = $team_members_row['TEAM'];
										$team_members_list = mysqli_query($connection, "SELECT USERNAME,TOKEN,TOKEN_ACT FROM users WHERE TEAM='$team_mem_code'");
										$count_members = mysqli_num_rows($team_members_list);
										echo "<td rowspan='$count_members'>$team_mem_code</td>";
										while($team_members_list_row = mysqli_fetch_assoc($team_members_list)){
											$username = $team_members_list_row['USERNAME'];
											$token = $team_members_list_row['TOKEN'];
											$token_stat = $team_members_list_row['TOKEN_ACT'];
											
											if($token_stat == 1){
												echo "<td style='background:#5e842e;color:black;'>".$username."</td>";
												echo "<td style='background:#5e842e;color:black;'>".$token."</td></tr>";
											}else{
												echo "<td style='background:#ff9999;color:black;'>".$username."</td>";
												echo "<td style='background:#ff9999;color:black;'>".$token."</td></tr>";
											}
										}
									}
								    ?>
										
								</table>
							</div>
							<?php
						break; 
						
				case "options":
				?>
						<h1>Event Options</h1>
						<div id="token-div-add">
						<form method="post" action="admin.php?option=options">
							<table style="width:100%;">
								<tr>
									    <th>
									    	<h1>Homepage Date</h1>
										</th>
									    <th>
											<input type="datetime-local" name="homepage-date" />
										</th> 
									    <th>
									    	<input type="submit" name="homepage-submit" value="Update"/>
									    </th> 
								</tr>
							</table>
						</form>
						<form method="post" action="admin.php?option=options">
							<table style="width:100%;">
								<tr>
									    <th>
									    	<h1>CTF Game End Time</h1>
										</th>
									    <th>
											<input type="datetime-local" name="ctf-date" />
										</th> 
									    <th>
									    	<input type="submit" name="ctf-submit" value="Update"/>
									    </th> 
								</tr>
							</table>
						</form>
						</div>
								
				<?php
						if(isset($_POST['homepage-submit'])){
								if(!empty($_POST['homepage-date'])){
									$home_date = $_POST['homepage-date'];
									$home_date_result = mysqli_query($connection, "UPDATE options SET value='$home_date' WHERE name='HOME_TIME'");
									if($home_date_result){
											echo "<p style='color:green;margin-left:10%;'>Home Time Successful</p>";

									}else{
										echo "<p style='color:maroon;margin-left:10%;'>Failed to update hometime</p>";
									}
		
								}else{
									echo "<p style='color:maroon;margin-left:10%;'>Time is empty</p>";
								}
						}
						
						if(isset($_POST['ctf-submit'])){
								if(!empty($_POST['ctf-date'])){
									$ctf_date = $_POST['ctf-date'];
									$ctf_date_result = mysqli_query($connection, "UPDATE options SET value='$ctf_date' WHERE name='END_TIME'");
									if($ctf_date_result){
											echo "<p style='color:green;margin-left:10%;'>CTF Time Successful</p>";

									}else{
										echo "<p style='color:maroon;margin-left:10%;'>Failed to update CTF time</p>";
									}
		
								}else{
									echo "<p style='color:maroon;margin-left:10%;'>Time is empty</p>";
								}
						}
					break; 			
						
					default:
						header('location:admin.php?option=team');
						break;	
				}			
			}
			
			?>
		</div>
	</div>
</body>
</html>