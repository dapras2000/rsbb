<form action="save_dpmp.php" name="dpmp" method="post" id="dpmp">
<input type="hidden" name="IDXDAFTAR" value="<?php echo $id_admission;?>" />
<input type="hidden" name="NOMR" value="<?php echo $nomr;?>" />
<input type="hidden" name="RUANG" value="<?php echo $noruang;?>" />
<table width="95%" class="tb" border="0">
  <tr valign="top">
    <td width="17%">DIIT :</td>
    <td colspan="2">
      Shift :
      <input type="radio" name="SHIFT" value="1"/> Pagi
      <input type="radio" name="SHIFT" value="2"/> Siang
      <input type="radio" name="SHIFT" value="3"/> Sore
      <span style="padding-left:100px;">Snack :
        <input type="radio" name="SNACK" value="1"/> Pagi
        <input type="radio" name="SNACK" value="2"/> Sore</span>    </td>
    </tr>
  <tr>
    <td>TYPE MAKANAN</td>
    <td width="30%">
      <select name="TYPEMAKANAN" class="text">
        <option selected="selected"> -Pilih- </option>
        <option value="1">PASIEN YANG MENDAPAT MAKANAN BIASA</option>
        <option value="2">PASIEN YANG MENDAPAT MAKANAN KHUSUS</option>
        </select>
    </td>
    <td width="53%">KETERANGAN TAMBAHAN</td>
    </tr>
  <tr>
    <td>KETERANGAN</td>
    <td>
    	<select name="KETERANGAN" class="text">
        	<option selected="selected"> -Pilih- </option>
            <option value="1">TKTP</option>
            <option value="2">RG</option>
            <option value="3">DL</option>
            <option value="4">DH</option>
            <option value="5">DM</option>
            <option value="6">DJ</option>
            <option value="7">TP</option>
            <option value="8">RP.r</option>
            <option value="9">RP</option>
            <option value="10">LAIN-LAIN</option>
        </select>
    </td>
    <td rowspan="5" valign="top"><textarea name="KETERANGANTAMBAHAN" class="text" cols="50" rows="6"></textarea></td>
  </tr>
  <tr>
    <td>JENIS MAKANAN</td>
    <td>
    	<select name="JENISMAKANAN" class="text">
        	<option selected="selected"> -Pilih- </option>
            <option value="1">Nasi</option>
            <option value="6">Nasi TIM (TIM)</option>
            <option value="2">Lunak / BUBUR</option>
            <option value="3">Bubur Saring</option>
            <option value="4">Cair</option>
            <option value="5">Sonde</option>
        </select>
    </td>
    </tr>
  <tr>
      <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Simpan" class="text" onclick="newsubmitform (document.getElementById('dpmp'),'ranap/save_dpmp.php','valid_save_dpmp',validatetask); return false;"/></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
<div id="valid_save_dpmp">
<? include("save_update_dpmp.php"); ?>
</div>