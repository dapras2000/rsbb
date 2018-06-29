<?php
include("include/connect.php");
mysql_query("DELETE FROM t_bayarrajal WHERE NOBILL='".$_GET['idxb']."' and idxdaftar='".$_GET['idxdaftar']."'");

?>

<script language="javascript" type="text/javascript">
window.location='index.php?link=33';
</script>