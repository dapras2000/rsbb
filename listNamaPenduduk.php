<form action="daftarProses.php" method="post" name="daftar" class="style1" id="daftar">
<table width="80%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td colspan="5" background="img/frame_title.png"><div align="center" class="style2">Data Penduduk Yang Ditemukan</div></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>

    <td colspan="5"><span class="style3">*) Pilih (klik) salah satu NIK yang sesuai dengan KTP</span></td>
    </tr>
  <tr>
    <td bgcolor="#FFFF99"><strong>NIK</strong></td>
    <td bgcolor="#FFFF99"><strong>Nama Lengkap</strong></td>
    <td bgcolor="#FFFF99"><strong>Tempat Lahir</strong></td>
    <td bgcolor="#FFFF99"><strong>Tanggal Lahir</strong></td>
    <td bgcolor="#FFFF99"><strong>Nama Lengkap Ibu</strong></td>
  </tr>


<? while ($row=mysql_fetch_array($result)) {
		$warna = ($no%2==1)?"#efefef":"#ffffff";
		?>


<tr bgcolor="<?=$warna?>">
    <td><a href="index.php?link=2b&nik=<? echo $row['nik'];?>"><? echo $row['nik'];?></a></td>
    <td><? echo $row['nama_lgkp']; ?></td>
    <td><? echo $row['tmpt_lhr']; ?></td>
    <td><? echo $row['tgl_lhr']; ?></td>
    <td><? echo $row['nama_lgkp_ibu']; ?></td>
  </tr>

	<? $no++; }?>


  <tr>
    <td width="20%">&nbsp;</td>
    <td width="24%">&nbsp;</td>
    <td width="15%">&nbsp;</td>
    <td width="15%">&nbsp;</td>
    <td width="26%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label></label></td>

  </tr>
</table>
</form>
