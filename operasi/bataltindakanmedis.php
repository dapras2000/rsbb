<?php
mysql_query("DELETE FROM  t_tindakan_medis WHERE IDX=".$_GET['idx']." AND IDXDAFTAR=".$_GET['idxdaftar']);
?>
<SCRIPT language="JavaScript">
window.location="index.php?link=209&idoperasi=<?=$_GET['idoperasi']?>&tanggal=<?=$_GET['tanggal']?>";
</SCRIPT>