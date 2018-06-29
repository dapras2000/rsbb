<?php
include("../include/connect.php");
include("../rajal/inc/function.php");

$ip = getRealIpAddr();
$sql = "SELECT KDBARANG, QTY, NIP,
			KDUNIT, tglkeluar, NOMR, IDXDAFTAR
		FROM
		  temp_cartbarang_pengeluaran
		WHERE IP = '$ip'";
						
		$row = mysql_query($sql)or die(mysql_error());
			if(count($row) > 0){
				  while($data = mysql_fetch_array($row)){
					  $kd_barang = $data['KDBARANG'];
					  $tgl_keluar = $data['tglkeluar'];
					  $jml_keluar = $data['QTY'];
					  $nip = $data['NIP'];
					  $kdunit = $data['KDUNIT'];
					  
					  if($data['NOMR']==""){
					  	$nomr = "";
					  	$idxdaftar = 'NULL';
					  }else{
					  	$nomr = $data['NOMR'];
					  	$idxdaftar = $data['IDXDAFTAR'];
					  }
					 
					  @mysql_query("INSERT INTO t_pengeluaran_barang (NIP, KDUNIT, kodebarang,
											  tglkeluar, jmlkeluar, IDXDAFTAR, NOMR)
								   VALUES('$nip', '$kdunit', '$kd_barang', '$tgl_keluar',
										  $jml_keluar, $idxdaftar, '$nomr')");
					  
					  $sqlsaldo = "SELECT saldo FROM t_barang_stok  WHERE kode_barang = '$kd_barang' 
					  AND KDUNIT = '".$kdunit."'
					  ORDER BY tanggal DESC, kd_stok DESC LIMIT 1";
					  $get = mysql_query ($sqlsaldo)or die(mysql_error());
		              $saldodata = mysql_fetch_assoc($get);
  					  $saldo = $saldodata['saldo'] - $jml_keluar;
					  
					  @mysql_query("INSERT INTO t_barang_stok (kode_barang, tanggal, keluar, saldo, KDUNIT) 
					VALUES ('$kd_barang', '$tgl_keluar', '$jml_keluar', '$saldo', '$kdunit')")or die(mysql_error());
				  }
			}
			
	
		@mysql_query("DELETE FROM temp_cartbarang_pengeluaran WHERE IP = '$ip'")or die(mysql_error());
		echo "<fieldset class='fieldset'>";
        echo "<legend>Informasi</legend>";
		echo "Simpan Data Pengeluaran Barang Berhasil."; 
		echo "</legend>"; 
?>