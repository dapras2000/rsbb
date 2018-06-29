<div style="border:1px solid #DF7; padding:5px; margin:5px; color:#F30; width:90%; background-color:#FFF;" align="left">
<?php
include("../include/connect.php");

$edit    = $_POST['edit'];
$id      = $_POST['id'];
$jenis   = $_POST['jns_makanan'];

if(!empty($edit)){

	mysql_query("UPDATE m_bahan_makanan SET jenis_makanan ='$jenis' WHERE id='$id'")or die(mysql_error());
	echo "<p><strong style='color:green;'>Edit Jenis Makanan Berhasil.</strong></p>";
	}else{
	// validasi input user :
	if($jenis==""){
		echo "<p><b>Anda belum Mengisi Data Dengan Lengkap : </b></p>";
		if($jenis==""){
			echo"<p>Anda Belum Mengisi Jenis Barang.</p>";
			}
	}else{
		
		//$a = str_replace("","+",$jenis);
		//echo $a;
		//die;
		mysql_query("INSERT INTO m_jenis_makanan (jenis_makanan) VALUES('$jenis')")or die(mysql_error());
		//echo "<p><strong style='color:green;'>Input Jenis Makanan Berhasil.</strong></p>";
	}
}

?>

<SCRIPT language="JavaScript">
alert("Data Telah Disimpan.");
window.location="../index.php?link=add_jenis_makanan";
</script>

</div>