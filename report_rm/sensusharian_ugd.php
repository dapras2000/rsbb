<?php 
session_start();
include '../include/connect.php';
include '../include/function.php';
include("ps_pagination_x.php");

$search = "";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
} 

if($tgl_kunjungan !=""){
	$search = " and a.tanggal = '".$tgl_kunjungan."'";
}else{
	$search = " and a.tanggal = curdate() ";
}

$sql = "SELECT a.nomr,b.nama,b.jeniskelamin,a.tanggal,
YEAR(a.TANGGAL)-YEAR(b.tgllahir) AS umur,
a.kunjungan_bl,a.diagnosa,a.terapi,b.kdkecamatan,d.nama
AS carabayar,e.status,a.icd_code,icdcm,a.JENIS,a.KLB,a.KASUS_BL
FROM t_pendaftaran e
LEFT JOIN t_diagnosadanterapi a ON a.idxdaftar=e.idxdaftar
INNER JOIN m_pasien b ON a.nomr=b.nomr
INNER JOIN m_carabayar d ON d.kode=e.kdcarabayar
WHERE e.kdpoly=9 ".$search;


$sqlcounter = "select count(a.nomr)
from t_pendaftaran e
left join t_diagnosadanterapi a on a.idxdaftar=e.idxdaftar
inner join m_pasien b on a.nomr=b.nomr
left join t_hasilugd c on a.idxdaftar=c.idxdaftar
inner join m_carabayar d on d.kode=e.kdcarabayar
where e.kdpoly=9 ".$search;


?>
<div align="center">
    <div id="frame" style="width:95%">
    <div id="frame_title">
      <h3>SENSUS HARIAN UGD</h3></div>
    <div align="right" style="margin:5px;">
    <form name="formsearch" method="get" >
     <table width="248" border="0" cellspacing="0" class="tb">
  <tr>
    <td>Tanggal</td>
    <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($_REQUEST['tgl_kunjungan'] !=""): echo $_REQUEST['tgl_kunjungan']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
    <input type="hidden" name="link" value="1316" /></td>
  </tr>
</table>

    </form> 
    <form action="report_rm/sensusharian_ugd_xls.php" method="get">
				 <input type="hidden" name="tgl_kunjungan" id="tgl_kunjungan" value=<?=$tgl_kunjungan?> />
                    <input type="submit" value="export xls" class="text"  />
                </form>
        <div id="table_search">
        <div style="overflow:scroll;width:98%;height:auto;" >  
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
              <th width="3%" rowspan="2">PENYAKIT DALAM</th>
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
			
            <?

    $pager = new PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "tgl_kunjungan=".$tgl_kunjungan,"index.php?link=1316&");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	$i = 1;
	while($data = mysql_fetch_array($rs)) {?>
            <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
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
		<td><? if ($data['status']==3){echo 'X';} ?></td>
		<td><? if ($data['status']==8){echo 'X';} ?></td>
              <td><? echo $data['icd_code']; ?></td>
              <td><? echo $data['icdcm']; ?></td>
			   </tr>
            <?	$i++; } 
	
	
?>
          </table>
          </div>
          <?php
	
	//Display the full navigation in one go
	//echo $pager->renderFullNav();
	
	//Or you can display the inidividual links
	echo "<div style='padding:5px;' align=\"center\"><br />";
	
	//Display the link to first page: First
	echo $pager->renderFirst()." | ";
	
	//Display the link to previous page: <<
	echo $pager->renderPrev()." | ";
	
	//Display page links: 1 2 3
	echo $pager->renderNav()." | ";
	
	//Display the link to next page: >>
	echo $pager->renderNext()." | ";
	
	//Display the link to last page: Last
	echo $pager->renderLast();
	
	echo "</div>";
			?>
        </div>
    </div>
</div>
</div>
<p></p>
