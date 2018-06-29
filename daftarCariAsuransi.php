<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style2 {
	color: #FFFFFF;
	font-weight: bold;
}
.style3 {
	font-size: small;
	color: #333333;
}
-->
</style>

<div align="center">
  <div id="frame">
  <div id="frame_title">
  <h3 align="left">DATA PASIEN ASURANSI</h3>
    <p align="center">&nbsp;</p>







<?
include ("include/connect.php");
$asuransi= $_GET['asuransi'];
$nama = $_GET['nama'];
$no = $_GET['nopeserta'];
$alamat= $_GET['alamat'];

//if (empty($_GET['nama']) and empty($_GET['nopeserta'])) return false;
if ($_GET['asuransi']==6){
	if (empty($alamat) and empty($nama) and (!empty($no))){
  		$sql = "select dpsnoka, dpsnmctk, dpsjk, dpstgllhr, dpsjln  from m_jamkesda where dpsnoka like '%".$no."%' and kdcrbayar=$asuransi order by dpsnmctk";
	}else if (!empty($nama) and (empty($no)) and (empty($alamat)) ){
  $sql = "select dpsnoka, dpsnmctk, dpsjk, dpstgllhr, dpsjln  from m_jamkesda where dpsnmctk like '%".$nama."%' and kdcrbayar=$asuransi order by dpsnmctk";
}
else if (empty($nama) and (empty($no)) and (!empty($alamat)) ){
  $sql = "select dpsnoka, dpsnmctk, dpsjk, dpstgllhr, dpsjln  from m_jamkesda where dpsjln like '%".$alamat."%' and kdcrbayar=$asuransi order by dpsnmctk";	
}
else if (!empty($nama) and (empty($no)) and (!empty($alamat)) ){
  $sql = "select dpsnoka, dpsnmctk, dpsjk, dpstgllhr, dpsjln from m_jamkesda where dpsnmctk like '%".$nama."%' and dpsjln like '%".$alamat."%' and kdcrbayar=$asuransi order by dpsnmctk";
}
else if (empty($nama) and (!empty($no)) and (!empty($alamat)) ){
  $sql = "select dpsnoka, dpsnmctk, dpsjk, dpstgllhr, dpsjln from m_jamkesda where dpsnoka like '%".$no."%' and dpsjln like '%".$alamat."%' and kdcrbayar=$asuransi order by dpsnmctk";
}

else if (!empty($nama) and (!empty($no)) and (empty($alamat)) ){
  $sql = "select dpsnoka, dpsnmctk, dpsjk, dpstgllhr, dpsjln from m_jamkesda where dpsnmctk like '%".$nama."%' and dpsnoka like '%".$no."%' and kdcrbayar=$asuransi order by dpsnmctk";
}

else if (!empty($nama) and (!empty($no)) and (!empty($alamat)) ){
  $sql = "select dpsnoka, dpsnmctk, dpsjk, dpstgllhr, dpsjln from m_jamkesda where dpsnmctk like '%".$nama."%' and dpsnoka like '%".$no."%' and dpsjln like '%".$alamat."%' and kdcrbayar=$asuransi order by dpsnmctk";
}
else return false;
}

else if ($_GET['asuransi']==7){
if (empty($alamat) and empty($nama) and (!empty($no))){
  $sql = "select nokk as dpsnoka, namalengkap as dpsnmctk, jeniskelamin as dpsjk, tgllahir as dpstgllhr, alamat as dpsjln,desa  from m_jamkesdasilver where nokk like '%".$no."%' and kdcrbayar=$asuransi order by namalengkap";
}
else if (!empty($nama) and (empty($no)) and (empty($alamat)) ){
  $sql = "select nokk as dpsnoka, namalengkap as dpsnmctk, jeniskelamin as dpsjk, tgllahir as dpstgllhr, alamat as dpsjln, desa  from m_jamkesdasilver where namalengkap like '%".$nama."%' and kdcrbayar=$asuransi order by namalengkap";
}
else if (empty($nama) and (empty($no)) and (!empty($alamat)) ){
  $sql = "select nokk as dpsnoka, namalengkap as dpsnmctk, jeniskelamin as dpsjk, tgllahir as dpstgllhr, alamat as dpsjln, desa  from m_jamkesdasilver where alamat like '%".$alamat."%' and kdcrbayar=$asuransi order by namalengkap";
}
else if (!empty($nama) and (empty($no)) and (!empty($alamat)) ){
  $sql = "select nokk as dpsnoka, namalengkap as dpsnmctk, jeniskelamin as dpsjk, tgllahir as dpstgllhr, alamat as dpsjln, desa from m_jamkesdasilver where namalengkap like '%".$nama."%' and alamat like '%".$alamat."%' and kdcrbayar=$asuransi order by namalengkap";
}
else if (empty($nama) and (!empty($no)) and (!empty($alamat)) ){
  $sql = "select nokk as dpsnoka, namalengkap as dpsnmctk, jeniskelamin as dpsjk, tgllahir as dpstgllhr, alamat as dpsjln, desa from m_jamkesdasilver where nokk like '%".$no."%' and alamat like '%".$alamat."%' and kdcrbayar=$asuransi order by namalengkap";
}
else if (!empty($nama) and (!empty($no)) and (empty($alamat)) ){
  $sql = "select nokk as dpsnoka, namalengkap as dpsnmctk, jeniskelamin as dpsjk, tgllahir as dpstgllhr, alamat as dpsjln, desa from m_jamkesdasilver where namalengkap like '%".$nama."%' and nokk like '%".$no."%' and kdcrbayar=$asuransi order by namalengkap";
}
else if (!empty($nama) and (!empty($no)) and (!empty($alamat)) ){
  $sql = "select nokk as dpsnoka, namalengkap as dpsnmctk, jeniskelamin as dpsjk, tgllahir as dpstgllhr, alamat as dpsjln, desa from m_jamkesdasilver where namalengkap like '%".$nama."%' and nokk like '%".$no."%' and alamat like '%".$alamat."%' and kdcrbayar=$asuransi order by namalengkap";
}
else return false;
}
else return false;
$result = mysql_query($sql) or die ("error:". mysql_error());
$num_rows = mysql_num_rows($result);

   if($num_rows == 0)
   {
   		echo '<h3><font color="Red">Tidak Diketemukan</font></h3><br><br>';
		//echo '<FORM action = "index.php?link=2" method="post"><INPUT type=submit value=" Gunakan Form Pendaftaran "></FORM>';
   		 
   }
   else 
   {
		//echo $row['nama_lgkp'];
		include 'list_peserta_asuransi.php';
   }
	
?>	


		</div>
	</div>
</div>