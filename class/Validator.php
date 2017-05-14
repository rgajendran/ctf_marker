<?php
class Validator{
	
	public static function filterString($input){
		return stripslashes(htmlspecialchars(htmlentities(trim(filter_var($input), FILTER_SANITIZE_STRING))));
	}
	
	public static function BooleanEmptyCheck($input){
		$string = preg_replace('/\s+/', '', $input);
		if(!empty($string)){
			if(strlen($string) > 2){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	public static function getCurrentTime(){
		$date = new DateTime('now', new DateTimeZone('Europe/London'));
		return $date->format('Y-m-d H:i:s');
	}
	
	public static function printSuccess($string){
		return "<h5 style='background:#c3e29c;color:black;text-align:center;width:100%;'>$string</h5>";
	}	
	
	
	public static function printFailure($string){
		return "<h5 style='background:#f7b9b9;color:black;text-align:center;width:100%;'>$string</h5>";
	}
	
	public static function AdminEditPermission(){
		include './template/connection.php';
		$query = mysqli_query($connection, "SELECT value FROM options WHERE name='ADMINEDIT'");
		if($query){
			while($row = mysqli_fetch_assoc($query)){
				if($row['value'] == "ALLOW"){
					return true;
				}else{
					return false;
				}
			}
		}else{
			return false;
		}		
	}
	
	public static function DisabledCSS(){
		return "style='background:#f7b9b9;color:black;'";
	}
	
}

class Creditional{
	
	public function __construct(){
		session_start();
	}
	
	public function getUsername(){
		return $_SESSION['USERNAME'];
	}
	
	public function getTeam(){
		return $_SESSION['TEAM'];
	}
	
	
}

class DB{
	
	public static function lockpickAdd($inputname, $inputflag){
		include './template/connection.php';
		$stmt = $connection->prepare("INSERT INTO lockpick (NAME, FLAG) VALUES (?, ?)");
		$stmt->bind_param("ss", Validator::filterString($inputname), $flag);
		$name = $inputname;
		$flag = $inputflag;
		$stmt->execute();
		return "Key Insert Successfull";
		$stmt->close();
		$conn->close();
	}
	
	public static function sendFlagsToTeamActivity($teamNumber, $flagName, $flagValue){
		try{
			include './template/connection.php';
			$stmt = $connection->prepare("INSERT INTO logger (DATE, TEAM, LOG) VALUES (?, ?, ?)");
			$flags = "[LOCKPICKING] - $flagName Unlocked. Your flag is = $flagValue";
			$stmt->bind_param("sss",$date, $team, $flag);
			$date = Validator::getCurrentTime();
			$team = $teamNumber;
			$flag = $flags;
			$stmt->execute();
			
			$updater = mysqli_query($connection, "UPDATE updater SET ACTIVITY=1  WHERE TEAM=$teamNumber");
			if($updater){
				return Validator::printSuccess("Flag Sent Successfull");
			}else{
				return Validator::printFailure("Update Failed");
			}
			$stmt->close();
			$conn->close();			
		}catch(Exception $e){
			return $e->getMessage();
		}
	}
	
	public static function checkOptionTablesExists(){
		include './template/connection.php';
		if(mysqli_num_rows(mysqli_query($connection, "SHOW TABLES LIKE 'options'"))==0){
			return false;
		}else{
			return true;
		}
	}
}
?>