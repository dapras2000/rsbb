<?php
include("../include/connect.php");
include("inc/function.php");

$ip = getRealIpAddr();
$tglcr = date("Ymd")."-".date("Gis");
$sql = "SELECT IDXBARANG,
			   KATEGORI,
			   KDBARANG,
			   QTY,
			   NIP,
			   KDPOLY,
			   GROUPBARANG,
			   IP
			FROM
			   temp_cartbarang
			WHERE IP = '$ip'";
						
		$row = mysql_query($sql)or die(mysql_error());
			if(count($row) > 0){
				  while($data = mysql_fetch_array($row)){
					  $kodebarang = $data['KDBARANG'];
					  $jumlahpesan = $data['QTY'];
					  $nip = $data['NIP'];
					  $kdpoly = $data['KDPOLY'];
					  $kategori = $data['KATEGORI'];
					  $grp = $data['GROUPBARANG'];
					  $tglpesan = date("Y-m-d");
					  $no = $tglcr."-".str_replace(".","",($data['IP']));
					  
					  @mysql_query("INSERT INTO t_permintaan_barang (NO, NIP, kodebarang, tglpesan, jumlahpesan, statusacc, KDPOLY, KATEGORY, GROUPBARANG) 
					VALUES ('$no', '$nip', '$kodebarang', '$tglpesan', '$jumlahpesan', '0', '$kdpoly', '$kategori', '$grp')")or die(mysql_error());
				  }
			}
			
	
		@mysql_query("DELETE FROM temp_cartbarang WHERE IP = '$ip'")or die(mysql_error());
		echo "<fieldset class='fieldset'>";
        echo "<legend>Informasi</legend>";
		echo "Simpan Data Permintaan Barang Berhasil."; 
		echo "</legend>";

?>