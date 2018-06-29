<div style="border:1px solid #DF7; padding:5px; margin:5px; color:#F30; width:90%; background-color:#FFF;" align="left">
<?php
include("../include/connect.php");

$edit    = $_POST['edit'];
$id      = $_POST['id'];
$tgl	 = $_POST['tgl_rencana'];
$jenis   = $_POST['nm_barang'];
$sat	 = $_POST['satuan'];
$jml     = $_POST['jml'];
$hrg	 = $_POST['hrg_sat'];
$jml_hrg = $_POST['jml_hrg'];


if(!empty($edit)){
/*	if($nama == $nama){
		echo"<p>Maaf Confirm Password Yang Anda Masukan Tidak Sama.</p>";	
	}else{*/
	//mysql_query("UPDATE m_pantri SET nama_makanan ='".$_POST['nama']."', spesifikasi = '$speks', merk = '$merk', satuan = '$sat', harga='$harga' WHERE nama_makanan='$nama'")or die(mysql_error());
	mysql_query("UPDATE m_bahan_makanan SET tanggal='$tgl', jenis_barang ='$jenis', satuan = '$sat', jumlah = '$jml', harga_satuan = '$hrg', jumlah_harga='$jml_hrg' WHERE id='$id'")or die(mysql_error());
	echo "<p><strong style='color:green;'>Edit Bahan Makanan Berhasil.</strong></p>";
	}else{
	// validasi input user :
	if($jenis=="" || $sat=="" || $jml==""  || $hrg=="" || $jml_hrg==""){
		echo "<p><b>Anda belum Mengisi Data Dengan Lengkap : </b></p>";
		if($jenis==""){
			echo"<p>Anda Belum Mengisi Jenis Barang.</p>";
			}
		if($sat==""){
			echo"<p>Anda Belum Memilih Satuan.</p>";
			}
		if($jml==""){
			echo"<p>Anda Belum Mengisi Jumlah.</p>";
			}
		if($hrg==""){
			echo"<p>Anda Belum Mengisi Harga Satuan.</p>";
			}
		if($jml_hrg==""){
			echo"<p>Anda Belum Mengisi Jumlah Harga.</p>";
		}
	//}//elseif($d_nama == $nama){
	//	echo"<p>Maaf Nama Makanan Yang Anda Masukan Telah Terdaftar.</p>";	
	//}
	}else{
	$date = date('Y-m-d', strtotime($tgl));
		mysql_query("INSERT INTO m_bahan_makanan (jenis_barang,satuan,jumlah,harga_satuan,jumlah_harga,tanggal) VALUES('$jenis','$sat','$jml','$hrg','$jml_hrg','$date')")or die(mysql_error());
	?>
<SCRIPT language="JavaScript">
alert("Data Telah Disimpan.");
window.location="../index.php?link=add_rencana_makanan";
</script>
<?php
	}
}
?>
</div>