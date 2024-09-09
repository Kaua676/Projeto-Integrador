<?php
require('boleto_bradesco.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$row = $result->fetch_assoc();
?>