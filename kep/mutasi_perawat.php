<?php
$sql	= mysql_query('select * from m_perawat where NIP = "'.$_REQUEST['NIP'].'" and IDPERAWAT = "'.$_REQUEST['PERID'].'"');
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
			alert('Tanggal Lahir Tidak Boleh 0000-00-00');
			jQuery(this).val('');
		}
	});
	jQuery('#myform').validate();
	jQuery("#TGLLAHIR").mask("9999/99/99");	
	
	jQuery("#TEMKERTUJ").change(function(){
		var selectValues = jQuery("#TEMKERTUJ").val();
		if (selectValues == 0){
            var msg = "<select name=\"TEMKERTUJ2\" id=\"TEMKERTUJ2\" class=\"text\"><option value=\"0\"> --pilih-- </option></select>";
            jQuery('#tempatkerjaTUJ').html(msg);
        }else if (selectValues == 1){
            var msg = "<select name=\"TEMKERTUJ2\" id=\"TEMKERTUJ2\" class=\"text\" onchange=\"pilihTUJ()\"><option value=\"0\"> --pilih-- </option><option value=\"Penyakit dalam\">Penyakit dalam</option><option value=\"Bedah\">Bedah</option><option value=\"Anak\">Anak</option><option value=\"Maternitas\">Maternitas</option><option value=\"Jiwa\">Jiwa</option><option value=\"L\">Lain-lain</option></select>";
            jQuery('#tempatkerjaTUJ').html(msg);
        }else if (selectValues == 2){
            var msg = "<select name=\"TEMKERTUJ2\" id=\"TEMKERTUJ2\" class=\"text\" onchange=\"pilihTUJ()\"><option value=\"0\"> --pilih-- </option><option value=\"Poliklinik Penyakit dalam\">Poliklinik Penyakit dalam</option><option value=\"Poliklinik bedah\">Poliklinik bedah</option><option value=\"Poliklinik anak\">Poliklinik anak</option><option value=\"Poliklinik kean\">Poliklinik kean</option><option value=\"L\">Lain-lain</option></select>";
            jQuery('#tempatkerjaTUJ').html(msg);
        }else if (selectValues == 3){
            var msg = "<select name=\"TEMKERTUJ2\" id=\"TEMKERTUJ2\" class=\"text\" onchange=\"pilihTUJ()\"><option value=\"0\"> --pilih-- </option><option value=\"Intensif care\">Intensif care</option><option value=\"Kamar operasi\">Kamar operasi</option><option value=\"Unit Luka Bakar\">Unit Luka Bakar</option><option value=\"NAPZA\">NAPZA</option><option value=\"Haemodialisa\">Haemodialisa</option><option value=\"L\">Lain-lain</option></select>";
            jQuery('#tempatkerjaTUJ').html(msg);
        }else if (selectValues == 4){
            var msg = "<select name=\"TEMKERTUJ2\" id=\"TEMKERTUJ2\" class=\"text\"><option value=\"0\"> --pilih-- </option><option value=\"IGD\">IGD</option></select>";
            jQuery('#tempatkerjaTUJ').html(msg);
        }
		jQuery('#lainTUJ').html("");
	});
});

function pilihTUJ(){
	if(document.getElementById('TEMKERTUJ2').value == "L"){
		document.getElementById('lainTUJ').innerHTML = '<input class="text" type="text" name="NAMALAINTUJ" size="25" id="NAMALAINTUJ" />';
	}else{
		document.getElementById('lainTUJ').innerHTML = '';
	}
}

</script>
<div align="center">
  <div id="frame">
  <div id="frame_title"><h3 align="left">MUTASI PERAWAT</h3></div>
	<div id="all">
    <form name="myform" id="myform" action="./kep/edit_mutasi.php" method="post">
	<div id="list_data"></div>
    <fieldset class="fieldset"><legend>Mutasi Perawat</legend>
      <table width="100%" border="0" cellpadding="3" cellspacing="0">
            <tr>
              <td>No Induk Pegawai</td>
              <td colspan="3"><?=$data['NIP']?><input class="text" value="<?=$data['NIP']?>" type="hidden" name="NIP" id="NIP" size="25" >
              <input class="text" value="<?=$data['IDPERAWAT']?>" type="hidden" name="IDPERAWAT" id="IDPERAWAT" >
              </td>              
            </tr>
            <tr>
          <td width="25%">Nama Lengkap</td>
          <td width="5%"><?=$data['NAMA']?></td>
          <td width="5%" colspan="1">&nbsp;</td>
		  <td width="65%" colspan="1">&nbsp;</td>
          </tr>
        <tr>
          <td valign="top">Unit kerja saat ini</td>
          <td colspan="1">
			<? if($data['TEMKER']=="1")echo "Rawat Inap";
				 else if($data['TEMKER']=="2")echo "Rawat Jalan";
				 else if($data['TEMKER']=="3")echo "Rawat Khusus";
				 else if($data['TEMKER']=="4")echo "Kegawatdaruratan";?>
		</td>
          <td colspan="1"><div id="tempatkerja">
			<? if($data['TEMKER']=="1"){ 
					if($data['TEMKER2']=="Penyakit dalam")echo "Penyakit dalam";
					else if($data['TEMKER2']=="Bedah")echo "Bedah";
					else if($data['TEMKER2']=="Anak")echo "Anak";
					else if($data['TEMKER2']=="Maternitas")echo "Maternitas";
					else if($data['TEMKER2']=="Jiwa")echo "Jiwa";
					else if(substr($data['TEMKER2'],0,2)=="L ")echo "Lain-lain";
				}else if($data['TEMKER']=="2"){
					if($data['TEMKER2']=="Poliklinik Penyakit dalam")echo "Poliklinik Penyakit dalam";
					else if($data['TEMKER2']=="Poliklinik bedah")echo "Poliklinik bedah";
					else if($data['TEMKER2']=="Poliklinik anak")echo "Poliklinik anak";
					else if($data['TEMKER2']=="Poliklinik kean")echo "Poliklinik kean";
					else if(substr($data['TEMKER2'],0,2)=="L ")echo "Lain-lain";
				}else if($data['TEMKER']=="3"){
					if($data['TEMKER2']=="Intensif care")echo "Intensif care";
					else if($data['TEMKER2']=="Kamar operasi")echo "Kamar operasi";
					else if($data['TEMKER2']=="Unit Luka Bakar")echo "Unit Luka Bakar";
					else if($data['TEMKER2']=="NAPZA")echo "NAPZA";
					else if($data['TEMKER2']=="Haemodialisa")echo "Haemodialisa";
					else if(substr($data['TEMKER2'],0,2)=="L ")echo "Lain-lain";
				}else if($data['TEMKER']=="4"){
					if($data['TEMKER2']=="IGD")echo "IGD";
				} ?>
		  </div></td>
		  <td colspan="1">
			<div align="left" id="lain" >
			<? if(substr($data['TEMKER2'],0,2)=="L "){ 
					$val = split("L ",$data['TEMKER2']);
					echo $val[1];
				} ?>
			</div>
		  </td>
		  <td colspan="2" />
        </tr>
		<tr>
          <td valign="top">Unit kerja tujuan</td>
          <td colspan="1"><select name="TEMKERTUJ" id="TEMKERTUJ" class="text">
            <option value="0"> --pilih-- </option>
            <option value="1" <? if($data['TEMKERTUJ']=="1")echo "selected=Selected";?> >Rawat Inap</option>
            <option value="2" <? if($data['TEMKERTUJ']=="2")echo "selected=Selected";?> >Rawat Jalan</option>
            <option value="3" <? if($data['TEMKERTUJ']=="3")echo "selected=Selected";?> >Rawat Khusus</option>
            <option value="4" <? if($data['TEMKERTUJ']=="4")echo "selected=Selected";?> >Kegawatdaruratan</option>
		</select></td>
          <td colspan="1"><div id="tempatkerjaTUJ">
			<? if($data['TEMKERTUJ']=="1"){ ?>
			<select name="TEMKERTUJ2" id="TEMKERTUJ2" class="text" onchange="pilihTUJ()">
				<option value="0"> --pilih-- </option>
				<option value="Penyakit dalam" <? if($data['TEMKERTUJ2']=="Penyakit dalam")echo "selected=Selected";?> >Penyakit dalam</option>
				<option value="Bedah" <? if($data['TEMKERTUJ2']=="Bedah")echo "selected=Selected";?> >Bedah</option>
				<option value="Anak" <? if($data['TEMKERTUJ2']=="Anak")echo "selected=Selected";?> >Anak</option>
				<option value="Maternitas" <? if($data['TEMKERTUJ2']=="Maternitas")echo "selected=Selected";?> >Maternitas</option>
				<option value="Jiwa" <? if($data['TEMKERTUJ2']=="Jiwa")echo "selected=Selected";?> >Jiwa</option>
				<option value="L" <? if(substr($data['TEMKERTUJ2'],0,2)=="L ")echo "selected=Selected";?> >Lain-lain</option>
			</select>
			<? }else if($data['TEMKERTUJ']=="2"){ ?>
			<select name="TEMKERTUJ2" id="TEMKERTUJ2" class="text" onchange="pilihTUJ()">
				<option value="0"> --pilih-- </option>
				<option value="Poliklinik Penyakit dalam" <? if($data['TEMKERTUJ2']=="Poliklinik Penyakit dalam")echo "selected=Selected";?> >Poliklinik Penyakit dalam</option>
				<option value="Poliklinik bedah" <? if($data['TEMKERTUJ2']=="Poliklinik bedah")echo "selected=Selected";?> >Poliklinik bedah</option>
				<option value="Poliklinik anak" <? if($data['TEMKERTUJ2']=="Poliklinik anak")echo "selected=Selected";?> >Poliklinik anak</option>
				<option value="Poliklinik kean" <? if($data['TEMKERTUJ2']=="Poliklinik kean")echo "selected=Selected";?> >Poliklinik kean</option>
				<option value="L" <? if(substr($data['TEMKERTUJ2'],0,2)=="L ")echo "selected=Selected";?> >Lain-lain</option>
			</select>
			<? }else if($data['TEMKERTUJ']=="3"){ ?>
			<select name="TEMKERTUJ2" id="TEMKERTUJ2" class="text" onchange="pilihTUJ()">
				<option value="0"> --pilih-- </option>
				<option value="Intensif care" <? if($data['TEMKERTUJ2']=="Intensif care")echo "selected=Selected";?> >Intensif care</option>
				<option value="Kamar operasi" <? if($data['TEMKERTUJ2']=="Kamar operasi")echo "selected=Selected";?> >Kamar operasi</option>
				<option value="Unit Luka Bakar" <? if($data['TEMKERTUJ2']=="Unit Luka Bakar")echo "selected=Selected";?> >Unit Luka Bakar</option>
				<option value="NAPZA" <? if($data['TEMKERTUJ2']=="NAPZA")echo "selected=Selected";?> >NAPZA</option>
				<option value="Haemodialisa" <? if($data['TEMKERTUJ2']=="Haemodialisa")echo "selected=Selected";?> >Haemodialisa</option>
				<option value="L" <? if(substr($data['TEMKERTUJ2'],0,2)=="L ")echo "selected=Selected";?> >Lain-lain</option>
			</select>
			<? }else if($data['TEMKERTUJ']=="4"){ ?>
			<select name="TEMKERTUJ2" id="TEMKERTUJ2" class="text"><option value="0"> --pilih-- </option><option value="IGD" <? if($data['TEMKERTUJ2']=="IGD")echo "selected=Selected";?> >IGD</option></select>
			<? }else{?>
			<select name="TEMKERTUJ2" id="TEMKERTUJ2" class="text"><option value="0"> --pilih-- </option></select>
			<? } ?>
		  </div></td>
		  <td colspan="1">
			<div align="left" id="lainTUJ" >
			<? if(substr($data['TEMKERTUJ2'],0,2)=="L "){ 
			$val = split("L ",$data['TEMKERTUJ2'])?>
			<input class="text" type="text" value= "<?=$val[1]?>"name="NAMALAINTUJ" size="25" id="NAMALAINTUJ" />
			<? } ?>
			</div>
		  </td>
		  <td colspan="2" />
        </tr>
		<tr>
          <td>Tanggal Mutasi</td>
          <td colspan="3">
            <input type="text" class="text required" value="<?=$data['TGLMUTASI']?>" name="TGLLAHIR" size="20" id="TGLLAHIR" onblur="calage(this.value,'umur');"/>
            <a href="javascript:showCal('Calendar1')"><img align="top" src="img/date.png" border="0" /></a> ex : 1999/09/29</td>
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