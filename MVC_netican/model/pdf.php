<?php
require 'fpdf/fpdf.php';
class PDF extends FPDF
{
    // En-tête
    function header()
    {
        $this->SetFont('Arial','B',12);
        // Logo
        $this->Image('habillage/images/23154-ARS.jpg',10,6,30);

        // Décalage à droite
        $this->Cell(80);

        // Titre
        $this->Cell(50,10,'Menus Journalier',2);

        // Saut de ligne
        $this->Ln(20);
    }
    
    //tete de tableau
    function headerTable()
    {
        $this->Ln(30);
        $this->Cell(25, 10,'lundi', 1,0,'C');
        $this->Cell(25, 10,'mardi', 1,0,'C');
        $this->Cell(25, 10,'jeudi', 1,0,'C');
        $this->Cell(25, 10,'vendredi', 1,0,'C');
        $this->Ln(10);
        
    }

    //récup table BDD
    function viewTablesE()
    {
        $this->SetFont('Arial','B',12);
        $this->Cell(25, 10,"cell1 dzjzgf zfz fjzf jzf zjf jzgg", 1,0,'L');
        $this->Cell(25, 10,'cell2', 1,0,'L');
        $this->Cell(25, 10,'cell3', 1,0,'L');
        $this->Cell(25, 10,'cell4', 1,0,'L');
        $this->Ln();   
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
?>