<?php session_start();
include("../include/connect.php");
include("inc/function.php");

if(!empty($_POST['IDXRESEP'])){
	$sqlresep = "SELECT IDXBARANG, IDXRESEP, KDBARANG, QTY,
  					NIP, KDUNIT, ATURAN, tgl_keluar, non_generik, nama_generik, obat_luar
				FROM
  				temp_cartapotek_permintaan
				WHERE IDXRESEP = '".$_POST['IDXRESEP']."'";
			$row = mysql_query($sqlresep)or die(mysql_error());
			if(count($row) > 0){
				  while($data = mysql_fetch_array($row)){
					  $idx = $data['IDXRESEP'];
					  $kd_barang = $data['KDBARANG'];
					  $jml_keluar = $data['QTY'];
					  $nip = $data['NIP'];
					  $kdunit = $data['KDUNIT'];
					  $aturan = $data['ATURAN'];
					  $tgl_keluar = $data['tgl_keluar'];
					  $non_generik = $data['non_generik'];
					  $nama_generik = $data['nama_generik'];
					  $obat_luar = $data['obat_luar'];
					  
					  $idxbarang = $data['IDXBARANG'];
					  
					  mysql_query("INSERT INTO t_permintaan_apotek(  
								  IDXRESEP, NIP, KDUNIT,
								  kodebarang, tglkeluar, jmlkeluar, ATURAN, non_generik, nama_generik, obat_luar)
								VALUES('$idx', '$nip', $kdunit,
									  '$kd_barang', '$tgl_keluar', '$jml_keluar', '$aturan', '$non_generik', '$nama_generik', '$obat_luar')");
						  
					  if($non_generik!="1"){
					   	$sqlsaldo = "SELECT saldo FROM t_barang_stok  WHERE kode_barang = '$kd_barang' 
					   	AND KDUNIT = ".$_SESSION['KDUNIT']."
					   	ORDER BY tanggal DESC, kd_stok DESC LIMIT 1";
					  	$get = mysql_query ($sqlsaldo)or die(mysql_error());
		              	$saldodata = mysql_fetch_assoc($get);
  					  	$saldo = $saldodata['saldo'] - $jml_keluar;
					  
					  	mysql_query("INSERT INTO t_barang_stok (kode_barang, tanggal, keluar, saldo, KDUNIT) 
						VALUES ('$kd_barang', '$tgl_keluar', '$jml_keluar', '$saldo', '".$_SESSION['KDUNIT']."')")or die(mysql_error());
					   	mysql_query("INSERT INTO t_pengeluaran_barang (NIP, KDUNIT, kodebarang, tglkeluar, jmlkeluar) 
						VALUES ('".$_SESSION['NIP']."', '".$_SESSION['KDUNIT']."', '$kd_barang', '$tgl_keluar', '$jml_keluar')")or die(mysql_error());
						
					  }
					  
					  
				  }
			}
			
	
		$ip = getRealIpAddr();
		@mysql_query("UPDATE t_resep SET STATUS = '1', tgl_save = now() WHERE   IDXRESEP ='$idx'");
		@mysql_query("DELETE FROM temp_cartapotek_permintaan WHERE IP = '$ip'")or die(mysql_error());
		echo "<fieldset class='fieldset'>";
        echo "<legend>Informasi</legend>";
		echo "Simpan Data Resep Berhasil."; 
		echo "</legend>"; 		  
}
?>