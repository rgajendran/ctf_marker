<?php

class Validator{
	
	public static function filterString($input){
		return stripslashes(htmlspecialchars(htmlentities(trim(filter_var($input), FILTER_SANITIZE_STRING))));
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

?>