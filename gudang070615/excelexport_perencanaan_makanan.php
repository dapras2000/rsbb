<?
include("../include/connect.php");

$sql 		= $_POST['query'];
$tanggal1	= $_POST['tanggal1'];
$tanggal2	= $_POST['tanggal2'];
$lap_header = $_POST['header'];
$filename   = $_POST['filename'];

$sql = str_replace("\\","",$sql);
//die($sql);
$rs=array();
$ret=mysql_query($sql);

if($ret) {
  $x =0;
  while ($r = mysql_fetch_array($ret)) {  
   for ($i=0; $i<mysql_num_fields($ret); $i++) {  
      $rs[$x][mysql_field_name($ret,$i)] = strip_tags($r[$i]);  
	}  
 $x++;
 }  
}


function xlsBOF() { 
	echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0); return; 
	} 

function xlsEOF() { 
	echo pack("ss", 0x0A, 0x00); return; 
	} 
	
function xlsWriteNumber($Row, $Col, $Value) { 
	echo pack("sssss", 0x203, 14, $Row, $Col, 0x0); 
	echo pack("d", $Value); return; 
	} 
	
function xlsWriteLabel($Row, $Col, $Value ) { 
	$L = strlen($Value); 
	echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L); 
	echo $Value; return; 
	}
	
 
	header("Pragma: public"); 
	header("Expires: 0"); 
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
	header("Content-Type: application/force-download"); 
	header("Content-Type: application/octet-stream"); 
	header("Content-Type: application/download"); 
	header("Content-Disposition: attachment;filename=".$filename.".xls"); 
	header("Content-Transfer-Encoding: binary ");
	
if(count($rs)>0){

xlsBOF();
//xlsWriteLabel(0,1,$sql);

$e=1;
foreach($rs[0] as $k=>$x):
		xlsWriteLabel(4,$e,$k); 
	$e++;
endforeach;

xlsWriteLabel(2,1,"DAFTAR PERENCANAAN PEMBELIAN MAKANAN");
if($tanggal1!="" AND $tanggal2!=""){
	xlsWriteLabel(3,1,"TANGGAL : ".$tanggal1." - ".$tanggal2);
	$total = "SELECT SUM(harga_satuan) FROM m_bahan_makanan WHERE DATE(TANGGAL) BETWEEN '".$tanggal1."' and '".$tanggal2."'";
	$hasil=mysql_query($total);
	$result = mysql_fetch_array($hasil);
	$hasil_total = $result['SUM(harga_satuan)'];
}else{
	xlsWriteLabel(3,1,"TANGGAL : ".date('Y/m/d'));
	$total = "SELECT SUM(harga_satuan) FROM m_bahan_makanan WHERE tanggal='".date('Y/m/d')."' ";
	$hasil=mysql_query($total);
	$result = mysql_fetch_array($hasil);
	$hasil_total = $result['SUM(harga_satuan)'];
}

$xlsRow = 5;
foreach($rs as $k=>$i):
    $a=1;
	foreach($i as $j):
	  $j = preg_replace("/&#?[a-z0-9]+;/i","",$j);
	  xlsWriteLabel($xlsRow,$a,trim($j));
	$a++;
	
	endforeach;
	
$xlsRow++;
endforeach;

xlsWriteLabel($xlsRow,$a-2,"Total :");
xlsWriteLabel($xlsRow,$a-1,($hasil_total));

xlsEOF(); 
}else{
  xlsWriteLabel(0,1,'Data Not Found');
} 

exit();
?>
