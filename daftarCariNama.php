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
  <h3 align="left">DATA PENDUDUK</h3>
    <p align="center">&nbsp;</p>







<?
include ("include/keDbSiak.php");

$nama = $_POST['nama'];
$tgl = $_POST['tgl'];


$sql = "select * from biodata_wni where nama_lgkp like '".$nama."%' and tgl_lhr = '".$tgl."'";
$result = mysql_query($sql) or die ("error:". mysql_error());
$num_rows = mysql_num_rows($result);

   if($num_rows == 0)
   {
   		echo '<h3><font color="Red">Tidak Diketemukan</font></h3><br><br>';
		echo '<FORM action = "index.php?link=2" method="post"><INPUT type=submit value=" Gunakan Form Pendaftaran "></FORM>';
   		 
   }
   else 
   {
		//echo $row['nama_lgkp'];
		include 'listNamaPenduduk.php';
   }
	
?>	


		</div>
	</div>
</div>