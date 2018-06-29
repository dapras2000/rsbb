     <? include("../include/connect.php");
$sql = "select * from t_diagnosadanterapi where idxdaftar = '".$_GET['idx']."'";

$get = mysql_query($sql);
$data = mysql_fetch_assoc($get);

?>
<form name="form_1" action="rm/save_icd.php" method="post" >
<table class="tb">
  <tr>
      <td>No RM</td>
      <td><input type="text" name="noRm" value="<?=$data['nomr']?>" readonly="readonly" class="text" /></td>
  </tr>
  <tr>
      <td>Kode ICD</td>
      <td><input type="text" name="icd_code" id="icd_code" class="text" value="<?=$data['icd_code']?>" /></td>
  </tr>
  <tr>
  	<td colspan="2" ><input type="hidden" name="idxdaftar" value="<?=$data['idxdaftar']?>" /><input type="submit" value="Simpan" class="text" /></td> 
  </tr>
</table>
 </form>