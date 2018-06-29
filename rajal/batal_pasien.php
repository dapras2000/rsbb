<?php
/*include("../include/connect.php");

$sql = "UPDATE t_pendaftaran SET `STATUS` = 11, KELUARPOLY = CURTIME() WHERE idxdaftar = ".$_GET['idx'];
mysql_query($sql);*/
?>
<!--
<script language="javascript" type="text/javascript" >
    window.location='./index.php?link=5&page=<?=$_GET['page']?>&tgl_reg=<?=$_GET['tgl_reg']?>&tgl_reg2=<?=$_GET['tgl_reg2']?>&nama=<?=$_GET['nama']?>&norm=<?=$_GET['norm']?>';
</script>
-->
<?php 
include("../include/connect.php");
$idx=$_GET['idx'];
//cek admission
//id_admission
$sqladmis= "SELECT id_admission FROM t_admission WHERE id_admission='$idx'";
$qryadmis = mysql_query($sqladmis);
$hsladmis = mysql_fetch_row($qryadmis);
if ($hsladmis['id_admission']){
	alert('Data Sudah di Admission');
	history.go(-1);
}
$sql_daftar= "DELETE FROM t_pendaftaran WHERE IDXDAFTAR='$idx'";
mysql_query($sql_daftar);
$sql_tbayar= "DELETE FROM t_bayarrajal WHERE IDXDAFTAR='$idx'";
mysql_query($sql_tbayar);
?>
<script type="text/javascript">
	//self.location.href='index.php?cnama=&cnomr=&poly=0&crbayar=0&link=adminrajal&start=2018%2F03%2F04&end=2018%2F04%2F04';
	//var idx= <?php echo $idx;?>;
	//alert(idx);
	alert('Data berhasil dibatalkan');
	history.go(-1);
</script>