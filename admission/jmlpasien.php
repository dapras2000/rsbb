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

$query_rsjml = "SELECT  count(a.nomr) as jpasien FROM t_admission a
inner join  m_pasien b on a.nomr=b.nomr 
inner join  m_carabayar c on a.statusbayar=c.kode 
left join	 icd d on a.icd_masuk=d.icd_code 
inner join   m_ruang e on a.noruang=e.no 
WHERE a.keluarrs is null or a.keluarrs='NULL'";
$rsjml = mysql_query($query_rsjml) or die(mysql_error());
$row_rsjml = mysql_fetch_assoc($rsjml);
$totalRows_rsjml = mysql_num_rows($rsjml);
echo 'Jumlah pasien yang telah terdaftar hari ini : <strong>'.$row_rsjml['jpasien'].'</strong>'; 
mysql_free_result($rsjml);
?>
