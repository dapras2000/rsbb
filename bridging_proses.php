<?
include("signature.php");
#error_reporting("E_ALL");
include('include/connect.php');
#include('lib/function.php');
if ($_POST) {
	extract($_POST);
if($reqdata=="sep"){
	$tgl=date("Y-m-d H:i:s");
$scml.="
<request>";
 $scml.="<data>";
  $scml.="<t_sep>";
   $scml.="<noKartu>$nopeserta</noKartu>
   <tglSep>$tgl</tglSep>
   <tglRujukan>$tglrujuk</tglRujukan>
   <noRujukan>$norujukan</noRujukan>
   <ppkRujukan>$noppk</ppkRujukan>
   <ppkPelayanan>0113R035</ppkPelayanan>
   <jnsPelayanan>2</jnsPelayanan>
   <catatan>Test WS</catatan>
   <diagAwal>$diagnosa</diagAwal>
   <poliTujuan>-</poliTujuan>
   <klsRawat>3</klsRawat>
   <user>test</user>
   <noMr>$nomr</noMr>";
  $scml.="</t_sep>";
 $scml.="</data>";
$scml.="</request>
";
$url= "http://api.asterix.co.id/SepWebRest/sep/create/";
#$nilai1="3201152704890003";
#$url= "".$ip."/$nilai1";
$process = curl_init($url); 
curl_setopt($process, CURLOPT_HTTPHEADER,
        array("Content-Type: application/xml\r\n" . "X-cons-id: 25676\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature"));
curl_setopt($process, CURLOPT_HEADER, false); 
curl_setopt($process, CURLOPT_TIMEOUT, 30); 
curl_setopt($process, CURLOPT_POST, true); 
curl_setopt($process, CURLOPT_POSTFIELDS, $scml); 
curl_setopt($process, CURLOPT_RETURNTRANSFER, TRUE); 
$return = curl_exec($process); 
curl_close($process);
$response = json_decode($return, true);
$no_sep=$response[response];
echo $no_sep;
}
if($reqdata=="rujukan"){
	$tgl=date("Y-m-d H:i:s");

$ip= "http://api.asterix.co.id/SepWebRest/peserta";
$nilai1=$nopeserta;
$url= "".$ip."/$nilai1";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Accept: application/json\r\n" . "X-cons-id: 25676\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature"));
curl_setopt($curl, CURLOPT_GET, true);
#curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

$json_response = curl_exec($curl);

#$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

$response = json_decode($json_response, true);
$rest=$response[metaData]['message']; 
if($rest==200){
/*$nik=$response[response]['peserta']['nik'];
$nama=$response[response]['peserta']['nama'];
$tgllahir=$response[response]['peserta']['tglLahir'];
$kdprovider=$response[response]['peserta']['provUmum']['kdProvider'];
$nmprovider=$response[response]['peserta']['provUmum']['nmProvider'];
$jnspeserta= $response[response]['peserta']['jenisPeserta']['nmJenisPeserta'];
$kelas= $response[response]['peserta']['kelasTanggungan']['kdKelas'];*/
echo $json_response;
}
else{
echo"Error";
}
}
if($reqdata=="norujukan"){
	$tgl=date("Y-m-d H:i:s");

$ip= "http://api.asterix.co.id/SepWebRest/rujukan";
$nilai1=$norujuk;
$url= "".$ip."/$nilai1";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Accept: application/json\r\n" . "X-cons-id: 26823\r\n" . "X-Timestamp: $tStamp\r\n" . "X-Signature: $encodedSignature"));
curl_setopt($curl, CURLOPT_GET, true);
#curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

$json_response = curl_exec($curl);

#$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

curl_close($curl);

$response = json_decode($json_response, true);
$rest=$response[metaData]['message']; 
if($rest==200){
$diagnosa=$response[response]['item']['diagnosa']['kdDiag'];
echo $diagnosa;
}
else{
echo "error";
}
}
}
?>