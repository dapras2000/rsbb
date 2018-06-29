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

$query_r = "select * from m_saratjamkesmas";
$r = mysql_query($query_r) or die(mysql_error());
$row_r = mysql_fetch_assoc($r);
$totalRows_r = mysql_num_rows($r);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>PILIH PERSYARATAN</h3></div>
<form action="index.php?link=156" method="POST" name="formsarat">
<table border="0" cellpadding="2" cellspacing="2">
  <tr>
    <th>No Urut Sarat</th>
    <th>Nama Sarat</th>
    <th>Keterangan</th>
    <th></th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_r['idxsarat']; ?></td>
      <td><?php echo $row_r['namasarat']; ?></td>
      <td><?php echo $row_r['keterangan']; ?></td>
      <td><label>
        <input type="checkbox" name="pilih[]" value="<? echo $row_r['idxsarat'];?>"/>
         <input name="nomr" type="hidden" value="<? echo $_GET['nomr'];?>" />
      </label></td>
    </tr>
    <?php } while ($row_r = mysql_fetch_assoc($r)); ?>
</table>
<br />
<label>
<input type="submit" name="Submit" id="Submit" value="Simpan Pilihan" class="text"/>
</label>

</form><br></div></div>
<?
if ($_POST['Submit']=='Simpan Pilihan')
{
	$pilih=$_POST['pilih'];
	for($i=0;$i<=count($pilih);$i++)
	{
		if($pilih[$i] != '')
		{
			$insert="INSERT INTO t_jamkesmas_sarat VALUES('','".$_POST['nomr']."','".$pilih[$i]."')";
			mysql_query($insert);
		}
	}
	
	//header("Location:index.php?link=154");
	?>
<script language="javascript">
document.location.replace("index.php?link=154");
</script>
<?
}

?>
</body>
</html>
<?php
mysql_free_result($r);

?>
