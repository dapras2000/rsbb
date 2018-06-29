<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form name="pengkajian_dewasa" id="pengkajian_dewasa" action="ranap/save_pengkajian_dewasa.php" method="post">
<table width="95%" border="0" cellpadding="0" cellspacing="0" class="tb">
  <tr>
    <td colspan="6"><strong>PENGKAJIAN PASIEN RAWAT INAP</strong></td>
    </tr>
  <tr>
    <td colspan="6"><hr /></td>
    </tr>
  <tr>
    <td width="28%">Yang Mengantar </td>
    <td width="28%"><input type="text" size="50" class="text" name="pengantar" /></td>
    <td width="3%">&nbsp;</td>
    <td width="39%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
    <td width="1%">&nbsp;</td>
  </tr>
  <tr>
    <td>Hubungan dengan Pasien</td>
    <td><input type="text" size="20" class="text" name="hubungan" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Tekanan Darah </td>
    <td><input type="text" size="10" class="text" name="tekanan_darah" />
      mmHg</td>
    <td>E</td>
    <td><input type="text" size="10" class="text" name="e" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> Suhu </td>
    <td><input type="text" size="10" class="text" name="suhu" />
      oC</td>
    <td>V</td>
    <td><input type="text" size="10" class="text" name="v" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Nadi</td>
    <td><input type="text" size="10" class="text" name="nadi" />
x/m</td>
    <td>m</td>
    <td><input type="text" size="10" class="text" name="m" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>RR</td>
    <td><input type="text" size="10" class="text" name="rr" />
x/m</td>
    <td>GCS</td>
    <td><input type="text" size="10" class="text" name="gsc" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>TB </td>
    <td><input type="text" size="10" class="text" name="tb" />
      cm</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> BB </td>
    <td><input type="text" size="10" class="text" name="bb" />
      kg</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> Nilai  </td>
    <td><input type="text" size="10" class="text" name="nilai" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Kesadaran: </td>
    <td><input type="text" size="30" class="text" name="kesadaran" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td> Cara Masuk : </td>
    <td>
    <input type="radio" name="datang_dari" value="1" /> Berjalan ? 
    <input type="radio" name="datang_dari" value="1" /> Kursi Roda ?
    <input type="radio" name="datang_dari" value="1" /> Brankar
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Datang dari : </td>
    <td>
    	<input type="radio" name="datang_dari" value="1" /> Admission 
        <input type="radio" name="datang_dari" value="2" /> UGD
        <input type="radio" name="datang_dari" value="3" /> Poli<span id="poli_coices"></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><strong>RIWAYAT KESEHATAN</strong></td>
    </tr>
  <tr>
    <td colspan="6"><hr /></td>
    </tr>
  <tr>
    <td>Diagnosa Medis Saat  Masuk </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Alasan Masuk :</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- Riwayat Medis </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- Pernah  Masuk RS </td>
    <td><input type="radio" name="ya" id="ya" value="1" /> 
      Ya <span id="ya"></span> 
        <input type="radio" name="tidak" id="tidak" value="2" /> Tidak
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- Medical </td>
    <td><input type="text" size="20" name="medical" class="text" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- Bedah</td>
    <td><input type="text" size="20" name="bedah" class="text" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">- Alergi : </td>
    <td colspan="3"><input name="alergi" type="checkbox" value="1"/> 
      Ashma 
      <input name="alergi" type="checkbox" value="2"/> Hay Fever/bersin-bersin 
      <input name="alergi" type="checkbox" value="3"/> Eksim 
      <input name="alergi" type="checkbox" value="4"/> Gatal-gatal <br />
      <input name="alergi" type="checkbox" value="5"/> Makanan <input type="text" size="20" name="ket1" class="text" /><br />
      <input name="alergi" type="checkbox" value="6"/> Obat <input type="text" size="20" name="ket2" class="text" /><br />
      <input name="alergi" type="checkbox" value="7"/> Lainnya <input type="text" size="20" name="ket3" class="text" /><br />
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Riwayat  Injuri/Kecelakaan/Kasus Ortopedi </td>
    <td><input type="text" size="50" name="riwayat" class="text" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Kebiasaan :</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- Makan </td>
    <td><input type="text" size="30" name="makanan" class="text" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- Perilaku </td>
    <td><input type="text" size="30" name="prilaku" class="text" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- Hygiene </td>
    <td><input type="text" size="30" name="hygiene" class="text" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- Aktivitas </td>
    <td><input type="text" size="30" name="aktivitas" class="text" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- Tidur</td>
    <td><input type="text" size="30" name="tidur" class="text" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Eliminasi :</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- BAB </td>
    <td><input type="text" size="30" name="bab" class="text" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- BAK </td>
    <td><input type="text" size="30" name="bak" class="text" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">
    <strong>PENGOBATAN</strong>
    <table width="90%" align="left" border="0" class="tb">
      <tr>
        <td width="21%">Nama Obat</td>
        <td width="79%"><input type="text" size="50" name="nama_obat2" class="text" /></td>
      </tr>
      <tr>
        <td>Dosis</td>
        <td><input type="text" size="50" name="dosis" class="text" /></td>
      </tr>
      <tr>
        <td>Frekuensi</td>
        <td><input type="text" size="50" name="frekuensi" class="text" /></td>
      </tr>
      <tr>
        <td>Lama Pemberian</td>
        <td><input type="text" size="50" name="lama_pemberian" class="text" /></td>
      </tr>
      <tr>
        <td>Dosis Terakhir yang  Diberikan</td>
        <td><input type="text" size="50" name="dosis_terakhir" class="text" /></td>
      </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" class="text" name="tambah" value="tambah"/></td>
  </tr>
</table>

    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><strong>COPING</strong></td>
    </tr>
  <tr>
    <td>Riwayat Sosial :</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Respon : </td>
    <td colspan="3">Gangguan Kooperatif Lainnya 
      <input name="gangguan" type="text"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Komunikasi : </td>
    <td colspan="3">Gangguan Bingung Lainnya 
      <input name="komunikasi" type="text"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Dampak Masuk RS :</td>
    <td colspan="3">(sedih, cemas,  menangis, dll)
      <input name="dampak" type="text"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Status Pernikahan : </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Tempat Tinggal : </td>
    <td colspan="3">
        <input type="radio" name="ttinggal" value="1" /> Sendiri 
        <input type="radio" name="ttinggal" value="2" /> Dengan 
        <input type="radio" name="ttinggal" value="3" /> Keluarga 
        <input type="radio" name="ttinggal" value="4" /> Menumpang 
        <input type="radio" name="ttinggal" value="5" /> Penampungan 
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Kebutuhan Khusus : </td>
    <td colspan="3">
      <input type="radio" name="kebutuhan_khusus" value="1" /> Kursi Roda 
      <input type="radio" name="kebutuhan_khusus" value="2" /> Kruk 
      <input type="radio" name="kebutuhan_khusus" value="3" /> Lainnya
      <input name="kebutuhan_khusus_lainnya" type="text"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Riwayat Keluarga : </td>
    <td colspan="3"><p>
      <input type="radio" name="riwayat_keluarga" value="1" /> DM 
      <input type="radio" name="riwayat_keluarga" value="2" /> Kanker 
      <input type="radio" name="riwayat_keluarga" value="3" /> Hipertensi 
      <input type="radio" name="riwayat_keluarga" value="4" /> Jantung 
      <input type="radio" name="riwayat_keluarga" value="5" /> TBC 
      <input type="radio" name="riwayat_keluarga" value="6" /> Anemia
      <input type="radio" name="riwayat_keluarga" value="7" /> Lainnya
	  <input name="riwayat_lainnya" type="text" />
    </p></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Konsumsi  Alkohol/Narkoba :</td>
    <td colspan="3">
      <input type="radio" name="alkohol" value="1" /> Tidak 
      <input type="radio" name="alkohol" value="1" /> Ya, 
      Jenis <input name="alkohol_jenis" type="text" />
      Sejak <input name="alkohol_sejak" type="text" />
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Merokok :</td>
    <td colspan="5"><input type="radio" name="merokok" value="1" /> Tidak <input type="radio" name="merokok" value="1" /> Ya, Jumlah per hari <input name="jml_perhari" type="text" /> Sejak 
      <input name="rokok_sejak" type="text" />
      Berhenti sejak 
      <input name="berhenti_sejak" type="text" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><strong>PENGKAJIAN RESIKO JATUH</strong></td>
    </tr>
  <tr>
    <td colspan="6"><hr /></td>
    </tr>
  <tr>
    <td colspan="6">Tidak Beresiko ? Umur: =65 Th atau = 3 Th ? Gizi Buruk ? Inkontinensia
      ? Gangguan Neuro/Ortopedi ? Peny. Kardiovaskuler ? Pengaruh Analgetik/Hipnotik 
      ? Kelemahan ? Bingung ? Gangguan Penglihatan ? Keterbatasan Mobilisasi
      ? Riwayat Pingsan/Jatuh ? Lainnya
      <input name="resiko" size="30" type="text"  class="text"/></td>
    </tr>
  <tr style="">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><strong>PENGKAJIAN SISTEM TUBUH</strong></td>
    </tr>
  <tr>
    <td><p>Respiratori</p></td>
    <td colspan="5">
      <input type="radio" name="respiratori" value="1" /> Normal
      <input type="radio" name="respiratori" value="2" /> Nyeri
      <input type="radio" name="respiratori" value="3" /> Batuk
      <input type="radio" name="respiratori" value="4" /> Dyspnoe
      <input type="radio" name="respiratori" value="5" /> Sputum 
      <input type="radio" name="respiratori" value="6" /> Penjelasan 
      <input name="respiratori_penjelasan" size="30"  class="text" type="text"/>
    </td>
    </tr>
  <tr>
    <td valign="top">Sirkulasi</td>
    <td colspan="5">
      <input type="radio" name="sirkulasi" value="1" /> Normal 
      <input type="radio" name="sirkulasi" value="2" /> Edema 
      <input type="radio" name="sirkulasi" value="3" /> Perdarahan 
      <input type="radio" name="sirkulasi" value="4" /> Syncope
      <input type="radio" name="sirkulasi" value="5" /> Palpitasi<br />
      <input type="radio" name="sirkulasi" value="6" /> Murmur
      <input type="radio" name="sirkulasi" value="7" /> Pacemaker
      <input type="radio" name="sirkulasi" value="8" /> Penjelasan 
      <input name="sirkulasi_penjelasan2" size="30"  class="text" type="text"/>
    </td>
    </tr>
  <tr>
    <td>Nutrisi</td>
    <td><input type="text" name="nutrisi" class="text" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Eliminasi</td>
    <td><input type="text" name="eliminasi" class="text" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Bowel</td>
    <td><input type="text" name="bowel" class="text" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Bladder</td>
    <td><input type="text" name="bladder" class="text" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Integumen</td>
    <td><input type="text" name="integumen" class="text" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Reproduksi</td>
    <td><input type="text" name="reproduksi" class="text" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Aktifitas seksual</td>
    <td><input type="text" name="aktifitas_seksual" class="text" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Jumlah Anak</td>
    <td><input type="text" name="jumlah_anak" class="text" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Kontrasepsi</td>
    <td><input type="text" name="kontrasepsi" class="text" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><p><strong>Aktifitas</strong></p></td>
    <td colspan="5">
        <input type="radio" name="sirkulasi" value="1" /> Normal 
        <input type="radio" name="sirkulasi" value="2" /> Lemah 
        <input type="radio" name="sirkulasi" value="3" /> Kram 
        <input type="radio" name="sirkulasi" value="4" /> Nyeri Ekstrimitas
        <input type="radio" name="sirkulasi" value="5" /> Kontraktur<br />
        <input type="radio" name="sirkulasi" value="6" /> Nyeri Otot
        <input type="radio" name="sirkulasi" value="7" /> Deformitas
        <input type="radio" name="sirkulasi" value="8" /> Arthritis
        <input type="radio" name="sirkulasi" value="9" /> Amputasi<br />
        <input type="radio" name="sirkulasi" value="10" /> Penjelasan
        <input type="text" name="aktifitas_penjelasan" class="text" size="30" />
      </td>
    </tr>
  <tr>
    <td valign="top"><strong>Rasa Nyaman</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Jelaskan nyeri yang  dirasakan</td>
    <td><input type="text" name="penjelasan_yg_dirasakan" class="text" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Yang dilakukan untuk  mengurangi/menghilangkan nyeri </td>
    <td valign="top"><input type="text" class="text" name="tindakan" size="30" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  </table>

</form>
</body>
</html>