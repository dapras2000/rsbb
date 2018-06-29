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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsicd = 20;
$pageNum_rsicd = 0;
if (isset($_GET['pageNum_rsicd'])) {
  $pageNum_rsicd = $_GET['pageNum_rsicd'];
}
$startRow_rsicd = $pageNum_rsicd * $maxRows_rsicd;

if($_POST['c'] != '')
{
$cr=$_POST['c'];
$query_rsicd = "select icd_code,jenis_penyakit from icd where jenis_penyakit like '%$cr' or jenis_penyakit like '$cr%' or jenis_penyakit like '%$cr%'";
}
else
{
$query_rsicd = "select icd_code,jenis_penyakit from icd";

}

$query_limit_rsicd = sprintf("%s LIMIT %d, %d", $query_rsicd, $startRow_rsicd, $maxRows_rsicd);
$rsicd = mysql_query($query_limit_rsicd) or die(mysql_error());
$row_rsicd = mysql_fetch_assoc($rsicd);

if (isset($_GET['totalRows_rsicd'])) {
  $totalRows_rsicd = $_GET['totalRows_rsicd'];
} else {
  $all_rsicd = mysql_query($query_rsicd);
  $totalRows_rsicd = mysql_num_rows($all_rsicd);
}
$totalPages_rsicd = ceil($totalRows_rsicd/$maxRows_rsicd)-1;

$queryString_rsicd = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsicd") == false && 
        stristr($param, "totalRows_rsicd") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsicd = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsicd = sprintf("&totalRows_rsicd=%d%s", $totalRows_rsicd, $queryString_rsicd);
?>
<div align="center">
<div id="frame">
<div id="frame_title" title="Update ICD code"> <h3>List Data ICD</h3></div>

<form id="form1" name="form1" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">  
  <p>&nbsp;  </p>
  <p>
   Jenis Penyakit : <input name="c" type="text" id="c" size="50" class="text" />
    <input type="submit" name="cari" id="cari" value="Cari" class="text" />
  </p>
  <label></label>
  <p>&nbsp;</p>
</form>


<table width="95%" border="0" class="tb" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <th>Kode ICD</th>
    <th>Jenis Penyakit</th>
    <th>Action</th>
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
      <td><?php echo $row_rsicd['icd_code']; ?></td>
      <td><?php echo $row_rsicd['jenis_penyakit']; ?></td>
      <td><div align="center"><a href="index.php?link=191&kode=<?php echo $row_rsicd['icd_code']; ?>"><input class="text" type="button" value="Edit" /></a></div></td>
    </tr>
    <?php } while ($row_rsicd = mysql_fetch_assoc($rsicd)); ?>
</table>

<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_rsicd > 0) { // Show if not first page ?>
          <a  class="text" href="<?php printf("%s?pageNum_rsicd=%d%s", $currentPage, 0, $queryString_rsicd); ?>">First</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rsicd > 0) { // Show if not first page ?>
          <a  class="text" href="<?php printf("%s?pageNum_rsicd=%d%s", $currentPage, max(0, $pageNum_rsicd - 1), $queryString_rsicd); ?>">Previous</a>
          <?php } // Show if not first page ?>
    </td>
    <td><?php if ($pageNum_rsicd < $totalPages_rsicd) { // Show if not last page ?>
          <a  class="text" href="<?php printf("%s?pageNum_rsicd=%d%s", $currentPage, min($totalPages_rsicd, $pageNum_rsicd + 1), $queryString_rsicd); ?>">Next</a>
          <?php } // Show if not last page ?>
    </td>
    <td><?php if ($pageNum_rsicd < $totalPages_rsicd) { // Show if not last page ?>
          <a  class="text" href="<?php printf("%s?pageNum_rsicd=%d%s", $currentPage, $totalPages_rsicd, $queryString_rsicd); ?>">Last</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
<?php
mysql_free_result($rsicd);
?>

<br />
<? 
$qry_excel = $query_rsicd; 
?>
<div align="left">
<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$qry_excel?>" />
<input type="hidden" name="header" value="DATA ICD" />
<input type="hidden" name="filename" value="data_icd" />
&nbsp;<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
<br />&nbsp;
</div>


