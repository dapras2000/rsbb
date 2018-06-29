<?php
session_start();
include("../../../include/connect.php");
//kondisi get no mr untuk pembayaran
header("Content-Type: text/html; charset=ISO-8859-15");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
<div id="finished">
<?

//remove
if(!empty($_GET['IDXDAFTAR'])){
	mysql_query("DELETE FROM t_resep WHERE IDXRESEP ='".$_SESSION['IDXRESEP']."' AND IDXDAFTAR ='".$_GET['IDXDAFTAR']."'")or die(mysql_query());
	echo "<div style='margin:5px; padding:5px; border:1px solid #CCC; background-color:#F3FFCE'><strong>Delete Succesfull!</strong></div>";
	unset($_SESSION['IDXRESEP']);
}
?>
<form name="frm_list2" action="" method="post" enctype="multipart/form-data">
<table width="100%" border="0">
  <tr>
    <th>Actions</th>
    <th>Nama Obat</th>
    <th>Kode Obat</th>
    <th>Jumlah</th>
    <th>Aturan Pakai</th>
    <th>Keterangan</th>
  </tr>
<? 
//list resep
$qry_resep = mysql_query("SELECT * FROM t_resep WHERE IDXDAFTAR = '".$_GET['IDXDAFTAR']."'")or die(mysql_error());
while($data = mysql_fetch_array($qry_resep)){ 

?>
  <tr>
   <td><? $_SESSION['IDXRESEP'] = $data['IDXRESEP']; ?>
   <input type="hidden" class="text" size="5" name="IDXDAFTAR" value="<? echo $data['IDXDAFTAR']; ?>" id="IDXDAFTAR" />
<a href="#" onclick="javascript: MyAjaxRequest('del','rajal/inc/delete.php?IDXDAFTAR=','IDXDAFTAR'); Effect.Appear('del'); return false;"><div align="center" class="text"> Hapus </div></a></td>
    <td><? 	echo $data['NAMAOBAT']; ?></td>
    <td><?	echo $data['KDOBAT']; ?></td>
    <td><?	echo $data['JUMLAH']; ?></td>
    <td><?  echo $data['ATURANPAKAI']; ?></td>
    <td><?	echo $data['KETERANGAN'];?></td>
  </tr>
<? } ?>
</table>

<div style="width:100px; padding:5px;"><a href="#" onclick="javascript: MyAjaxRequest('finished','rajal/finish.php?action=','finished'); Effect.Appear('finish'); return false;">
<div align="center" class="text"> Finish </div>
</a>
</div>
</form>
</div>