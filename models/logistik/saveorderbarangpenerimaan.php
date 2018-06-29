<?php
include("../include/connect.php");
include("inc/function.php");

$ip = getRealIpAddr();
$sql = "SELECT NO, NIP, kodebarang,
			pengirim, tglterima,
			jmlterima, terimadari,
			KATEGORY
		FROM
		  temp_cartbarang_penerimaan
		WHERE IP = '$ip' AND KATEGORY='L'";
						
		$row = mysql_query($sql)or die(mysql_error());
			if(count($row) > 0){
				  while($data = mysql_fetch_array($row)){
					  $no = $data['NO'];
					  $nip = $data['NIP'];
					  $kd_barang = $data['kodebarang'];
					  $pengirim = $data['pengirim'];
					  $tgl_terima = $data['tglterima'];
					  $jml_terima = $data['jmlterima'];
					  $jns = $data['terimadari'];
					  $kategori = $data['KATEGORY'];
					  @mysql_query("INSERT INTO t_penerimaan_barang (NO, NIP, kodebarang, pengirim, tglterima,
  										jmlterima, jnsterima, KATEGORY)
								   VALUES('$no', '$nip', '$kd_barang', '$pengirim', '$tgl_terima',
										  $jml_terima, '$jns', '$kategori')");
					  
					  $sqlsaldo = "SELECT saldo FROM t_barang_stok  WHERE kode_barang = '$kd_barang' 
					  ORDER BY tanggal DESC, kd_stok DESC LIMIT 1";
					  $get = mysql_query ($sqlsaldo)or die(mysql_error());
		              $saldodata = mysql_fetch_assoc($get);
  					 
					   if(mysql_num_rows($get) > 0){
	   						$saldo = $saldodata['saldo'] + $jml_terima;
	   					}else{
		   					$saldo = $jml_terima;
	   					}
					  
					  @mysql_query("INSERT INTO t_barang_stok (kode_barang, tanggal, masuk, saldo) 
					VALUES ('$kd_barang', '$tgl_terima', '$jml_terima', '$saldo')")or die(mysql_error());
				  }
			}
			
	
		@mysql_query("DELETE FROM temp_cartbarang_penerimaan WHERE IP = '$ip'")or die(mysql_error());
		echo "<fieldset class='fieldset'>";
        echo "<legend>Informasi</legend>";
		echo "Simpan Data Penerimaan Barang Berhasil."; 
		echo "</legend>"; 
?>