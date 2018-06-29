    <form action="index.php?link=2d" method="post" name="daftar" class="style1" id="daftar">


  <tr>
    <td width="39%">&nbsp;</td>
    <td width="6%">&nbsp;</td>
    <td width="55%">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">NIK</td>
    <td bgcolor="#CCCCCC"><div align="center">:</div></td>
    <td bgcolor="#CCCCCC"><? echo $row['nik']; ?><input type="hidden" value="<? echo $row['nik']; ?>" name="nik" /></td>
  </tr>
  <tr>
    <td>No. KTP</td>
    <td><div align="center">:</div></td>
    <td><? echo $row['no_ktp']; ?><input type="hidden" value="<? echo $row['no_ktp']; ?>" name="no_ktp" /></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Nama Lengkap</td>
    <td bgcolor="#CCCCCC"><div align="center">:</div></td>
    <td bgcolor="#CCCCCC"><? echo $row['nama_lgkp']; ?><input type="hidden" value="<? echo $row['nama_lgkp']; ?>" name="nama_lgkp" /></td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td><div align="center">:</div></td>
    <td><? if ($row['jenis_klmin']==1) { echo "Laki-Laki"; } elseif ($row['jenis_klmin']==2) {echo "Perempuan"; }?><input type="hidden" value="<? echo $row['jenis_klmin']; ?>" name="JENISKELAMIN" /></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Tempat Lahir</td>
    <td bgcolor="#CCCCCC"><div align="center">:</div></td>
    <td bgcolor="#CCCCCC"><? echo $row['tmpt_lhr']; ?><input type="hidden" value="<? echo $row['tmpt_lhr']; ?>" name="tmpt_lhr" /></td>
  </tr>
  <tr>
    <td>Tanggal Lahir</td>
    <td><div align="center">:</div></td>
    <td><? echo $row['tgl_lhr']; ?><input type="hidden" value="<? echo $row['tgl_lhr']; ?>" name="tgl_lhr" /></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Agama</td>
    <td bgcolor="#CCCCCC"><div align="center">:</div></td>
    <td bgcolor="#CCCCCC"><? 
	
	$sql4 = "select agama_master.descrip from agama_master where agama_master.no = '".$row['agama']."'";
	$result4 = mysql_query($sql4) or die ("error:". mysql_error());
	$row4=mysql_fetch_array($result4);
	$agama=$row4['descrip'];

	
	echo $agama; 
	?><input type="hidden" value="<? echo $row['agama']; ?>" name="AGAMA" /></td>
  </tr>
  <tr>
    <td>Pendidikan Terakhir</td>
    <td><div align="center">:</div></td>
    <td>
	
	
	
	
	
	<? /*if ($row['pddk_akh'] = 1) {
			$pddk = "Tidak/Belum Sekolah";}
			elseif ($row['pddk_akh'] = 2) {
			$pddk = "PNS";	}
	
	echo $pddk ;
	*/
	
	$sql2 = "select pddk_master.descrip from pddk_master where pddk_master.no = '".$row['pddk_akh']."'";
	$result2 = mysql_query($sql2) or die ("error:". mysql_error());
	$row2=mysql_fetch_array($result2);
	$pddk=$row2['descrip'];

	
	echo $pddk; 
	
	if ($row['pddk_akh'] == "1" || $row['pddk_akh'] == "2" || $row['pddk_akh'] == "3") {
		$PENDIDIKAN = "1";}
	elseif ($row['pddk_akh'] == "4") {
		$PENDIDIKAN = "2";}
	elseif ($row['pddk_akh'] == "5") {
		$PENDIDIKAN = "3";}
	elseif ($row['pddk_akh'] == "6" || $row['pddk_akh'] == "7") {
		$PENDIDIKAN = "4";}
	elseif ($row['pddk_akh'] == "8" || $row['pddk_akh'] == "9" || $row['pddk_akh'] == "10") {
		$PENDIDIKAN = "5";}

		
	?><input type="hidden" value="<? echo $PENDIDIKAN; ?>" name="PENDIDIKAN" /></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Pekerjaan </td>
    <td bgcolor="#CCCCCC"><div align="center">:</div></td>
    <td bgcolor="#CCCCCC">
	
			<? 
			
	$sql3 = "select pkrjn_master.descrip from pkrjn_master where pkrjn_master.no = '".$row['jenis_pkrjn']."'";
	$result3 = mysql_query($sql3) or die ("error:". mysql_error());
	$row3=mysql_fetch_array($result3);
	$pkrjn=$row3['descrip'];
	echo $pkrjn; 
	
	
	
	?>
      <input type="hidden" value="<?=$pkrjn?>" name="pkrjn" /></td>
  </tr>
  <tr>
    <td>Nama Lengkap Ayah</td>
    <td><div align="center">:</div></td>
    <td><? echo $row['nama_lgkp_ayah']; ?>
      <input type="hidden" value="<? echo $row['nama_lgkp_ayah']; ?>" name="SUAMI_ORTU" /><input type="hidden" value="<? echo $row['stat_kwn']; ?>" name="KAWIN" /></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Nama Lengkap Ibu</td>
    <td bgcolor="#CCCCCC"><div align="center">:</div></td>
    <td bgcolor="#CCCCCC"><? echo $row['nama_lgkp_ibu']; ?>
      <input type="hidden" value="<? echo $row['nama_lgkp_ibu']; ?>" name="nama_lgkp_ibu" /></td>
  </tr>
  <tr>
    <td>Alamat </td>
    <td><div align="center">:</div></td>
    <td>
    
    
    <? 
			
	$sqlAlamat = "select data_keluarga.alamat, data_keluarga.no_rt, data_keluarga.no_rw from data_keluarga where data_keluarga.no_kk = '".$row['no_kk']."'";
	$resultAlamat = mysql_query($sqlAlamat) or die ("error:". mysql_error());
	$rowAlamat=mysql_fetch_array($resultAlamat);
	$alamat="".$rowAlamat['alamat']." RT ".$rowAlamat['no_rt']." RW ".$rowAlamat['no_rw']."";
	echo $alamat; 
	
	
	
	?>
      <input type="hidden" value="<?=$alamat?>" name="ALAMAT" />


    <? 
			
	$sqlTelp = "select data_keluarga.telp from data_keluarga where data_keluarga.no_kk = '".$row['no_kk']."'";
	$resultTelp = mysql_query($sqlTelp) or die ("error:". mysql_error());
	$rowTelp=mysql_fetch_array($resultTelp);
	$telp=$rowTelp['telp'];
	
	
	
	?>
      <input type="hidden" value="<?=$telp?>" name="NOTELP" />

    
    
    </td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Kelurahan</td>
    <td bgcolor="#CCCCCC"><div align="center">:</div></td>
    <td bgcolor="#CCCCCC"><? 
			
	$sqlKel = "select setup_kel.nama_kel from setup_kel where setup_kel.no_kel = '".$row['no_kel']."' and setup_kel.no_kec = '".$row['no_kec']."' and setup_kel.no_kab = '".$row['no_kab']."'";
	$resultKel = mysql_query($sqlKel) or die ("error:". mysql_error());
	$rowKel=mysql_fetch_array($resultKel);
	$kelurahan=$rowKel['nama_kel'];
	echo $kelurahan; 
	
	
	
	?>
      <input type="hidden" value="<?=$kelurahan?>" name="KELURAHAN" /></td>
  </tr>
  <tr>
    <td>Kecamatan</td>
    <td><div align="center">:</div></td>
    <td><? 
			
	$sqlKec = "select setup_kec.nama_kec from setup_kec where setup_kec.no_kec = '".$row['no_kec']."' and setup_kec.no_kab = '".$row['no_kab']."'";
	$resultKec = mysql_query($sqlKec) or die ("error:". mysql_error());
	$rowKec=mysql_fetch_array($resultKec);
	$kecamatan=$rowKec['nama_kec'];
	echo $kecamatan; 
	
	
	
	?>
      <input type="hidden" value="<?=$kecamatan?>" name="KECAMATAN" /><input type="hidden" value="<?=$row['no_kec']?>" name="KDKECAMATAN" /></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">Kabupaten / Kota</td>
    <td bgcolor="#CCCCCC"><div align="center">
      <div align="center">:</div>
    </div></td>
    <td bgcolor="#CCCCCC"><? 
			
	$sqlKab = "select setup_kab.nama_kab from setup_kab where setup_kab.no_kab = '".$row['no_kab']."'";
	$resultKab = mysql_query($sqlKab) or die ("error:". mysql_error());
	$rowKab=mysql_fetch_array($resultKab);
	$kabupaten=$rowKab['nama_kab'];
	echo $kabupaten; 
	
	
	
	?>
      <input type="hidden" value="<?=$kabupaten?>" name="KOTA" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div align="center"></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><label>
      <input type="submit" name="kirim" id="kirim" value="Proses Registrasi" />
    </label></td>
  </tr>
</table>

</form>
