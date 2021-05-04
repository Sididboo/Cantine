<?php
require 'model/pdf.php';
require 'model/contient.php';

$db = BDD::getBDD();

setlocale(LC_TIME, "fr_FR");
$lundi = strftime("%d/%m/%Y", strtotime("+1 Monday"));
$mardi = strftime("%d/%m/%Y", strtotime("+1 Tuesday")); 
$jeudi = strftime("%d/%m/%Y", strtotime("+1 Thursday")); 
$vendredi = strftime("%d/%m/%Y", strtotime("+1 Friday")); 

$leContenant = new Contient();
$lesContenants = $leContenant->findAllByDate($lundi);
//var_dump($lesContenants);
/*$lesContenants = $leContenant->findAllByDate($mardi);
$lesContenants = $leContenant->findAllByDate($jeudi);
$lesContenants = $leContenant->findAllByDate($vendredi);*/

// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AddPage();
$pdf->header();
$pdf->headerTable();
$pdf->viewTablesE();


$etat = 'pdf';
    
?>