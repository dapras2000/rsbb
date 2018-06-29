<script language="javascript" src="include/cal3.js"></script>
<script language="javascript" src="include/cal_conf3.js"></script>

<script type="text/javascript">
function startjam(){
	var d = new Date();
	var curr_hour = d.getHours();
	var curr_min = d.getMinutes();
	var curr_sec = d.getSeconds();
	document.getElementById('start_daftar').value=(curr_hour + ":" + curr_min+ ":" + curr_sec);
}

// JavaScript Document
jQuery(document).ready(function(){
	// 	jQuery('#tr_nomr').hide();
	jQuery("#myform").validate();
	
	jQuery('.loader').hide();
	jQuery('#KDCARABAYAR').hide();
	jQuery('#NOKARTU').hide();
	jQuery('#TGL_SEP').hide();
	jQuery('#DIAGNOSA').hide();
	jQuery('#JEPEL').hide();
	<?php if($_REQUEST['xNOMR'] == ''): ?> 
	jQuery('#NOMR').attr('disabled','disabled').val('-automatic-');
	<? endif; ?>
	jQuery('.statuspasien').change(function(){
		var status_val	= jQuery(this).val();
		if(status_val == 1){
			jQuery('#NOMR').attr('disabled','disabled').val('-automatic-');
			jQuery('#PASIENBARU').val(1);
			jQuery('#NAMA').val('');
			jQuery('#TEMPAT').val('');
			jQuery('#TGLLAHIR').val('');
			//jQuery('#umur').val(newdata[5]);
			jQuery('#ALAMAT').val('');
			jQuery('#ALAMAT_KTP').val('');
			jQuery('#KELURAHAN').val('');
			jQuery('#KECAMATAN').val('');
			jQuery('#KOTA').val('');
			jQuery('#KDPROVINSI').val('');
			jQuery('#notelp').val('');
			jQuery('#NOKTP').val('');
			jQuery('#SUAMI_ORTU').val('');
			jQuery('#PEKERJAAN').val('');
			//jQuery('#nama_penanggungjawab').val(newdata[14]);
			//jQuery('#hubungan_penanggungjawab').val(newdata[15]);
			//jQuery('#alamat_penanggungjawab').val(newdata[16]);
			//jQuery('#phone_penanggungjawab').val(newdata[17]);
			jQuery('#JENISKELAMIN_'+newdata[5]).removeAttr('checked');
			jQuery('#status_'+newdata[15]).removeAttr('checked');
			jQuery('#PENDIDIKAN_'+newdata[17]).removeAttr('checked');
			jQuery('#AGAMA_'+newdata[16]).removeAttr('checked');
			jQuery('#carabayar_'+newdata[18]).removeAttr('checked');
			jQuery('.loader').hide();
		}else{
			jQuery('#NOMR').removeAttr('disabled').val('');
			jQuery('#PASIENBARU').val(0);
		}
	});
	jQuery('#TGLLAHIR').blur(function(){
		var tgl = jQuery(this).val();						  
		if(tgl == ('0000/00/00') || tgl == ('0000-00-00') || tgl == ('00-00-0000') || tgl == ('00/00/0000')  ){
			alert('Tanggal Lahir Tidak Boleh 00-00-0000');
			jQuery(this).val('');
		}
	});
	jQuery('#NOMR').blur(function(){
		var nomr	= jQuery(this).val();
		if(nomr != ''){
			jQuery('.loader').show();
			jQuery.get('<?php echo _BASE_; ?>include/process.php?psn='+nomr,function(data){
				newdata	= data.split("|");
				//jQuery('#STATUSPASIEN_'+newdata[0]).attr('checked','checked');
				if(newdata[0] == 1){
					//jQuery('#NOMR').attr('disabled','disabled');
				}
				jQuery('#NAMA').val(newdata[2]);
				jQuery('#NOMR2').val(newdata[26]);
				jQuery('#TEMPAT').val(newdata[3]);
				var tahun = newdata[4].substr(0,4);
				var bulan = newdata[4].substr(5,2);
				var hari = newdata[4].substr(8,2);
				jQuery('#TGLLAHIR').val(hari+"/"+bulan+"/"+tahun);
				//jQuery('#umur').val(newdata[5]);
				jQuery('#ALAMAT').val(newdata[6]);
				jQuery('#ALAMAT_KTP').val(newdata[19]);
				jQuery('#KELURAHAN').val(newdata[7]);
				jQuery('#KECAMATAN').val(newdata[8]);
				jQuery('#KELURAHANHIDDEN').val(newdata[7]);
				jQuery('#KECAMATANHIDDEN').val(newdata[8]);
				jQuery('#KOTAHIDDEN').val(newdata[9]);
				jQuery('#KDPROVINSI').val(newdata[10]).change();
				jQuery('#KOTA').val(newdata[9]).change();
				jQuery('#notelp').val(newdata[11]);
				jQuery('#NOKTP').val(newdata[12]);
				jQuery('#SUAMI_ORTU').val(newdata[13]);
				jQuery('#PEKERJAAN').val(newdata[14]);
				jQuery('#umur').val(newdata[20]);
				jQuery('#CALLER option[value='+newdata[21]+']').attr('selected', 'selected');

				jQuery('#nama_penanggungjawab').val(newdata[22]);
				jQuery('#hubungan_penanggungjawab').val(newdata[23]);
				jQuery('#alamat_penanggungjawab').val(newdata[24]);
				jQuery('#phone_penanggungjawab').val(newdata[25]);
				jQuery('#kartu1').val(newdata[27]);
				jQuery('#jns_peserta').val(newdata[28]);
				jQuery('#KDCARABAYAR').val(newdata[18]);
				jQuery('#JENISKELAMIN_'+newdata[5]).attr('checked','checked');
				jQuery('#status_'+newdata[15]).attr('checked','checked');
				jQuery('#PENDIDIKAN_'+newdata[17]).attr('checked','checked');
				jQuery('#AGAMA_'+newdata[16]).attr('checked','checked');
				jQuery('#carabayar_'+newdata[18]).attr('checked','checked');
				jQuery('#payplan'+newdata[29]).attr('checked','checked');
				jQuery('.loader').hide();
				if (newdata[29]==''){
				jQuery('#KDCARABAYAR').show().addClass('required');
				jQuery('#kartu1').show().addClass('required');
				//jQuery('#TGL_SEP').show().addClass('required');
				jQuery('#NOKARTU').show().addClass('required');
				}
			});
		}
	});
	
	///////////////////////////////////////////////

	
	jQuery('#kdpoly').change(function(){
		var val	= jQuery(this).val();
		jQuery('#loader_namadokter').show();
		jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{kdpoly:val,load_dokterjaga:'true'},function(data){
			//var n = data.split("|");
			//jQuery('#kddokter').val(n[0]);
			jQuery('#listdokter_jaga').empty().append(data);
			//jQuery('#loader_namadokter').hide();
		});
	});

        jQuery('#payplan').click(function(){
		var val	= jQuery(this).val();
		if(val >= 1){
			jQuery('#KDCARABAYAR').show().addClass('required');
			jQuery('#kartu1').show().addClass('required');
			jQuery('#jns_peserta').show().addClass('required');
		}
	});
	
	jQuery('#payplan1').click(function(){
		var val = jQuery(this).val();
		

		if(val == 1){
			jQuery('#KDCARABAYAR').hide().removeClass('required');
			jQuery('#kartu1').hide().removeClass('required');
			jQuery('#jns_peserta').hide().removeClass('required');
		}
		
		});
		jQuery('#KDCARABAYAR').change(function(){
		var val = jQuery(this).val();
		

		if(val == 2 || val==9){
			jQuery('#NOKARTU').show().addClass('required');
			jQuery('#TGL_SEP').show().addClass('required');
			jQuery('#DIAGNOSA').show().addClass('required');
			jQuery('#JEPEL').show().addClass('required');
		}
		else{
			jQuery('#NOKARTU').hide().addClass('required');
			jQuery('#TGL_SEP').hide().addClass('required');
			jQuery('#DIAGNOSA').hide().addClass('required');
			jQuery('#JEPEL').hide().addClass('required');
		}
	});
	//jQuery('#carabayar_lain').hide();
	//jQuery('#kdrujuk_lain').hide();
	
	jQuery('.kdrujuk').click(function(){
		var val = jQuery(this).val();
		if(val != 1){
			jQuery('#kdrujuk_lain').show().addClass('required');
		}else{
			jQuery('#kdrujuk_lain').hide().removeClass('required');
		}
	});
	
	jQuery('#NOKARTU').blur(function(){
	var NOKARTU	= jQuery('#NOKARTU').val();
	if(NOKARTU != ''){
	var url = 'http://localhost/simrs_lama/bridge.php?msg='+NOKARTU;
		jQuery.getJSON(url, function(data) {
        jQuery.each(data, function(index, data) {
		jQuery('#TGL_SEP').val(data.TGLSJP);
		jQuery('#DIAGNOSA').val(data.DIAGPPK);
		jQuery('#JEPEL').val(data.KdKlsRwt);
       	jQuery('#kartu1').val(data.NOKA);
		jQuery('#jns_peserta option[value='+data.JNSPELSJP+']').attr('selected', 'selected');
		jQuery('#NAMA').val(data.NAMA);
		jQuery('#JENISKELAMIN_'+data.JKPST).attr('checked','checked');
		jQuery('#umur').val(data.umur);
    });
//	alert(data);
   });
	}
	});
	
});
//alert("Data Telah Disimpan. \n Nama Pasien : <?php echo $NAMADATA; ?> \n No MR <?php echo $nomr; ?>");
</script>
<!--<script language="javascript" type="text/javascript" src="js/jquery.js"></script>-->

<style type="text/css">
.loader{background:url(js/loading.gif) no-repeat; width:16px; height:16px; float:right; margin-right:30px;}
.loader2{background:url(js/loading.gif) no-repeat; width:16px; height:16px; float:right; margin-right:30px;}
input.error{ border:1px solid #F00;}
label.error{ color:#F00; font-weight:bold;}
</style>

<div align="center">
  <div id="frame">
  <div id="frame_title"><h3 align="left">DATA ADMINISTRASI PASIEN</h3>
</div>

<form name="myform" id="myform" action="models/pendaftaran.php" method="post">
<fieldset class="fieldset">
<legend>Data Medis</legend>
<?
unset($_SESSION['register_nomr']);
unset($_SESSION['register_nama']);
//include 'bridge.php';
#  echo $pmb -> begin_round("100%","FFF","CCC","CCC"); //  (width, fillcolor, edgecolor, shadowcolor)
?>
<table width="100%" border="0" style="background:none;" title=" From Ini Berfungsi Sebagai Form Pendaftaran Baru.">
      <tr>
        <td>Status Pasien</td>
        <td>
        	<div id="psn" >
            <script src="js/custom-js.js" language="JavaScript" type="text/javascript"></script>
            <input type="hidden" name="PASIENBARU" id="PASIENBARUS" value="1"><? 
			if(!isset($_GET['PASIENBARU'])){
				echo '<input type="hidden" name="PASIENBARU" id="PASIENBARU" value="1">';
				?>
				<input type="radio"  name="STATUSPASIEN" id="STATUSPASIEN_1" class="statuspasien" value="1" <?php if($_GET['PASIENBARU'] != '0'): echo'checked="checked"'; endif; ?>> Pasien Baru
				<input type="radio"  name="STATUSPASIEN" id="STATUSPASIEN_0" class="statuspasien" value="0" <?php if($_GET['PASIENBARU'] == '0'): echo'checked="checked"'; endif; ?>> Pasien Lama
			<?php
			}else{
				echo '<input type="hidden" name="PASIENBARU" id="PASIENBARU" value="'.$_GET['PASIENBARU'].'">';
				?>
				<input type="radio"  name="STATUSPASIEN" id="STATUSPASIEN_1" class="statuspasien" value="1" <?php if($_GET['PASIENBARU'] != '0'): echo'checked="checked"'; endif; ?>> Pasien Baru
				<input type="radio"  name="STATUSPASIEN" id="STATUSPASIEN_0" class="statuspasien" value="0" <?php if($_GET['PASIENBARU'] == '0'): echo'checked="checked"'; endif; ?>> Pasien Lama
				<?php
			}
			?>&nbsp;
			</div>
       </td>
      </tr>
      <tr id="tr_nomr">
        <td width="16%">No RM <?php #echo nomr("1");?></td>
        <td width="42%"><input class="text" type="text" name="NOMR" id="NOMR" size="25" value="<?php echo $_REQUEST['xNOMR']; ?>"/><div class="loader"></div><!--&nbsp;NO. MR LAMA :&nbsp;<input class="text" type="text" name="NOMR2" id="NOMR2" size="25" value="<?php echo $_REQUEST['xNOMR2']; ?>">-->
        <td width="53%" align="left">""Shift Petugas Jaga"
            <input type="radio" name="SHIFT" class="required" title="*" value="1" <? if($t_pendaftaran->SHIFT=="1" || $_GET['SHIFT']=="1")echo "Checked";?>/>
			Pagi
            <input type="radio" name="SHIFT" class="required" title="*" value="2" <? if($t_pendaftaran->SHIFT=="2" || $_GET['SHIFT']=="2")echo "Checked";?>/>
            Siang
            <input type="radio" name="SHIFT" class="required" title="*" value="3" <? if($t_pendaftaran->SHIFT=="3" || $_GET['SHIFT']=="3")echo "Checked";?>/>
			Malam
		</td>
      </tr>
      <tr>
        <td>Poli / dokter yang dituju </td>
        <td colspan="2">
        	<select name="KDPOLY" id="kdpoly" class="selectbox text required" title="*" style="float:left; margin-right:20px;">
            	<option value=""> - Pilih Poliklinik - </option>
            	<?php 
					$sql	= mysql_query('select * from m_poly order by nama asc');
					while($data	= mysql_fetch_array($sql)){
						if($_GET['KDPOLY'] == $data['kode']): $zx = 'selected="selected"'; else: $zx = ''; endif;
						echo '<option value="'.$data['kode'].'" '.$zx.'>'.$data['nama'].'</option>';
					}
				?>
            </select>
            <div id="listdokter_jaga">
            	<?php
            	if($_GET['KDPOLY'] != ''){
					$sqldokter	= mysql_query('select a.kddokter, b.NAMADOKTER from m_dokter_jaga a join m_dokter b on a.KDDOKTER = b.kddokter where a.kdpoly = "'.$_GET['KDPOLY'].'"');
					if(mysql_num_rows($sqldokter) > 0){
						echo '<select name="KDDOKTER">';
						while($datadok = mysql_fetch_array($sqldokter)){
							if($_GET['KDDOKTER'] == $datadok['kddokter']): $sel = 'selected="selected"'; else: $sel = ''; endif;
							echo '<option value="'.$datadok['kddokter'].'" '.$sel.'>'.$datadok['NAMADOKTER'].'</option>';
						}
						echo '</select>';
						
					}else{
						echo 'Tidak ada dokter jaga di poli tersebut';
					}
					#echo getDokterName($_GET['KDDOKTER']);
				}
				?>
            </div>
            
		</td>
        </tr>
        <tr><td>Minta Rujukan </td><td><input type="checkbox" name="minta_rujukan" id="minta_rujukan" value="1" /></td></tr>
      <tr>
        <td>Tanggal Daftar : </td>
        <td><input type="text" 	name="TGLREG" id="TGLREG" class="text" value="<?php if(!empty($_GET['TGLREG'])){ echo $_GET['TGLREG']; }else{ echo date("Y-m-d"); } ?>" size="20"/>
        		<input type='hidden' name='start_daftar' id='start_daftar' /></td>
        <td align="right"></td>
      </tr>

	  
	  
      <!--<tr><td>&nbsp;</td>-->
    <tr>
		<td>Cara Bayar</td>
		<td colspan="2">
            <?php
			$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
			while($ds = mysql_fetch_array($ss)){
				if($_GET['KDCARABAYAR'] == $ds['KODE']): $sel = "Checked"; else: $sel = ''; endif;
				echo '<input type="radio" name="KDCARABAYAR" id="carabayar_'.$ds['KODE'].'" title="*" class="carabayar required" '.$sel.' value="'.$ds['KODE'].'" /> '.$ds['NAMA'].'&nbsp;';
			}
	  
			$cssb ='style="display:none;"';
			if($_GET['KETBAYAR'] != ''): 
				$cssb = 'style="display:inline;"';
			endif;
			?>
		</td>
	</tr>
<!--<input type="text" name="KETBAYAR" title="*" id="carabayar_lain" <?php echo $cssb;?> value="<?php echo $_REQUEST['KETBAYAR']; ?>" class="text"/></td></tr>-->
	<tr>
		<td>NO Kartu BPJS</td>
		<td colspan="2">
			<input type="text" name="nokartu" title="*" id="nokartu" <?php echo $ppk;?> value="" class="text"/>
			<input type='button' id='btnrujukan' class='text' value='cari'>
		</td>
	</tr> 
	
<tr>
<td>Kelompok Peserta</td> <td colspan="2"><input type="text" name="jns_peserta" title="*" id="jns_peserta" <?php echo $ppk;?> value="" class="text"/></td></tr>		
	 <tr>
        <!--<td>&nbsp;</td>-->
        <td>Rujukan </td>
        <td colspan="2">
         <?php
		  $ss	= mysql_query('select * from m_rujukan order by ORDERS ASC');
		  while($ds = mysql_fetch_array($ss)){
			if($_GET['KDRUJUK'] == $ds['KODE']): $sel = "Checked"; else: $sel = ''; endif;
			echo '<input type="radio" name="KDRUJUK" id="asal'.$ds['KODE'].'" title="*" class="kdrujuk required" '.$sel.' value="'.$ds['KODE'].'" /> '.$ds['NAMA'].'&nbsp;';
		  }
		
		$css ='style="display:none; float:left;"';
		if($_GET['KETRUJUK'] != ''): 
			$css = 'style="display:inline;"';
		endif;
		?>
        <input type="text" title="*" name="KETRUJUK" <?php echo $css; ?> value="<?php echo $_GET['KETRUJUK'];?>" id="kdrujuk_lain" class="text" />
        
          </td>
        </tr>
		   
		
      <tr><td>NO Rujukan</td><td colspan=2><input type="text" name="norujukan" title="*" id="norujukan" <?php echo $norujukan;?> value="" class="text"/></td>
	  </tr>
	  <tr>
          <!--<td>&nbsp;</td>-->
        <td>Tanggal Rujukan </td>
        <td><input type="text" name="tglrujuk" id="tglrujuk" class="text" value="<?php if(!empty($_GET['TGLREG'])){ echo $_GET['TGLREG']; }else{ echo date("Y-m-d H:i:s"); } ?>" size="20"/>
        		<input type='hidden' name='start_daftar' id='start_daftar' /></td>
        <td align="right">
          
</td>
      </tr>
	     <tr><td>KODE PPK Rujukan</td><td colspan="2"><input type="text" name="noppk" title="*" id="noppk" <?php echo $ppk;?> value="" class="text"/>
		<input type="hidden" name="namappk" title="*" id="namappk" <?php echo $ppk;?> value="" class="text"/></TD></tr>
		<tr><td>Diagnosa Awal</td><td colspan="2"><input type="text" name="diagnosa" title="*" id="diagnosa" <?php echo $ppk;?> value="" class="text"/>
		</TD></tr>
 <tr>
          <!--<td>&nbsp;</td>-->
        <td>Kelas Perawatan </td>
        <td><input type="text" name="kelas" id="kelas" class="text" value="<?php if(!empty($_GET['Kelas'])){ echo $_GET['Kelas']; }else{ echo "3"; } ?>" size="3"/>
        		<input type='hidden' name='start_daftar' id='start_daftar' /></td>
        <td align="right">
          
</td>
      </tr>		


			<tr>
        
        <td>NO SEP</td>
        <td colspan="2">
<input type="text" name="NK" id="NK" value="" class="text"/>&nbsp;<input type='button' id='btnsep' class='text' value='create No SEP'></td></tr>
	  
	  
	  
    </table>
	
	
<? 
  #echo $pmb -> end_round();
?>    
    </fieldset>
   <div id="all">	
     <? include("include/view_prosess.php");?>
  </div>
       </form>
  </div>
  </div>