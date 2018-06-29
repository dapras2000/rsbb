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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rs = 20;
$pageNum_rs = 0;
if (isset($_GET['pageNum_rs'])) {
  $pageNum_rs = $_GET['pageNum_rs'];
}
$startRow_rs = $pageNum_rs * $maxRows_rs;

$query_rs = "select a.NOMR,a.KDCARABAYAR,b.nama,c.nama as namapasien,c.alamat,c.noktp,d.keluarrs,a.keluarpoly FROM t_pendaftaran a,m_carabayar b,m_pasien c JOIN t_admission d ON (d.keluarrs is null) WHERE  a.kdcarabayar=b.kode and a.nomr=c.nomr and (a.KDCARABAYAR=3 OR a.KDCARABAYAR=4) and a.keluarpoly='00:00:00'";
$query_limit_rs = sprintf("%s LIMIT %d, %d", $query_rs, $startRow_rs, $maxRows_rs);
$rs = mysql_query($query_limit_rs) or die(mysql_error());
$row_rs = mysql_fetch_assoc($rs);

if (isset($_GET['totalRows_rs'])) {
  $totalRows_rs = $_GET['totalRows_rs'];
} else {
  $all_rs = mysql_query($query_rs);
  $totalRows_rs = mysql_num_rows($all_rs);
}
$totalPages_rs = ceil($totalRows_rs/$maxRows_rs)-1;

$queryString_rs = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rs") == false && 
        stristr($param, "totalRows_rs") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rs = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rs = sprintf("&totalRows_rs=%d%s", $totalRows_rs, $queryString_rs);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>VERIFIKASI PERSYARATAN JAMKESMAS</h3></div>
    <br /><div id="tambah" align="center"><a href="#" class="text">TAMBAH DATA PASIEN JAMKESMAS/SKTM</a></div><br />
<table border="0" cellpadding="3" cellspacing="3" width="100%">
  <tr>
    <th>NOMR</th>
    <th>Cara Pembayaran</th>
    <th>Nama Pasien</th>
    <th>Alamat</th>
    <th>Nomer KTP</th>
    <th></th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rs['NOMR']; ?></td>
     
      <td><?php echo $row_rs['nama']; ?></td>
      <td><?php echo $row_rs['namapasien']; ?></td>
      <td><?php echo $row_rs['alamat']; ?></td>
      <td><?php echo $row_rs['noktp']; ?></td>
      <?
      $qselect="SELECT nomr FROM t_jamkesmas_sarat where nomr='".$row_rs['NOMR']."' group by nomr";
	  $hselect=mysql_query($qselect);
	  $jml=mysql_num_rows($hselect);
	  if ($jml >0)
	  {
	   echo "<td><a href=index.php?link=157&nomr=".$row_rs['NOMR']." class=text>SELESAI DIVERIFIKASI</a></td>";
	  }
	  else
	  {
	  ?>
      <td><a href="index.php?link=156&nomr=<?=$row_rs['NOMR'];?>" class="text">VERIFIKASI</a></td>
      <? } ?>
    </tr>
    <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
</table>

<table border="0">
  <tr>
    <td class="text"><?php if ($pageNum_rs > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, 0, $queryString_rs); ?>">First</a>
          <?php } // Show if not first page ?>
    </td>
    <td class="text"><?php if ($pageNum_rs > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, max(0, $pageNum_rs - 1), $queryString_rs); ?>">Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td class="text"><?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, min($totalPages_rs, $pageNum_rs + 1), $queryString_rs); ?>">Next</a>
          <?php } // Show if not last page ?>
    </td>
    <td class="text"><?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, $totalPages_rs, $queryString_rs); ?>">Last</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</div></div>
</body>
</html>
<?php
mysql_free_result($rs);
?>
