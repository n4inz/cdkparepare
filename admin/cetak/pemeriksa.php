<?php
include("../connection.php");
require('../class/fpdf181/fpdf.php');
session_start();

$kode = $_GET['kodep'];


$hasil=MYSQLI_QUERY($connection, "SELECT * FROM pemeriksa WHERE kodep=$kode");
$data = mysqli_fetch_assoc($hasil);


class PDF extends FPDF
{
// Page header
function Header()
{
    $this->SetFont('Arial','B',15);
    // Logo
    // Arial bold 15
    
    // Move to the right
    $this->Cell(55);
    // Title
    $this->SetFont('Arial','BU',18);
    $this->Cell(50,10,'Pemeriksa');
    // Line break
    $this->Ln(10);
}

// Page footer
/*function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);

}*/
}

if($data['nomorsurat']==null){
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Ln(8);
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(65,25,'Kode');
    $pdf->Cell(5,25,':');
    $pdf->Cell(5,25,$_GET['kodep']);
    $pdf->Ln(8);
    $pdf->Cell(65,25,'Nama');
    $pdf->Cell(5,25,':');
    $pdf->Cell(5,25,'Null');
    $pdf->Ln(8);
    $pdf->Cell(65,25,'Nomor Surat');
    $pdf->Cell(5,25,':');
    $pdf->Cell(5,25,'Null');
    $pdf->Ln(8);
    $pdf->Cell(65,25,'Tanggal');
    $pdf->Cell(5,25,':');
    $pdf->Cell(5,25,'Null');
    $pdf->Ln(8);
    $pdf->Ln(8);
    $pdf->Cell(65,25,'Kode Pemeriksa Dengan No '.$_GET['kodep'].'. Belum di ajukan ke');
    $pdf->Ln(8);
    $pdf->Cell(65,25,'INPUT NOTA DINAS KERUSAKAN BARANG, Di mohon agar kiranya petugas PEMERIKSA ');
    $pdf->Ln(8);
    $pdf->Cell(65,25,'segera melakukan permohonan surat ke atasan agar kerusakan kerusakan di PT. Pelni dapat teratasi.');
    $pdf->Ln(8);
    $pdf->Cell(65,25,'Terima Kasih');
    $pdf->Ln(8);
    $pdf->Ln(8);
    $pdf->Cell(5,25,$_GET['tanggal']);
    $pdf->Ln(8);
    $pdf->Ln(8);
    $pdf->Ln(8);
    $pdf->Cell(5,25,$_GET['nama']);
    
    $pdf->Output();
    
}else{
    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Ln(8);
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(65,25,'Kode');
    $pdf->Cell(5,25,':');
    $pdf->Cell(5,25,$_GET['kodep']);
    $pdf->Ln(8);
    $pdf->Cell(65,25,'Nama');
    $pdf->Cell(5,25,':');
    $pdf->Cell(5,25,$data['nama']);
    $pdf->Ln(8);
    $pdf->Cell(65,25,'Nomor Surat');
    $pdf->Cell(5,25,':');
    $pdf->Cell(5,25,$data['nomorsurat']);
    $pdf->Ln(8);
    $pdf->Cell(65,25,'Tanggal');
    $pdf->Cell(5,25,':');
    $pdf->Cell(5,25,$data['tanggal']);
    $pdf->Ln(8);
    $pdf->Ln(8);
    $pdf->Cell(65,25,'Bersama Surat ini , kami selaku bagian teknik PT. Pelindo IV Cabang Parepare. ');
    $pdf->Ln(8);
    $pdf->Cell(65,25,'mengajukan surat perbaikan/pergantian barang atau alat sesuai nomor kode diatas .');
    $pdf->Ln(8);
    $pdf->Cell(65,25,'Mohon Kiranya dilakukan perbaikan/pergantian barang atau alat tersebut.');
    $pdf->Ln(8);
    $pdf->Cell(65,25,'Terima Kasih');
    $pdf->Ln(8);
    $pdf->Ln(8);
    $pdf->Cell(5,25,$data['tanggal']);
    $pdf->Ln(8);
    $pdf->Ln(8);
    $pdf->Ln(8);
    $pdf->Cell(5,25,$_GET['nama']);
    
    $pdf->Output();
}


?>
