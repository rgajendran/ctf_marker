<?php

if(isset($_POST['token_pdf']) && isset($_POST['token_gen_team'])){

	require 'fpdf181/fpdf.php';
	include 'template/connection.php';
	$team = $_POST['token_gen_team'];
	$teamName = "NULL";
	$query = "SELECT * FROM users WHERE TEAM='$team'";
	$result = mysqli_query($connection, $query);
	class PDF extends FPDF{
		function Footer()
			{
			    // Position at 1.5 cm from bottom
			    $this->SetY(-15);
			    // Arial italic 8
			    $this->SetFont('Arial','I',8);
			    // Page number
			    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'R');
			}
	}

	$pdf = new PDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',10);
	$pdf->SetFillColor(171,209,125);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(180,20,'Flawed Fortress Keys',1,'','C',true);
	$pdf->Ln(20);
	$pdf->SetFillColor(231,239,220);
	$pdf->Cell(180,10,'http://schreuders.org/flawedfortress/',1,'','C',true);
	$pdf->Ln(23);
	
	$sno = 0;
	while($row = mysqli_fetch_assoc($result)){
		$team_name_getter_new = mysqli_query($connection, "SELECT TEAMNAME FROM team WHERE TEAM='$team'");
		while($team_row = mysqli_fetch_assoc($team_name_getter_new)){									
			$teamName = $team_row['TEAMNAME'];
		}
		$pdf->SetFont('Arial','B',9);
		$pdf->setFillColor(231,239,220);
		$pdf->Cell(10,8,'S.No',1,'','C',true); 
		$pdf->Cell(80,8,'Team',1,'','C',true);
		$pdf->Cell(90,8,'Token',1,'','C',true);			
		$pdf->Ln(8);
		$pdf->SetFont('Arial','',9);
		$sno = $sno + 1;
		$pdf->Cell(10,8,$sno,1,'','C');
		$pdf->Cell(80,8,$teamName,1,'','C');
		$pdf->SetFillColor(195,219,166);
		$pdf->Cell(90,8,$row['TOKEN'],1,'','C',true);
		$pdf->SetTextColor(0,0,0);
		$pdf->Ln(20);
	}
	ob_start();
	$pdf->Output('',$teamName.".pdf");
	ob_flush();
	
}else{
	header('location:index.php');
}
?>