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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE icd SET jenis_penyakit=%s WHERE icd_code=%s",
                       GetSQLValueString($_POST['jenis_penyakit'], "text"),
                       GetSQLValueString($_POST['icd_code'], "text"));

  $Result1 = mysql_query($updateSQL) or die(mysql_error());

  $updateGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  ?>
  <script language="javascript">
  alert("Update Sukess");
  window.location="index.php?link=19";
  </script>
  <?
}

$query_reedit = "select * from icd where icd_code='".$_GET['kode']."'";
$reedit = mysql_query($query_reedit) or die(mysql_error());
$row_reedit = mysql_fetch_assoc($reedit);
$totalRows_reedit = mysql_num_rows($reedit);
?>
<div align="center">
<div id="frame">
<div id="frame_title" title="Update ICD code"> <h3>Update ICD code</h3></div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center" border="0" width="50%" class="tb">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Icd_code:</td>
      <td><?php echo $row_reedit['icd_code']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Jenis_penyakit:</td>
      <td><input type="text" size="60" class="text" name="jenis_penyakit" value="<?php echo htmlentities($row_reedit['jenis_penyakit'], ENT_COMPAT, 'utf-8'); ?>" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit"  class="text" value="Update Data" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="icd_code" value="<?php echo $row_reedit['icd_code']; ?>" />
</form>
</div>
</div>
<?php
mysql_free_result($reedit);
?>
