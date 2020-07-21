<?php
include '../../config/db.php';
global $db;
$tgl = $_GET['tgl'];

if($tgl ===''){
    $query = mysqli_query($db,"select * from transaksi");
}elseif($tgl){
    $query = mysqli_query($db,"SELECT * FROM transaksi WHERE tanggal='$tgl'");
}


require_once("../../dompdf/autoload.inc.php");

use Dompdf\Dompdf;
$dompdf = new Dompdf();

$html = '<center><h3>Laporan Keuangan</h3></center><i>'.$tgl.'</i><hr/><br/>';
$html .= '<table width="100%" border="1">
 <tr align=center style="background-color: black; color: white;">
 <th>No</th>
 <th>Barang</th>
 <th>Terjual</th>
 <th>Harga</th>
 <th>Tanggal</th>
 <th>Jumlah</th>
 </tr>';
$no = 1;
$tot = 0 ;
while($row = mysqli_fetch_array($query))
{
 $html .= "<tr align=center>
 <td>".$no."</td>
 <td align=left>".$row['orderan']."</td>
 <td>".$row['jumlah']."</td>
 <td>".number_format($row['harga'],0,',','.')."</td>
 <td>".$row['tanggal']."</td>
 <td>".number_format($row['total'],0,',','.')."</td>
 </tr>";
 $tot += $row['total'];
 $no++;
}
$html .= "

<tr style='border:none;'>
<td colspan=4></td>
<td align=right>Total :</td>
<td align=center>".number_format($tot,0,',','.')."</td>
</tr>";
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF
$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('laporan_keuangan.pdf');

?>




