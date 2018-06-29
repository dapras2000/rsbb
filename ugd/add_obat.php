<?php
$ip	= getRealIpAddr();
//input ke temp_cartobat
if(!empty($_POST['idxtemp'])){
	$SQLdel  = "DELETE FROM temp_cartobat WHERE IDXTEMP = '".$_POST['idxtemp']."'";
	mysql_query($SQLdel);
	echo "<strong>Hapus Berhasil</strong>";
}else{ 
	if(empty($_POST['nm_barang2'])){
		if(!isset($_GET['idx'])) echo "<strong>Obat Belum Diisi</strong>";
	}else{
		$INSQL = "INSERT INTO temp_cartobat (IDXDAFTAR,NAMAOBAT,SEDIAAN,ATURANPAKAI,JUMLAH, IP) VALUES ('".$_POST['idxdaftarz']."','".$_POST['nm_barang2']."','".$_POST['sediaan2']."','".$_POST['aturan2']."','".$_POST['jml_permintaan2']."', '".$ip."')";
		mysql_query($INSQL);
	}
}
//select dari temp_cartobat
$SQL = "SELECT * FROM temp_cartobat WHERE IP = '".$ip."'";
$QRY = mysql_query($SQL);

if(mysql_num_rows($QRY) > 0){
?>
<table width="100%" class="tb" border="0" cellpadding="1" cellspacing="1">
<tr><th>Nama Obat</th><th>Sediaan</th><th>Takaran</th><th>Jumlah</th><th>Edit</th></tr>
<? while($VIEW = mysql_fetch_array($QRY)){ ?>
<tr><td><?=$VIEW['NAMAOBAT']?></td><td><?=$VIEW['SEDIAAN']?></td><td><?=$VIEW['ATURANPAKAI']?></td><td><?=$VIEW['JUMLAH']?></td><td><a href="#" onclick="javascript:delobat('<?=$VIEW['IDXTEMP']?>');"><div style='padding:2px; background:#FFC; border:1px solid #CCC; margin:2px;' align='center'>remove</div></a></td></tr>
<? } ?>
</table>
<? 
} 
?>