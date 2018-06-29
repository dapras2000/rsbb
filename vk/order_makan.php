<form action="vk/save_dpmp.php" name="dpmp" method="post" id="dpmp">
      <input name="NOMR" id="NOMR" type="hidden" value=<?php echo $nomr; ?> >
      <input name="IDXDAFTAR" id="IDXDAFTAR" type="hidden" value=<?php echo $idxdaftar; ?> >
		<input type="hidden" name="POLY" value="<?php echo $kdpoly;?>" />
        <table width="95%" class="tb" border="0">
          <tr valign="top">
            <td width="17%">DIIT :</td>
            <td colspan="2">
              Shift :
              <input type="radio" name="SHIFT" value="1"/> Pagi
              <input type="radio" name="SHIFT" value="2"/> Siang
              <input type="radio" name="SHIFT" value="3"/> Sore
              <span style="padding-left:100px;">Snack :
                <input type="radio" name="SHIFT" value="4"/> Pagi
                <input type="radio" name="SHIFT" value="5"/> Sore</span>    </td>
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
            <td width="53%" rowspan="6">&nbsp;</td>
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
          </tr>
          <tr>
            <td>JENIS MAKANAN</td>
            <td>
                <select name="JENISMAKANAN" class="text">
                    <option selected="selected"> -Pilih- </option>
                    <option value="1">Nasi</option>
                    <option value="2">Lauk</option>
                    <option value="3">Bubur Sonde</option>
                    <option value="4">Cair</option>
                    <option value="5">Sonde</option>
                </select>
            </td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit" value="Simpan" class="text" onclick="newsubmitform (document.getElementById('dpmp'),'vk/save_dpmp.php','valid_save_dpmp',validatetask); return false;"/></td>
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