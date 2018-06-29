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

$maxRows_rsradio = 25;
$pageNum_rsradio = 0;
if (isset($_GET['pageNum_rsradio'])) {
  $pageNum_rsradio = $_GET['pageNum_rsradio'];
}
$startRow_rsradio = $pageNum_rsradio * $maxRows_rsradio;
if ($_POST['Submit']=='Cari[1]')
{
	
//echo $_POST['carab'];
/*$query_rsradio = "SELECT a.idxorderrad,a.nomr, b.nama as namapasien, b.jeniskelamin, a.polypengirim,e.nama, c.namadokter, d.nama_rad as nama_rad, 
       f.kdcarabayar,g.nama as carabayar,a.tglperiksa,a.tglambil,a.jenisfilm,a.jumlahfilm_baik,a.jumlahfilm_rusak,a.jumlahfilm_rusak,a.hasilresume,
       h.namapetugas ,h.keterangan 
FROM t_radiologi a inner join  m_pasien b on a.nomr = b.nomr 
inner join m_dokter c on c.kddokter = a.drpengirim 
inner join m_radiologi d on a.jenisphoto = d.kd_rad 
inner join m_poly e on a.polypengirim=e.kode 
inner join t_pendaftaran f on a.idxdaftar=f.idxdaftar and a.nomr=f.nomr 
inner join m_carabayar g on f.kdcarabayar=g.kode 
left join  t_radiologi_petugas h on  a.idxorderrad=h.idxorderrad
WHERE a.jenisfilm <>'' and f.kdcarabayar='".$_POST['carab']."'"; */


$query_rsradio = "SELECT a.idxorderrad,a.nomr, b.nama as namapasien, b.jeniskelamin, a.polypengirim,e.nama, c.namadokter,  d.nama_rad as nama_rad, f.kdcarabayar,g.nama as carabayar,a.tglperiksa,a.tglambil,a.jenisfilm,a.jumlahfilm_baik,a.jumlahfilm_rusak,a.jumlahfilm_rusak,a.hasilresume,
(select namapetugas from t_radiologi_petugas where idxorderrad = a.idxorderrad and keterangan = 'DOKTER' limit 1) as rad_dokter,
(select namapetugas from t_radiologi_petugas where idxorderrad = a.idxorderrad and keterangan = 'PETUGAS' limit 1) as rad_petugas
FROM t_radiologi a, m_pasien b, m_dokter c, m_radiologi d,m_poly e,t_pendaftaran f, m_carabayar g WHERE a.nomr = b.nomr AND c.kddokter = a.drpengirim AND a.jenisphoto = d.kd_rad AND a.polypengirim=e.kode AND a.nomr=f.nomr and a.idxdaftar=f.idxdaftar and f.kdcarabayar=g.kode and a.jenisfilm <>'' and f.kdcarabayar='".$_POST['carab']."'";

}
elseif ($_POST['Submit']=='Cari[2]')
{
//echo $_POST['jp'];
$query_rsradio = "SELECT a.idxorderrad,a.nomr, b.nama as namapasien, b.jeniskelamin, a.polypengirim,e.nama, c.namadokter,  d.nama_rad as nama_rad, f.kdcarabayar,g.nama as carabayar,a.tglperiksa,a.tglambil,a.jenisfilm,a.jumlahfilm_baik,a.jumlahfilm_rusak,a.hasilresume,
(select namapetugas from t_radiologi_petugas where idxorderrad = a.idxorderrad and keterangan = 'DOKTER' limit 1) as rad_dokter,
(select namapetugas from t_radiologi_petugas where idxorderrad = a.idxorderrad and keterangan = 'PETUGAS' limit 1) as rad_petugas
FROM t_radiologi a, m_pasien b, m_dokter c, m_radiologi d,m_poly e,t_pendaftaran f, m_carabayar g WHERE a.nomr = b.nomr AND c.kddokter = a.drpengirim AND a.jenisphoto = d.kd_rad AND a.polypengirim=e.kode AND a.nomr=f.nomr and a.idxdaftar=f.idxdaftar and f.kdcarabayar=g.kode and a.jenisfilm <>'' and d.kd_rad='".$_POST['jp']."'";
}
elseif ($_POST['Submit']=='Cari[3]')
{
//echo $_POST['jenisfilm'];
$query_rsradio = "SELECT a.idxorderrad,a.nomr, b.nama as namapasien, b.jeniskelamin, a.polypengirim,e.nama, c.namadokter,  d.nama_rad as nama_rad, f.kdcarabayar,g.nama as carabayar,a.tglperiksa,a.tglambil,a.jenisfilm,a.jumlahfilm_baik,a.jumlahfilm_rusak, a.hasilresume,
(select namapetugas from t_radiologi_petugas where idxorderrad = a.idxorderrad and keterangan = 'DOKTER' limit 1) as rad_dokter,
(select namapetugas from t_radiologi_petugas where idxorderrad = a.idxorderrad and keterangan = 'PETUGAS' limit 1) as rad_petugas
FROM t_radiologi a, m_pasien b, m_dokter c, m_radiologi d,m_poly e,t_pendaftaran f, m_carabayar g WHERE a.nomr = b.nomr AND c.kddokter = a.drpengirim AND a.jenisphoto = d.kd_rad AND a.polypengirim=e.kode AND a.nomr=f.nomr and a.idxdaftar=f.idxdaftar and f.kdcarabayar=g.kode and a.jenisfilm <>'' and a.jenisfilm='".$_POST['jenisfilm']."'";
}

elseif ($_POST['Submit']=='Cari[4]')
{
//echo $_POST['theDate'];
$query_rsradio = "SELECT a.idxorderrad,a.nomr, b.nama as namapasien, b.jeniskelamin, a.polypengirim,e.nama, c.namadokter,  d.nama_rad as nama_rad, f.kdcarabayar,g.nama as carabayar,a.tglperiksa,a.tglambil,a.jenisfilm,a.jumlahfilm_baik,a.jumlahfilm_rusak,a.jumlahfilm_rusak, a.hasilresume,
(select namapetugas from t_radiologi_petugas where idxorderrad = a.idxorderrad and keterangan = 'DOKTER' limit 1) as rad_dokter,
(select namapetugas from t_radiologi_petugas where idxorderrad = a.idxorderrad and keterangan = 'PETUGAS' limit 1) as rad_petugas
FROM t_radiologi a, m_pasien b, m_dokter c, m_radiologi d,m_poly e,t_pendaftaran f, m_carabayar g WHERE a.nomr = b.nomr AND c.kddokter = a.drpengirim AND a.jenisphoto = d.kd_rad AND a.polypengirim=e.kode AND a.nomr=f.nomr and a.idxdaftar=f.idxdaftar and f.kdcarabayar=g.kode and a.jenisfilm <>'' and a.tglperiksa BETWEEN '".$_POST['theDate']."' AND '".$_POST['tglsampai']."'";


}


$query_limit_rsradio = sprintf("%s LIMIT %d, %d", $query_rsradio, $startRow_rsradio, $maxRows_rsradio);
$rsradio = mysql_query($query_limit_rsradio) or die(mysql_error());
$row_rsradio = mysql_fetch_assoc($rsradio);




if (isset($_GET['totalRows_rsradio'])) {
  $totalRows_rsradio = $_GET['totalRows_rsradio'];
} else {
  $all_rsradio = mysql_query($query_rsradio);
  $totalRows_rsradio = mysql_num_rows($all_rsradio);
}
$totalPages_rsradio = ceil($totalRows_rsradio/$maxRows_rsradio)-1;

$queryString_rsradio = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsradio") == false && 
        stristr($param, "totalRows_rsradio") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsradio = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsradio = sprintf("&totalRows_rsradio=%d%s", $totalRows_rsradio, $queryString_rsradio);

if ($totalRows_rsradio<1)
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>HASIL FOTO RADIOLOGI</h3></div>

<table class="tb" border="0" cellpadding="1" cellspacing="2">
  <tr>
    <th rowspan="2">NOMR</th>
    <th rowspan="2">Nama Pasien</th>
    <th rowspan="2">Jenis Kelamin</th>
    <th rowspan="2">Nama Poliklinik Pengirim</th>
    <th rowspan="2">Nama Dokter Pengirim</th>
    <th rowspan="2">No Film</th>
    <th rowspan="2">Permintaan Photo</th>
    <th rowspan="2">Cara Pembayaran</th>
    <th rowspan="2">Jenis Film</th>
    <th colspan="2">Jumlah Film</th>
    <th rowspan="2">Dokter Radiologi</th>
    <th rowspan="2">Petugas</th>
    <th rowspan="2">Keterangan</th>
  </tr>
  <tr>
    <th> Baik</th>
    <th>Rusak</th>
    </tr>
  <?php do { ?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
      <td><?php echo $row_rsradio['nomr']; ?></td>
      <td><?php echo $row_rsradio['namapasien']; ?></td>
      <td><?php echo $row_rsradio['jeniskelamin']; ?></td>
      <td><?php echo $row_rsradio['nama']; ?></td>
      <td><?php echo $row_rsradio['namadokter']; ?></td>
<?           
$no_film = substr("00000",0,5-strlen($row_rsradio['idxorderrad'])).$row_rsradio['idxorderrad'];
?>           
      <td><?=$no_film?></td>
      <td><?php echo $row_rsradio['nama_rad']; ?></td>
      <td><?php echo $row_rsradio['carabayar']; ?></td>
      <td><?php echo $row_rsradio['jenisfilm']; ?></td>
       <td><?php echo $row_rsradio['jumlahfilm_baik']; ?></td>
       <td><?php echo $row_rsradio['jumlahfilm_rusak']; ?></td>
       <td><?php echo $row_rsradio['rad_dokter']; ?></td>
       <td><?php echo $row_rsradio['rad_petugas']; ?></td>
      <td><?php echo substr($row_rsradio['hasilresume'],0,30); ?></td>
      
    <?php } while ($row_rsradio = mysql_fetch_assoc($rsradio)); ?>
</table>

<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_rsradio > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsradio=%d%s", $currentPage, 0, $queryString_rsradio); ?>">First</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rsradio > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsradio=%d%s", $currentPage, max(0, $pageNum_rsradio - 1), $queryString_rsradio); ?>">Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rsradio < $totalPages_rsradio) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsradio=%d%s", $currentPage, min($totalPages_rsradio, $pageNum_rsradio + 1), $queryString_rsradio); ?>">Next</a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_rsradio < $totalPages_rsradio) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsradio=%d%s", $currentPage, $totalPages_rsradio, $queryString_rsradio); ?>">Last</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</div></div>
</body>
</html>
<?php
mysql_free_result($rsradio);}
?>
