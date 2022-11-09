<?php
include_once("./fpdf184/fpdf.php");
session_start();
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');

foreach ($_SESSION['partida']->getJugadores() as $p) {
    $pdf->Cell(0,10,'Player: '.$p->id,0,1);
}
// foreach ($this->getBaraja()->getCartas() as $key => $card) {
//     $pdf->Cell(0,10,'Carta '.$key.' color '.$card->getColor().' num '.$card->getNumero(),0,1);
// }
$pdf->Output();