<?php include("../include/connect.php"); ?>
<?php
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

$query_tm = "SELECT kode_jasa,nama_jasa,tarif FROM `m_tarif` WHERE `group_jasa` LIKE '0108%'";
$tm = mysql_query($query_tm) or die(mysql_error());
$row_tm = mysql_fetch_assoc($tm);
$totalRows_tm = mysql_num_rows($tm);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align="center">
  <div id="frame">
  <div id="frame_title">
  <h3 align="left">Tarif Tindakan Medis</h3></div>
  <form id="form1" name="form1" method="post" action="operasi/tambah_tindakan_medis.php">
    <table border="0" cellpadding="2" cellspacing="2" width="70%">
      <tr>
        <th>KODE JASA</th>
        <th>NAMA JASA</th>
        <th><div align="center">TARIF</div></th>
        <th></th>
      </tr>
      <?php do { ?>
      <tr>
        <td><?php echo $row_tm['kode_jasa']; ?></td>
        <td><strong><?php echo $row_tm['nama_jasa']; ?></strong></td>
        <td><div align="right"><?php echo $row_tm['tarif']; ?></div></td>
        <td><label>
        <input name="idoperasi" type="hidden" value="<?php echo $_GET['idoperasi'];?>" />
        <input name="kodejasa" type="hidden" value="<?php echo $row_tm['kode_jasa']; ?>" />
        <input name="namajasa[]" type="hidden" value="<?php echo $row_tm['nama_jasa']; ?>" />
        <input name="tarif" type="hidden" value="<?php echo $row_tm['tarif']; ?>" />
        <input type="checkbox" name="kd[]" value="<?php echo $row_tm['kode_jasa']; ?>"/>
        </label></td>
      </tr>
      <tr>      </tr>
      <?php } while ($row_tm = mysql_fetch_assoc($tm)); ?>
    </table>
   
      <label>
      <input type="submit" name="pilih" id="pilihtindakan" value="PILIH TINDAKAN MEDIS"/>
      </label>
  
  </form>
  <p>&nbsp;</p>
  </div></div>
</body>
</html>
<?php
mysql_free_result($tm);
?>
