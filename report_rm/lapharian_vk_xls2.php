<?php
$search = " AND DATE(a.masukrs) = CURDATE() ";
$search2 = " AND a.tglreg = CURDATE() ";
	
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])) {
    $tgl_kunjungan =$_GET['tgl_kunjungan'];
} 

if($tgl_kunjungan !="") {
    $search = " AND DATE(a.masukrs) BETWEEN  '".$tgl_kunjungan."' ";
	$search2 = " AND a.tglreg BETWEEN  '".$tgl_kunjungan."' ";
}

$tgl_kunjungan2 = "";
if(!empty($_GET['tgl_kunjungan2'])) {
    $tgl_kunjungan2 =$_GET['tgl_kunjungan2'];
} 


if($tgl_kunjungan !="") {
    if($tgl_kunjungan2 !="") {
        $search = $search." AND '".$tgl_kunjungan2."' ";
		$search2 = $search2." AND '".$tgl_kunjungan2."' ";
    }else {
        $search = $search." AND '".$tgl_kunjungan."' ";
		$search2 = $search2." AND '".$tgl_kunjungan."' ";
    }
}

$qry = "SELECT a.nomr AS NO_RM,
				  		  	b.nama AS NAMA,
						  	b.tgllahir AS TGL_LAHIR,
						  	b.jeniskelamin AS JNS_KELAMIN, 
						  	DATE_FORMAT(a.masukrs,'%d/%m/%Y') AS TGL_MASUK, 
						  	date(masukrs) AS TANGGAL, 
       						DATE_FORMAT(nullif(a.keluarrs,'0000-00-00'),'%d/%m/%Y') AS TGL_KELUAR,
      						DATEDIFF(a.keluarrs,a.masukrs) AS LAMA_DIRAWAT,
							c.kdrujuk AS KDRUJUK,
							d.nama AS CARABAYAR,
							e.diagnosapulang AS DIAGNOSA_PULANG,
							e.icdkeluar AS ICD_KELUAR,
							berat_badan AS BRT_BADAN,
							g.namadokter AS NAMA_DOKTER,
							h.nama AS POLY, 
							e.statuspulang AS STATUS_PLG
FROM t_admission a
INNER JOIN m_pasien b ON a.nomr=b.nomr
INNER JOIN t_pendaftaran c ON a.id_admission=c.idxdaftar
INNER JOIN m_carabayar d ON d.kode=a.statusbayar
INNER JOIN t_resumepulang e ON e.IDADMISSION=a.id_admission
LEFT JOIN t_reg_partus f ON f.idxdaftar=a.id_admission
INNER JOIN m_dokter g ON a.dokterpengirim=g.kddokter
INNER JOIN m_poly h ON h.kode=a.kd_rujuk WHERE a.noruang=14 ".$search." 
UNION 
SELECT a.nomr AS NO_RM,
				  		  	b.nama AS NAMA,
						  	b.tgllahir AS TGL_LAHIR,
						  	b.jeniskelamin AS JNS_KELAMIN, 
						  	CONCAT(a.tglreg,' ',a.masukpoly) AS TGL_MASUK, 
						  	a.tglreg AS TANGGAL, 
       						CONCAT(a.tglreg,' ',a.keluarpoly) AS TGL_KELUAR,
      						DATEDIFF(a.keluarpoly,a.masukpoly) AS LAMA_DIRAWAT,
							a.kdrujuk AS KDRUJUK,
							d.nama AS CARABAYAR,
							k.objektif AS DIAGNOSA_PULANG,
							k.icd_code AS ICD_KELUAR,
							berat_badan AS BRT_BADAN,
							g.namadokter AS NAMA_DOKTER,
							h.nama AS POLY, 
							NULL AS STATUS_PLG
FROM t_pendaftaran a
INNER JOIN m_pasien b ON a.nomr=b.nomr
INNER JOIN m_carabayar d ON d.kode=a.kdcarabayar
LEFT JOIN t_kunjungan_kamar k ON a.idxdaftar = k.idxdaftar
LEFT JOIN t_reg_partus f ON f.idxdaftar=a.idxdaftar
INNER JOIN m_dokter g ON a.kddokter=g.kddokter
INNER JOIN m_poly h ON h.kode=a.kdpoly WHERE a.kdpoly=10 ".$search2;

$sql= mysql_query($qry) or die (mysql_error());

?>
<div align="center">
    <div id="frame" style="width:100%">
    <div id="frame_title"><h3>LAPORAN HARIAN PASIEN KAMAR BERSALIN (HIDUP & MENINGGAL)</h3></div>
<div align="right" style="margin:5px;">
      

    <div style="overflow:auto" >
        <table width="95%" style="margin:10px;" border="1" cellspacing="0" cellspading="0" class="tb">
          <tr align="center">
            <th width="3%" rowspan="2">NO</th>
            <th width="9%" rowspan="2">NOMOR RM</th>
            <th width="13%" rowspan="2">NAMA PASIEN</th>
            <th colspan="2">UMUR</th>
            <th width="7%" rowspan="2">TGL MASUK</th>
            <th width="8%" rowspan="2">TGL KELUAR</th>
            <th width="8%" rowspan="2">LAMA DIRAWAT</th>
            <th width="11%" colspan="4">ASAL PASIEN</th>
            <th width="12%" rowspan="2">CARA BAYAR</th>
            <th width="7%" rowspan="2">DIAGNOSA </th>
            <th width="9%" rowspan="2">ICD</th>
            <th width="4%" rowspan="2">TINDAKAN</th>
            <th width="2%" rowspan="2">ICD-9 CM</th>
            <th colspan="2">BERAT BAYI</th>
             <th width="0%" rowspan="2">DOKTER</th>
            <th width="0%" rowspan="2">ASAL WILAYAH</th>
            <th width="0%" rowspan="2">MASUK DARI</th>
            <th width="0%" colspan="4">KEADAAN KELUAR</th>
            <th width="1%" rowspan="2">KET</th>
          </tr>
          <tr align="center">
            <th width="6%">L</th>
            <th width="6%">P</th>
            <th width="11%">DS</th>
            <th width="6%">PKM</th>
            <th width="11%">RS LAIN</th>
            <th width="11%">INSTANSI LAIN</th>
            <th width="1%">&lt; 2500 gr</th>
            <th width="1%">&gt;= 2500 gr</th>
            <th width="0%">H</th>
            <th width="0%">R</th>
            <th width="0%">K</th>
            <th width="0%">M</th>
          </tr>
          <? $i=1;
	while($data = mysql_fetch_array($sql)) {?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
        <td><?=$i;?></td>
            <td><?=$data['NO_RM'];?></td>
            <td><?=$data['NAMA'];?></td>
                <td><?php 
				      $a = datediff($data['TANGGAL'], $data['TGL_LAHIR']);
					  if ($data['JNS_KELAMIN']=='L'){echo $a[years].' tahun '; }?></td>
                <td><?php 
				      $a = datediff($data['TANGGAL'], $data['TGL_LAHIR']);
					  if ($data['JNS_KELAMIN']=='P'){echo $a[years].' tahun '; }?></td>
            <td><?=$data['TGL_MASUK'];?></td>
            <td><?=$data['TGL_KELUAR'];?></td>
            <td><?=$data['LAMA_DIRAWAT'];?></td>
                <td><?php 
					  if ($data['KDRUJUK']=='1'){echo ' X'; }?></td>
                <td><?php 
					  if ($data['KDRUJUK']=='2'){echo ' X'; }?></td>
                <td><?php 
					  if ($data['KDRUJUK']=='3'){echo ' X'; }?></td>
                <td><?php 
					  if ($data['KDRUJUK']=='4'){echo ' X'; }?></td>
            <td><?=$data['CARABAYAR'];?></td>
            <td><?=$data['DIAGNOSA_PULANG'];?></td>
            <td><?=$data['ICD_KELUAR'];?></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?php 
					  if ($data['BRT_BADAN'] <2500){echo ' X'; }?></td>
                <td><?php 
					  if ($data['BRT_BADAN']>=2500){echo ' X'; }?></td>
           <td><?=$data['NAMA_DOKTER'];?></td>
              <td>&nbsp;</td>
              <td><?=$data['POLY'];?></td>
                <td><?php 
					  if (($data['STATUS_PLG']=='1') or ($data['STATUS_PLG']=='5')) {echo ' X'; }?></td>
                <td><?php 
					  if ($data['STATUS_PLG']=='3'){echo ' X'; }?></td>
                <td><?php 
					  if ($data['STATUS_PLG']=='4'){echo ' X'; }?></td>
                <td><?php 
					   if (($data['STATUS_PLG']=='2') or ($data['STATUS_PLG']=='6')) {echo ' X'; }?></td>
               <td>&nbsp;</td>
          </tr>
	 <?	$i++; } ?>
  
</table>
</div>
</div>
</div>