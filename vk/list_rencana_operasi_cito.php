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

$query_rs = "select a.id_operasi, date_format(a.tanggal,'%d-%m-%Y') as tanggal,a.nomr,b.nama,a.diagnosa,a.dokteroperator,a.dokteranastesi ,a.keteranganpasien, a.status, a.cito from t_operasi_cito a, m_pasien b where a.nomr=b.nomr";
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
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align="center">
  <div id="frame">
  <div id="frame_title">
  <h3 align="left">RENCANA OPERASI CITO/KURET</h3></div>
<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2">
  <tr>
    <th>Tanggal Operasi</th>
    <th>NOMR</th>
    <th>Nama Pasien</th>
    <th>Diagnosa</th>
    <th>Dokter Operator</th>
    <th>Dokter Anastesi</th>
    <th>Cara Bayar</th>
    <th>Jenis Operasi</th>
    <th>&nbsp;</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rs['tanggal']; ?></td>
      <td><?php echo $row_rs['nomr']; ?></td>
      <td><?php echo $row_rs['nama']; ?></td>
      <td><?php echo $row_rs['diagnosa']; ?></td>
      <td><?php echo $row_rs['dokteroperator']; ?></td>
      <td><?php echo $row_rs['dokteranastesi']; ?></td>
      <td><?php echo $row_rs['keteranganpasien']; ?></td>
      <td><?php if($row_rs['cito']=="1"){ echo "Cito";
	  }else{ echo "Kuret"; } ?></td>
      <td><?php if($row_rs['status']=="batal"){ echo "Batal"; 
	  }else{
	  ?><div id="div<?=$row_rs['id_operasi']?>">
	  <a href="#" onClick="javascript: MyAjaxRequest('div<?=$row_rs['id_operasi']?>','vk/status_operasi_cito.php?idxoperasi=<?=$row_rs['id_operasi']?>'); return false;" ><input type="button" value="BATAL" class="text" /></a></div>
	  <?
	  }?></td>
      <td><a href="#" ></a></td>
    </tr>
    <?php } while ($row_rs = mysql_fetch_assoc($rs)); ?>
</table>

<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_rs > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, 0, $queryString_rs); ?>">First</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rs > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, max(0, $pageNum_rs - 1), $queryString_rs); ?>">Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rs=%d%s", $currentPage, min($totalPages_rs, $pageNum_rs + 1), $queryString_rs); ?>">Next</a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_rs < $totalPages_rs) { // Show if not last page ?>
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
