<script language="javascript" src="include/cal3.js"></script>
<script language="javascript" src="include/cal_conf3.js"></script>

<SCRIPT LANGUAGE="JavaScript">
    function stopjam(){
var d = new Date();
var curr_hour = d.getHours();
var curr_min = d.getMinutes();
var curr_sec = d.getSeconds();
document.getElementById('stop_daftar').value=(curr_hour + ":" + curr_min+ ":" + curr_sec);
	}
</SCRIPT>
<script>
jQuery(document).ready(function(){

	jQuery('#TGLLAHIR').blur(function(){
		var tgl = jQuery(this).val();						  
		if(tgl == ('0000/00/00') || tgl == ('0000-00-00') || tgl == ('00-00-0000') || tgl == ('00/00/0000')  ){
			alert('Tanggal Lahir Tidak Boleh 00-00-0000');
			jQuery(this).val('');
		}
	});
	
	jQuery("#KDPROVINSI").change(function(){
		var selectValues = jQuery("#KDPROVINSI").val();
		jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{kdprov:selectValues,load_kota:'true'},function(data){
			jQuery('#kotapilih').html(data);
			jQuery('#kecamatanpilih').html("<select name=\"KDKECAMATAN\" class=\"text required\" title=\"*\" id=\"KDKECAMATAN\"><option value=\"0\"> --pilih-- </option></select>");
			jQuery('#kelurahanpilih').html("<select name=\"KELURAHAN\" class=\"text required\" title=\"*\" id=\"KELURAHAN\"><option value=\"0\"> --pilih-- </option></select>");
		});
	});
	
});
</script>
      <div id='msg'></div>
	<div id="list_data"></div>
    <fieldset class="fieldset"><legend>Identitas Pasien</legend>
	<table width="70%" border="0" cellpadding="0" cellspacing="0" title=" From Ini Berfungsi Sebagai Form Entry Data Pasien Baru." style="float:left;">
    <tr><td width="20%">Nama Lengkap Pasien</td><td width="56%">
    	<input class="text required" type="text" <?php if($_SESSION['NAMA']){ echo"value='".$_SESSION['NAMA']."'";} ?> name="NAMA" size="30" value="<?=$m_pasien->NAMA?>" id="AWAL"  /></td></tr>
        <tr>
          <td>Tempat Tanggal Lahir</td>
          <td>Tempat
            <input type="text" value="<? if($m_pasien->TEMPAT || $_SESSION['TEMPAT']){ echo $_SESSION['TEMPAT'].$m_pasien->TEMPAT; }?>" class="text required" name="TEMPAT" size="15" />
            <input onblur="calage1(this.value,'umur');" type="text" class="text required" value="<? if($m_pasien->TGLLAHIR || $_SESSION['TGLLAHIR']){ echo date('d/m/Y', strtotime($_SESSION['TGLLAHIR'].$m_pasien->TGLLAHIR)); }?>" name="TGLLAHIR" id="TGLLAHIR" size="20" />
            <a href="javascript:showCal1('Calendar1')"><img align="top" src="img/date.png" border="0" /></a> ex : 29/09/1999</td>
          </tr>
        <tr>
          <td>Umur Pasien</td>
          <td>
          <?php 
		  if ($m_pasien->TGLLAHIR==""){
			  $a = datediff(date("Y/m/d"), date("Y/m/d"));
		  }
		  else {
		       $a = datediff($m_pasien->TGLLAHIR, date("Y/m/d"));
		  }
		  ?>
          <span id="umurc"><input class="text required" type="text" value="<?php echo 'umur '.$a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?>" name="umur" id="umur" size="45" /></span></td>
          </tr>
        <tr>
          <td valign="top">Alamat Pasien</td>
          <td colspan="1"><input name="ALAMAT" class="text required" type="text" value="<? if($m_pasien->ALAMAT || $_SESSION['ALAMAT']){echo $_SESSION['ALAMAT'].$m_pasien->ALAMAT;} ?>" size="45" /></td>
          </tr>
        <tr>
          <td>Provinsi</td>
          <td><select name="KDPROVINSI" class="text required" title="*" id="KDPROVINSI">
            <option value="0"> --pilih-- </option>
			<?php
			  $ss	= mysql_query('select * from m_provinsi order by idprovinsi ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($_SESSION['KDPROVINSI'] == $ds['idprovinsi']): $sel = "selected=Selected"; else: $sel = ''; endif;
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
			  $ss	= mysql_query('select * from m_kota where idprovinsi = "'.$_SESSION['KDPROVINSI'].'" order by idkota ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($_SESSION['KOTA'] == $ds['idkota']): $sel = "selected=Selected"; else: $sel = ''; endif;
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
			  $ss	= mysql_query('select * from m_kecamatan where idkota = "'.$_SESSION['KOTA'].'" order by idkecamatan ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($_SESSION['KDKECAMATAN'] == $ds['idkecamatan']): $sel = "selected=Selected"; else: $sel = ''; endif;
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
			  $ss	= mysql_query('select * from m_kelurahan where idkecamatan = "'.$_SESSION['KDKECAMATAN'].'" order by idkelurahan ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($_SESSION['KELURAHAN'] == $ds['idkelurahan']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$ds['idkelurahan'].'" '.$sel.' /> '.$ds['namakelurahan'].'</option>&nbsp;';
			  }
			?>
			</select></div></td>
        </tr>
        <tr>
          <td>No Telepon / HP Pasien</td>
          <td><input  class="text" value="<? if($m_pasien->NOTELP || $_SESSION['NOTELP']){echo $_SESSION['NOTELP'].$m_pasien->NOTELP;}?>" type="text" name="NOTELP" size="25" /></td>
        </tr>
        <tr>
          <td>No KTP </td>
          <td><input  class="text" value="<? if($m_pasien->NOKTP || $_SESSION['NOKTP']){echo $_SESSION['NOKTP'].$m_pasien->NOKTP;}?>" type="text" name="NOKTP" size="25" /></td>
          </tr>
        <tr>
          <td>Nama Suami / Orang Tua Pasien</td>
          <td><input class="text" type="text" value="<? if($m_pasien->SUAMI_ORTU || $_SESSION['SUAMI_ORTU']){echo $_SESSION['SUAMI_ORTU'].$m_pasien->SUAMI_ORTU;}?>" name="SUAMI_ORTU" id="SUAMI_ORTU" size="25" /></td>
          </tr>
        <tr valign="top">
          <td valign="top">Pekerjaan Pasien / Orang Tua</td>
          <td><input class="text" type="text" value="<? if($m_pasien->PEKERJAAN || $_SESSION['PEKERJAAN']){echo $_SESSION['PEKERJAAN'].$m_pasien->SUAMI_ORTU;}?>" name="PEKERJAAN" size="25" /></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td colspan="2"><input type='hidden' name='stop_daftar' id='stop_daftar' /></td>
        </tr>
      </table>
      <table width="20%" style="float:right;">
      <tr> <td valign="top"> Jenis Kelamin :<br />
            <input type="radio" name="JENISKELAMIN" class="required" value="L" <? if($m_pasien->JENISKELAMIN=="L" || $m_pasien->JENISKELAMIN=="l" || $_SESSION['JENISKELAMIN'] =="L")echo "Checked";?>/>
            Laki-laki<br />
            <input type="radio" name="JENISKELAMIN" class="required" value="P" <? if($m_pasien->JENISKELAMIN=="P" || $_SESSION['JENISKELAMIN'] =="P")echo "Checked";?>/>
            Perempuan<br />
            <br />
            Status Perkawinan :<br />
            
            <input type="radio" name="STATUS" value="1" <? if($m_pasien->STATUS=="1" || $_SESSION['PEKERJAAN']=="1")echo "Checked";?>/>
            Belum Kawin<br />
            <input type="radio" name="STATUS" value="2" <? if($m_pasien->STATUS=="2" || $_SESSION['PEKERJAAN']=="2")echo "Checked";?> />
            Kawin<br />
            <input type="radio" name="STATUS" value="3" <? if($m_pasien->STATUS=="3" || $_SESSION['PEKERJAAN']=="3")echo "Checked";?>/>
            Janda / Duda<br /><br />
            
            Pendidikan Terakhir :<br />
            <input type="radio" name="PENDIDIKAN" value="1" <? if($m_pasien->PENDIDIKAN=="1" || $_SESSION['PENDIDIKAN']=="1" )echo "Checked";?> />
            SD<br />
            <input type="radio" name="PENDIDIKAN" value="2" <? if($m_pasien->PENDIDIKAN=="2" || $_SESSION['PENDIDIKAN']=="2" )echo "Checked";?> />
            SLTP<br />
            <input type="radio" name="PENDIDIKAN" value="3" <? if($m_pasien->PENDIDIKAN=="3" || $_SESSION['PENDIDIKAN']=="3" )echo "Checked";?> />
            SMU<br />
            <input type="radio" name="PENDIDIKAN" value="4" <? if($m_pasien->PENDIDIKAN=="4" || $_SESSION['PENDIDIKAN']=="4" )echo "Checked";?> />
            D3/Akademik<br />
            <input type="radio" name="PENDIDIKAN" value="5" <? if($m_pasien->PENDIDIKAN=="5" || $_SESSION['PENDIDIKAN']=="5" )echo "Checked";?> />
            Universitas<br /><br />
           
            Agama :<br />
             <input type="radio" name="AGAMA" value="1" <? if($m_pasien->AGAMA=="1" || $_SESSION['AGAMA']=="1" )echo "Checked";?> />
Islam<br />

<input type="radio" name="AGAMA" value="2" <? if($m_pasien->AGAMA=="2" || $_SESSION['AGAMA']=="2" )echo "Checked";?>/>
Kristen Protestan<br />

<input type="radio" name="AGAMA" value="3" <? if($m_pasien->AGAMA=="3" || $_SESSION['AGAMA']=="3" )echo "Checked";?>/>
Katholik<br />

<input type="radio" name="AGAMA" value="4" <? if($m_pasien->AGAMA=="4" || $_SESSION['AGAMA']=="4" )echo "Checked";?>/>
Hindu<br />

<input type="radio" name="AGAMA" value="5" <? if($m_pasien->AGAMA=="5" || $_SESSION['AGAMA']=="5" )echo "Checked";?>/>
Budha<br />

<input type="radio" name="AGAMA" value="6" <? if($m_pasien->AGAMA=="6" || $_SESSION['AGAMA']=="6" )echo "Checked";?>/>
Lain - lain </td></tr>
<tr><td><input type="submit" name="daftar" class="text" value="  S a v e  "/>
      <input type="text" id="msgid" name="msgid" style="border:1px #FFF solid; width:0px; height:0px;"></td></tr>
</table>
<br clear="all">
<br clear="all">
      
      
    </fieldset>
    
   
  