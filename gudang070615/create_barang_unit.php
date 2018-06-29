<?
include("../include/connect.php");

$qry = "SELECT kode_barang, nama_barang, satuan FROM m_barang where group_barang = 4";
$get = mysql_query($qry);
while($data = mysql_fetch_array($get)){
	
$kodebarang = $data['kode_barang'];	
$nama_barang = ltrim($data['nama_barang']);
$satuan = $data['satuan'];	

		/*mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 14)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 10)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 3)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 15)");
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 4)"); 
		
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
				VALUES ($kodebarang, 16)");
		
		mysql_query("INSERT INTO m_barang_unit (kode_barang, KDUNIT)
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
		
		mysql_query("update m_barang set nama_barang = ltrim(nama_barang), satuan = ltrim(satuan)
					where kode_barang = ".$kode_barang);
}


?>