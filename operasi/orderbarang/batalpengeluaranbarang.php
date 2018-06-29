<?php
mysql_query("DELETE FROM t_operasi_barang WHERE IDX_BARANG=".$_GET['idxbarang']." AND IDXOPERASI=".$_GET['idoperasi']);
?>
<SCRIPT language="JavaScript">
window.location="index.php?link=206&idoperasi=<?=$_GET['idoperasi']?>&tanggal=<?=$_GET['tanggal']?>";
</SCRIPT>