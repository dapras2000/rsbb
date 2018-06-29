<?php session_start();
include("../include/connect.php");
include("../rajal/inc/function.php");

$u_name = $_POST['u_name'];
$u_pass = $_POST['u_pass'];
$ret = 0;

$sql_user = "SELECT 
			  m_login.NIP,
			  m_login.PWD,
			  m_login.KDUNIT
			FROM
			  m_login
			WHERE  m_login.NIP = '".$u_name."'
			AND m_login.KDUNIT = ".$_SESSION['KDUNIT'];
$get_user = mysql_query($sql_user);
if(count($get_user) > 0){
  	$dat_user = mysql_fetch_assoc($get_user);
	$user_pass = $dat_user['PWD'];
	
	if(strcmp($user_pass,$u_pass)==0){
	   $ret = 1;
	}
}

if($ret == 1){
		$ip = getRealIpAddr();
		$sql = "SELECT IDXBARANG,
					   KDBARANG,
					   QTY,
					   IP,
					   NIP,
					   KDUNIT,
					   tahun,
					   tglpesan
					FROM
					   temp_cartbarang_pengadaan
					WHERE IP = '$ip'";
								
				$row = mysql_query($sql)or die(mysql_error());
					if(count($row) > 0){
						  while($data = mysql_fetch_array($row)){
							  $kodebarang = $data['KDBARANG'];
							  $jumlahpesan = $data['QTY'];
							  $nip = $data['NIP'];
							  $kdunit = $data['KDUNIT'];
							  $tglpesan = $data['tglpesan'];
							  $tahun = $data['tahun'];
							  
							  @mysql_query("INSERT INTO t_pengadaan_barang (NIP, KDUNIT, kodebarang, tglpesan, jumlahpesan, tahun) 
							VALUES ('$nip', '$kdunit', '$kodebarang', '$tglpesan', '$jumlahpesan', '$tahun')")or die(mysql_error());
						  }
					}
					
			
				@mysql_query("DELETE FROM temp_cartbarang_pengadaan WHERE IP = '$ip'")or die(mysql_error());
				echo "<fieldset class='fieldset'>";
				echo "<legend>Informasi</legend>";
				echo "Simpan Data Pengadaan Barang Berhasil."; 
				echo "</legend>";
}else{
	            echo "<fieldset class='fieldset'>";
				echo "<legend>Informasi</legend>";
				echo "NIP atau Password Tidak Valid."; 
				echo "</legend>";
}
?>