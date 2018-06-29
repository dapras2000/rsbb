<?php include("../include/connect.php"); ?>
<?php
echo $_POST['t'];
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

$maxRows_h = 30;
$pageNum_h = 0;
if (isset($_GET['pageNum_h'])) {
  $pageNum_h = $_GET['pageNum_h'];
}
$startRow_h = $pageNum_h * $maxRows_h;

$query_h = "select a.*,b.* from t_jadwaldokter a, m_dokter b where a.iddokter=b.kddokter and a.tanggal='".$_POST['tgl1']."'";
$query_limit_h = sprintf("%s LIMIT %d, %d", $query_h, $startRow_h, $maxRows_h);
$h = mysql_query($query_limit_h) or die(mysql_error());
$row_h = mysql_fetch_assoc($h);

if (isset($_GET['totalRows_h'])) {
  $totalRows_h = $_GET['totalRows_h'];
} else {
  $all_h = mysql_query($query_h);
  $totalRows_h = mysql_num_rows($all_h);
}
$totalPages_h = ceil($totalRows_h/$maxRows_h)-1;

@include('lihatjadwal.php');
if ($totalRows_h>0)
{
?>
<br />
<br />

<div align="center" style="width:100%;">
    <div id="frame">
    <div id="frame_title"><h3>Lihat Hasil Jadwal Dokter</h3></div>

  <table width="95%" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">
  <tr>
    <th rowspan="2"><div align="center">KD DOKTER</div></th>
    <th rowspan="2"><div align="center">NAMA DOKTER</div></th>
    <th colspan="31"><div align="center">TANGGAL</div></th>
    </tr>
  <tr>
    <th><div align="center">01</div></th>
    <th><div align="center">02</div></th>
    <th><div align="center">03</div></th>
    <th><div align="center">04</div></th>
    <th><div align="center">05</div></th>
    <th><div align="center">06</div></th>
    <th><div align="center">07</div></th>
    <th><div align="center">08</div></th>
    <th><div align="center">09</div></th>
    <th><div align="center">10</div></th>
    <th><div align="center">11</div></th>
    <th><div align="center">12</div></th>
    <th><div align="center">13</div></th>
    <th><div align="center">14</div></th>
    <th><div align="center">15</div></th>
    <th><div align="center">16</div></th>
    <th><div align="center">17</div></th>
    <th><div align="center">18</div></th>
    <th><div align="center">19</div></th>
    <th><div align="center">20</div></th>
    <th><div align="center">21</div></th>
    <th><div align="center">22</div></th>
    <th><div align="center">23</div></th>
    <th><div align="center">24</div></th>
    <th><div align="center">25</div></th>
    <th><div align="center">26</div></th>
    <th><div align="center">27</div></th>
    <th><div align="center">28</div></th>
    <th><div align="center">29</div></th>
    <th><div align="center">30</div></th>
    <th><div align="center">31</div></th>
  </tr>
  <?php do { ?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>      <td><div align="center"><?php echo $row_h['NAMADOKTER']; ?></div></td>
      <td><div align="center"><?php echo $row_h['tanggal']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t1']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t2']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t3']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t4']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t5']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t6']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t7']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t8']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t9']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t10']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t11']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t12']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t13']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t14']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t15']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t16']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t17']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t18']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t19']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t20']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t21']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t22']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t23']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t24']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t25']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t26']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t27']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t28']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t29']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t30']; ?></div></td>
      <td><div align="center"><?php echo $row_h['t31']; ?></div></td>
    </tr>
    <?php } while ($row_h = mysql_fetch_assoc($h)); ?>
</table>
</div>
</div>
<?php
mysql_free_result($h);
}
?>
