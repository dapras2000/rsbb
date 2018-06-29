<?
include '../include/connect.php';
$sql = $_POST['query'];
$lap_header = $_POST['header'];
$filename = $_POST['filename'];

$sql = str_replace("\\","",$sql);
$rs=array();
$ret=mysql_query($sql);

if($ret) {
  $x =0;
  while ($r = mysql_fetch_array($ret)) {  
   for ($i=0; $i<mysql_num_fields($ret); $i++) {  
      $rs[$x][mysql_field_name($ret,$i)] = $r[$i];  
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
xlsWriteLabel(0,1,$lap_header);

$e=1;
foreach($rs[0] as $k=>$x):
		xlsWriteLabel(2,$e,$k); 
	$e++;
endforeach;



$xlsRow = 3;
foreach($rs as $k=>$i):
    $a=1;
	foreach($i as $j):
	  xlsWriteLabel($xlsRow,$a,$j);
	$a++;
	endforeach;
$xlsRow++;
endforeach;

xlsEOF(); 
}else{
  xlsWriteLabel(0,1,'Data Not Found');
} 
exit();
?>