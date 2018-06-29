<html>
<head><title>Hasil Pencarian Data Penduduk</title>
<style type="text/css">
<!--
.style2 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>




<?

include ("include/keDbSiak.php");

if (!$nik = $_POST['nik']){
	$nik = $_GET['nik'];
}
$sql = "select * from biodata_wni where nik = '".$nik."'";
$result = mysql_query($sql) or die ("error:". mysql_error());
$row=mysql_fetch_array($result);$num_rows = mysql_num_rows($result);



?>
<style type="text/css">
<!--
.style1 {font-family: Verdana, Arial, Helvetica, sans-serif}
-->
</style>
<div align="center">
  <div id="frame">
  <div id="frame_title">
  <h3 align="left">DATA PENDUDUK</h3>
    <p align="center">&nbsp;</p>
    



<table width="50%" border="0" cellspacing="1" cellpadding="0" align="center">
  
  <tr>
    <td colspan="3" background="img/frame_title.png"><div align="center" class="style2">Data Penduduk : 
          <? 


   if($num_rows == 0)
   {
   		echo '<font color="Yellow">Tidak Diketemukan</font><br><br><FORM action = "index.php?link=2" method="post"><INPUT type=submit value=" Gunakan Form Pendaftaran "></FORM>';
   		 
   }
   else 
   {
		echo $row['nama_lgkp'];
		include 'listPenduduk.php';
   }
	
	 ?>	
    </div></td>
    </tr>
		</div>
	</div>
</div>

</html>