<?php 
include '../include/connect.php';
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$query_rsruang = "select * from m_ruang";
$rsruang = mysql_query($query_rsruang) or die(mysql_error());
$row_rsruang = mysql_fetch_assoc($rsruang);
$totalRows_rsruang = mysql_num_rows($rsruang);
?><div align="center">
<div id="frame" align="center">
	<div id="frame_title"><h3>PEMAKAIAN RUANGAN HARI INI</h3></div>
<table width="80%" border="1" align="center" cellpadding="1" class="tb" cellspacing="1">
  <tr>
    <th width="78"><div align="center">No</div></th>
    <th width="95"><div align="center">Nama </div></th>
    <th width="94"><div align="center">Kelas</div></th>
    <th width="137"><div align="center">Ruang</div></th>
    <th width="338"><div align="center">Jumlah Tempat Tidur</div></th>
  </tr>
  <?php do { ?>
    <tr bgcolor="#FFF9DF">
      <td><div align="center"><?php echo $row_rsruang['no']; ?></div></td>
      <td><div align="center"><?php echo $row_rsruang['nama']; ?></div></td>
      <td><div align="center"><?php echo $row_rsruang['kelas']; ?></div></td>
      <td><div align="center"><?php echo $row_rsruang['ruang']; ?></div></td>
      <td><div align="left">
        <?
	  	$idx=$row_rsruang['no'];
		$namarg=$row_rsruang['nama'];
      	mysql_select_db($database_conrawatinap);
		$detail="SELECT idxruang,no_tt FROM m_detail_tempat_tidur WHERE idxruang='".$idx."'";
	  	$result=mysql_query($detail);
		while($brs=@mysql_fetch_array($result))
		{
		 $seleksi="SELECT id_admission FROM t_admission WHERE noruang='".$idx."' AND nott='".$brs['no_tt']."' AND keluarrs IS NULL";
		 $hasilseleksi=mysql_query($seleksi);
		 $jumlahseleksi=mysql_num_rows($hasilseleksi);
		 if ($jumlahseleksi>0)
		 {
		 echo "<input style='background-color:#CC0000; border-style:solid;' type=button name=button id=".$brs['no_tt']." value=" . $brs['no_tt'] . " disabled>";
		 }
		 else
		 {	
		 $gy=substr($brs['no_tt'],-2);
		 if ($gy=='EB')
		 {
		 $gaya="style=background-color:#33CC00; border-style:solid;";
		 }
		 elseif ($gy=='BB')
		 {
		 $gaya="style=background-color:#33CC00; border-style:solid;";

		 }
		 else
		 {
		$gaya="style=background-color:#33CC00; width:40px; border-style:solid;";

		 }
		 
		
echo "<input $gaya type=button name=button id=".$brs['no_tt']." value=".$brs['no_tt']." onclick=window.location.href='?link=17g&idruang=".$brs['idxruang']."&p=daftar&idx=".$_GET['no']."&no_tt=".$brs['no_tt']."&namaruang=".$namarg."';>";
			}
			
		}
	  ?>
      </div></td>
    </tr>
    <tr>
      <td colspan="5">&nbsp;</td>
    </tr>
    <?php } while ($row_rsruang = mysql_fetch_assoc($rsruang)); ?>
</table>
</div>
</div>
<?php
mysql_free_result($rsruang);
?>
