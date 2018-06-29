<?
	// Setting koneksi ke MySQL
	$connection = mysql_connect('localhost','root','')	
					or die('Tidak bisa tersambung ke server database :))');
	// Nama Database
	$db 		= mysql_select_db('simrs2012',$connection)
					or die('Tidak bisa tersambung ke database.');
?>