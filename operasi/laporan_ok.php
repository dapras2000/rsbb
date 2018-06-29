<?php
include '../include/connect.php';
if($_REQUEST['dokteroperator'] != ''){
	$dokteroperator = " AND a.kode_dokteroperator = ".$_REQUEST['dokteroperator'];
}
if($_REQUEST['dokteranak'] != ''){
	$dokteranak 	= " AND a.kode_dokteranak	= ".$_REQUEST['dokteranak'];
}
if($_REQUEST['dokteranastesi'] != ''){
	$dokteranastesi = " AND a.kode_dokteranastesi	= ".$_REQUEST['dokteranastesi'];
}
if($_REQUEST['tindakan'] != ''){
	$tindakan	= " AND f.nama_tindakan like '%".$_REQUEST['tindakan']."'";
}
if($_REQUEST['tglreg'] != ''){
	$tglreg	= " AND a.tanggal = '".$_REQUEST['tglreg']."'";
}
/*
$sqls = "SELECT a.tanggal,b.NAMA, b.JENISKELAMIN AS JK,CEIL(DATEDIFF(a.tanggal,b.TGLLAHIR) / 365) AS umur, a.nomr, b.ALAMAT,a.dokteroperator,a.dokteranastesi,
a.dokteranak,a.diagnosa,
IF(a.JNSOPERASI = 'c','cito','elektif') AS jenis,a.jammulai, a.jamselesai, a.asistenoperator,a.perawatinstrumen,a.perawatsirkuler,a.asistenanastesi, f.nama_tindakan, f.tarif, d.NAMA AS carabayar
FROM t_operasi a
JOIN m_pasien b ON b.NOMR = a.nomr
JOIN t_admission c ON c.id_admission = a.IDXDAFTAR
JOIN m_carabayar d ON d.KODE = c.statusbayar
LEFT JOIN t_billranap e ON e.IDXDAFTAR = a.IDXDAFTAR AND e.NOMR = a.nomr
LEFT JOIN m_tarif2012 f ON f.kode_tindakan = e.KODETARIF
*/
$sqls = "SELECT a.tanggal,b.NAMA, b.JENISKELAMIN AS JK,CEIL(DATEDIFF(a.tanggal,b.TGLLAHIR) / 365) AS umur, a.nomr, b.ALAMAT,
a.dokteroperator,a.dokteranastesi,a.dokteranak,h.NAMADOKTER AS pelaksana,a.diagnosa, 
IF(a.JNSOPERASI = 'c','cito','elektif') AS jenis,a.jammulai, a.jamselesai, a.asistenoperator,a.perawatinstrumen,a.perawatsirkuler,a.asistenanastesi, f.nama_tindakan, e.tarifrs as tarif, d.NAMA AS carabayar
FROM t_operasi a
JOIN m_pasien b ON b.NOMR = a.nomr
JOIN t_admission c ON c.id_admission = a.IDXDAFTAR
JOIN m_carabayar d ON d.KODE = c.statusbayar
LEFT JOIN t_billranap e ON e.IDXDAFTAR = a.IDXDAFTAR AND e.NOMR = a.nomr
LEFT JOIN m_tarif2012 f ON f.kode_tindakan = e.KODETARIF
LEFT JOIN t_operasi_tindakan_medis g ON a.id_operasi = g.idoperasi AND e.KODETARIF = g.kodejasa
LEFT JOIN m_dokter h ON g.dokter = h.KDDOKTER
WHERE a.tanggal IS NOT NULL AND e.KODETARIF LIKE '04.%' ".$dokteroperator.$dokteranak.$dokteranastesi.$tindakan.$tglreg."
ORDER BY a.IDXDAFTAR, a.nomr";
$sql =  mysql_query($sqls);
#left join t_operasi_tindakan_medis e on e.idoperasi = a.id_operasi
?>
<div align="center">
  	<div id="frame" style="width:100%;">
  		<div id="frame_title"><h3 align="left">LAPORAN OPERASI</h3></div>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get" id="cari">
        	<input type="hidden" name="link" value="lapok" />
        	<table width="100%">
            <tr><td>Dokter Operator</td>
            	<td><select class="text" name="dokteroperator" id="dokteroperator">
          	<option value=""> -- </option>
		<?php 
	  		$q="SELECT a.kddokter, b.NAMADOKTER FROM m_dokter_jaga a 
JOIN m_dokter b ON a.kddokter = b.kddokter
WHERE a.kdpoly = 4 ORDER BY NAMADOKTER ASC";
	  		$h=mysql_query($q);
	 		while($b=mysql_fetch_array($h)){
	  			?><option value="<?=$b['kddokter'];?>" <? if($row_operasi3['kode_dokteroperator']==$b['kddokter']) echo "selected=selected"; ?> ><?=$b['NAMADOKTER'];?></option>
              <? }?>
          </select></td>
          		<td>Nama Tindakan</td>
                <td><input type="text" class="text" name="tindakan" id="tindakan" size="30" /></td></tr>
          <tr><td>Dokter Anak</td>
          		<td><select class="text" name="dokteranak" id="dokteranak">
            	<option value=""> -- </option>
		<?php 
	  		$q="SELECT a.kddokter, b.NAMADOKTER FROM m_dokter_jaga a 
JOIN m_dokter b ON a.kddokter = b.kddokter
WHERE a.kdpoly = 3 ORDER BY NAMADOKTER ASC";
	  		$h=mysql_query($q);
	 		while($b=mysql_fetch_array($h)){
	  			?><option value="<?=$b['kddokter'];?>" <? if($row_operasi3['kode_dokteranak']==$b['kddokter']) echo "selected=selected"; ?> ><?=$b['NAMADOKTER'];?></option>
              <? }?>
          </select></td>
          <td>
          Tgl Operasi </td><td><input type="text" class="text" name="tglreg" id="TGLREG" size="10"
									value = "<?php if($_REQUEST['tglreg'] !=""): echo $_REQUEST['tglreg']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar2')"><img src="img/date.png" alt="" border="0" align="top" /></a></td></tr>
          <tr><td>
          Dokter Anestesi</td><td><select class="text" name="dokteranastesi" id="dokteranastesi">
          	<option value=""> -- </option>
              <?php 
			  	$q1="SELECT a.kddokter, b.NAMADOKTER FROM m_dokter_jaga a 
JOIN m_dokter b ON a.kddokter = b.kddokter
WHERE a.kdpoly = 8 ORDER BY NAMADOKTER ASC";
	 	 		$h1=mysql_query($q1);
	  			while($b1=mysql_fetch_array($h1)){
	  			?><option value="<?=$b1['kddokter'];?>" <? if($row_operasi3['kode_dokteranastesi']==$b1['kddokter']) echo "selected=selected"; ?>  ><?=$b1['NAMADOKTER'];?></option>
              	<? 
				}
				?>
          </select></td><td></td><td><input type="submit" name="cari" id="cari" value="Cari" class="text" /></td></tr>
          </table>
        </form>
        <table class="tb" cellspacing="1" border="0" width="95%" cellspading="1" style="margin: 10px; overflow:scroll;">
        <tr>
        	<th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>L</th>
            <th>P</th>
            <th>Alamat</th>
            <th>D.Operator</th>
            <th>D.Anastesi</th>
            <th>D.Anak</th>
            <th>D.Pelaksana</th>
            <th>Diagnosa</th>
            <th>Jenis</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Asisten</th>
            <th>Instrumen</th>
            <th>Sirkuler</th>
            <th>Anestesi</th>
            <th>Tindakan</th>
            <th>Tarif</th>
            <th>Pembayaran</th>
        </tr>
        <?php
		if(mysql_num_rows($sql) > 0):
			$i = 1;
			while($data = mysql_fetch_array($sql)){
                  if ($i % 2) { $class = "tr1";} else { $class = "tr2"; }	
			?>
			<tr class="<?php echo $class; ?>">
				<td><?php echo $i;?></td>
				<td><?php echo $data['tanggal'];?></td>
				<td><?php echo $data['NAMA'];?></td>
				<td><?php if($data['JK'] == 'L'): echo $data['umur']; endif; ?></td>
				<td><?php if($data['JK'] == 'P'): echo $data['umur']; endif; ?></td>
				<td><?php echo $data['ALAMAT'];?></td>
				<td><?php echo $data['dokteroperator'];?></td>
				<td><?php echo $data['dokteranastesi'];?></td>
				<td><?php echo $data['dokteranak'];?></td>
                <td><?php echo $data['pelaksana'];?></td>
				<td><?php echo $data['diagnosa'];?></td>
				<td><?php echo $data['jenis'];?></td>
				<td><?php echo $data['jammulai'];?></td>
				<td><?php echo $data['jamselesai'];?></td>
				<td><?php echo $data['asistenoperator'];?></td>
				<td><?php echo $data['perawatinstrumen'];?></td>
				<td><?php echo $data['perawatsirkuler'];?></td>
				<td><?php echo $data['asistenanastesi'];?></td>
                <td><?php echo $data['nama_tindakan'];?></td>
                <td align="right"><?php echo curformat($data['tarif']);?></td>
				<td><?php echo $data['carabayar'];?></td>
			</tr>
            <?php $i++;
			}
		endif;
		?>
        </table>
        
        
	</div>
    
</div>

<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$sqls?>" />
<input type="hidden" name="header" value="LAPORAN KAMAR OPERASI" />
<input type="hidden" name="filename" value="lap_kamaroperasi" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>