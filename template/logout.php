<?php
session_start();
session_destroy();
unset($_COOKIE['TEAMCOOK']);
setcookie("TEAMCOOK","",time()-3600,"/");
header('location:../index.php');

?>