<?php
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
}else{
	$tgl_kunjungan =DATE('Y/m/d');  
}


?>
<h3>SENSUS HARIAN UGD</h3>
          <table width="95%" style="margin:10px;" border="1" cellspacing="0" cellspading="0" class="tb">
            <tr align="center">
              <th width="2%" rowspan="3">NO </th>
              <th width="3%" rowspan="3">NOMOR RM</th>
              <th width="3%" rowspan="3">NAMA</th>
              <th height="100" colspan="2">UMUR</th>
              <th colspan="2">KUNJUNGAN</th>
              <th width="4%" rowspan="3">DIAGNOSA</th>
              <th width="4%" rowspan="3">TINDAKAN</th>
              <th colspan="2">KASUS PENYAKIT</th>
              <th colspan="5">JENIS PELAYANAN</th>
              <th colspan="2">KASUS</th>
              <?
				$jumlahKec = 0;
				$ss	= mysql_query('select a.kdkecamatan, b.namakecamatan from (SELECT kdkecamatan FROM m_pasien group by kdkecamatan order by kdkecamatan DESC) as a left join m_kecamatan b on a.kdkecamatan = b.idkecamatan');
				while($ds = mysql_fetch_array($ss)){
					if($ds['kdkecamatan'] == '0' || $ds['kdkecamatan'] == null){
					}else{
						$jumlahKec++;
					}
				}
			  ?>
              <th colspan="<?=$jumlahKec;?>">ASAL WILAYAH KECAMATAN</th>
              <th width="3%" rowspan="3">CARA BAYAR</th>
              <th colspan="5">TINDAK LANJUT PELAYANAN</th>
              <th colspan="2">DIISI OLEH PETUGAS RM</th>
            </tr>
            <tr align="center">
              <th width="3%" rowspan="2">L</th>
              <th width="1%" rowspan="2">P</th>
              <th width="1%" rowspan="2">B</th>
              <th width="4%" rowspan="2">L</th>
              <th width="1%" rowspan="2">B</th>
              <th width="4%" rowspan="2">L</th>
              <th width="3%" rowspan="2">BEDAH</th>
              <th width="3%" rowspan="2">NON BEDAH</th>
              <th width="1%" rowspan="2">KB &amp; KD</th>
              <th width="4%" rowspan="2">PSIKIATRI</th>
              <th width="4%" rowspan="2">ANAK</th>
              <th width="1%" rowspan="2">KL</th>
              <th width="3%" rowspan="2">NON KLL</th>
              <?
				$ss	= mysql_query('select a.kdkecamatan, b.namakecamatan from (SELECT kdkecamatan FROM m_pasien group by kdkecamatan order by kdkecamatan DESC) as a left join m_kecamatan b on a.kdkecamatan = b.idkecamatan');
				while($ds = mysql_fetch_array($ss)){
					if($ds['kdkecamatan'] == '0' || $ds['kdkecamatan'] == null){
					}else{
						echo '<th width="5%" rowspan="2">'.$ds['namakecamatan'].'</th>';
					}
				}
			  ?>
              <th width="3%" rowspan="2">PULANG</th>
              <th width="3%" rowspan="2">RAWAT</th>
              <th width="3%" rowspan="2">RUJUK</th>
              <th width="2%" rowspan="2">DOA</th>
              <th width="5%" rowspan="2">MENINGGAL</th>
              <th colspan="2">KODE</th>
            </tr>
            <tr align="center">
              <th width="2%">ICD-XL</th>
              <th width="4%">ICD IX CM</th>
            </tr>
            <?php
			$sql = mysql_query("SELECT a.nomr,b.nama,b.jeniskelamin,a.tanggal,
YEAR(a.TANGGAL)-YEAR(b.tgllahir) AS umur,
a.kunjungan_bl,a.diagnosa,a.terapi,b.kdkecamatan,d.nama
AS carabayar,e.status,a.icd_code,icdcm,a.JENIS,a.KLB,a.KASUS_BL
FROM t_pendaftaran e
LEFT JOIN t_diagnosadanterapi a ON a.idxdaftar=e.idxdaftar
INNER JOIN m_pasien b ON a.nomr=b.nomr
INNER JOIN m_carabayar d ON d.kode=e.kdcarabayar
WHERE e.kdpoly=9 and a.TANGGAL = '".$tgl_kunjungan."'");
			$i = 1;
            while($data = mysql_fetch_array($sql)) {
				?>
            <tr>
              <td><?php echo $i;?></td>
              <td><? echo $data['nomr']; ?></td>
              <td><? echo $data['nama']; ?></td>
              <td><? if ($data['jeniskelamin']=='P') {echo $data['umur'].' tahun';} ?></td>
			  <td><? if ($data['jeniskelamin']=='L') {echo $data['umur'].' tahun ';} ?></td>
              <td><? if ($data['kunjungan_bl']==1){echo 'B';}?></td>
			  <td><? if ($data['kunjungan_bl']==0){echo 'L';}?></td>
              <td><? echo $data['diagnosa'];?></td>
              <td><? echo $data['terapi'];?></td>
              <td><? if ($data['KASUS_BL']==1){echo 'B';} ?></td>
		<td><? if ($data['KASUS_BL']==0){echo 'L';} ?></td>
              <td><? if ($data['JENIS']==4){echo 'X';} ?></td>
		<td><? if ($data['JENIS']==5){echo 'X';} ?></td>
		<td><? if ($data['JENIS']==1){echo 'X';} ?></td>
		<td><? if ($data['JENIS']==2){echo 'X';} ?></td>
		<td><? if ($data['JENIS']==3){echo 'X';} ?></td>
              <td><? if ($data['kllnonkll']==1){echo 'X';} ?></td>
              <td><? if ($data['kllnonkll']==0){echo 'X';} ?></td>
			  <?
				$ss	= mysql_query('select a.kdkecamatan, b.namakecamatan from (SELECT kdkecamatan FROM m_pasien group by kdkecamatan order by kdkecamatan DESC) as a left join m_kecamatan b on a.kdkecamatan = b.idkecamatan');
				while($ds = mysql_fetch_array($ss)){
					if($ds['kdkecamatan'] == '0' || $ds['kdkecamatan'] == null){
					}else{
						echo '<td>';
						if ($data['kdkecamatan']==$ds['kdkecamatan']){echo 'X';}
						echo '</td>';
					}
				}
			  ?>
              <td><? echo $data['carabayar']; ?></td>
              <td><? if ($data['status']==1){echo 'X';} ?></td>
		<td><? if ($data['status']==2){echo 'X';} ?></td>
		<td><? if ($data['status']==5){echo 'X';} ?></td>
		<td><? if ($data['status']==6){echo 'X';} ?></td>
		<td><? if ($data['status']==7){echo 'X';} ?></td>
		<td><? if ($data['status']==8){echo 'X';} ?></td>
              <td colspan="5"><? echo $data['icd_code']; ?></td>
              <td colspan="2"><? echo $data['icdcm']; ?></td>
            </tr>
            <?	$i++; } 
	
	
?>
          </table>
<p></p>
