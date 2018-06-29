<script language="javascript" src="include/cal3.js"></script>
<script language="javascript" src="include/cal_conf3.js"></script>

<div align="center">
    <div id="frame">
   		<div id="frame_title"><h3 align="left">IDENTITAS PASIEN</h3></div>
        <script>
		jQuery(document).ready(function(){
			jQuery("#myform").validate();
			jQuery('#parent_nomr').blur(function(){
				var val	= jQuery(this).val();
				jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{loadDetailPasien:true,nomr:val},function(data){
					var d = data.split('|');
					jQuery('#parent_nama').empty().append(d[2]);
				});
			});
			jQuery('.ruang').click(function(){
				var val = jQuery(this).val();
				if(val == 'vk'){
				   	jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{load_dokterjaga:true,kdpoly:10},function(data){
						jQuery('#load_dokterjaga').empty().html(data);
					});
				}else{
					jQuery('#load_dokterjaga').empty();
				}
			});
			jQuery('.carabayar').change(function(){
				var val = jQuery(this).val();
				if(val == 5){
					jQuery('#carabayar_lain').show().addClass('required');
				}else{
					jQuery('#carabayar_lain').hide().removeClass('required');
				}
			});
			jQuery("#KDPROVINSI").change(function(){
				var selectValues = jQuery("#KDPROVINSI").val();
				jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{kdprov:selectValues, load_kota:'true'},function(data){
					jQuery('#kotapilih').html(data);
					jQuery('#kecamatanpilih').html("<select name=\"KDKECAMATAN\" class=\"text required\" title=\"*\" id=\"KDKECAMATAN\"><option value=\"0\"> --pilih-- </option></select>");
					jQuery('#kelurahanpilih').html("<select name=\"KELURAHAN\" class=\"text required\" title=\"*\" id=\"KELURAHAN\"><option value=\"0\"> --pilih-- </option></select>");
				});
			});
		});
		</script>
        <style type="text/css">
.loader{background:url(js/loading.gif) no-repeat; width:16px; height:16px; float:right; margin-right:30px;}
input.error{ border:1px solid #F00;}
label.error{ color:#F00; font-weight:bold;}

</style>
    	<form action="models/pendaftaran_bayi.php" method="post" id="myform">
    		<fieldset class="fieldset"><legend>Identitas</legend>
			<table width="80%" border="0" cellpadding="0" cellspacing="0" title=" From Ini Berfungsi Sebagai Form Entry Data Bayi Baru." style="float:left;">
        	<tr><td valign="top" width="3%" rowspan="16"><img src="img/data.png" /></td>
            	<td>Nomr Orang Tua</td><td><input type="text" name="parent_nomr" id="parent_nomr" class="text required" title="*" /><span id="parent_nama" style="font-weight:bold;"></span></td></tr>
                <td>Ruang Lahir</td><td>
                	<input type="radio" name="ruang" value="ok" class="ruang required" title="*" /> Ruang OK 
                    <input type="radio" class="ruang required" name="ruang" value="vk" title="*" /> Ruang VK <span id="load_dokterjaga"></span></td></tr>
                <td>Carabayar</td><td>
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
<input type="text" name="KETBAYAR" title="*" id="carabayar_lain" <?php echo $cssb;?> value="<?php echo $_REQUEST['KETBAYAR']; ?>" class="text"/>
                	</td></tr>
				<td>Shift</td><td>
                <input type="radio" name="SHIFT" class="required" title="*" value="1" <? if($_GET['SHIFT']=="1")echo "Checked";?>/> 1
            	<input type="radio" name="SHIFT" class="required" title="*" value="2" <? if($_GET['SHIFT']=="2")echo "Checked";?>/> 2
            	<input type="radio" name="SHIFT" class="required" title="*" value="3" <? if($_GET['SHIFT']=="3")echo "Checked";?>/> 3 </td></tr>
				<td width="23%">Nama Lengkap Bayi</td>
                <td width="54%"><input class="text required" title="*" type="text" name="NAMA" size="30" value="<? if(!empty($_GET['NAMA'])){ echo $_GET['NAMA']; }?>" id="NAMA"  />
                  <!--
                  <select name="CALLER" class="text">
                    <option selected="selected" value="">- Alias -</option>
                    <option value="Tn." <? if($_GET['CALLER']=="Tn.") echo "selected=selected"; ?>> Tn </option>
                    <option value="Ny." <? if($_GET['CALLER']=="Ny.") echo "selected=selected"; ?>> Ny </option>
                    <option value="Nn." <? if($_GET['CALLER']=="Nn.") echo "selected=selected"; ?>> Nn </option>
                    <option value="An." <? if($_GET['CALLER']=="An.") echo "selected=selected"; ?>> An </option>
                  </select>-->
          		</td></tr>
        	<tr><td>Tempat Tanggal Lahir</td>
            	<td>Tempat<input type="text" value="<? if(!empty($_GET['TEMPAT'])){ echo $_GET['TEMPAT']; } ?>" class="text required" title="*" name="TEMPAT" size="15" id="TEMPAT" />
						<input onblur="calage1(this.value,'umur');" type="text" class="text required" title="*" value="<? if(!empty($_GET['TGLLAHIR'])){ echo date('d/m/Y', strtotime($_GET['TGLLAHIR'])); }else{ echo date('d/m/Y');} ?>" name="TGLLAHIR" id="TGLLAHIR" size="20" />
            <a href="javascript:showCal1('Calendar1')"><img align="top" src="img/date.png" border="0" /></a> ex : 29/09/1999</td>
          </tr>
        <tr>
          <td>Umur </td>
          <td>
          <?php 
		  if 	( $_REQUEST['TGLLAHIR']==""){ $a = datediff(date("Y/m/d"), date("Y/m/d")); }
		  else 	{ $a = datediff($_REQUEST['TGLLAHIR'], date("Y/m/d")); }
		  ?>
          <span id="umurc"><input class="text" type="text" value="<?php echo 'umur '.$a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?>" name="umur" id="umur" size="45" /></span></td>
          </tr>
        <tr>
          <td valign="top">Alamat Sekarang</td>
          <td colspan="1"><input name="ALAMAT" id="ALAMAT" class="text required" title="*" type="text" value="<? if(!empty($_GET['ALAMAT'])){ echo $_GET['ALAMAT']; }?>" size="45" /></td>
          </tr>
        <tr>
          <td>Alamat KTP</td>
          <td><input name="ALAMAT_KTP" class="text" type="text" value="<? if(!empty($_GET['ALAMAT_KTP'])){ echo $_GET['ALAMAT_KTP']; }?>" size="45" id="ALAMAT_KTP" /></td>
        </tr>
        <tr>
          <td>Provinsi</td>
          <td><select name="KDPROVINSI" class="text required" title="*" id="KDPROVINSI">
            <option value="0"> --pilih-- </option>
			<?php
			  $ss	= mysql_query('select * from m_provinsi order by idprovinsi ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($_GET['KDPROVINSI'] == $ds['idprovinsi']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$ds['idprovinsi'].'" '.$sel.' > '.$ds['namaprovinsi'].'</option>';
			  }
			?>
          </select></td>
        </tr>
        <tr>
          <td>Kota</td>
          <td><div id="kotapilih"><select name="KOTA" class="text required" title="*" id="KOTA">
            <option value="0"> --pilih-- </option>
			<?php
			  $ss	= mysql_query('select * from m_kota where idprovinsi = "'.$_GET['KDPROVINSI'].'" order by idkota ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($_GET['KOTA'] == $ds['idkota']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$ds['idkota'].'" '.$sel.' > '.$ds['namakota'].'</option>';
			  }
			?>
          </select></div></td>
        </tr>
        <tr>
          <td>Kecamatan</td>
          <td><div id="kecamatanpilih"><select name="KDKECAMATAN" class="text required" title="*" id="KDKECAMATAN">
            <option value="0"> --pilih-- </option>
			<?php
			  $ss	= mysql_query('select * from m_kecamatan where idkota = "'.$_GET['KOTA'].'" order by idkecamatan ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($_GET['KDKECAMATAN'] == $ds['idkecamatan']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$ds['idkecamatan'].'" '.$sel.' /> '.$ds['namakecamatan'].'</option>&nbsp;';
			  }
			?>
          </select></div></td>
        </tr>
        <tr>
          <td>Kelurahan</td>
          <td><div id="kelurahanpilih"><select name="KELURAHAN" class="text required" title="*" id="KELURAHAN">
            <option value="0"> --pilih-- </option>
			<?php
			  $ss	= mysql_query('select * from m_kelurahan where idkecamatan = "'.$_GET['KDKECAMATAN'].'" order by idkelurahan ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($_GET['KELURAHAN'] == $ds['idkelurahan']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$ds['idkelurahan'].'" '.$sel.' /> '.$ds['namakelurahan'].'</option>&nbsp;';
			  }
			?>
			</select></div></td>
        </tr>
        <tr>
          <td>No Telepon / HP </td>
          <td><input  class="text" value="<? if(!empty($_GET['NOTELP'])){ echo $_GET['NOTELP']; }?>" type="text" name="NOTELP" size="25" id="notelp" /></td>
        </tr>
        <tr>
          <td>No KTP </td>
          <td><input  class="text" value="<? if(!empty($_GET['NOKTP'])){ echo $_GET['NOKTP']; }?>" type="text" name="NOKTP" id="NOKTP" size="25" /></td>
          </tr>
        <tr>
          <td>Nama Suami / Orang Tua </td>
          <td><input class="text" type="text" value="<? if(!empty($_GET['SUAMI_ORTU'])){ echo $_GET['SUAMI_ORTU']; }?>" name="SUAMI_ORTU" id="SUAMI_ORTU" size="25" /></td>
          </tr>
        <tr valign="top">
		  <td valign="top">&nbsp;</td>
          <td height="22" valign="top">Pekerjaan Pasien / Orang Tua</td>
          <td><input class="text" type="text" value="<? if(!empty($_GET['PEKERJAAN'])){ echo $_GET['PEKERJAAN']; }?>" name="PEKERJAAN" size="25" id="PEKERJAAN" /></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top">Nama Penanggung Jawab</td>
          <td valign="top"><input class="text" type="text" name="nama_penanggungjawab" size="30" value="<? if(!empty($_GET['nama_penanggungjawab'])){ echo $_GET['nama_penanggungjawab']; } ?>" id="nama_penanggungjawab"  /></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top">Hubungan Dengan Pasien</td>
          <td valign="top"><input class="text" type="text" name="hubungan_penanggungjawab" size="30" value="<? if(!empty($_GET['hubungan_penanggungjawab'])){ echo $_GET['hubungan_penanggungjawab']; } ?>" id="hubungan_penanggungjawab" /></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top">Alamat</td>
          <td valign="top"><input name="alamat_penanggungjawab" class="text" type="text" size="45" value="<? if(!empty($_GET['alamat_penanggungjawab'])){ echo $_GET['alamat_penanggungjawab']; } ?>" id="alamat_penanggungjawab" /></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top">No Telepon / HP</td>
          <td valign="top"><input  class="text" type="text" name="phone_penanggungjawab" size="25" value="<? if(!empty($_GET['phone_penanggungjawab'])){ echo $_GET['phone_penanggungjawab']; } ?>" id="phone_penanggungjawab" /></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td colspan="2"><input type='hidden' name='stop_daftar' id='stop_daftar' /></td>
        </tr>
      </table>
		<table width="15%" style="float:right;">
        	<tr><td width="20%" rowspan="19" valign="top"> Jenis Kelamin :<br />
            <input type="radio" name="JENISKELAMIN" class="required" title="*" id="JENISKELAMIN_L" value="L" <? if(strtoupper($_GET['JENISKELAMIN'])=="L") echo "Checked";?>/> Laki-laki<br />
            <input type="radio" name="JENISKELAMIN" class="required" title="*" id="JENISKELAMIN_P" value="P" <? if(strtoupper($_GET['JENISKELAMIN'])=="P") echo "Checked";?>/> Perempuan<br />
            <br />
            Status Perkawinan :<br />
            <input type="radio" name="STATUS" id="status_1" value="1" <? if($_GET['STATUS']=="1") echo "Checked";?>/>
            Belum Kawin<br />
            <input type="radio" name="STATUS" id="status_2" value="2" <? if($_GET['STATUS']=="2") echo "Checked";?> />
            Kawin<br />
            <input type="radio" name="STATUS" id="status_3" value="3" <? if($_GET['STATUS']=="3") echo "Checked";?>/>
            Janda / Duda<br /><br />
            
            Pendidikan Terakhir :<br />
            <input type="radio" name="PENDIDIKAN" id="PENDIDIKAN_1" value="1" <? if($_GET['PENDIDIKAN']=="1") echo "Checked";?> />
            SD<br />
            <input type="radio" name="PENDIDIKAN" id="PENDIDIKAN_2" value="2" <? if($_GET['PENDIDIKAN']=="2") echo "Checked";?> />
            SLTP<br />
            <input type="radio" name="PENDIDIKAN" id="PENDIDIKAN_3" value="3" <? if($_GET['PENDIDIKAN']=="3") echo "Checked";?> />
            SMU<br />
            <input type="radio" name="PENDIDIKAN" id="PENDIDIKAN_4" value="4" <? if($_GET['PENDIDIKAN']=="4") echo "Checked";?> />
            D3/Akademik<br />
            <input type="radio" name="PENDIDIKAN" id="PENDIDIKAN_5" value="5" <? if($_GET['PENDIDIKAN']=="5") echo "Checked";?> />
            Universitas<br /><br />
           
            Agama :<br />
             <input type="radio" name="AGAMA" id="AGAMA_1" value="1" <? if($_GET['AGAMA']=="1") echo "Checked";?> />
Islam<br />

<input type="radio" name="AGAMA" id="AGAMA_2" value="2" <? if($_GET['AGAMA']=="2") echo "Checked";?>/>
Kristen Protestan<br />

<input type="radio" name="AGAMA" id="AGAMA_3" value="3" <? if($_GET['AGAMA']=="3") echo "Checked";?>/>
Katholik<br />

<input type="radio" name="AGAMA" id="AGAMA_4" value="4" <? if($_GET['AGAMA']=="4") echo "Checked";?>/>
Hindu<br />

<input type="radio" name="AGAMA" id="AGAMA_5" value="5" <? if($_GET['AGAMA']=="5") echo "Checked";?>/>
Budha<br />

<input type="radio" name="AGAMA" id="AGAMA_6" value="6" <? if($_GET['AGAMA']=="6") echo "Checked";?>/>
Lain - lain </td></tr>
        </table>
        <br clear="all" />
        <table width="100%">
        <tr>
          <td colspan="4" align="right">
          <input type="submit" name="daftar" class="text" value="  S a v e  " />
          <a href="#" onclick="cetak();" >
          <input type="button" name="print" class="text" value=" Print Kartu Pasien " />
          </a>
          </td>
        </tr>
        </table>
      <input type="text" id="msgid" name="msgid" style="border:1px #FFF solid; width:0px; height:0px;">
      <br>
    </fieldset>
    </form>
</div>
</div>