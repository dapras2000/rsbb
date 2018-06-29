<?php include("../include/connect.php"); ?>
<?php
$nama=$_POST['namapasien'];
$ruang=$_POST['ruangpasien'];
$dari=$_POST['daricariadmission'];
$sampai=$_POST['sampaicariadmission'];

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

$maxRows_rsad = 20;
$pageNum_rsad = 0;
if (isset($_GET['pageNum_rsad'])) {
  $pageNum_rsad = $_GET['pageNum_rsad'];
}
$startRow_rsad = $pageNum_rsad * $maxRows_rsad;

if ($_POST['Submit']=='Cari Nama')
{
$query_rsad = "SELECT a. id_admission,b.nama as namapasien,a.nomr,b.alamat,a.statusbayar,c.nama as jenisbayar,a.masukrs,a.noruang,e.nama,a.nott,a.icd_masuk,d.jenis_penyakit 
FROM t_admission a
inner join m_pasien b on a.nomr=b.nomr  and (b.nama like '%$nama' or b.nama like '$nama%' or b.nama like '%$nama%')
inner join m_carabayar c on a.statusbayar=c.kode 
inner join m_ruang e on a.noruang=e.no
left join icd d on a.icd_masuk=d.icd_code ";

}
elseif ($_POST['Submit']=='Cari Ruang')
{
$query_rsad = "SELECT a. id_admission,b.nama as namapasien,a.nomr,b.alamat,a.statusbayar,c.nama as jenisbayar,a.masukrs,a.noruang,e.nama,a.nott,a.icd_masuk,d.jenis_penyakit 
FROM t_admission a
inner join m_pasien b on a.nomr=b.nomr 
inner join m_carabayar c on a.statusbayar=c.kode 
inner join m_ruang e on a.noruang=e.no
left join icd d on a.icd_masuk=d.icd_code 
WHERE a.noruang='".$ruang."'";

}
elseif ($_POST['Submit']=='Cari Tanggal')
{
$query_rsad = "SELECT a.id_admission,b.nama as namapasien,a.nomr,b.alamat,a.statusbayar,c.nama as jenisbayar,a.masukrs,a.noruang,e.nama,a.nott,a.icd_masuk,d.jenis_penyakit 
FROM t_admission a
inner join m_pasien b on a.nomr=b.nomr 
inner join m_carabayar c on a.statusbayar=c.kode 
inner join m_ruang e on a.noruang=e.no
left join icd d on a.icd_masuk=d.icd_code 
WHERE a.masukrs between '".$dari."' and '".$sampai."'";

}

$query_limit_rsad = sprintf("%s LIMIT %d, %d", $query_rsad, $startRow_rsad, $maxRows_rsad);
$rsad = mysql_query($query_limit_rsad) or die(mysql_error());
$row_rsad = mysql_fetch_assoc($rsad);

if (isset($_GET['totalRows_rsad'])) {
  $totalRows_rsad = $_GET['totalRows_rsad'];
} else {
  $all_rsad = mysql_query($query_rsad);
  $totalRows_rsad = mysql_num_rows($all_rsad);
}
$totalPages_rsad = ceil($totalRows_rsad/$maxRows_rsad)-1;



$queryString_rsad = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsad") == false && 
        stristr($param, "totalRows_rsad") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsad = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsad = sprintf("&totalRows_rsad=%d%s", $totalRows_rsad, $queryString_rsad);


if ($totalRows_rsad<1)
{	?>
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>HASIL PENCARIAN</h3></div><br />
<? echo "MAAF DATA YANG ANDA CARI TIDAK ADA!<BR><br>"; ?>
<input name="kembali" type="button" value="Kembali" onClick="history.back();" class="text"/>

<BR /><br />
</div></div>
<?
}
else
{

?>




<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>

<body>
<div align="center">
<div id="frame">
	<div id="frame_title">
	  <h3>Hasil Pencarian Data Pasien Rawat Inap</h3>
	</div>

<table border="0" cellpadding="2" cellspacing="2">
  <tr>
    <th>NOMR</th>
    <th>Nama Pasien</th>
    <th>Alamat Pasien</th>
    <th>Jenis Pembayaran</th>
    <th>Tanggal Masuk Rumah Saktit</th>
    <th>Nama Ruangan</th>
    <th>Nomer Tempat Tidur</th>
    <th>icd_masuk</th>
    <? if($_SESSION['KDUNIT']==19){ ?>
    <th>Proses</th>    
    <? } ?>
  </tr>
  <?php do { ?>
    <tr valign="top">
      <td><?php echo $row_rsad['nomr']; ?></td>
      <td><?php echo $row_rsad['namapasien']; ?></td>
      <td><?php echo $row_rsad['alamat']; ?></td>
      <td><?php echo $row_rsad['jenisbayar']; ?></td>
      <td><?php echo $row_rsad['masukrs']; ?></td>
      <td><?php echo $row_rsad['nama']; ?></td>
      <td><?php echo $row_rsad['nott']; ?></td>
      <td><?php echo $row_rsad['icd_masuk']; ?></td>
      <? if($_SESSION['KDUNIT']==19){ ?>
      <td align="center"><a href="index.php?link=121&amp;id_admission=<?php echo $row_rsad['id_admission']?>" ><input type="button" class="text" value="Proses" /></a></td>
	  <? } ?>
    </tr>
    <?php } while ($row_rsad = mysql_fetch_assoc($rsad)); ?>
</table>

<table border="0">
  <tr>
    <td><?php if ($pageNum_rsad > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsad=%d%s", $currentPage, 0, $queryString_rsad); ?>">First</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rsad > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsad=%d%s", $currentPage, max(0, $pageNum_rsad - 1), $queryString_rsad); ?>">Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rsad < $totalPages_rsad) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsad=%d%s", $currentPage, min($totalPages_rsad, $pageNum_rsad + 1), $queryString_rsad); ?>">Next</a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_rsad < $totalPages_rsad) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsad=%d%s", $currentPage, $totalPages_rsad, $queryString_rsad); ?>">Last</a> 
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</div></div>
</body>
</html>
<?php
mysql_free_result($rsad);
}
?>
<br />
<? 
$qry_excel = "SELECT a.id_admission AS INDEX_DAFTAR, 
				a.nomr AS NOMR, 
				b.nama AS NAMA_PASIEN, 
				b.alamat AS ALAMAT, 
				c.nama AS STATUS_BAYAR,
				a.masukrs AS TGL_MASUK,
				a.tgl_pindah AS TGL_PINDAH, 
				e.nama AS RUANG, 
				a.nott AS NO_BED,
				a.icd_masuk AS ICD_MASUK
			FROM t_admission a
			inner join m_pasien b on a.nomr=b.nomr 
			inner join m_carabayar c on a.statusbayar=c.kode 
			left join icd d on a.icd_masuk=d.icd_code 
			inner join m_ruang e on a.noruang=e.no 
			WHERE (a.keluarrs is null or a.keluarrs='NULL') ".$search." ORDER BY a.nott ASC";
?>
<div align="left">
<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$qry_excel?>" />
<input type="hidden" name="header" value="LIST PASIEN RAWAT INAP" />
<input type="hidden" name="filename" value="list_ranap" />
&nbsp;<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>

