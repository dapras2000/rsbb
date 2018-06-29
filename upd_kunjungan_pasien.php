<?php 
 include("include/connect.php");
 $sql="SELECT a.*,b.NAMA FROM t_pendaftaran a, m_pasien b where a.nomr=b.nomr and idxdaftar=".$_GET['idx'];
 $get = mysql_query($sql); 
 $userdata = mysql_fetch_assoc($get); 	
?>
<script>

jQuery(document).ready(function(){
	
	jQuery('#kdpoly').change(function(){
		var val	= jQuery(this).val();
		jQuery('#loader_namadokter').show();
		jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{kdpoly:val,load_dokterjaga:'true'},function(data){
			jQuery('#listdokter_jaga').empty().append(data);
		});
	});
	var xx = jQuery('.carabayar').val();
	if( xx == 5){
		jQuery('#keterangan_bayar').show();
	}else{
		jQuery('#keterangan_bayar').hide();
	}
	jQuery('.carabayar').click(function(){
		var val = jQuery(this).val();
		if(val == 5){
			jQuery('#keterangan_bayar').show();
		}else{
			jQuery('#keterangan_bayar').hide();
		}
	});
	jQuery('.kdrujuk').click(function(){
		var val = jQuery(this).val();
		if(val != 1){
			jQuery('#keterangan').show();
		}else{
			jQuery('#keterangan').hide();
		}
	});
});
</script>
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>FORM PENDAFTARAN</h3></div>

<form name="myform" id="myform" action="del_pendaftaran.php" method="post">
    <fieldset class="fieldset"><legend>Form Pendaftaran </legend>
		<input type="hidden" name="old_carabayar" value="<?php echo $userdata['KDCARABAYAR']; ?>" />
      <table width="100%" border="0" >
      <tr>
        <td>Nama</td>
        <td><?=$userdata['NAMA']?></td>
        <td align="right"><input type="hidden" name="idxdaftar" id="idxdaftar" value="<?=$userdata['IDXDAFTAR']?>" /></td>
      </tr>
      <tr>
        <td width="13%">No MR</td>
        <td width="15%"><input class="text" readonly="readonly" value="<?=$userdata['NOMR']?>" name="nomr" id="nomr"/> </td>
        <td width="72%" align="right">Shift : 
        <input type="radio" name="SHIFT" value="1" <? if($userdata['SHIFT']=="1")echo "Checked";?>/> 1
        <input type="radio" name="SHIFT" value="2" <? if($userdata['SHIFT']=="2")echo "Checked";?>/> 2
        <input type="radio" name="SHIFT" value="3" <? if($userdata['SHIFT']=="3")echo "Checked";?>/> 3 </td>
        </tr>
      <tr>
        <td>Poli / dokter yang dituju</td>
        <td colspan="2"><select name="KDPOLY" class="text" id="kdpoly" >
          <option value="0">-Pilih poly-</option>
          		<?  	
				$qrypoly  = mysql_query("SELECT * FROM m_poly ORDER BY kode ASC");
				while ($listpoly = mysql_fetch_array($qrypoly)){
					?><option value="<? echo $listpoly['kode'];?>" <? if($userdata['KDPOLY']== $listpoly['kode'])echo "selected='Selected'";?> ><? echo $listpoly['nama'];?></option>
				<? 
				} 
				?>
        </select>
        &nbsp; &nbsp; Dokter &nbsp; 
        <span id="listdokter_jaga"><select name="KDDOKTER" class="text" >
          <option value="0">-Pilih -</option>
          <?  	if($userdata['KDPOLY']==""){
		  		  $f_dokter  = "";
				}else{
		  		  $f_dokter  = " WHERE a.kdpoly = ".$userdata['KDPOLY'];
		  		}
		  
		  		$qrydokter  = mysql_query("SELECT a.kddokter,a.kdpoly,b.NAMADOKTER FROM m_dokter_jaga a join m_dokter b on a.kddokter = b.KDDOKTER ".$f_dokter." ORDER BY NAMADOKTER ASC");
				while ($listdokter = mysql_fetch_array($qrydokter)){
			 ?>
          <option value="<? echo $listdokter['kddokter'];?>" <? if($userdata['KDDOKTER']== $listdokter['kddokter'])echo "selected='Selected'";?> ><? echo $listdokter['NAMADOKTER'];?></option>
		<? } ?>
        </select></span></td>
        </tr>
      <tr>
        <td>Tanggal Daftar : </td>
        <td><input type="text" name="TGLREG" id="TGLREG" class="text" value="<?=$userdata['TGLREG']?>" size="20"  /></td>
        <td align="right"></td>
		<tr><td>Cara Bayar :</td><td colspan="2">
        <?php
		$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
	  while($ds = mysql_fetch_array($ss)){
		if($userdata['KDCARABAYAR'] == $ds['KODE']): $sel = "Checked"; else: $sel = ''; endif;
		echo '<input type="radio" name="KDCARABAYAR" id="carabayar_'.$ds['KODE'].'" title="*" class="carabayar required" '.$sel.' value="'.$ds['KODE'].'" /> '.$ds['NAMA'].'&nbsp;';
	  }
		?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php
		if($userdata['KETBAYAR'] != ''){
          	echo '<span style="text-align:left;" id="keterangan_bayar"><input type="text" class="text" name="KETBAYAR" value="'.$userdata['KETBAYAR'].'"></span>';
		}else{
			echo '<span style="text-align:left;" id="keterangan_bayar"><input type="text" class="text" name="KETBAYAR" value=""></span>';
		}
		?>
        </td></tr>
		

      </tr>
      <tr>
        <td>Asal Pasien </td>
        <td colspan="2"><div align="left">
          <input type="radio" id="asal1" name="KDRUJUK" class="kdrujuk" value="1" <? if($userdata['KDRUJUK']=="1")echo "Checked";?>/> Datang Sendiri
          <input type="radio" id="asal2" name="KDRUJUK" class="kdrujuk" value="2" <? if($userdata['KDRUJUK']=="2") echo "Checked";?>/> Puskesmas
          <input type="radio" id="asal3" name="KDRUJUK" class="kdrujuk" value="3" <? if($userdata['KDRUJUK']=="3") echo "Checked";?>/> Rumah Sakit lain
          <input type="radio" id="asal4" name="KDRUJUK" class="kdrujuk" value="4" <? if($userdata['KDRUJUK']=="4") echo "Checked";?>/> Lain-Lain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          
          <?php 
		  	if($userdata['KETRUJUK'] != ''):
          	echo '<span style="text-align:right;" id="keterangan"><input type="text" name="KETRUJUK" value="'.$userdata['KETRUJUK'].'"></span>';
			else:
			echo '<span style="text-align:right;" id="keterangan"></span>';
			endif;
		  ?>
          
        </div></td>
        </tr>
        <tr>
        <td>Status Pasien <?php echo $userdata['PASIENBARU'];?></td>
        <td colspan="2"><div align="left">
          <input type="radio" id="pasienbaru1" name="pasienbaru" class="pasien" value="1" <? if($userdata['PASIENBARU']=="1")echo "Checked";?>/> Pasien Baru
          <input type="radio" id="pasienbaru2" name="pasienbaru" class="pasien" value="0" <? if($userdata['PASIENBARU']!="2") echo "Checked";?>/> Pasien Lama
        </div></td>
        </tr>
        <tr><td>Minta Rujukan </td><td colspan="2"><input type="checkbox" <?php if($userdata['MINTA_RUJUKAN'] == 1): echo 'checked="checked"'; endif;?> name="minta_rujukan" id="minta_rujukan" value="1" /></td></tr>
        <tr><td>NO BILLING</td><td colspan="2"><input type="text" name="nobill" value="" class="text" /> ( masukan no billing jika pasien sudah melakukan pembayaran )</td></tr>
        <tr>
          <td>User SPV </td>
          <td><input type="text" name="userspv" id="userspv" value="" class="text"></td>
          <td>&nbsp;</td>
        </tr>        
        <tr>
          <td>Password SPV </td>
          <td><input type="password" name="pwdspv" id="pwdspv" value="" class="text"></td>
          <td>&nbsp;</td>
        </tr>        
        
          <td colspan="3" align="right"><input type="submit" name="daftar" class="text" value=" S i m p a n "/>            
          <input type="submit" name="daftar" class="text" value="  H a p u s  "/></td>
          
    </table>
    </fieldset>
     </form>
</div>
</div>

