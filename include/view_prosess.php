<SCRIPT LANGUAGE="JavaScript">

jQuery(document).ready(function(){

	jQuery("#KDPROVINSI").change(function(){
		var selectValues = jQuery("#KDPROVINSI").val();
		var kotaHidden = jQuery("#KOTAHIDDEN").val();
		var kecHidden = jQuery("#KECAMATANHIDDEN").val();
		jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{kdprov:selectValues, kdkota:kotaHidden, kdkec:kecHidden, load_kota:'true'},function(data){
			jQuery('#kotapilih').html(data);
			jQuery('#KOTA').val(kotaHidden).change();
			jQuery('#kecamatanpilih').html("<select name=\"KDKECAMATAN\" class=\"text required\" title=\"*\" id=\"KDKECAMATAN\"><option value=\"0\"> --pilih-- </option></select>");
			jQuery('#kelurahanpilih').html("<select name=\"KELURAHAN\" class=\"text required\" title=\"*\" id=\"KELURAHAN\"><option value=\"0\"> --pilih-- </option></select>");
		});
	});
	
});
</SCRIPT>
	<script type="text/javascript">
  </script>
      <div id='msg'></div>
	<div id="list_data"></div>
    <fieldset class="fieldset"><legend>Data Pasien</legend>
	 
      <table width="70%" border="0" id="tablebody" cellpadding="0" cellspacing="0" title=" From Ini Berfungsi Sebagai Form Entry Data Pasien Baru." style="float:left;">
        <thead>
		
	    <tr>
          <td width="23%">Nama Lengkap Pasien</td>
          <td width="54%"><span id="nam"><input title="*" class="text required" type="text" name="NAMA" size="30" value="<? //if(!empty($_GET['NAMA'])){ echo $_GET['NAMA']; } ?>" id="NAMA"  /></span>
          <select name="CALLER" class="text" id="CALLER">
          	<option selected="selected" value="">- Alias -</option>
            <option value="Tn" <? if($_GET['CALLER']=="Tn") echo "selected=selected"; ?>> Tn </option>
            <option value="Ny" <? if($_GET['CALLER']=="Ny") echo "selected=selected"; ?>> Ny </option>
            <option value="Nn" <? if($_GET['CALLER']=="Nn") echo "selected=selected"; ?>> Nn </option>
	     <option value="An" <? if($_GET['CALLER']=="An") echo "selected=selected"; ?>> An </option>
	     
          </select>
          </td>
          
        </tr>
        <tr>
          <td>Tempat Tanggal Lahir</td>
          <td>Tempat
            <input type="text" value="<? if(!empty($_GET['TEMPAT'])){ echo $_GET['TEMPAT']; }else{ echo $m_pasien->TEMPAT;} ?>" class="text required" title="*" name="TEMPAT" size="15" id="TEMPAT" />
            <input onblur="calage1(this.value,'umur');" type="text" class="text required" title="*" value="<? if(!empty($_GET['TGLLAHIR'])){ echo date('d/m/Y', strtotime($_GET['TGLLAHIR'])); }else{ echo date('d/m/Y', strtotime($m_pasien->TGLLAHIR));} ?>" name="TGLLAHIR" id="TGLLAHIR" size="20" />
            <a href="javascript:showCal1('Calendar1')"><img align="top" src="img/date.png" border="0" /></a> ex : 29/09/1999</td>
          </tr>
        <tr>
          <td>Umur </td>
          <td>
          <?php 
		  if ($m_pasien->TGLLAHIR==""){
			  $a = datediff(date("Y/m/d"), date("Y/m/d"));
		  }
		  else {
			   $a = datediff($m_pasien->TGLLAHIR, date("Y/m/d"));
		  }
		  ?>
          <span id="umurc"><input class="text" type="text" value="<?php //echo 'umur '.$a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?>" name="umur" id="umur" size="45" /></span></td>
          </tr>
        <tr>
          <td valign="top">Alamat Sekarang</td>
          <td colspan="1"><input name="ALAMAT" id="ALAMAT" class="text required" type="text" value="<? if(!empty($_GET['ALAMAT'])){ echo $_GET['ALAMAT']; } ?>" title="*" size="45" /></td>
          </tr>
        <tr>
          <td>Alamat KTP</td>
          <td><input name="ALAMAT_KTP" class="text" type="text" value="<? if(!empty($_GET['ALAMAT_KTP'])){ echo $_GET['ALAMAT_KTP']; } ?>" size="45" id="ALAMAT_KTP" /></td>
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
          </select>
		  <input class="text" value="<?=$_GET['KOTA']?>" type="hidden" name="KOTAHIDDEN" id="KOTAHIDDEN" >
		  <input class="text" value="<?=$_GET['KECAMATAN']?>" type="hidden" name="KECAMATANHIDDEN" id="KECAMATANHIDDEN" >
		  <input class="text" value="<?=$_GET['KELURAHAN']?>" type="hidden" name="KELURAHANHIDDEN" id="KELURAHANHIDDEN" ></td>
        </tr>
        <tr>
          <td>Kabupaten / Kota</td>
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
          <td><input  class="text" value="<? if(!empty($_GET['NOTELP'])){ echo $_GET['NOTELP']; }else{ echo $m_pasien->NOTELP;} ?>" type="text" name="NOTELP" size="25" id="notelp" /></td>
        </tr>
        <tr>
          <td>No KTP </td>
          <td><input  class="text" value="<? if(!empty($_GET['NOKTP'])){ echo $_GET['NOKTP']; }else{ echo $m_pasien->NOKTP;} ?>" type="text" name="NOKTP" id="NOKTP" size="25" /></td>
          </tr>
        <tr>
          <td>Nama Suami / Orang Tua </td>
          <td><input class="text" type="text" value="<? if(!empty($_GET['SUAMI_ORTU'])){ echo $_GET['SUAMI_ORTU']; }else{ echo $m_pasien->SUAMI_ORTU;} ?>" name="SUAMI_ORTU" id="SUAMI_ORTU" size="25" /></td>
          </tr>
        <!--<tr valign="top">-->
		<tr>
          <!--<td height="22" valign="top">--><td>Pekerjaan Pasien / Orang Tua</td>
          <td><input class="text" type="text" value="<? if(!empty($_GET['PEKERJAAN'])){ echo $_GET['PEKERJAAN']; }else{ echo $m_pasien->PEKERJAAN;} ?>" name="PEKERJAAN" size="25" id="PEKERJAAN" /></td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">Nama Penanggung Jawab</td>
          <td valign="top"><input class="text" type="text" name="nama_penanggungjawab" size="30" value="<? if(!empty($_GET['nama_penanggungjawab'])){ echo $_GET['nama_penanggungjawab']; } ?>" id="nama_penanggungjawab"  /></td>
        </tr>
        <tr>
          <td valign="top">Hubungan Dengan Pasien</td>
          <td valign="top"><input class="text" type="text" name="hubungan_penanggungjawab" size="30" value="<? if(!empty($_GET['hubungan_penanggungjawab'])){ echo $_GET['hubungan_penanggungjawab']; } ?>" id="hubungan_penanggungjawab" /></td>
        </tr>
        <tr>
          <td valign="top">Alamat</td>
          <td valign="top"><input name="alamat_penanggungjawab" class="text" type="text" size="45" value="<? if(!empty($_GET['alamat_penanggungjawab'])){ echo $_GET['alamat_penanggungjawab']; } ?>" id="alamat_penanggungjawab" /></td>
        </tr>
        <tr>
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
          <td colspan="2"><input type='hidden' name='stop_daftar' id='stop_daftar' /></td>
        </tr>
      </table>
	  
		<table width="25%" style="float:right;">
        	<tr><td width="20%" rowspan="19" valign="top"> Jenis Kelamin :<br />
            <input type="radio" name="JENISKELAMIN" id="JENISKELAMIN_L" title="*" class="required" value="L" <? //if(strtoupper($_GET['JENISKELAMIN'])=="L") echo "Checked";?>/>
            Laki-laki<br />
<input type="radio" name="JENISKELAMIN" id="JENISKELAMIN_P" title="*" class="required" value="P" <? //if(strtoupper($_GET['JENISKELAMIN'])=="P") echo "Checked";?>/>
            Perempuan<br />
            <br />
            Status Perkawinan :<br />
            
            <input type="radio" name="STATUS" id="status_1" value="1" <? if($m_pasien->STATUS=="1" || $_GET['STATUS']=="1") echo "Checked";?>/>
            Belum Kawin<br />
            <input type="radio" name="STATUS" id="status_2" value="2" <? if($m_pasien->STATUS=="2" || $_GET['STATUS']=="2") echo "Checked";?> />
            Kawin<br />
            <input type="radio" name="STATUS" id="status_3" value="3" <? if($m_pasien->STATUS=="3" || $_GET['STATUS']=="3") echo "Checked";?>/>
            Janda / Duda<br /><br />
            
            Pendidikan Terakhir :<br />
            <input type="radio" name="PENDIDIKAN" id="PENDIDIKAN_1" value="1" <? if($m_pasien->PENDIDIKAN=="1" || $_GET['PENDIDIKAN']=="1") echo "Checked";?> />
            SD<br />
            <input type="radio" name="PENDIDIKAN" id="PENDIDIKAN_2" value="2" <? if($m_pasien->PENDIDIKAN=="2" || $_GET['PENDIDIKAN']=="2") echo "Checked";?> />
            SLTP<br />
            <input type="radio" name="PENDIDIKAN" id="PENDIDIKAN_3" value="3" <? if($m_pasien->PENDIDIKAN=="3" || $_GET['PENDIDIKAN']=="3") echo "Checked";?> />
            SMU<br />
            <input type="radio" name="PENDIDIKAN" id="PENDIDIKAN_4" value="4" <? if($m_pasien->PENDIDIKAN=="4" || $_GET['PENDIDIKAN']=="4") echo "Checked";?> />
            D3/Akademik<br />
            <input type="radio" name="PENDIDIKAN" id="PENDIDIKAN_5" value="5" <? if($m_pasien->PENDIDIKAN=="5" || $_GET['PENDIDIKAN']=="5") echo "Checked";?> />
            Universitas<br /><br />
           
            Agama :<br />
             <input type="radio" name="AGAMA" id="AGAMA_1" value="1" <? if($m_pasien->AGAMA=="1" || $_GET['AGAMA']=="1") echo "Checked";?> />
Islam<br />

<input type="radio" name="AGAMA" id="AGAMA_2" value="2" <? if($m_pasien->AGAMA=="2" || $_GET['AGAMA']=="2") echo "Checked";?>/>
Kristen Protestan<br />

<input type="radio" name="AGAMA" id="AGAMA_3" value="3" <? if($m_pasien->AGAMA=="3" || $_GET['AGAMA']=="3") echo "Checked";?>/>
Katholik<br />

<input type="radio" name="AGAMA" id="AGAMA_4" value="4" <? if($m_pasien->AGAMA=="4" || $_GET['AGAMA']=="4") echo "Checked";?>/>
Hindu<br />

<input type="radio" name="AGAMA" id="AGAMA_5" value="5" <? if($m_pasien->AGAMA=="5" || $_GET['AGAMA']=="5") echo "Checked";?>/>
Budha<br />

<input type="radio" name="AGAMA" id="AGAMA_6" value="6" <? if($m_pasien->AGAMA=="6" || $_GET['AGAMA']=="6") echo "Checked";?>/>
Lain - lain </td></tr>
        </table>
        <br clear="all" />
        <table width="100%">
        <tr>
          <td colspan="4" align="right">
          <input type="submit" name="daftar" class="text" value="  S I M P A N "
          onclick="stopjam();" />
          <!--<a href="../cetak_kartupasien.php?NOMR=000001"-->
          <a href="#" onclick="cetak();" >
          <input type="button" name="print" class="text" value=" Print Kartu Pasien " />
          </a>
		  <!--<a href="#" onclick="get_cbg();" >
          <input type="button" name="print" class="text" value=" Send Data Pasien to CBG " />
          </a>-->
          </td>
        </tr>
		</thead>
  
  </tbody>
        </table>
      <input type="text" id="msgid" name="msgid" style="border:1px #FFF solid; width:0px; height:0px;">
      <br>
    </fieldset>
<? if(!empty($_GET['TGLLAHIR'])){ ?>    
<script language="javascript" >
calage1('<?=$_GET['TGLLAHIR']?>','umur');
</script>
<? } ?>

<script language="javascript" type="text/javascript">
function cetak(){
var nomr = document.getElementById('NOMR').value;
var nama = document.getElementById('NAMA').value;
var alamat = document.getElementById('ALAMAT').value;
var TGLLAHIR = document.getElementById('TGLLAHIR').value;
var JENISKELAMIN = document.getElementById('JENISKELAMIN_L').value;

//window.open("pdfb/kartupasien.php?NOMR="+ nomr +"&NAMA="+ nama +"&ALAMAT="+ alamat+"&TGLLAHIR="+ TGLLAHIR+"&JENISKELAMIN="+ JENISKELAMIN,"mywindow");

if (nomr==='-automatic-' || nama==''){
  alert('No RM belum ada');
}else{  
  window.open("cetak_kartupasien.php?NOMR="+ nomr,"mywindow");
}
return false;

}
</script>
<script language="javascript" type="text/javascript">
function get_cbg(){
var nomr = document.getElementById('NOMR').value;
var nama = document.getElementById('NAMA').value;
var alamat = document.getElementById('ALAMAT').value;
var TGLLAHIR = document.getElementById('TGLLAHIR').value;
var JENISKELAMIN = document.getElementById('JENISKELAMIN_L').value;
var JENISBAYAR= document.getElementById('KDCARABAYAR').value;
var nopeserta= document.getElementById('kartu1').value;
var nosep= document.getElementById('NOKARTU').value;
var jenisperawatan= '2';
var tglpelayanan= document.getElementById('TGLREG').value;
var tglkeluar= document.getElementById('TGLREG').value;
window.open("http://192.168.40.151/inacbg/parse_json_simrs.php?NOMR="+ nomr +"&NAMA="+ nama +"&ALAMAT="+ alamat+"&TGLLAHIR="+ TGLLAHIR+"&JENISKELAMIN="+ JENISKELAMIN+"&JENISBAYAR="+ JENISBAYAR+"&nopeserta="+ nopeserta+"&nosep="+ nosep+"&jenisperawatan="+ jenisperawatan+"&tglpelayanan="+ tglpelayanan+"&tglkeluar="+ tglkeluar,"mywindow");
return false;

}
</script>
  