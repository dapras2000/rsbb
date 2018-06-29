<div style="border:1px solid #DF7; padding:5px; margin:5px; color:#F30; width:90%; background-color:#FFF;" align="left">
<?php
include("../include/connect.php");

//mengambil data dari tabel m_login
//$datalogin  = mysql_query("SELECT * FROM m_pantri")or die(mysql_error());
//$listlogin  = mysql_fetch_assoc($datalogin);

//$d_pwd    = $listlogin['PWD'];
//$d_sesreg = $listlogin['SES_REG'];
//if($_POST['simpan']) {
//$nama     = $_POST['nama'];
//$speks    = $_POST['spek'];
//$merk     = $_POST['merk'];
//$sat	  = $_POST['satuan'];
//$harga 	  = $_POST['harga'];

$edit    = $_POST['edit'];
$id      = $_POST['id'];
$nama    = $_POST['nama'];
$speks   = $_POST['spek'];
$merk    = $_POST['merk'];
$sat	 = $_POST['satuan'];
$harga 	 = $_POST['harga'];


if(!empty($edit)){
/*	if($nama == $nama){
		echo"<p>Maaf Confirm Password Yang Anda Masukan Tidak Sama.</p>";	
	}else{*/
	//mysql_query("UPDATE m_pantri SET nama_makanan ='".$_POST['nama']."', spesifikasi = '$speks', merk = '$merk', satuan = '$sat', harga='$harga' WHERE nama_makanan='$nama'")or die(mysql_error());
	mysql_query("UPDATE m_pantri SET nama_makanan ='$nama', spesifikasi = '$speks', merk = '$merk', satuan = '$sat', harga='$harga' WHERE id='$id'")or die(mysql_error());
	echo "<p><strong style='color:green;'>Edit Makanan Berhasil.</strong></p>";
	}else{
	// validasi input user :
	if($nama=="" || $speks=="" || $sat==""  || $harga==""){
		echo "<p><b>Anda belum Mengisi Data Dengan Lengkap : </b></p>";
		if($nama==""){
			echo"<p>Anda Belum Mengisi Nama Makanan.</p>";
			}
		if($speks==""){
			echo"<p>Anda Belum Mengisi Spesifikasi.</p>";
			}
		/*if($merk==""){
			echo"<p>Anda Belum Mengisi Merk.</p>";
			}*/
		if($sat==""){
			echo"<p>Anda Belum Memilih Satuan.</p>";
			}
		if($harga==""){
			echo"<p>Anda Belum Mengisi Harga.</p>";
		}
	}elseif($d_nama == $nama){
		echo"<p>Maaf Nama Makanan Yang Anda Masukan Telah Terdaftar.</p>";	
	//}
	}else{
	//	insert into m_pantri (nama_makanan,spesifikasi,merk,satuan,harga) VALUES ('ghjj','gjhj','jhj','Kg','65767')
/*	if(trim($_POST['nama']) != ''){
		mysql_query("UPDATE m_pantri SET nama_makanan ='$nama', spesifikasi = '$spek', merk = '$merk', satuan = '$sat', harga='$harga' WHERE nama_makanan='$nama'")or die(mysql_error());
		echo "<p><strong style='color:green;'>Edit Makanan Berhasil.</strong></p>";
	}else{*/
		mysql_query("INSERT INTO m_pantri (nama_makanan,spesifikasi,merk,satuan,harga) VALUES('$nama','".$_POST['spek']."','$merk','$sat','$harga')")or die(mysql_error());
		//echo "<p><strong style='color:green;'>Input Nama Makanan Berhasil.</strong></p>";
	}
}

?>
<SCRIPT language="JavaScript">
alert("Data Telah Disimpan.");
window.location="../index.php?link=add_pantri";
</script>

</div>