<div align="center">
	<div id="frame" style="width:100%;">
		<div id="frame_title"><h3>DATA RADIOLOGI</h3></div>
		<form id="formperiksaradiologi" name="formperiksaradiologi" method="post" action="radiologi/updateperiksa_dokter.php">
  <table width="700" border="0" cellspacing="0" cellpadding="2" align="center" class="tb">
	<?php $sel = mysql_query('select a.*, (select nama from m_poly where kode = a.POLYPENGIRIM) nama_poly, (select namadokter from m_dokter where kddokter = a.DRPENGIRIM) dokter_pengirim, (select nama_tindakan from m_tarif2012 where kode_tindakan = a.jenisphoto) permintaan_photo, (select namadokter from m_dokter where kddokter=a.drradiologi) dokter_radiologi from t_radiologi a where idxdaftar='.$_REQUEST['idx']); 
      $row = mysql_fetch_array($sel); ?>
    <tr>
      <td width="158">No. Foto</td>
      <td><? echo $row['NO_FILM'];?></td>
    </tr>
	<tr>
      <td width="160">Nama Poliklinik Pengirim</td>
      <td><? echo $row['nama_poly'];?></td>
    </tr>
	<tr>
      <td width="158">Nama Dokter Pengirim</td>
      <td><? echo $row['dokter_pengirim'];?></td>
    </tr>
	<tr>
      <td width="158">Permintaan Photo</td>
      <td><? echo $row['permintaan_photo'];?></td>
    </tr>
	<tr>
      <td width="158">Jenis Film</td>
      <td><? echo $row['jenisfilm'];?></td>
    </tr>
    <tr valign="top">
      <td> Dokter Radiologi</td>
      <td><?=$row['dokter_radiologi']?></td>
    </tr>
    <tr>
      <td valign="top">Hasil Expertise</td>
      <td><?php echo $row['HASILRESUME'];?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>
      	<input class="text" type="button" name="kembali" id="kembali" value="K e m b a l i" onClick="history.back();" />        
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</div></div>
