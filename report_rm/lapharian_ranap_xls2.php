<div id="frame_title"><h3>LAPORAN HARIAN RAWAT INAP</h3></div>
<table width="95%" style="margin:10px;" border="1" cellspacing="0" cellspading="0" class="tb">
<tr align="center">
<th width="3%" rowspan="2">NO</th>
<th width="9%" rowspan="2">NOMOR RM</th>
<th width="13%" rowspan="2">NAMA PASIEN</th>
<th colspan="2">UMUR</th>
<th width="3%" rowspan="2">TGL MASUK</th>
<th width="4%" rowspan="2">TGL KELUAR</th>
<th width="8%" rowspan="2">LAMA DIRAWAT</th>
<th width="11%" colspan="4">ASAL PASIEN</th>
<th width="12%" rowspan="2">RUANG</th>
<th width="12%" rowspan="2">KELAS</th>
<th width="12%" rowspan="2">CARA BAYAR</th>
<th width="7%" rowspan="2">DIAGNOSA AKHIR</th>
<th width="9%" rowspan="2">ICD-X</th>
<th width="4%" rowspan="2">TINDAKAN</th>
<th width="2%" rowspan="2">ICD-9 CM</th>
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
<th width="0%">H</th>
<th width="0%">R</th>
<th width="0%">K</th>
<th width="0%">M</th>
</tr>
<tr>
<td>1</td>
<td>2</td>
<td>3</td>
<td>4</td>
<td>5</td>
<td>6</td>
<td>7</td>
<td>8</td>
<td>9</td>
<td>10</td>
<td>11</td>
<td>12</td>
<td>13</td>
<td>14</td>
<td>15</td>
<td>16</td>
<td>17</td>
<td>18</td>
<td>19</td>
<td>20</td>
<td>21</td>
<td>22</td>
<td>23</td>
<td>24</td>
<td>25</td>
<td>26</td>
<td>27</td>
</tr>
<?php
$search = "";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
} 
else $tgl_kunjungan=date('Y/m/d');
if(!empty($_GET['tgl_kunjungan2'])){
	$tgl_kunjungan2 =$_GET['tgl_kunjungan2']; 
} 
else $tgl_kunjungan2=date('Y/m/d');

if($tgl_kunjungan !=""){
	$search = " and ( e.tglmasuk between '".$tgl_kunjungan."' and   '".$tgl_kunjungan2."')";
}else{
	$search = " and ( e.tglmasuk  = curdate()  )";
}

$sql=mysql_query("select a.id_admission,a.nomr, b.nama,b.jeniskelamin,b.tgllahir, b.KDKECAMATAN, DATE_FORMAT(e.tglmasuk,'%d/%m/%Y') as tglmasuk, DATE_FORMAT(e.tglkeluar,'%d/%m/%Y') as tglkeluar,
datediff(e.tglkeluar,e.tglmasuk)+1 as lamadirawat, a.kirimdari,c.nama as ruang,c.kelas, d.nama as crbayar,diagnosapulang, icdkeluar,f.nama as poly,e.STATUSPULANG
from m_pasien b, m_ruang c, m_carabayar d,  m_poly f ,t_admission a 
left join t_resumepulang e on e.idadmission=a.id_admission  
where a.nomr=b.nomr and a.noruang=c.no and a.statusbayar=d.kode and 
 a.kirimdari=f.kode ".$search." order by e.tglmasuk");
	$i = 1;
	while($data = mysql_fetch_array($sql)) {?>
	<tr>
    	<td><?php echo $i; ?></td>
        <td><?=$data['nomr']; ?></td>
                <td><?=$data['nama']; ?></td>
                <td><?php 
				      $a = datediff($data['tglmasuk'], $data['tgllahir']);
					  if ($data['jeniskelamin']=='L'){echo $a['years'].' tahun '; }?></td>
                <td><?php 
				      $a = datediff($data['tglmasuk'], $data['tgllahir']);
					  if ($data['jeniskelamin']=='P'){echo $a['years'].' tahun '; }?></td>
                <td><?=$data['tglmasuk'];?></td>
                <td><?=$data['tglkeluar'];?></td>
                <td><?=$data['lamadirawat'];?></td>
                <td><?php if ($data['kirimdari']==1) echo "X";?></td>
                <td><?php if ($data['kirimdari']==2) echo "X";?></td>
                <td><?php if ($data['kirimdari']==3) echo "X";?></td>
                <td><?php if ($data['kirimdari']==4) echo "X";?></td>
                <td><?=$data['ruang'];?></td>
                <td><?=$data['kelas'];?></td>
                <td><?=$data['crbayar'];?></td>
                <td><?=$data['diagnosapulang'];?></td>
                <td><?=$data['icdkeluar'];?></td>
                <td></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?php echo getKecamatanName($data['KDKECAMATAN']);?></td>
                <td><?=$data['poly'];?></td>
                <td><?php if(($data['STATUSPULANG'] == 1) || ($data['STATUSPULANG'] == 2)) echo 'x'; ?></td>
                <td><?php if($data['STATUSPULANG'] == 6) echo 'x'; ?></td>
                <td><?php if($data['STATUSPULANG'] == 4) echo 'x'; ?></td>
                <td><?php if($data['STATUSPULANG'] == 7) echo 'x'; ?></td>
                <td>&nbsp;</td>
              </tr>
              <?	
			  $i++;
			  }
			?>
            </table>