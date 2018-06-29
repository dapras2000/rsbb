<?php include("../include/connect.php");
if(!empty($_GET['gudang'])){
?>
<select class="text" name="grpbarang" id="grpbarang"  onchange="javascript: MyAjaxRequest('ruang_x','orderbarang/changegroup.php?ruang_x=' + this.value); MyAjaxRequest('ruang_h','orderbarang/changegroup.php?ruang_h=' + this.value); return false;" >
   <option value="1" >Obat</option>
   <option value="2" >Alat Kesehatan Pakai Habis</option>
   <option value="3" >Bahan Radiologi</option>
   <option value="4" >Gas</option>
   <option value="5" >Reagensia</option>
</select>
<?php
}
?>
<?php
if(!empty($_GET['logistik'])){
?>
<select class="text" name="grpbarang" id="grpbarang" >
   <option value="1" >ATK</option>
   <option value="2" >Cetakan</option>
   <option value="3" >ART</option>
   <option value="4" >Alat Bersih dan Pembersih</option>
   <option value="5" >Lain - Lain</option>
</select>
<?php
}
if(!empty($_GET['ruang_x'])){
	
 if($_GET['ruang_x']=="4"){
 $sql_ruang = "SELECT 
  			m_ruang_gas.`no`,
  			m_ruang_gas.nama
		FROM
  			m_ruang_gas
		ORDER BY m_ruang_gas.nama";
 $get_ruang = mysql_query($sql_ruang); 
?>
<select class="text" name="ruang" id="ruang" >
<? while($data_ruang = mysql_fetch_array($get_ruang)){ ?>
<option value="<?=$data_ruang['no']?>" ><?=$data_ruang['nama']?></option>
<? } ?>   
</select>
<? }else{ echo "&nbsp;"; } } 
if(!empty($_GET['ruang_h'])){
 if($_GET['ruang_h']=="4"){

?>
Ruang
<? }else{ echo "&nbsp;"; } } ?>