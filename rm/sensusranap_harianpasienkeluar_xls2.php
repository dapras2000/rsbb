<?php

$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan = $_GET['tgl_kunjungan']; 
}else{
	$tgl_kunjungan = date('Y/m/d');  
}

$sql3	= 'SELECT a.nomr,c.nama, c.jeniskelamin,ROUND(DATEDIFF(a.TGLMASUK,c.TGLLAHIR) / 365)  AS umur,
a.TGLMASUK, a.TGLKELUAR,DATEDIFF(a.TGLKELUAR,a.TGLMASUK) AS lamadirawat, d.nama AS ruang, d.kelas, e.NAMA AS carabayar,
f.jenis_penyakit AS icd_keluar, g.NAMADOKTER AS dokter, c.KDKECAMATAN, h.nama AS poly, a.statuspulang
FROM t_resumepulang a
JOIN t_admission b ON a.IDADMISSION = b.id_admission
JOIN m_pasien c ON a.NOMR = c.NOMR
JOIN m_ruang d ON b.noruang = d.no
JOIN m_carabayar e ON e.kode = b.statusbayar
LEFT JOIN icd f ON f.icd_code = b.icd_keluar
LEFT JOIN m_dokter g ON g.KDDOKTER = b.dokter_penanggungjawab
LEFT JOIN m_poly h ON h.kode = b.kirimdari
where a.TGLKELUAR = "'.$tgl_kunjungan.'"';
?>
<div align="center">
    <div id="frame" style="width:95%">
    <div id="frame_title">
      <h3>LAPORAN HARIAN PASIEN KELUAR</h3></div>
    <div align="center">
    
        <div id="table_search">
         <div style="overflow:scroll;width:100%;height:auto;" > 
     
        <table width="100%" style="margin:10px;" border="1" cellspacing="0" cellspading="0" class="tb">
		<tr><th rowspan="2">No</th><th rowspan="2">NOMR</th><th rowspan="2">Nama Pasien</th><th colspan="2">Umur</th><th rowspan="2">Tgl Masuk</th><th rowspan="2">Lama Di Rawat</th><th rowspan="2">Ruang</th><th rowspan="2">Kelas</th><th rowspan="2">Carabayar</th><th rowspan="2">Diagnosa Akhir</th><th rowspan="2">ICD-X</th><th rowspan="2">Tindakan</th><th rowspan="2">ICD-9 CM</th><th rowspan="2">Dokter</th><th rowspan="2">Asal Wilayah</th><th rowspan="2">Masuk Dari</th><th colspan="4">Keadaan Keluar</th><th rowspan="2">KET</th></tr>
        <tr><th>L</th><th>P</th><th>H</th><th>R</th><th>K</th><th>M</th></tr>
        <tr><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th><th>10</th><th>11</th><th>12</th><th>13</th><th>14</th><th>15</th><th>16</th><th>17</th><th>18</th><th>19</th><th>20</th><th>21</th><th>22</th></tr>
        <?php
		$t = 1;
		$sql3 	= mysql_query($sql3);
		while($data3 = mysql_fetch_array($sql3)){
			if($data3['jeniskelamin'] == 'P'){
				$l = $data3['umur'];
				$p = '';
			}else{
				$l = '';
				$p = $data3['umur'];
			}
			if( ($data3['statuspulang'] == 1) || ($data3['statuspulang'] == 2) ){
				$H = 'x';
				$R = '';
				$K = '';
				$M = '';
			}elseif($data3['statuspulang'] == 6){
				$H = '';
				$R = 'x';
				$K = '';
				$M = '';
			}elseif($data3['statuspulang'] == 7){
				$H = '';
				$R = '';
				$K = '';
				$M = 'x';
			}else{
				$H = '';
				$R = '';
				$K = 'x';
				$M = '';
			}
			echo '<tr><td>'.$t.'</td><td>'.$data3['nomr'].'</td><td>'.$data3['nama'].'</td><td>'.$l.'</td><td>'.$p.'</td><td>'.$data3['TGLMASUK'].'</td><td>'.$data3['lamadirawat'].' Hari</td><td>'.$data3['ruang'].'</td><td>'.$data3['kelas'].'</td><td>'.$data3['carabayar'].'</td><td>'.$data3['icd_keluar'].'</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>'.$data3['dokter'].'</td><td>'.getKecamatanName($data3['KDKECAMATAN']).'</td><td>'.$data3['poly'].'</td><td>'.$H.'</td><td>'.$R.'</td><td>'.$K.'</td><td>'.$M.'</td><td></td></tr>';
			$t++;
		}
		?>
        
        </table>
       
          </div>
          
        </div>
    </div>
</div>
</div>
<p></p>
