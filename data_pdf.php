<?php

if(isset($_POST['token_pdf']) && isset($_POST['token_gen_team'])){

	require 'fpdf181/fpdf.php';
	include 'template/connection.php';
	$team = $_POST['token_gen_team'];
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
	$pdf->SetFillColor(204,255,255);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(180,10,'Capture The Flag Token',1,'','C',true);
	$pdf->Ln(23);
	
	$sno = 0;
	while($row = mysqli_fetch_assoc($result)){
		$pdf->SetFont('Arial','B',9);
		$pdf->setFillColor(230,230,230);
		$pdf->Cell(10,8,'S.No',1,'','C',true); 
		$pdf->Cell(80,8,'Team',1,'','C',true);
		$pdf->Cell(90,8,'Token',1,'','C',true);			
		$pdf->Ln(8);
		$pdf->SetFont('Arial','',9);
		$sno = $sno + 1;
		$pdf->Cell(10,8,$sno,1,'','C');
		$pdf->Cell(80,8,$row['TEAM'],1,'','C');
		$pdf->SetFillColor(204,255,255);
		$pdf->Cell(90,8,$row['TOKEN'],1,'','C',true);
		$pdf->SetTextColor(0,0,0);
		$pdf->Ln(20);
	}
	ob_start();
	$pdf->Output();
	ob_flush();
	
}else{
	header('location:index.php');
}
?>