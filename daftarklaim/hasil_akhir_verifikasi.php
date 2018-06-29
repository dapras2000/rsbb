<?php include("../include/connect.php");
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

$query_r = "select * from m_saratjamkesmas left join t_jamkesmas_sarat ON kodesarat=sarat and nomr='".$_GET['nomr']."'";
$r = mysql_query($query_r) or die(mysql_error());
$row_r = mysql_fetch_assoc($r);
$totalRows_r = mysql_num_rows($r);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>HASIL VERIFIKASI SARAT</h3></div>
<table border="0" cellpadding="2" cellspacing="2">
  <tr>
    <th>Kode Sarat</th>
    <th>Nama Sarat</th>
    <th>Ketarangan</th>
    <th>Sarat</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_r['kodesarat']; ?></td>
      <td><?php echo $row_r['namasarat']; ?></td>
      <td><?php echo $row_r['keterangan']; ?></td>
      <td><?php echo $row_r['sarat']; ?></td>
    </tr>
    <?php } while ($row_r = mysql_fetch_assoc($r)); ?>
</table>
</div></div>
</body>
</html>
<?php
mysql_free_result($r);
?>
