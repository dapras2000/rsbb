<?php
include("../include/connect.php");
include("../rajal/inc/function.php");

$ip = getRealIpAddr();
$tglcr = date("Ymd")."-".date("Gis");
$sql = "SELECT IDXBARANG,
			   KDBARANG,
			   QTY,
			   NIP,
			   KDUNIT,
			   IP,
			   RUANG
			FROM
			   temp_cartbarang_permintaan
			WHERE IP = '$ip'";
						
		$row = mysql_query($sql)or die(mysql_error());
			if(count($row) > 0){
				  while($data = mysql_fetch_array($row)){
					  $kodebarang = $data['KDBARANG'];
					  $jumlahpesan = $data['QTY'];
					  $nip = $data['NIP'];
					  $kdunit = $data['KDUNIT'];
					  $tglpesan = date("Y-m-d");
					  $no = $tglcr."-".$data['KDUNIT']."-".$data['NIP'];
					  $ruang = $data['RUANG'];
					  
					  @mysql_query("INSERT INTO t_permintaan_barang (NO, NIP, KDUNIT, kodebarang, tglpesan, jumlahpesan, statusacc, RUANG) 
					VALUES ('$no', '$nip', '$kdunit', '$kodebarang', '$tglpesan', $jumlahpesan, '0', $ruang)")or die(mysql_error());
				  }
			}
			
	
		@mysql_query("DELETE FROM temp_cartbarang_permintaan WHERE IP = '$ip'")or die(mysql_error());
		echo "<fieldset class='fieldset'>";
        echo "<legend>Informasi</legend>";
		echo "Simpan Data Permintaan Barang Berhasil."; 
		echo "</legend>";

?>