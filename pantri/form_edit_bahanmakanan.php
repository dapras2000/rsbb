<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#jns_brg").autocomplete("pantri/include/auto.php",{width:260});
});
</script>
<script language="javascript" type="text/javascript" src="../rajal/functions.js"></script>
<script language="javascript" type="text/javascript" src="../rajal/xmlhttp.js"></script>
<?
// edit ----------------------------------------------------------------------------------------------
include("../include/connect.php");

if(!empty($_POST['id'])){
	$qry = mysql_query("SELECT * FROM m_bahan_makanan WHERE id='$_POST[id]'")or die(mysql_error());
	$set = mysql_fetch_assoc($qry);
?>
<div align="center">
    <div id="frame" style="width:50%">
    	<div id="frame_title">
    	  <h3>FORM EDIT BAHAN MAKANAN</h3></div>
        <div style="margin:5px;">
		<div id="val_pro"></div>
        	<form name="input_bahan_makanan" id="input_bahan_makanan" action="pantri/save_bahan_makanan.php" method="post">
            	<table width="90%" style="padding:10px;" title="Form Edit Bahan Makanan" border="0" cellpadding="0" cellspacing="0">
				<input type="text" class="text" id="id" name="id" value="<?php echo $set['id']; ?>" hidden>
  <tr>
    <td width="28%">Jenis Barang</td>
    <td width="43%"><input type="text" class="text" id="jns_brg" name="jns_brg" value="<?php echo $set['jenis_barang']; ?>" onkeypress="if(enter_pressed(event))
          				{
                        var str=document.getElementById('jns_brg').value;
                        
                        }"></td>
    </tr>
	<tr>
    <td>Satuan</td>
    <td>
    	<select name="satuan" id="satuan" class="text">
        	<option selected >
				<?php if($set['satuan']=="Kg"){ 
							echo"Kg";
					 }elseif($set['satuan']=="Pasang"){
							echo"Pasang";
					 }elseif($set['satuan']=="Bh"){
							echo"Bh";
					 }elseif($set['satuan']=="Bks"){
							echo"Bks";
					 }elseif($set['satuan']=="Btr"){
							echo"Btr";
					 }elseif($set['satuan']=="Piring"){
							echo"Piring";
					 }elseif($set['satuan']=="Biji"){
							echo"Biji";
					}elseif($set['satuan']=="Ikat"){
							echo"Ikat";
					}elseif($set['satuan']=="Sisir"){
							echo"Sisir";
					}elseif($set['satuan']=="Btl"){
							echo"Btl";
					}elseif($set['satuan']=="Pack"){
							echo"Pack";
					}elseif($set['satuan']=="Sch"){
							echo"Sch";
					}elseif($set['satuan']=="Boks"){
							echo"Boks";
					}elseif($set['satuan']=="Galon"){
							echo"Galon";
					}elseif($set['satuan']=="Klg"){
							echo"Klg";
					}elseif($set['satuan']=="Ktk"){
							echo"Ktk";
					}elseif($set['satuan']=="Tpls"){
							echo"Tpls";
					}elseif($set['satuan']=="Cup"){
							echo"Cup";
					}elseif($set['satuan']=="Drg"){
							echo"Drg";
					}elseif($set['satuan']=="Roll"){
							echo"Roll";
					}elseif($set['satuan']=="Tbg"){
							echo"Tbg";
					}elseif($set['satuan']=="Plastik"){
							echo"Plastik";
					}elseif($set['satuan']=="Lusin"){
							echo"Lusin";
					}elseif($set['satuan']=="Gelas"){
							echo"Gelas";
					}else{
						 echo"Satuan belum ada";
					 } 
			    ?>
            </option>
        	<option value="Kg">Kg</option>
		<option value="Pasang">Pasang</option>
		<option value="Bh">Bh</option>
		<option value="Bks">Bks</option>
		<option value="Btr">Btr</option>
		<option value="Piring">Piring</option>
		<option value="Biji">Biji</option>
		<option value="Ikat">Ikat</option>
		<option value="Sisir">Sisir</option>
		<option value="Btl">Btl</option>
		<option value="Pack">Pack</option>
		<option value="Sch">Sch</option>
		<option value="Boks">Boks</option>
		<option value="Galon">Galon</option>
		<option value="Klg">Klg</option>
		<option value="Ktk">Ktk</option>
		<option value="Tpls">Tpls</option>
		<option value="Cup">Cup</option>
		<option value="Drg">drg</option>
		<option value="Roll">Roll</option>
		<option value="Tbg">Tbg</option>
		<option value="Plastik">Plastik</option>
		<option value="Lusin">Lusin</option>
		<option value="Gelas">Gelas</option>
        </select>
    </td>
    </tr>
   <tr>
    <td>Jumlah</td>
    <td><input type="text" class="text" id="jml" name="jml" size="35" value="<?php echo $set['jumlah']; ?>"></td>
    </tr>
	<tr>
    <td>Harga Satuan</td>
    <td align="left"><input type="text" class="text" id="hrg_sat" name="hrg_sat" size="35" value="<?php echo $set['harga_satuan']; ?>"/></td>
  </tr>
  <tr>
    <td valign="top">Jumlah Harga</td>
	<td><input type="text" class="text" id="jml_hrg" name="jml_hrg" size="35" value="<?php echo $set['jumlah_harga']; ?>"></td>
    </tr> 
  <tr>
    <td>&nbsp;</td>
    <td align="right">
    <input type="hidden" name="edit" value="edit" />
    <input onClick="submitform(document.getElementById('input_bahan_makanan'),'pantri/save_bahan_makanan.php','val_pro',validatetask); return false;" type="Submit" name="simpan" value=" Simpan " class="text">
    </td>
    </tr>
</table>
 </form>
        </div>
	</div>
</div>

<?	} ?>