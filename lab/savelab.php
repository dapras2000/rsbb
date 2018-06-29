<?php session_start(); 
include("../include/connect.php");

$pid	= count($_REQUEST['id']);
$mulai	= $_REQUEST['jamMulai'];
$selesai= $_REQUEST['jamSelesai'];
if($selesai == ''){
	$selesai = date('Y-m-d H:i:s');
}
$shift	= $_REQUEST['SHIF'];
$petugas= $_REQUEST['petugas'];
$nolab	= $_REQUEST['nolab'];
$keterangan	= $_REQUEST['keterangan'];
$hasil	= $_REQUEST['hasil'];
$nilai	= $_REQUEST['nilainormal'];
$unit	= $_REQUEST['unit'];
$id		= $_REQUEST['id'];

for($i=0; $i<$pid; $i++):
	mysql_query('update t_orderlab set HASIL_PERIKSA = "'.$hasil[$i].'", NILAI_NORMAL = "'.$nilai[$i].'", UNIT = "'.$unit[$i].'", TGL_MULAI = "'.$mulai.'", TGL_SELESAI = "'.$selesai.'", STATUS = "1", KETERANGAN ="'.$keterangan.'", PETUGAS ="'.$petugas.'", SHIF = "'.$shift.'" where IDXORDERLAB = "'.$id[$i].'"');
endfor;
?>
<script language="javascript" type="text/javascript" >
	alert("Simpan Data Lab Sukses.");
	window.location="<?php echo _BASE_;?>index.php?link=6";
</script>