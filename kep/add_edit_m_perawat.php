<script language="javascript" src="include/cal3.js"></script>
<script language="javascript" src="include/cal_conf3.js"></script>

<?php
$sql	= mysql_query('select * from m_perawat where NIP = "'.$_REQUEST['NIP'].'" and IDPERAWAT = "'.$_REQUEST['PERID'].'"');
$data	= mysql_fetch_array($sql);
if(empty($_REQUEST['PERID'])){
	$edit = "no";
} else {
	$edit = "ok";
}
?>
<script>
/*
	Masked Input plugin for jQuery
	Copyright (c) 2007-2011 Josh Bush (digitalbush.com)
	Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license) 
	Version: 1.3
*/
(function(a){var b=(a.browser.msie?"paste":"input")+".mask",c=window.orientation!=undefined;a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},dataName:"rawMaskFn"},a.fn.extend({caret:function(a,b){if(this.length!=0){if(typeof a=="number"){b=typeof b=="number"?b:a;return this.each(function(){if(this.setSelectionRange)this.setSelectionRange(a,b);else if(this.createTextRange){var c=this.createTextRange();c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select()}})}if(this[0].setSelectionRange)a=this[0].selectionStart,b=this[0].selectionEnd;else if(document.selection&&document.selection.createRange){var c=document.selection.createRange();a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length}return{begin:a,end:b}}},unmask:function(){return this.trigger("unmask")},mask:function(d,e){if(!d&&this.length>0){var f=a(this[0]);return f.data(a.mask.dataName)()}e=a.extend({placeholder:"_",completed:null},e);var g=a.mask.definitions,h=[],i=d.length,j=null,k=d.length;a.each(d.split(""),function(a,b){b=="?"?(k--,i=a):g[b]?(h.push(new RegExp(g[b])),j==null&&(j=h.length-1)):h.push(null)});return this.trigger("unmask").each(function(){function v(a){var b=f.val(),c=-1;for(var d=0,g=0;d<k;d++)if(h[d]){l[d]=e.placeholder;while(g++<b.length){var m=b.charAt(g-1);if(h[d].test(m)){l[d]=m,c=d;break}}if(g>b.length)break}else l[d]==b.charAt(g)&&d!=i&&(g++,c=d);if(!a&&c+1<i)f.val(""),t(0,k);else if(a||c+1>=i)u(),a||f.val(f.val().substring(0,c+1));return i?d:j}function u(){return f.val(l.join("")).val()}function t(a,b){for(var c=a;c<b&&c<k;c++)h[c]&&(l[c]=e.placeholder)}function s(a){var b=a.which,c=f.caret();if(a.ctrlKey||a.altKey||a.metaKey||b<32)return!0;if(b){c.end-c.begin!=0&&(t(c.begin,c.end),p(c.begin,c.end-1));var d=n(c.begin-1);if(d<k){var g=String.fromCharCode(b);if(h[d].test(g)){q(d),l[d]=g,u();var i=n(d);f.caret(i),e.completed&&i>=k&&e.completed.call(f)}}return!1}}function r(a){var b=a.which;if(b==8||b==46||c&&b==127){var d=f.caret(),e=d.begin,g=d.end;g-e==0&&(e=b!=46?o(e):g=n(e-1),g=b==46?n(g):g),t(e,g),p(e,g-1);return!1}if(b==27){f.val(m),f.caret(0,v());return!1}}function q(a){for(var b=a,c=e.placeholder;b<k;b++)if(h[b]){var d=n(b),f=l[b];l[b]=c;if(d<k&&h[d].test(f))c=f;else break}}function p(a,b){if(!(a<0)){for(var c=a,d=n(b);c<k;c++)if(h[c]){if(d<k&&h[c].test(l[d]))l[c]=l[d],l[d]=e.placeholder;else break;d=n(d)}u(),f.caret(Math.max(j,a))}}function o(a){while(--a>=0&&!h[a]);return a}function n(a){while(++a<=k&&!h[a]);return a}var f=a(this),l=a.map(d.split(""),function(a,b){if(a!="?")return g[a]?e.placeholder:a}),m=f.val();f.data(a.mask.dataName,function(){return a.map(l,function(a,b){return h[b]&&a!=e.placeholder?a:null}).join("")}),f.attr("readonly")||f.one("unmask",function(){f.unbind(".mask").removeData(a.mask.dataName)}).bind("focus.mask",function(){m=f.val();var b=v();u();var c=function(){b==d.length?f.caret(0,b):f.caret(b)};(a.browser.msie?c:function(){setTimeout(c,0)})()}).bind("blur.mask",function(){v(),f.val()!=m&&f.change()}).bind("keydown.mask",r).bind("keypress.mask",s).bind(b,function(){setTimeout(function(){f.caret(v(!0))},0)}),v()})}})})(jQuery)

jQuery(document).ready(function(){
		jQuery('#TGLLAHIR').blur(function(){
		var tgl = jQuery(this).val();						  
		if(tgl == ('0000/00/00') || tgl == ('0000-00-00') || tgl == ('00-00-0000') || tgl == ('00/00/0000')  ){
			alert('Tanggal Lahir Tidak Boleh 00-00-0000');
			jQuery(this).val('');
		}
	});
	jQuery('#myform').validate();
	jQuery("#TGLLAHIR").mask("99/99/9999");	
	
	jQuery("#TEMKER").change(function(){
		var selectValues = jQuery("#TEMKER").val();
		if (selectValues == 0){
            var msg = "<select name=\"TEMKER2\" id=\"TEMKER2\" class=\"text\"><option value=\"0\"> --pilih-- </option></select>";
            jQuery('#tempatkerja').html(msg);
        }else if (selectValues == 1){
            var msg = "<select name=\"TEMKER2\" id=\"TEMKER2\" class=\"text\" onchange=\"pilih()\"><option value=\"0\"> --pilih-- </option><option value=\"Penyakit dalam\">Penyakit dalam</option><option value=\"Bedah\">Bedah</option><option value=\"Anak\">Anak</option><option value=\"Maternitas\">Maternitas</option><option value=\"Jiwa\">Jiwa</option><option value=\"L\">Lain-lain</option></select>";
            jQuery('#tempatkerja').html(msg);
        }else if (selectValues == 2){
            var msg = "<select name=\"TEMKER2\" id=\"TEMKER2\" class=\"text\" onchange=\"pilih()\"><option value=\"0\"> --pilih-- </option><option value=\"Poliklinik Penyakit dalam\">Poliklinik Penyakit dalam</option><option value=\"Poliklinik bedah\">Poliklinik bedah</option><option value=\"Poliklinik anak\">Poliklinik anak</option><option value=\"Poliklinik kean\">Poliklinik kean</option><option value=\"L\">Lain-lain</option></select>";
            jQuery('#tempatkerja').html(msg);
        }else if (selectValues == 3){
            var msg = "<select name=\"TEMKER2\" id=\"TEMKER2\" class=\"text\" onchange=\"pilih()\"><option value=\"0\"> --pilih-- </option><option value=\"Intensif care\">Intensif care</option><option value=\"Kamar operasi\">Kamar operasi</option><option value=\"Unit Luka Bakar\">Unit Luka Bakar</option><option value=\"NAPZA\">NAPZA</option><option value=\"Haemodialisa\">Haemodialisa</option><option value=\"L\">Lain-lain</option></select>";
            jQuery('#tempatkerja').html(msg);
        }else if (selectValues == 4){
            var msg = "<select name=\"TEMKER2\" id=\"TEMKER2\" class=\"text\"><option value=\"0\"> --pilih-- </option><option value=\"IGD\">IGD</option></select>";
            jQuery('#tempatkerja').html(msg);
        }
		jQuery('#lain').html("");
	});
	
	jQuery("#KDPROVINSI").change(function(){
		var selectValues = jQuery("#KDPROVINSI").val();
		jQuery.post('<?php echo _BASE_;?>include/ajaxload.php',{kdprov:selectValues,load_kota:'true'},function(data){
			jQuery('#kotapilih').html(data);
			jQuery('#kecamatanpilih').html("<select name=\"KDKECAMATAN\" class=\"text required\" title=\"*\" id=\"KDKECAMATAN\"><option value=\"0\"> --pilih-- </option></select>");
			jQuery('#kelurahanpilih').html("<select name=\"KELURAHAN\" class=\"text required\" title=\"*\" id=\"KELURAHAN\"><option value=\"0\"> --pilih-- </option></select>");
		});
	});
	
	jQuery("#KOTA").change(function(){
		var selectValues = jQuery("#KOTA").val();
		jQuery.post('./include/ajaxload.php',{kdkota:selectValues,load_kecamatan:'true'},function(data){
			jQuery('#kecamatanpilih').html(data);
			jQuery('#kelurahanpilih').html("<select name=\"KELURAHAN\" class=\"text required\" title=\"*\" id=\"KELURAHAN\"><option value=\"0\"> --pilih-- </option></select>");
		});
	});
	
	jQuery("#KDKECAMATAN").change(function(){
		var selectValues = jQuery("#KDKECAMATAN").val();
		jQuery.post('./include/ajaxload.php',{kdkecamatan:selectValues,load_kelurahan:'true'},function(data){
			jQuery('#kelurahanpilih').html(data);
		});
	});
});

function pilih(){
	if(document.getElementById('TEMKER2').value == "L"){
		document.getElementById('lain').innerHTML = '<input class="text" type="text" name="NAMALAIN" size="25" id="NAMALAIN" />';
	}else{
		document.getElementById('lain').innerHTML = '';
	}
}

</script>
<div align="center">
  <div id="frame">
  <div id="frame_title"><h3 align="left">IDENTITAS PERAWAT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?link=kep_riw_kerja&NIP=<?=$data['NIP'];?>&PERID=<?=$_GET['PERID']?>"  style="font-weight: bolder;padding: 5px" name="daftar2" class="text" value="Riwayat Pekerjaan">Riwayat Pekerjaan</a></h3></div>
	<div id="all">
    <form name="myform" id="myform" action="./kep/add_edit_perawat.php?edit=<?echo $edit;?>" method="post">
    
	<div id="list_data"></div>
    <fieldset class="fieldset"><legend>Identitas Perawat</legend>
      <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td>No Induk Pegawai</td>
              <td colspan="3"><input class="text" value="<?=$data['NIP']?>" type="text" name="NIP" id="NIP" size="25" >
              <input class="text" value="<?=$data['IDPERAWAT']?>" type="hidden" name="IDPERAWAT" id="IDPERAWAT" >
              </td>              
            </tr>
            <tr>
          <td width="25%">Nama Lengkap</td>
          <td width="5%"><input class="text" type="text" value="<?=$data['NAMA']?>" name="NAMA" size="25" id="NAMA" /></td>
          <td width="22%" colspan="2">&nbsp;</td>
          </tr>
        <tr>
          <td>Tempat Tanggal Lahir</td>
          <td colspan="3">Tempat
            <input type="text" value="<?=$data['TEMPAT']?>" class="text" name="TEMPAT" size="15" />
            <input type="text" class="text required" value="<?=date('d/m/Y', strtotime($data['TGLLAHIR']))?>" name="TGLLAHIR" size="20" id="TGLLAHIR" onblur="calage1(this.value,'umur');"/>
            <a href="javascript:showCal1('Calendar1')"><img align="top" src="img/date.png" border="0" /></a> ex : 29/09/1999</td>
          </tr>
		  <tr>
		  <td> Jenis Kelamin</td>
		  <td colspan="3"><select name="JENISKELAMIN" class="text">
            <option value=""> --pilih-- </option>
            <option value="L" <? if($data['JENISKELAMIN']=="L")echo "selected=Selected";?> >Laki-laki</option>
            <option value="P" <? if($data['JENISKELAMIN']=="P")echo "selected=Selected";?> >Perempuan</option>
          </select></td>
		</tr>
        <tr>
          <td>Status Perkawinan</td>
		  <td colspan="3"><select name="STATUS" class="text">
            <option value=""> --pilih-- </option>
            <option value="1" <? if($data['STATUS']=="1")echo "selected=Selected";?> >Belum Kawin</option>
            <option value="2" <? if($data['STATUS']=="2")echo "selected=Selected";?> >Kawin</option>
			<option value="3" <? if($data['STATUS']=="3")echo "selected=Selected";?> >Janda / Duda</option>
          </select></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">Alamat</td>
          <td colspan="2"><input name="ALAMAT" type="text" value="<?=$data['ALAMAT']?>" size="45" class="text" /></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>Alamat KTP</td>
          <td colspan="3"><input name="ALAMAT_KTP" class="text" type="text" value="<? if($data['ALAMAT_KTP']){ echo $data['ALAMAT_KTP']; } ?>" size="45" /></td>
        </tr>
        <tr>
          <td>Provinsi</td>
          <td colspan="3"><select name="KDPROVINSI" class="text required" title="*" id="KDPROVINSI">
            <option value="0"> --pilih-- </option>
			<?php
			  $ss	= mysql_query('select * from m_provinsi order by idprovinsi ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($data['KDPROVINSI'] == $ds['idprovinsi']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$ds['idprovinsi'].'" '.$sel.' /> '.$ds['namaprovinsi'].'</option>&nbsp;';
			  }
			?>
          </select>
		  <input class="text" value="" type="hidden" name="KOTAHIDDEN" id="KOTAHIDDEN" >
		  <input class="text" value="" type="hidden" name="KECAMATANHIDDEN" id="KECAMATANHIDDEN" >
		  <input class="text" value="" type="hidden" name="KELURAHANHIDDEN" id="KELURAHANHIDDEN" ></td>
        </tr>
        <tr>
          <td>Kota</td>
          <td colspan="3"><div id="kotapilih"><select name="KOTA" class="text required" title="*" id="KOTA">
            <option value="0"> --pilih-- </option>
			<?php
			  $ss	= mysql_query('select * from m_kota where idprovinsi = "'.$data['KDPROVINSI'].'" order by idkota ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($data['KOTA'] == $ds['idkota']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$ds['idkota'].'" '.$sel.' /> '.$ds['namakota'].'</option>&nbsp;';
			  }
			?>
          </select></div></td>
        </tr>
        <tr>
          <td>Kecamatan</td>
          <td colspan="3"><div id="kecamatanpilih"><select name="KDKECAMATAN" class="text required" title="*" id="KDKECAMATAN">
            <option value="0"> --pilih-- </option>
			<?php
			  $ss	= mysql_query('select * from m_kecamatan where idkota = "'.$data['KOTA'].'" order by idkecamatan ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($data['KDKECAMATAN'] == $ds['idkecamatan']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$ds['idkecamatan'].'" '.$sel.' /> '.$ds['namakecamatan'].'</option>&nbsp;';
			  }
			?>
          </select></div></td>
        </tr>
        <tr>
          <td>Kelurahan</td>
          <td colspan="3"><div id="kelurahanpilih"><select name="KELURAHAN" class="text required" title="*" id="KELURAHAN">
            <option value="0"> --pilih-- </option>
			<?php
			  $ss	= mysql_query('select * from m_kelurahan where idkecamatan = "'.$data['KDKECAMATAN'].'" order by idkelurahan ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($data['KELURAHAN'] == $ds['idkelurahan']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$ds['idkelurahan'].'" '.$sel.' /> '.$ds['namakelurahan'].'</option>&nbsp;';
			  }
			?>
			</select></div></td>
        </tr>
        <tr>
          <td>No Telepon / HP</td>
          <td colspan="3"><input  class="text" value="<?=$data['NOTELP']?>" type="text" name="NOTELP" size="25" /></td>
        </tr>
        <tr>
          <td>No KTP </td>
          <td><input  class="text" value="<?=$data['NOKTP']?>" type="text" name="NOKTP" size="25" /></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">Agama </td>
          <td colspan="4"><select name="AGAMA" class="text">
            <option value="0"> --pilih-- </option>
            <option value="1" <? if($data['AGAMA']=="1")echo "selected=Selected";?> >Islam</option>
            <option value="2" <? if($data['AGAMA']=="2")echo "selected=Selected";?> >Kristen Protestan</option>
            <option value="3" <? if($data['AGAMA']=="3")echo "selected=Selected";?> >Katholik</option>
            <option value="4" <? if($data['AGAMA']=="4")echo "selected=Selected";?> >Hindu</option>
            <option value="5" <? if($data['AGAMA']=="5")echo "selected=Selected";?> >Budha</option>
            <option value="6" <? if($data['AGAMA']=="6")echo "selected=Selected";?> >Lain - lain</option>
		</select></td>
        </tr>
        <tr>
          <td valign="top">Pendidikan Terakhir</td>
          <td colspan="4"><select name="PENDIDIKAN" class="text">
            <option value="0"> --pilih-- </option>
            <option value="1" <? if($data['PENDIDIKAN']=="1")echo "selected=Selected";?> >SPK</option>
            <option value="2" <? if($data['PENDIDIKAN']=="2")echo "selected=Selected";?> >D III Keperawatan</option>
            <option value="3" <? if($data['PENDIDIKAN']=="3")echo "selected=Selected";?> >Ners (S.Kp dan Ns.)</option>
            <option value="4" <? if($data['PENDIDIKAN']=="4")echo "selected=Selected";?> >S2 Magister Keperawatan (Manajemen & Kepemimpinan)</option>
            <option value="5" <? if($data['PENDIDIKAN']=="5")echo "selected=Selected";?> >Ners Spesialis</option>
            <option value="6" <? if($data['PENDIDIKAN']=="6")echo "selected=Selected";?> >S3 Keperawatan</option>
		</select></td>
        </tr>
        <tr>
          <td valign="top">Pelatihan Manajemen Keperawatan</td>
		  <?$val = split(",",$data['PELMANKEP']); $i = 0;?>
          <td colspan="4"><input type="checkbox" name="PELMANKEP[]" value="01" <? if($val[$i]=="01"){echo "Checked"; $i++;}?> />
            Manajemen ruangan<br>
            <input type="checkbox" name="PELMANKEP[]" value="02" <? if($val[$i]=="02"){echo "Checked"; $i++;}?> />
            SP2KP<br>
            <input type="checkbox" name="PELMANKEP[]" value="03" <? if($val[$i]=="03"){echo "Checked"; $i++;}?> />
            PPI RS<br>
            <input type="checkbox" name="PELMANKEP[]" value="04" <? if($val[$i]=="04"){echo "Checked"; $i++;}?> />
            Patient safety<br>
            <input type="checkbox" name="PELMANKEP[]" value="05" <? if($val[$i]=="05"){echo "Checked"; $i++;}?> />
            Manajemen logistik<br>
			<input type="checkbox" name="PELMANKEP[]" value="06" <? if($val[$i]=="06"){echo "Checked"; $i++;}?> />
			Utilisasi tenaga keperawatan<br>
			<input type="checkbox" name="PELMANKEP[]" value="07" <? if($val[$i]=="07"){echo "Checked"; $i++;}?> />
			TOT keperawatan / Clinical Instructor & Preceptorship<br>
			<input type="checkbox" name="PELMANKEP[]" value="08" <? if($val[$i]=="08"){echo "Checked"; $i++;}?> />
			Service Excellent<br>
			<input type="checkbox" name="PELMANKEP[]" value="09" <? if($val[$i]=="09"){echo "Checked"; $i++;}?> />
			Audit Keperawatan<br>
			<input type="checkbox" name="PELMANKEP[]" value="10" <? if($val[$i]=="10"){echo "Checked"; $i++;}?> />
			Manajemen mutu pel kep<br>
			<input type="checkbox" name="PELMANKEP[]" value="11" <? if($val[$i]=="11"){echo "Checked"; $i++;}?> />
			MPKP<br>
			<input type="checkbox" name="PELMANKEP[]" value="12" <? if($val[$i]=="12"){echo "Checked"; $i++;}?> />
			Diklat PIM<br>
			<input type="checkbox" name="PELMANKEP[]" value="13" <? if($val[$i]=="13"){echo "Checked"; $i++;}?> />
			Manajemen Askep</td>
        </tr>
        <tr>
          <td valign="top">Pelatihan Teknis Keperawatan Kegawatdaruratan</td>
		  <?$valPELTEKKEPGAW = split(",",$data['PELTEKKEPGAW']); $iPELTEKKEPGAW = 0;?>
          <td colspan="4"><input type="checkbox" name="PELTEKKEPGAW[]" value="01" <? if($valPELTEKKEPGAW[$iPELTEKKEPGAW]=="01"){echo "Checked"; $iPELTEKKEPGAW++;}?> />
            BHD / BLS<br>
            <input type="checkbox" name="PELTEKKEPGAW[]" value="02" <? if($valPELTEKKEPGAW[$iPELTEKKEPGAW]=="02"){echo "Checked"; $iPELTEKKEPGAW++;}?> />
            BTCLS<br>
            <input type="checkbox" name="PELTEKKEPGAW[]" value="03" <? if($valPELTEKKEPGAW[$iPELTEKKEPGAW]=="03"){echo "Checked"; $iPELTEKKEPGAW++;}?> />
            BHL / ALS<br>
            <input type="checkbox" name="PELTEKKEPGAW[]" value="04" <? if($valPELTEKKEPGAW[$iPELTEKKEPGAW]=="04"){echo "Checked"; $iPELTEKKEPGAW++;}?> />
            ATCLS<br>
            <input type="checkbox" name="PELTEKKEPGAW[]" value="05" <? if($valPELTEKKEPGAW[$iPELTEKKEPGAW]=="05"){echo "Checked"; $iPELTEKKEPGAW++;}?> />
            Basic Emergency Nursing<br>
			 <input type="checkbox" name="PELTEKKEPGAW[]" value="06" <? if($valPELTEKKEPGAW[$iPELTEKKEPGAW]=="06"){echo "Checked"; $iPELTEKKEPGAW++;}?> />
            Intermediate Emergency Nursing<br>
			<input type="checkbox" name="PELTEKKEPGAW[]" value="07" <? if($valPELTEKKEPGAW[$iPELTEKKEPGAW]=="07"){echo "Checked"; $iPELTEKKEPGAW++;}?> />
			Advance Emergency Nursing<br>
			<input type="checkbox" name="PELTEKKEPGAW[]" value="08" <? if($valPELTEKKEPGAW[$iPELTEKKEPGAW]=="08"){echo "Checked"; $iPELTEKKEPGAW++;}?> />
			PPGD<br>
			<input type="checkbox" name="PELTEKKEPGAW[]" value="09" <? if($valPELTEKKEPGAW[$iPELTEKKEPGAW]=="09"){echo "Checked"; $iPELTEKKEPGAW++;}?> />
			pelatihan pelayanan keperawatan kritis<br>
			<input type="checkbox" name="PELTEKKEPGAW[]" value="10" <? if($valPELTEKKEPGAW[$iPELTEKKEPGAW]=="10"){echo "Checked"; $iPELTEKKEPGAW++;}?> />
			pelatihan pelayanan keperawatan kritis pediatrik<br>
			<input type="checkbox" name="PELTEKKEPGAW[]" value="11" <? if($valPELTEKKEPGAW[$iPELTEKKEPGAW]=="11"){echo "Checked"; $iPELTEKKEPGAW++;}?> />
			pelatihan pelayanan keperawatan kritis Neonatus<br>
			<input type="checkbox" name="PELTEKKEPGAW[]" value="12" <? if($valPELTEKKEPGAW[$iPELTEKKEPGAW]=="12"){echo "Checked"; $iPELTEKKEPGAW++;}?> />
			pelatihan pelayanan keperawatan kritis Cardiology<br>
			<input type="checkbox" name="PELTEKKEPGAW[]" value="13" <? if($valPELTEKKEPGAW[$iPELTEKKEPGAW]=="13"){echo "Checked"; $iPELTEKKEPGAW++;}?> />
			resusitasi neonatus</td>
        </tr>
        <tr>
          <td valign="top">Pelatihan Teknis Keperawatan Medikal Bedah</td>
		  <?$valPELTEKKEPMEDAH = split(",",$data['PELTEKKEPMEDAH']); $iPELTEKKEPMEDAH = 0;?>	
          <td colspan="4"><input type="checkbox" name="PELTEKKEPMEDAH[]" value="01" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="01"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
            Stoma Wound care<br>
            <input type="checkbox" name="PELTEKKEPMEDAH[]" value="02" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="02"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
            Kep. Respirasi dasar<br>
            <input type="checkbox" name="PELTEKKEPMEDAH[]" value="03" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="03"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
            kep. Respirasi lanjutan<br>
            <input type="checkbox" name="PELTEKKEPMEDAH[]" value="04" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="04"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
            Kep. Neurologi dasar<br>
            <input type="checkbox" name="PELTEKKEPMEDAH[]" value="05" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="05"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
            Kep. Neurologi lanjutan<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="06" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="06"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			Kep. Mahhir Mata<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="07" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="07"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			Kardiologi dasar<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="08" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="08"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			kardiologi lanjutan<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="09" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="09"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			Perawatan luka bakar<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="10" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="10"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			Pengelolaan kamar bedah<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="11" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="11"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			Keperawatan mahir bedah<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="12" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="12"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			keperawatan kemoterapi<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="13" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="13"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			keperawatan paliatif<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="14" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="14"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			keperawatan  geriatri<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="15" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="15"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			manajemen pelayanan home care<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="16" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="16"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			edukasi DM<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="17" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="17"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			Haemodialisa<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="18" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="18"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			kep. DM<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="19" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="19"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			kep. Kaki diabetic<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="20" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="20"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			VCT<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="21" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="21"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			PCS<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="22" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="22"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			CST<br>
			<input type="checkbox" name="PELTEKKEPMEDAH[]" value="23" <? if($valPELTEKKEPMEDAH[$iPELTEKKEPMEDAH]=="23"){echo "Checked"; $iPELTEKKEPMEDAH++;}?> />
			PMTCT</td>
        </tr>
        <tr>
          <td valign="top">Pelatihan Teknis Keperawatan Anak</td>
		  <?$valPELTEKKEPNAK = split(",",$data['PELTEKKEPNAK']); $iPELTEKKEPNAK = 0;?>
          <td colspan="4"><input type="checkbox" name="PELTEKKEPNAK[]" value="1" <? if($valPELTEKKEPNAK[$iPELTEKKEPNAK]=="1"){echo "Checked"; $iPELTEKKEPNAK++;}?> />
            metode kangguru<br>
            <input type="checkbox" name="PELTEKKEPNAK[]" value="2" <? if($valPELTEKKEPNAK[$iPELTEKKEPNAK]=="2"){echo "Checked"; $iPELTEKKEPNAK++;}?> />
            perawatan BBLR</td>
        </tr>
        <tr>
          <td valign="top">Pelatihan Teknis Keperawatan Maternitas</td>
		  <?$valPELTEKKEPMAT = split(",",$data['PELTEKKEPMAT']); $iPELTEKKEPMAT = 0;?>
          <td colspan="4"><input type="checkbox" name="PELTEKKEPMAT[]" value="1" <? if($valPELTEKKEPMAT[$iPELTEKKEPMAT]=="1"){echo "Checked"; $iPELTEKKEPMAT++;}?> />
            manajemen laktasi<br>
            <input type="checkbox" name="PELTEKKEPMAT[]" value="2" <? if($valPELTEKKEPMAT[$iPELTEKKEPMAT]=="2"){echo "Checked"; $iPELTEKKEPMAT++;}?> />
            senam hamil dan nifas<br>
            <input type="checkbox" name="PELTEKKEPMAT[]" value="3" <? if($valPELTEKKEPMAT[$iPELTEKKEPMAT]=="3"){echo "Checked"; $iPELTEKKEPMAT++;}?> />
            pelatihan KB<br>
            <input type="checkbox" name="PELTEKKEPMAT[]" value="4" <? if($valPELTEKKEPMAT[$iPELTEKKEPMAT]=="4"){echo "Checked"; $iPELTEKKEPMAT++;}?> />
            PONED<br>
            <input type="checkbox" name="PELTEKKEPMAT[]" value="5" <? if($valPELTEKKEPMAT[$iPELTEKKEPMAT]=="5"){echo "Checked"; $iPELTEKKEPMAT++;}?> />
            PONEK</td>
        </tr>
        <tr>
          <td valign="top">Pelatihan Teknis Keperawatan Jiwa</td>
		  <?$valPELTEKKEPJIWA = split(",",$data['PELTEKKEPJIWA']); $iPELTEKKEPJIWA = 0;?>
          <td colspan="4"><input type="checkbox" name="PELTEKKEPJIWA[]" value="1" <? if($valPELTEKKEPJIWA[$iPELTEKKEPJIWA]=="1"){echo "Checked"; $iPELTEKKEPJIWA++;}?> />
            CT (Assertive Community Treatment)<br>
            <input type="checkbox" name="PELTEKKEPJIWA[]" value="2" <? if($valPELTEKKEPJIWA[$iPELTEKKEPJIWA]=="2"){echo "Checked"; $iPELTEKKEPJIWA++;}?> />
            TAK (terapi aktivitas kelompok)<br>
            <input type="checkbox" name="PELTEKKEPJIWA[]" value="3" <? if($valPELTEKKEPJIWA[$iPELTEKKEPJIWA]=="3"){echo "Checked"; $iPELTEKKEPJIWA++;}?> />
            PICU (Psychiatric Intensive Care Unit)<br>
            <input type="checkbox" name="PELTEKKEPJIWA[]" value="4" <? if($valPELTEKKEPJIWA[$iPELTEKKEPJIWA]=="4"){echo "Checked"; $iPELTEKKEPJIWA++;}?> />
            PPGDJ (Pedoman Penggolongan Gangguan Diagnosa Jiwa)<br>
            <input type="checkbox" name="PELTEKKEPJIWA[]" value="5" <? if($valPELTEKKEPJIWA[$iPELTEKKEPJIWA]=="5"){echo "Checked"; $iPELTEKKEPJIWA++;}?> />
            terapi modalitas<br>
			<input type="checkbox" name="PELTEKKEPJIWA[]" value="6" <? if($valPELTEKKEPJIWA[$iPELTEKKEPJIWA]=="6"){echo "Checked"; $iPELTEKKEPJIWA++;}?> />
			CLMHN (Consultation Liasion Mental Health Nursing)<br>
			<input type="checkbox" name="PELTEKKEPJIWA[]" value="7" <? if($valPELTEKKEPJIWA[$iPELTEKKEPJIWA]=="7"){echo "Checked"; $iPELTEKKEPJIWA++;}?> />
			MPKP Jiwa<br>
			<input type="checkbox" name="PELTEKKEPJIWA[]" value="8" <? if($valPELTEKKEPJIWA[$iPELTEKKEPJIWA]=="8"){echo "Checked"; $iPELTEKKEPJIWA++;}?> />
			pelatihan metadon</td>
        </tr>
        <tr>
          <td valign="top">Jabatan Fungsional</td>
          <td colspan="4"><select name="JABFUNG" class="text">
            <option value="0"> --pilih-- </option>
            <option value="1" <? if($data['JABFUNG']=="1")echo "selected=Selected";?> >Perawat terampil pelaksana pemula</option>
            <option value="2" <? if($data['JABFUNG']=="2")echo "selected=Selected";?> >Perawat terampil pelaksana</option>
            <option value="3" <? if($data['JABFUNG']=="3")echo "selected=Selected";?> >Perawat terampil pelaksana lanjutan</option>
            <option value="4" <? if($data['JABFUNG']=="4")echo "selected=Selected";?> >Perawat terampil penyelia</option>
            <option value="5" <? if($data['JABFUNG']=="5")echo "selected=Selected";?> >Perawat ahli pertama</option>
            <option value="6" <? if($data['JABFUNG']=="6")echo "selected=Selected";?> >Perawat ahli muda</option>
			<option value="7" <? if($data['JABFUNG']=="7")echo "selected=Selected";?> >Perawat ahli madya</option>
			<option value="8" <? if($data['JABFUNG']=="8")echo "selected=Selected";?> >Perawat ahli Utama</option>
			<option value="9" <? if($data['JABFUNG']=="9")echo "selected=Selected";?> >ketua komite keperawatan</option>
			<option value="10" <? if($data['JABFUNG']=="10")echo "selected=Selected";?> >kepala instalasi</option>
			<option value="11" <? if($data['JABFUNG']=="11")echo "selected=Selected";?> >supervisor</option>
			<option value="12" <? if($data['JABFUNG']=="12")echo "selected=Selected";?> >kepala ruangan</option>
		</select></td>
        </tr>
        <tr>
          <td valign="top">Jabatan Struktural</td>
          <td colspan="4"><select name="JABSTRUK" class="text">
            <option value="0"> --pilih-- </option>
            <option value="1" <? if($data['JABSTRUK']=="1")echo "selected=Selected";?> >Kepala keperawatan</option>
            <option value="2" <? if($data['JABSTRUK']=="2")echo "selected=Selected";?> >Kepala seksi pelayanan keperawatan</option>
		</select></td>
        </tr>
		<tr>
                    <td valign="top">Tugas Lain</td>
                    <td colspan="4"><select name="JABLAIN" class="text">
                        <option value="0"> --pilih-- </option>
                        <option value="9" <? if ($data['JABLAIN'] == "9") echo "selected=Selected"; ?> >ketua komite keperawatan</option>
                        <option value="10" <? if ($data['JABLAIN'] == "10") echo "selected=Selected"; ?> >kepala instalasi</option>
                        <option value="11" <? if ($data['JABLAIN'] == "11") echo "selected=Selected"; ?> >supervisor</option>
                        <option value="12" <? if ($data['JABLAIN'] == "12") echo "selected=Selected"; ?> >kepala ruangan</option>
                        <option value="13" <? if ($data['JABLAIN'] == "13") echo "selected=Selected"; ?> >IPCN</option>
                        <option value="14" <? if ($data['JABLAIN'] == "14") echo "selected=Selected"; ?> >CCM</option>
                    </select></td>
                  </tr>

        <tr>
          <td valign="top">Lama Kerja</td>
          <td colspan="4"><select name="LAMKER" class="text">
            <option value="0"> --pilih-- </option>
            <option value="1" <? if($data['LAMKER']=="1")echo "selected=Selected";?> >0 - 1 tahun</option>
            <option value="2" <? if($data['LAMKER']=="2")echo "selected=Selected";?> >1 - 3 tahun</option>
            <option value="3" <? if($data['LAMKER']=="3")echo "selected=Selected";?> >3 - 5 tahun</option>
            <option value="4" <? if($data['LAMKER']=="4")echo "selected=Selected";?> >5 - 7 tahun</option>
            <option value="5" <? if($data['LAMKER']=="5")echo "selected=Selected";?> >7 - 10 tahun</option>
            <option value="6" <? if($data['LAMKER']=="6")echo "selected=Selected";?> >lebih dari 10 tahun</option>
		</select></td>
        </tr>
        <tr>
          <td valign="top">Tempat Kerja Sesuai Area</td>
          <td colspan="4"><select name="TEMKER" id="TEMKER" class="text">
            <option value="0"> --pilih-- </option>
            <option value="1" <? if($data['TEMKER']=="1")echo "selected=Selected";?> >Rawat Inap</option>
            <option value="2" <? if($data['TEMKER']=="2")echo "selected=Selected";?> >Rawat Jalan</option>
            <option value="3" <? if($data['TEMKER']=="3")echo "selected=Selected";?> >Rawat Khusus</option>
            <option value="4" <? if($data['TEMKER']=="4")echo "selected=Selected";?> >Kegawatdaruratan</option>
		</select></td>
        </tr>
		<tr>
          <td valign="top"></td>
          <td colspan="1"><div id="tempatkerja">
			<? if($data['TEMKER']=="1"){ ?>
			<select name="TEMKER2" id="TEMKER2" class="text" onchange="pilih()">
				<option value="0"> --pilih-- </option>
				<option value="Penyakit dalam" <? if($data['TEMKER2']=="Penyakit dalam")echo "selected=Selected";?> >Penyakit dalam</option>
				<option value="Bedah" <? if($data['TEMKER2']=="Bedah")echo "selected=Selected";?> >Bedah</option>
				<option value="Anak" <? if($data['TEMKER2']=="Anak")echo "selected=Selected";?> >Anak</option>
				<option value="Maternitas" <? if($data['TEMKER2']=="Maternitas")echo "selected=Selected";?> >Maternitas</option>
				<option value="Jiwa" <? if($data['TEMKER2']=="Jiwa")echo "selected=Selected";?> >Jiwa</option>
				<option value="L" <? if(substr($data['TEMKER2'],0,2)=="L ")echo "selected=Selected";?> >Lain-lain</option>
			</select>
			<? }else if($data['TEMKER']=="2"){ ?>
			<select name="TEMKER2" id="TEMKER2" class="text" onchange="pilih()">
				<option value="0"> --pilih-- </option>
				<option value="Poliklinik Penyakit dalam" <? if($data['TEMKER2']=="Poliklinik Penyakit dalam")echo "selected=Selected";?> >Poliklinik Penyakit dalam</option>
				<option value="Poliklinik bedah" <? if($data['TEMKER2']=="Poliklinik bedah")echo "selected=Selected";?> >Poliklinik bedah</option>
				<option value="Poliklinik anak" <? if($data['TEMKER2']=="Poliklinik anak")echo "selected=Selected";?> >Poliklinik anak</option>
				<option value="Poliklinik kean" <? if($data['TEMKER2']=="Poliklinik kean")echo "selected=Selected";?> >Poliklinik kean</option>
				<option value="L" <? if(substr($data['TEMKER2'],0,2)=="L ")echo "selected=Selected";?> >Lain-lain</option>
			</select>
			<? }else if($data['TEMKER']=="3"){ ?>
			<select name="TEMKER2" id="TEMKER2" class="text" onchange="pilih()">
				<option value="0"> --pilih-- </option>
				<option value="Intensif care" <? if($data['TEMKER2']=="Intensif care")echo "selected=Selected";?> >Intensif care</option>
				<option value="Kamar operasi" <? if($data['TEMKER2']=="Kamar operasi")echo "selected=Selected";?> >Kamar operasi</option>
				<option value="Unit Luka Bakar" <? if($data['TEMKER2']=="Unit Luka Bakar")echo "selected=Selected";?> >Unit Luka Bakar</option>
				<option value="NAPZA" <? if($data['TEMKER2']=="NAPZA")echo "selected=Selected";?> >NAPZA</option>
				<option value="Haemodialisa" <? if($data['TEMKER2']=="Haemodialisa")echo "selected=Selected";?> >Haemodialisa</option>
				<option value="L" <? if(substr($data['TEMKER2'],0,2)=="L ")echo "selected=Selected";?> >Lain-lain</option>
			</select>
			<? }else if($data['TEMKER']=="4"){ ?>
			<select name="TEMKER2" id="TEMKER2" class="text"><option value="0"> --pilih-- </option><option value="IGD" <? if($data['TEMKER2']=="IGD")echo "selected=Selected";?> >IGD</option></select>
			<? }else{?>
			<select name="TEMKER2" id="TEMKER2" class="text"><option value="0"> --pilih-- </option></select>
			<? } ?>
		  </div></td>
		  <td colspan="1">
			<div align="left" id="lain" >
			<? if(substr($data['TEMKER2'],0,2)=="L "){ 
			$val = split("L ",$data['TEMKER2'])?>
			<input class="text" type="text" value= "<?=$val[1]?>"name="NAMALAIN" size="25" id="NAMALAIN" />
			<? } ?>
			</div>
		  </td>
		  <td colspan="2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </tr>
		        <tr>
          <td colspan="5" align="right"><input type="submit" name="daftar" class="text" value="  S a v e  "/></td>
        </tr>
      </table>
    </fieldset>
  </form>
   </div>
  </div>
  </div>