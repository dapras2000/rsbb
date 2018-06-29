<?php
include("../include/connect.php");
$s	= mysql_query('select COUNT(*) from t_bayarrajal where IDXDAFTAR = "'.$_REQUEST['idx'].'" and STATUS = "LUNAS"');
if(mysql_num_rows($s) > 0):
	?>
    <script language="javascript" type="text/javascript" >
		alert('Billing sudah di bayar, tidak bisa dibatalkan');
		window.location='./index.php?link=5&page=<?=$_GET['page']?>&tgl_reg=<?=$_GET['tgl_reg']?>&tgl_reg2=<?=$_GET['tgl_reg2']?>&nama=<?=$_GET['nama']?>&norm=<?=$_GET['norm']?>';
	</script>
    <?php	
else:
	$sql = "delete from t_pendaftaran WHERE idxdaftar = ".$_GET['idx'];
	mysql_query($sql);
	?>
    <script language="javascript" type="text/javascript" >
    window.location='./index.php?link=5&page=<?=$_GET['page']?>&tgl_reg=<?=$_GET['tgl_reg']?>&tgl_reg2=<?=$_GET['tgl_reg2']?>&nama=<?=$_GET['nama']?>&norm=<?=$_GET['norm']?>';
</script>
    <?php
endif;
?>