<?
include("include/connect.php");

$qry = "SELECT NOMR FROM m_pasien";
$get = mysql_query($qry);
while($data = mysql_fetch_array($get)){
	
$kodebarang = $data['NOMR'];	
		/*mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 14)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 10)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 3)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 15)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 4)"); */
		$sql_daftar = "select TGLREG from t_pendaftaran where NOMR = '".$kodebarang."'
						order by IDXDAFTAR asc limit 1";
		$get_daftar = mysql_query($sql_daftar);
		$dat_daftar = mysql_fetch_assoc($get_daftar);
		$tgl_daftar = $dat_daftar['TGLREG']; 
		
		mysql_query("update m_pasien set TGLDAFTAR = '".$tgl_daftar."' where NOMR= '".$kodebarang."'");
		/*mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 2)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 17)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 20)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 22)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 1)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 18)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 5)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 19)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 7)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 21)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 9)"); */
}


?>