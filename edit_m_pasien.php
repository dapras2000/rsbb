<script language="javascript" src="include/cal3.js"></script>
<script language="javascript" src="include/cal_conf3.js"></script>

<?php
$sql	= mysql_query('select * from m_pasien where NOMR = "'.$_REQUEST['NOMR'].'"');
$data	= mysql_fetch_array($sql);
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
</script>
<div align="center">
  <div id="frame">
  <div id="frame_title"><h3 align="left">IDENTITAS PASIEN</h3></div>
	<div id="all">
    <form name="myform" id="myform" action="models/edit_pasien.php?edit=ok" method="post">
    
	<div id="list_data"></div>
    <fieldset class="fieldset"><legend>Identitas Pasien</legend>
      <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td>No Rekam Medik</td>
              <td><input class="text" value="<?=$data['NOMR']?>" type="text" name="NOMR" id="NOMR" size="25" >
              <input class="text" value="<?=$data['NOMR']?>" type="hidden" name="NOMRKEY" id="NOMRKEY" >
              </td>
              <td>Awal daftar</td>
              <td><input class="text" type="text" value="<?=$data['TGLDAFTAR']?>" name="awaldaftar" size="25" id="awaldaftar" /></td>
              <td width="17%" rowspan="14" valign="top"> Jenis Kelamin:<br />
                <input type="radio" name="JENISKELAMIN" value="L" <? if($data['JENISKELAMIN']=="L" || $data['JENISKELAMIN']=="l")echo "Checked";?>/>
                Laki-laki<br />
                <input type="radio" name="JENISKELAMIN" value="P" <? if($data['JENISKELAMIN']=="P")echo "Checked";?>/>
                Perempuan<br />
                <br />
                <br />
                Cara Pembayaran :<br>
				<?$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
				  while($ds = mysql_fetch_array($ss)){
					if($data['KDCARABAYAR'] == $ds['KODE']): $sel = "Checked"; else: $sel = ''; endif;
					echo '<input type="radio" name="KDCARABAYAR" value="'.$ds['KODE'].'" '.$sel.' /> '.$ds['NAMA']. '<br>';
				  }?>
                <input type="hidden" name="TGLREG" value="<?php echo date("Y-m-d"); ?>" size="10" />            
              </td>
            </tr>
            <tr>
          <td width="25%">Nama Lengkap Pasien</td>
          <td width="36%"><input class="text" type="text" value="<?=$data['NAMA']?>" name="NAMA" size="25" id="NAMA" /></td>
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
          <td>Umur Pasien</td>
          <td>
          <?php 
		  $a = datediff($data['TGLLAHIR'], date("Y-m-d"));
		  ?>
          <input class="text" type="text" value="<?php echo 'umur '.$a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?>" name="umur" id="umur" size="40" />          
          </td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">Alamat Pasien</td>
          <td colspan="1"><input name="ALAMAT" type="text" value="<?=$data['ALAMAT']?>" size="45" class="text" /></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>Alamat KTP</td>
          <td colspan="3"><input name="ALAMAT_KTP" class="text" type="text" value="<? if($data['ALAMAT_KTP']){ echo $data['ALAMAT_KTP']; } ?>" size="45" /></td>
        </tr>
        <tr>
          <td>Provinsi</td>
          <td><select name="KDPROVINSI" class="text required" title="*" id="KDPROVINSI">
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
          <td><div id="kotapilih"><select name="KOTA" class="text required" title="*" id="KOTA">
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
          <td><div id="kecamatanpilih"><select name="KDKECAMATAN" class="text required" title="*" id="KDKECAMATAN">
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
          <td><div id="kelurahanpilih"><select name="KELURAHAN" class="text required" title="*" id="KELURAHAN">
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
          <td>No Telepon / HP Pasien</td>
          <td colspan="3"><input  class="text" value="<?=$data['NOTELP']?>" type="text" name="NOTELP" size="25" /></td>
        </tr>
        <tr>
          <td>No KTP </td>
          <td><input  class="text" value="<?=$data['NOKTP']?>" type="text" name="NOKTP" size="25" /></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>Nama Suami / Orang Tua Pasien</td>
          <td><input class="text" type="text" value="<?=$data['SUAMI_ORTU']?>" name="SUAMI_ORTU" size="25" /></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>Pekerjaan Pasien / Orang Tua</td>
          <td><input class="text" type="text" value="<?=$data['PEKERJAAN']?>" name="PEKERJAAN" size="25" /></td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td>Status Perkawinan</td>
          <td><input type="radio" name="STATUS" value="1" <? if($data['STATUS']=="1")echo "Checked";?>/>
            Belum Kawin
            <input type="radio" name="STATUS" value="2" <? if($data['STATUS']=="2")echo "Checked";?> />
            Kawin
            <input type="radio" name="STATUS" value="3" <? if($data['STATUS']=="3")echo "Checked";?>/>
            Janda / Duda</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">Agama </td>
          <td colspan="4"><input type="radio" name="AGAMA" value="1" <? if($data['AGAMA']=="1")echo "Checked";?> />
            Islam
            <input type="radio" name="AGAMA" value="2" <? if($data['AGAMA']=="2")echo "Checked";?>/>
            Kristen Protestan
            <input type="radio" name="AGAMA" value="3" <? if($data['AGAMA']=="3")echo "Checked";?>/>
            Katholik
            <input type="radio" name="AGAMA" value="4" <? if($data['AGAMA']=="4")echo "Checked";?>/>
            Hindu
            <input type="radio" name="AGAMA" value="5" <? if($data['AGAMA']=="5")echo "Checked";?>/>
            Budha
            <input type="radio" name="AGAMA" value="6" <? if($data['AGAMA']=="6")echo "Checked";?>/>
            Lain - lain </td>
        </tr>
        <tr>
          <td valign="top">Pendidikan Terakhir Pasien</td>
          <td colspan="4"><input type="radio" name="PENDIDIKAN" value="1" <? if($data['PENDIDIKAN']=="1")echo "Checked";?> />
            SD
            <input type="radio" name="PENDIDIKAN" value="2" <? if($data['PENDIDIKAN']=="2")echo "Checked";?> />
            SLTP
            <input type="radio" name="PENDIDIKAN" value="3" <? if($data['PENDIDIKAN']=="3")echo "Checked";?> />
            SMU
            <input type="radio" name="PENDIDIKAN" value="4" <? if($data['PENDIDIKAN']=="4")echo "Checked";?> />
            D3/Akademik
            <input type="radio" name="PENDIDIKAN" value="5" <? if($data['PENDIDIKAN']=="5")echo "Checked";?> />
            Universitas</td>
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
