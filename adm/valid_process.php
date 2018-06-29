<div style="border:1px solid #DF7; padding:5px; margin:5px; color:#F30; width:90%; background-color:#FFF;" align="left">
<?php
include("../include/connect.php");

//mengambil data dari tabel m_login
$datalogin  = mysql_query("SELECT * FROM m_login WHERE nip='".$_POST['nip']."'")or die(mysql_error());
$listlogin = mysql_fetch_assoc($datalogin);
$d_nip    = $listlogin['NIP'];
$d_pwd    = $listlogin['PWD'];
$d_sesreg = $listlogin['SES_REG'];

$nip     = $_POST['nip'];
$pwd     = $_POST['pwd'];
$pwd2    = $_POST['pwd2'];
$roles   = $_POST['roles'];
$edit    = $_POST['edit'];
$kdunit  = $_POST['kd_unit'];
$dep  = $_POST['departemen'];
$ses_reg = md5('$pwd:$nip');

if(!empty($edit)){
	if($pwd != $pwd2){
		echo"<p>Maaf Confirm Password Yang Anda Masukan Tidak Sama.</p>";	
	}else{
	mysql_query("UPDATE m_login SET NIP ='$nip', PWD = '$pwd', SES_REG = '$ses_reg', ROLES = '".$roles."' WHERE NIP='$nip'")or die(mysql_error());
	echo "<p><strong style='color:green;'>Edit User Berhasil.</strong></p>";
	}
}else{
	// validasi input user :
	if($nip=="" || $pwd=="" || $pwd2=="" || $roles=="" || $kdunit=="-Pilih Unit-"){
		echo "<p><b>Anda belum Mengisi Data Dengan Lengkap : </b></p>";
		if($nip==""){
			echo"<p>Anda Belum Mengisi NIP Field.</p>";
			}
		if($pwd==""){
			echo"<p>Anda Belum Mengisi Password Field.</p>";
			}
		if($pwd2==""){
			echo"<p>Anda Belum Mengisi Confirm Password Field.</p>";
			}
		if($roles=="-Pilih Roles-"){
			echo"<p>Anda Belum Memilih Roles Field.</p>";
			}
		if($roles=="-Pilih Roles-"){
			echo"<p>Anda Belum Memilih Kode Unit Field.</p>";
			}
	}elseif($d_nip == $nip){
		echo"<p>Maaf NIP Yang Anda Masukan Telah Terdaftar.</p>";	
	}elseif($pwd == $d_pwd){
		echo"<p>Maaf Password Yang Anda Masukan Telah Terdaftar.</p>";	
	}elseif($pwd != $pwd2){
		echo"<p>Maaf Confirm Password Yang Anda Masukan Tidak Sama.</p>";	
	}else{
		$ses_reg = md5('$pwd:$nip');
		mysql_query("INSERT INTO m_login VALUES('$nip','$pwd','$ses_reg','$roles','$kdunit','$dep')")or die(mysql_error());
		echo "<p><strong style='color:green;'>Input User Baru Berhasil.</strong></p>";
	}
}
?>
</div>