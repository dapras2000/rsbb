<?php
include("../include/connect.php");

$sql = "UPDATE t_pendaftaran SET `STATUS` = 11, KELUARPOLY = CURTIME() WHERE idxdaftar = ".$_GET['idx'];
mysql_query($sql);
?>

<script language="javascript" type="text/javascript" >
    window.location='./index.php?link=5&page=<?=$_GET['page']?>&tgl_reg=<?=$_GET['tgl_reg']?>&tgl_reg2=<?=$_GET['tgl_reg2']?>&nama=<?=$_GET['nama']?>&norm=<?=$_GET['norm']?>';
</script>