<script>
jQuery(document).ready(function(){
	jQuery("#myform").validate();
});
</script>
<style type="text/css">
.loader{background:url(js/loading.gif) no-repeat; width:16px; height:16px; float:right; margin-right:30px;}
input.error{ border:1px solid #F00;}
label.error{ color:#F00; font-weight:bold;}
</style>
<div align="center">
  <div id="frame" style="width:100%;">
  <div id="frame_title"><h3 align="left">&nbsp;</h3></div>
<form name="myform" id="myform" action="adminrajal/pendaftaran.php" method="post">
    <fieldset class="fieldset"><legend>Form Pendaftaran APS</legend>
    <table width="100%" border="0" title=" From Ini Berfungsi Sebagai Form Pendaftaran Baru.">
    <tr><td width="24%">Tanggal Daftar </td><td width="28%"><input type="text" name="TGLREG" class="text" value="<?php echo date("Y-m-d"); ?>" size="20"/>
		<input type='hidden' name='start_daftar' id='start_daftar' /></td>
    	<td width="48%" align="right">Shift : 	<input type="radio" name="SHIFT"  value="1" checked="checked" class="required" /> 1
                                        <input type="radio" name="SHIFT" value="2" class="required" /> 2
                                        <input type="radio" name="SHIFT" value="3" class="required" /> 3 </td>
    </tr>
    <tr><td>Cara Pembayaran</td><td colspan="2">
    <input type="radio" name="KDCARABAYAR" value="1" checked="checked" class="required" /> UMUM
    <input type="radio" name="KDCARABAYAR" value="2" class="required" /> BPJS
    <!--<input type="radio" name="KDCARABAYAR" value="3" class="required" /> JMKS
    <input type="radio" name="KDCARABAYAR" value="4" class="required" /> SKTM-->
    <input type="radio" name="KDCARABAYAR" value="5" class="required" /> LAIN-LAIN
    </td></tr>
	<tr><td>Asal Pasien </td><td colspan="2"><div align="left">
    	<input type="radio" id="asal1" name="KDRUJUK" value="1" class="required" checked="checked"/> Datang Sendiri
        <input type="radio" id="asal2" name="KDRUJUK" value="2" class="required" /> Puskesmas
		<input type="radio" id="asal3" name="KDRUJUK" value="3" class="required" /> Rumah Sakit lain
		<input type="radio" id="asal4" name="KDRUJUK" value="4" class="required" /> Lain-Lain &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span style="text-align:right;" id="keterangan"></span></div>
	</td></tr>
    </table>
    </fieldset>
    <div id="all">	
    <? include("lab/view_prosess_aps.php");?>
    </div>
</form>
  </div>
</div>