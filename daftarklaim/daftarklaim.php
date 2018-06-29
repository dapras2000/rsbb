<?php 
include("../include/connect.php");
require_once('ps_pagination.php');
$myquery = "SELECT 
  m_login.NIP,
  m_login.DEPARTEMEN,
  m_login.KDUNIT
FROM
  m_login
WHERE  m_login.NIP='".$_SESSION['NIP']."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
		$nip=$userdata['NIP'];
		$kdpoly=$userdata['KDUNIT'];
		$bagian=$userdata['DEPARTEMEN'];

?>

<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title">
      <h3>KLAIM JAMKESMAS DAN SKTM RAWAT JALAN</h3></div>
    <div align="center" style="margin:5px;"> 
     
        <div id="table_search">
        <table width="95%" border="0" bordercolor="#FFFFFF" cellspacing="0" cellspading="0" class="tb">
          <tr align="center" valign="top">
            <th width="5%" rowspan="2">NOMR</th>
            <th width="5%" rowspan="2">TANGGAL</th>
            <th width="10%" rowspan="2">NAMA PASIEN</th>
            <th width="3%" rowspan="2">L/P</th>
            <th width="5%" rowspan="2">TEMPAT & TGLLAHIR</th>
            <th width="5%" rowspan="2">UMUR</th>
            <th width="14%" rowspan="2">ALAMAT</th>
            <th width="14%" rowspan="2">KECAMATAN</th>
            <th width="14%" rowspan="2">KOTA</th>
            <th width="11%" rowspan="2">CARA BAYAR</th>
            <th width="11%" rowspan="2">POLI</th>
            <th width="11%" rowspan="2">DOKTER</th>
            <th colspan="3">DIAGNOSA</th>
          </tr>
          <tr align="center">
            <th width="11%">DIAGNOSA</th>
            <th width="7%">KODE ICD</th>
            <th width="7%">DESKRIPSI ICD X</th>
          </tr>
          <?
	$sql = "select a.nomr, a.tanggal, b.nama, b.jeniskelamin, b.TEMPAT, b.TGLLAHIR, b.ALAMAT, 
	(select namakota from m_kota where idkota = b.KOTA) as KOTA, b.KDCARABAYAR, a.KDPOLY, a.KDDOKTER,
       (select namakecamatan from m_kecamatan where idkecamatan = b.kdkecamatan) as kdkecamatan,
       case b.jeniskelamin when 1 then 'Laki-Laki' when 2 then 'Perempuan'
	   end as jeniskelamin,
	   case a.KDPOLY when 1 then 'DALAM' when 2 then 'KB dan KD' when 3 then 'ANAK' when 4 then 'BEDAH' when 5 then 'GIGI'
	   		   when 6 then 'PSIKIATRI' when 7 then 'NEUROLOGI' when 8 then 'ANESTESI' when 9 then 'UGD' when 10 then 'VK'
			   when 11 then 'RUJUKAN' when 28 then 'THT' when 29 then 'MATA' when 30 then 'PARU'
	   end as KDPOLY,
	   a.diagnosa,a.terapi,
       (select nama from m_carabayar where kode = c.kdcarabayar) as kdcarabayar,
       case c.pasienbaru when 0 then 'L' else 'B' end as pasienbaru,
       d.keterangan as kdtujuanrujuk, 
       case  c.pasienbaru when 0 then 'L' else 'B' end as pasienbaru, case a.kunjungan_bl when 0 then 'L' else 'B' end as kunjungan_bl, a.kasus_bl, a.icd_code
from t_diagnosadanterapi a
inner join m_pasien b on a.nomr=b.nomr 
inner join t_pendaftaran c on a.idxdaftar=c.idxdaftar  
left join m_statuskeluar d on a.kdtujuanrujuk=d.status ";
//WHERE b.KDCARABAYAR='3' AND b.KDCARABAYAR='4';
	$pager = new PS_Pagination($connect, $sql, 15, 5, "param1=valu1&param2=value2");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {?>
          <tr valign="top" <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
            <td><strong><? echo $data['nomr'];?></strong></td>
            <td><? echo $data['tanggal'];?></td>
            <td><? echo $data['nama'];?> </td>
            <td><? echo $data['jeniskelamin']; ?> </td>
            <td><? echo $data['TEMPAT'].", ".$data['TGLLAHIR']; ?></td>
 <?php 
		  if ($data['tanggal']==""){
			  $a = datediff(date("Y/m/d"), date("Y/m/d"));
		  }
		  else {
		       $a = datediff($data['tanggal'], $data['TGLLAHIR']);
		  }            
   ?>         
            <td><?php echo 'umur '.$a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td><? echo $data['kdkecamatan']; ?> </td>
            <td><? echo $data['kota']; ?> </td>
            <td><? echo $data['kdcarabayar'];?></td>
            <td><? echo $data['KDPOLY']; ?></td>
            <td><? echo $data['KDDOKTER']; ?></td>
            <td><? echo $data['diagnosa'];?> </td>
            <td><? echo $data['icd_code'];?></td>
            <td><? echo $data['jenis_penyakit'];?></td>            
          </tr>
	 <?	} 
	
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
  
</table>

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