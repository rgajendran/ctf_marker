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
		include './template/connection.php';
		$stmt = $connection->prepare("INSERT INTO logger (DATE, TEAM, LOG) VALUES (?, ?, ?)");
		$flag = "[LOCKPICKING] - $flagName Unlocked. Your flag is = $flagValue";
		$stmt->bind_param("sss",$date, $team, $flag);
		$date = Validator::getCurrentTime();
		$team = $teamNumber;
		$flag = $flagName;
		$stmt->execute();
		return "Flag Sent Successfull";
		$stmt->close();
		$conn->close();
	}
}
?>