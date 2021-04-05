<?php
require('../fpdf/fpdf.php');
include('../model/accesBDD.php');

$db = BDD::getBDD();

class PDF extends FPDF
{
// En-tête
function Header()
{

    // Police Arial gras 15
    // Logo
    $this->Image('../habillage/images/23154-ARS.jpg',10,6,30);
    $this->SetFont('Arial','B',15);
    // Décalage à droite
    $this->Cell(80);
    // Titre
    $this->Cell(50,10,'Menus Journalier',1,0,'C');
    // Saut de ligne
    $this->Ln(20);
}

//tete de tableau
function headerTable()
{
    $this->Ln(30);
    $this->SetFont('Arial','B',12);
    $this->Cell(25, 10,'Lundi', 1,0,'C');
    $this->Cell(25, 10,'Mardi ', 1,0,'C');
    $this->Cell(25, 10,'Jeudi', 1,0,'C');
    $this->Cell(25, 10,'Vendredi', 1,0,'C');
    $this->Ln(10);
    
}
//récup table BDD
function viewTablesE($db)
{
   $this->SetFont('Arial','B',12);
  $stmt =$db->query(
//'SELECT *
//FROM plats, menus, contient
//where plats.IDPLAT=contient.IDPLAT and menus.DATEMENU=contient.DATEMENU
//ORDER BY
//(CASE
//    WHEN DATEMENU=2020-10-06
//END)');

  'select * from plats ,menus,contient where plats.IDPLAT=contient.IDPLAT and menus.DATEMENU=contient.DATEMENU') ;
   while($data = $stmt->fetch(PDO::FETCH_ASSOC))
   {
    $this->Cell(25, 10,$data['NOMPLAT'], 1,0,'L');
    $this->Cell(25, 10,$data['DATEMENU'], 1,0,'L');
	$this->Cell(25, 10,$data['NOMPLAT'], 1,0,'L');
    $this->Cell(25, 10,$data['DATEMENU'], 1,0,'L');
    $this->Ln();   
   }
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
} 

// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('L');
$pdf->headerTable();
$pdf->viewTablesE($db);
$pdf->SetFont('Arial','',12);
$pdf->Output();
?>

