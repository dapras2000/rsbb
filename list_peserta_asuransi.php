<form action="daftarProses.php" method="post" name="daftar" class="style1" id="daftar">
<table width="80%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td colspan="5" background="img/frame_title.png"><div align="center" class="style2">Data Pasien Asuransi Yang Ditemukan</div></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>

    <td colspan="5">&nbsp;</td>
    </tr>
  <tr>
    <td bgcolor="#FFFF99"><strong>Nomor Peserta</strong></td>
    <td bgcolor="#FFFF99"><strong>Nama Lengkap</strong></td>
    <td bgcolor="#FFFF99"><strong>Jenis Kelamin</strong></td>
    <td bgcolor="#FFFF99"><strong>Tanggal Lahir</strong></td>
    <td bgcolor="#FFFF99"><strong>Alamat</strong></td>
  </tr>


<? while ($row=mysql_fetch_array($result)) {
		$warna = ($no%2==1)?"#efefef":"#ffffff";
		?>


<tr bgcolor="<?=$warna?>">
    <td><? echo $row['dpsnoka'];?></td>
    <td><? echo $row['dpsnmctk']; ?></td>
    <td><? echo $row['dpsjk']; ?></td>
    <td><? echo $row['dpstgllhr']; ?></td>
    <td><? echo $row['dpsjln']; ?></td>
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
