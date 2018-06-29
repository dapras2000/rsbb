<?php
include '../include/connect.php';
include '../include/function.php';
if($_REQUEST['rajal'] == 1){
	$link = 'list_obat_rajal';
	mysql_query('INSERT INTO t_obat_stok (kode_obat,tanggal,masuk,saldo,pemakaian)
	/*SELECT t_billobat_rajal.kode_obat,NOW(),t_billobat_rajal.qty,m_obat.stok + t_billobat_rajal.qty,"Retur" FROM t_billobat_rajal */
	SELECT t_billobat_rajal.kode_obat,NOW(),t_billobat_rajal.qty,m_obat.stok + t_billobat_rajal.qty,"Retur" FROM t_billobat_rajal
	JOIN m_barang ON m_barang.kode_barang = t_billobat_rajal.kode_obat 
	WHERE t_billobat_rajal.kode_obat NOT LIKE "07.%" 
	AND t_billobat_rajal.kode_obat NOT LIKE "R%"
	AND t_billobat_rajal.noresep = "'.$_REQUEST['noresep'].'"');
	mysql_query('UPDATE m_obat a, t_billobat_rajal b SET a.stok=a.stok+b.qty WHERE a.kode_obat=b.kode_obat AND b.kode_obat NOT LIKE "R%"');	
	mysql_query('update t_billobat_rajal set status = "Batal" where noresep = "'.$_REQUEST['noresep'].'"');
}else{
	$link = 'list_obat_ranap';
	mysql_query('INSERT INTO t_obat_stok (kode_obat,tanggal,masuk,saldo,pemakaian)
	SELECT t_billobat_ranap.kode_obat,NOW(),t_billobat_ranap.qty,m_obat.stok + t_billobat_ranap.qty,"Retur" FROM t_billobat_ranap 
	JOIN m_obat ON m_obat.kode_obat = t_billobat_ranap.kode_obat 
	WHERE t_billobat_ranap.kode_obat NOT LIKE "07.%" 
	AND t_billobat_ranap.kode_obat NOT LIKE "R%"
	AND t_billobat_ranap.noresep = "'.$_REQUEST['noresep'].'"');
	mysql_query('UPDATE m_obat a, t_billobat_ranap b SET a.stok=a.stok+b.qty WHERE a.kode_obat=b.kode_obat AND b.kode_obat NOT LIKE "R%"');	
	mysql_query('update t_billobat_ranap set status = "Batal" where noresep = "'.$_REQUEST['noresep'].'"');
}
?>
<SCRIPT language="JavaScript">
alert("Pembatalan Obat Berhasil.");
window.location="<?php echo _BASE_;?>/index.php?link=<?php echo $link;?>";
</SCRIPT>