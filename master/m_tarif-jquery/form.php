<?
	include("../../include/connect.php");
	$id = isset($_GET['kode']) ? $_GET['kode']: false ;
	
	if($id){
	   $sql='SELECT * FROM m_tarif WHERE kode = "'.$_GET['kode'].'"';
	   $query = mysql_query($sql);
	   if($query && mysql_num_rows($query) == 1){
	      $data = mysql_fetch_object($query);
	   }else 
	      die('Data tarif tidak ditemukan ');
	}
?>
<div id="divResult" style="font-size:11px;text-align:center;display:none"></div>
<form action="process.php" method="post" id="formData" onSubmit="return submitForm();">
 <table>
   <tr>
	 <td>Kode</td>
	 <td>:</td>
	 <td><input type="text" name="kode" size="12" maxlength="12" value="<?=@$data->kode?>" onKeyUp="this.value = String(this.value).toUpperCase()" /></td>
   </tr>
   <tr>
	 <td>Kode Group</td>
	 <td>:</td>
	 <td><input type="text" name="group_jasa" size="30" value="<?=@$data->group_jasa?>" /></td>
   </tr>
   <tr valign="top">
	 <td>Nama</td>
	 <td>:</td>
	 <td><input type="text" name="nama" size="50" value="<?=@$data->nama_jasa?>" /></td>
   </tr>
   <tr>
	 <td>Tarif</td>
	 <td>:</td>
	 <td><input type="text" name="tarif" size="30" value="<?=@$data->tarif?>" /></td>   
   </tr>
   <tr>
	 <td>&nbsp;</td>
	 <td>&nbsp;</td>
	 <td>
		<input type="hidden" name="id" value="<?=@$data->kode?>" />
		<input type="submit" name="submit" value="Simpan" />
		<input type="button" value="Batal" onClick="tb_remove()" />
	 </td>
   </tr>
 </table>
</form>
