<?
error_reporting("E_ALL");
/*include "dbase.php";
$tgl=date('Y-m-d');
$tgl1='2013-05-16';
$sql= "SELECT Propinsi,RUMAH_SAKIT,usrpwd2 from data where `TANGGAL UPDATE`='$tgl'";
$hasil=mysql_query($sql);

while($r1=mysql_fetch_array($hasil)){

// membaca data1, data2, dan data3 dari form
*/
$nilai1="3302191";
$nilai2="rs adit";
$nilai3="12prop";
/* echo"$nilai1"; */
// pengiriman ke situsku.com via CURL

$url = "http://202.70.136.52/proses.php";

 

$curlHandle = curl_init();

curl_setopt($curlHandle, CURLOPT_URL, $url);

curl_setopt($curlHandle, CURLOPT_POSTFIELDS, "kodesatker=".$nilai1);

curl_setopt($curlHandle, CURLOPT_HEADER, 0);

curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);

curl_setopt($curlHandle, CURLOPT_POST, 1);

$response= curl_exec($curlHandle);

curl_close($curlHandle);
print $response;

?>