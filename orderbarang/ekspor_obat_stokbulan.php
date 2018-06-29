<?php session_start();
include '../include/connect.php';
include '../include/function.php';
$thn=$_GET['thn'];
$bln=$_GET['bln'];

header('Content-Type: text/csv; charset=utf-8'); 
//header("Content-type: application/csv"); 
header('Content-Disposition: attachment; filename=Laporan stok bulan csv');  
// do not cache the file
//header('Pragma: no-cache');
//header('Expires: 0');

$output = fopen("php://output", "w"); 
fputcsv($output, array('Kode Departement', 'Nama Department'));  
$query = "SELECT kd_department,nama_department from depart ORDER BY kd_department DESC";  
$result = mysqli_query($koneksi,$query);  
while($row = mysqli_fetch_assoc($result))  
{  
fputcsv($output, $row);  
}  
fclose($output);  
 //} 

?>