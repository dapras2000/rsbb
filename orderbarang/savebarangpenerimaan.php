<?php
include("../include/connect.php");
include("../rajal/inc/function.php");

$ip = getRealIpAddr();
$sql = "SELECT kodebarang, tglterima, jmlterima,
			NIP, KDUNIT, IP
		FROM
		  temp_cartbarang_penerimaan
		WHERE IP = '$ip'";
						
		$row = mysql_query($sql)or die(mysql_error());
			if(count($row) > 0){
				  while($data = mysql_fetch_array($row)){
					  $kd_barang = $data['kodebarang'];
					  $tgl_terima = $data['tglterima'];
					  $jml_terima = $data['jmlterima'];
					  $nip = $data['NIP'];
					  $kdunit = $data['KDUNIT'];
					 
					  @mysql_query("INSERT INTO t_penerimaan_barang (NIP, KDUNIT, kodebarang,
											  tglterima, jmlterima)
								   VALUES('$nip', '$kdunit', '$kd_barang', '$tgl_terima',
										  $jml_terima)");
					  
					  $sqlsaldo = "SELECT saldo FROM t_barang_stok  WHERE kode_barang = '$kd_barang' 
					  AND KDUNIT = '".$kdunit."'
					  ORDER BY tanggal DESC, kd_stok DESC LIMIT 1";
					  $get = mysql_query ($sqlsaldo)or die(mysql_error());
		              $saldodata = mysql_fetch_assoc($get);
  					  $saldo = $saldodata['saldo'] + $jml_terima;
					  
					  @mysql_query("INSERT INTO t_barang_stok (kode_barang, tanggal, masuk, saldo, KDUNIT) 
					VALUES ('$kd_barang', '$tgl_terima', '$jml_terima', '$saldo', '$kdunit')")or die(mysql_error());
				  }
			}
			
	
		@mysql_query("DELETE FROM temp_cartbarang_penerimaan WHERE IP = '$ip'")or die(mysql_error());
		echo "<fieldset class='fieldset'>";
        echo "<legend>Informasi</legend>";
		echo "Simpan Data Penerimaan Barang Berhasil."; 
		echo "</legend>"; 
?>