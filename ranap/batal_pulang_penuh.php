<?php 
include '../include/connect.php'; 
include '../include/function.php';

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
  
  $sql = "DELETE FROM t_resumepulang WHERE IDADMISSION='".$_GET['indeks']."'";
  $sql = "UPDATE t_admission SET keluarrs=NULL, icd_keluar='' WHERE id_admission='".$_GET['indeks']."'";
  mysql_query($sql);

 $updateSQL = sprintf("UPDATE t_admission SET nomr=%s, dokterpengirim=%s, statusbayar=%s, kirimdari=%s, keluargadekat=%s, panggungjawab=%s, masukrs=%s, noruang=%s, nott=%s, deposit=%s, noruang_asal=%s, nott_asal=%s, tgl_pindah=%s, kd_rujuk=%s WHERE id_admission=%s",
                       GetSQLValueString($_POST['nomr'], "text"),
                       GetSQLValueString($_POST['dokterpengirim'], "text"),
                       GetSQLValueString($_POST['statusbayar'], "text"),
                       GetSQLValueString($_POST['kirimdari'], "text"),
                       GetSQLValueString($_POST['keluargadekat'], "text"),
                       GetSQLValueString($_POST['panggungjawab'], "text"),
                       GetSQLValueString($_POST['masukrs'], "date"),
                       GetSQLValueString($_POST['noruang'], "int"),
                       GetSQLValueString($_POST['nott'], "text"),
                       GetSQLValueString($_POST['deposit'], "int"),
                       GetSQLValueString($_POST['noruang_asal'], "int"),
                       GetSQLValueString($_POST['nott_asal'], "int"),
                       GetSQLValueString($_POST['tgl_pindah'], "date"),
                       GetSQLValueString($_POST['kd_rujuk'], "int"),
                       GetSQLValueString($_POST['id_admission'], "int"));
  $Result1 = mysql_query($updateSQL) or die(mysql_error());
  $updateGoTo = "index.php?p=list";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  $historyback = 12;
  if($_REQUEST['historyback'] !=''){
	  $historyback = $_REQUEST['historyback'];
  }
?>
<script language="javascript">
alert("Pasien kembali masuk sukses!");
window.location="?link=<?php echo $historyback; ?>";
</script> 
<?
}

$query_rse = "select a.*, b.NAMA
from t_admission a 
join m_pasien b on b.nomr = a.nomr
where a.id_admission='".$_GET['indeks']."'";
$rse = mysql_query($query_rse) or die(mysql_error());
$row_rse = mysql_fetch_assoc($rse);
$totalRows_rse = mysql_num_rows($rse);

?>
<div align="center">
<div id="frame">
	<div id="frame_title"><h3>Form Kembali Masuk Pindah Ruang</h3></div>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center" class="tb">
    <!--
    <tr valign="baseline"><td width="99" align="left" nowrap="nowrap">ID Admission</td><td width="252"><?php echo $row_rse['id_admission']; ?></td>
    </tr>
    -->
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">NOMR</td>
      <td><input type="hidden" name="nomr" class="text" value="<?php echo htmlentities($row_rse['nomr'], ENT_COMPAT, 'utf-8'); ?>" size="32" /><?php echo htmlentities($row_rse['nomr'], ENT_COMPAT, 'utf-8'); ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">NAMA</td>
      <td><?php echo $row_rse['NAMA'];?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Masuk Rumah Sakit</td>
      <td><input type="text" name="masukrs" id="tgl_masuk" readonly="readonly" class="text" 
              value="<?php echo htmlentities($row_rse['masukrs'], ENT_COMPAT, 'utf-8'); ?>"/><a href="javascript:showCal('Calendary')"><img align="top" src="img/date.png" border="0" /></a></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Dokter Pengirim</td>
      <td>
      	<?php 
		$dktr = getNamaDokter($row_rse['dokterpengirim']);
		echo $dktr['NAMADOKTER'];
		?>
      	<input type="hidden" class="text"  name="dokterpengirim" value="<?php echo htmlentities($row_rse['dokterpengirim'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
        <input type="hidden" name="kirimdari" value="<?php echo htmlentities($row_rse['kirimdari'], ENT_COMPAT, 'utf-8'); ?>"/>
        <input type="hidden" name="noruang_asal" value="<?php echo htmlentities($row_rse['noruang'], ENT_COMPAT, 'utf-8'); ?>"/>
        <input type="hidden" name="nott_asal" value="<?php echo htmlentities($row_rse['nott'], ENT_COMPAT, 'utf-8'); ?>"/>
        <input type="hidden" name="kd_rujuk" value="<?php echo htmlentities($row_rse['kd_rujuk'], ENT_COMPAT, 'utf-8'); ?>"/></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Keluarga Dekat</td>
      <td><input type="text" class="text"  name="keluargadekat" value="<?php echo htmlentities($row_rse['keluargadekat'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Penanggung Jawab</td>
      <td><input type="text" class="text"  name="panggungjawab" value="<?php echo htmlentities($row_rse['panggungjawab'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Nomer Ruang
      <input type="hidden" name="masukrs" value="<?php echo htmlentities($row_rse['masukrs'], ENT_COMPAT, 'utf-8'); ?>" /></td>
      <td><input type="text" class="text" name="noruang" value="<?php if ($_GET['idruang']==''){echo htmlentities($row_rse['noruang'], ENT_COMPAT, 'utf-8');} else {echo $_GET['idruang'];} ?>" size="10" />
      <label>
      <a href="index.php?link=176&indek=<?=$row_rse['id_admission'];?>&historyback=<?php echo $_REQUEST['historyback'];?>&batal_pulang_penuh=ya"><input class="text" type="button" name="button" id="button" value="Pilih Ruang"/></a>      </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Nomer Tempat Tidur</td>
      <td><input type="text" name="nott" class="text"  value="<?php if ($_GET['no_tt']=='') {echo htmlentities($row_rse['nott'], ENT_COMPAT, 'utf-8');} else {echo $_GET['no_tt'];} ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Tanggal Pindah Kamar</td>
      <td>
      <?php if($row_rse['tgl_pindah'] == '0000-00-00'){
		  $tglpindah = date('Y/m/d');
	  }else{
		  $tglpindah	= $row_rse['tgl_pindah'];
	  }
	  ?>
      <input type="text" class="text" name="tgl_pindah" id="tgl_pindah" value="<?php echo $tglpindah;?>" size="20" />
        <a href="javascript:showCal('tgl_pindah')"><img src="img/date.png" alt="" border="0" align="top" /></a> ex : 1999/09/29 </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Cara Bayar</td>
      <td><label>
        <select name="statusbayar" id="statusbayar" class="text" required="true">
        	<option value=""> -- Pilih Pembayaran -- </option>
        	<?php
			$sql = mysql_query('select * from m_carabayar order by ORDERS');
			while($dsql	= mysql_fetch_array($sql)){
				if($row_rse['statusbayar'] == $dsql['KODE']): $sel = 'selected="selected"'; else: $sel = ''; endif;
				echo '<option value="'.$dsql['KODE'].' '.$sel.'">'.$dsql['NAMA'].'</option>';
			}
			?>
        </select>
        </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="left">Deposit</td>
      <td>
      <?php echo curformat($row_rse['deposit']); ?>
      <input type="hidden" readonly="readonly" class="text" name="deposit" value="<?php echo $row_rse['deposit']; ?>" size="32" />      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Simpan"  class="text"/>  <input class="text" name="kembali" type="button" value="Batal" onClick="javascript:history.back(1)" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_admission" value="<?php echo $row_rse['id_admission']; ?>" />
</form>
</div>
</div>
<?php
mysql_free_result($rse);
?>
