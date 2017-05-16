<?php
session_start();
if($_SESSION['TYPE'] == "N"){
	session_destroy();
	header('location:../survey.php');	
}else if(isset($_SESSION['TYPE']) == "A"){
	session_destroy();
	header('location:../index.php');	
}

?>