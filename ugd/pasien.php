<table width="810" class="tb">
  <tr>
    <td height="21" colspan="2">Nama (pakailah hurup cetak)</td>
    <td colspan="2">Tanggal &amp; Jam Masuk</td>
    <td colspan="2">No Rekam Medis</td>
  </tr>
  <tr>
    <td height="23" colspan="2"><input name="nama" class="text" type="text" id="nama" size="40" /></td>
    <td colspan="2"><input type="text" class="text" name="tgl_jam_masuk" id="tgl_jam_masuk" /></td>
    <td colspan="2">
      <input type="text" class="text" name="NOMR" id="NOMR" />
      <input type="hidden" name="IDXDAFTAR" id="IDXDAFTAR" />
    </td>
  </tr>
  <tr>
    <td colspan="2" rowspan="2"><p>Alamat</p>
      <p>
        <textarea name="alamat" id="alamat" cols="40" rows="2"></textarea>
    </p></td>
    <td width="97">Desa    </td>
    <td width="293"><input class="text" type="text" name="desa" id="desa" /></td>
    <td width="223">Kec</td>
    <td width="146"><input type="text" name="kec" id="kec" class="text" /></td>
  </tr>
  <tr>
    <td>Rt/ Rw    </td>
    <td><input type="text" class="text" name="rt" id="rt" /></td>
    <td>Kab</td>
    <td><input type="text" name="kab" id="kab" /></td>
  </tr>
  <tr>
    <td width="174"><div align="center">Umur</div></td>
    <td width="174"><div align="center">Tgl Lahir</div></td>
    <td><div align="center">Sex</div></td>
    <td><div align="center">Status Perkawinan</div></td>
    <td><div align="center">Agama</div></td>
    <td><div align="center">Pekerjaan</div></td>
  </tr>
  <tr>
    <td><input type="text" class="text" name="umur" id="umur" /></td>
    <td><input type="text"class="text" name="tgl_lahir" id="tgl_lahir" /></td>
    <td><p>
      <label>
        <input type="radio" name="sex" value="1" id="sex_0" />
        Laki - lako</label>
      <label>
        <input type="radio" name="sex" value="0" id="sex_1" />
        Perempuan</label>
      <br />
    </p></td>
    <td><select name="status" class="text" id="status">
      <option value="1">Kawin</option>
      <option value="2">Blm Kawin</option>
      <option value="3">Janda</option>
      <option value="4">Duda</option>
    </select></td>
    <td><select name="agama" class="text" id="agama">
      <option value="1">Islam</option>
      <option value="2">Kristen</option>
      <option value="3">Katolik</option>
      <option value="4">Hindu</option>
      <option value="5">Budha</option>
    </select></td>
    <td><input type="text" name="pekerjaan" id="pekerjaan" class="text" /></td>
  </tr>
  <tr>
    <td colspan="3">Yang dapat dihubungi<br />
  <textarea name="contact_person" class="text" id="contact_person" cols="40" rows="3"></textarea>
    </td>
    <td colspan="3">Alamat/ telepon<br />
        <textarea name="alamat_cntact" class="text" id="alamat_cntact" cols="40" rows="3"></textarea>
    </td>
  </tr>
  <tr>
    <td colspan="2" valign="top">Tgl Kecelakaan&nbsp; 
    <input type="text" name="tgl_kecelakaan" id="tgl_kecelakaan" /></td>
    <td colspan="4">Tempat terjadinya<br />
        <textarea name="tmp_kecelakaan" id="tmp_kecelakaan" cols="40" rows="3"></textarea>
    </td>
  </tr>
  <tr>
    <td height="80" colspan="3"><table width="418" border="0" cellspacing="0">
      <tr>
        <td width="152">Dibawa ke RSUD oleh</td>
        <td width="95"><input type="radio" name="dibawa_oleh" id="keluarga" value="keluarga" />
          Keluarga</td>
        <td width="165"><input type="radio" name="dibawa_oleh" id="sendiri" value="sendiri" />
          Sendiri</td>
      </tr>
      <tr>
        <td><input type="radio" name="dibawa_oleh" id="polisi" value="polisi" />
Polisi</td>
        <td><input type="radio" name="dibawa_oleh" id="lainnya" value="lainnya"/>
          Lainnya</td>
        <td><input type="text" name="ket_lainnya" id="ket_lainnya" /></td>
      </tr>
    </table></td>
    <td colspan="3"><table border="0" cellspacing="0">
      <tr>
        <td width="152">Bentuk pelayanan</td>
        <td width="95"><input type="checkbox" name="checkbox" id="checkbox" />
          X - Ray</td>
        <td width="154"><input type="checkbox" name="checkbox2" id="checkbox2" />
          Lab</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="checkbox" name="checkbox6" id="checkbox6" /> 
          Fisioterapi
</td>
        <td><input type="checkbox" name="checkbox5" id="checkbox5" /> 
          EKG
</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>BB&nbsp; 
    <input name="textfield13" type="text" id="textfield13" size="10" />
    &nbsp;Kg</td>
    <td colspan="3">PEMBERITAHUAN KEPADA</td>
  </tr>
  <tr>
    <td colspan="3" rowspan="4" valign="top">RIWAYAT SINGKAT<br /><textarea name="textarea5" id="textarea5" cols="65" rows="5"></textarea></td>
    <td><input type="checkbox" name="checkbox7" id="checkbox7" /> 
    Keluarga</td>
    <td colspan="2"><input type="checkbox" name="checkbox8" id="checkbox8" />
      Polisi</td>
  </tr>
  <tr>
    <td>Oleh</td>
    <td colspan="2"><input type="text" name="textfield15" id="textfield15" /></td>
  </tr>
  <tr>
    <td>Tgl. Jam</td>
    <td colspan="2"><input type="text" name="textfield16" id="textfield16" /></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Tanda Vital :&nbsp;&nbsp;Tek. Darah&nbsp;
      <input name="textfield17" type="text" id="textfield17" size="10" />
mmHG&nbsp;</td>
    <td>Nadi&nbsp;
      <input name="textfield19" type="text" id="textfield19" size="10" />
x/m&nbsp;</td>
    <td>Respirasi
      <input name="textfield20" type="text" id="textfield20" size="10" />
x/m</td>
    <td colspan="2">Suhu&nbsp;
      <input name="textfield18" type="text" id="textfield18" size="10" />
oC</td>
  </tr>
  <tr>
    <td colspan="6">DITERUSKAN KEPADA : Dr 
    <input name="textfield21" type="text" id="textfield21" size="50" /></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
