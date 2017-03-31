<?php
if(isset($_POST['cids']) && isset($_POST['team']) && isset($_POST['vms'])){
		
		$cid = stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['cids'],FILTER_SANITIZE_STRING)))));
		$team = stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['team'],FILTER_SANITIZE_STRING)))));
		$vm = stripslashes(htmlspecialchars(htmlentities(trim(filter_var($_POST['vms'],FILTER_SANITIZE_STRING)))));
		
		include 'connection.php';		
		$sSelectStatus = "SELECT HINT_ID, HINT_STATUS, HINT_TYPE, HINT_TEXT FROM hint WHERE C_ID='$cid' AND TEAM='$team' AND SYSTEM_NAME='$vm'";
		$sSelectStatusResult = mysqli_query($connection, $sSelectStatus);
		$bigResult = mysqli_query($connection, "SELECT HINT_TYPE FROM hint WHERE C_ID='$cid' AND TEAM='$team' AND SYSTEM_NAME='$vm' AND HINT_TYPE='big_hint'");
		$norResult = mysqli_query($connection, "SELECT HINT_TYPE FROM hint WHERE C_ID='$cid' AND TEAM='$team' AND SYSTEM_NAME='$vm' AND HINT_TYPE='normal'");
		$hintOpen = Array();
		$HO = Array();
		$HC = Array();
		$hintClose = Array();
		$sSelectHintCount = mysqli_num_rows($sSelectStatusResult);
		$bighint = mysqli_num_rows($bigResult);
		$normalhint = mysqli_num_rows($norResult);
		$totalhint = ($bighint * 2)+$normalhint;
		$singlePay = 200/$totalhint;
		while($sSelectStatusRow = mysqli_fetch_assoc($sSelectStatusResult)){
			$hintId = $sSelectStatusRow['HINT_ID'];
			$hintStatus = $sSelectStatusRow['HINT_STATUS'];
			$hintText = $sSelectStatusRow['HINT_TEXT'];
			$hintType = $sSelectStatusRow['HINT_TYPE'];
			if($hintType == "big_hint"){
				$point = round($singlePay * 2,0,PHP_ROUND_HALF_DOWN);
			}else if($hintType == "normal"){
				$point = round($singlePay,0,PHP_ROUND_HALF_DOWN);
			}
			if($hintStatus == 0){
				$hintClose[] = "Hint Locked (- $point)";
			}else{
				$hintOpen[] = preg_replace('/\s{2,}/', ' ',$hintText);
			}
		
		}
		$HO = implode("~#~", $hintOpen);
		$HC = implode("~#~", $hintClose);
		echo print_r($HO."#~#".$HC,true);
		
}
?>