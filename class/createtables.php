<?php
require 'Constants.php';
class Tables{
	
	public function getCreateTablefor($value){
		switch($value){
			case Constants::LOCKPICK:
				$table = "CREATE TABLE ".Constants::LOCKPICK." (
						  `ID` int(2) NOT NULL AUTO_INCREMENT PRIMARY KEY,
						  `NAME` varchar(50) NOT NULL,
						  `FLAG` varchar(150) NOT NULL
						) ENGINE=InnoDB DEFAULT CHARSET=latin1;";					
				return $table;
				break;
		} 
	}
	
	public function createTable($table){
		include './template/connection.php';
		$result = mysqli_query($connection, $this->getCreateTablefor($table));
		if($result){
			return $this->returnSuccess("Success");
		}else{
			return $this->returnFailure(mysqli_error($connection));
		}
	}
	
	public function dropTable($table){
		include './template/connection.php';
		$result = mysqli_query($connection, "DROP TABLE IF EXISTS $table");
		if($result){
			return $this->returnSuccess("Success");
		}else{
			return $this->returnFailure(mysqli_error($connection));
		}		
	}
	
	public function returnSuccess($success){
		return "<h1 style='color:green;'>$success</h1>";
	}

	public function returnFailure($fail){
		return "<h1 style='color:red;'>$fail</h1>";
	}
}

?>