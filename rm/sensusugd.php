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
      <h3>SENSUS HARIAN UGD</h3></div>
    <div align="right" style="margin:5px;"> 
     
        <div id="table_search">
        <table width="100%" border="0" cellspacing="0" cellspading="0" class="tb">
          <tr align="center">
            <th width="5%">NOMR</th>
            <th width="10%">NAMA</th>
            <th width="3%">L/P</th>
            <th width="5%">UMUR</th>
            <th width="14%">JENIS PELAYANAN</th>
            <th width="14%">KECAMATAN</th>
            <th width="14%">KOTA</th>
            <th width="11%">DIAGNOSA</th>
            <th width="14%">TINDAKAN </th>
            <th width="6%">CARA BAYAR</th>
            <th width="5%">KE<BR />LUAR</th>
            <th width="7%">PENGUN<BR />JUNG</th>
            <th width="7%">KUN<BR />JUNGAN</th>            
            <th width="6%">KASUS</th>
            <th width="7%">ICD X</th>
          </tr>
          <?
	$sql = "select a.nomr,b.nama,b.TGLLAHIR, b.jeniskelamin,a.tanggal, b.kota,
       (select namakecamatan from m_kecamatan where idkecamatan = b.kdkecamatan) as kdkecamatan,
       a.diagnosa,a.terapi,
       case c.kdcarabayar when 1 then 'UMUM' when 2 then 'BPJS' when 5 then 'LAINNYA' else '-'
       end as kdcarabayar,
       case c.pasienbaru when 0 then 'L' else 'B' end as pasienbaru,
       d.keterangan as kdtujuanrujuk, 
       case  c.pasienbaru when 0 then 'L' else 'B' end as pasienbaru, case a.kunjungan_bl when 0 then 'L' else 'B' end as kunjungan_bl, a.kasus_bl, a.icd_code 
from t_diagnosadanterapi a
inner join m_pasien b on a.nomr=b.nomr 
inner join t_pendaftaran c on a.idxdaftar=c.idxdaftar  
left join m_statuskeluar d on a.kdtujuanrujuk=d.status";
	$pager = new PS_Pagination($connect, $sql, 15, 5, "param1=valu1&param2=value2");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
            <td><strong><? echo $data['nomr'];?></strong></td>
            <td align="center"><? echo $data['nama'];?> </td>
            <td align="center"><? echo $data['jeniskelamin']; ?> </td>
 <?php 
		  if ($data['tanggal']==""){
			  $a = datediff(date("Y/m/d"), date("Y/m/d"));
		  }
		  else {
		       $a = datediff($data['tanggal'], $data['TGLLAHIR']);
		  }            
   ?>         
            <td align="center"><?php echo $a[years].' tahun' ; ?></td>
            <td align="center">&nbsp;</td>
            <td align="center"><? echo $data['kdkecamatan']; ?> </td>
            <td align="center"><? echo $data['kota']; ?> </td>
            <td align="center"><? echo $data['diagnosa'];?> </td>
            <td align="center"><? echo $data['terapi'];?> </td>
            <td align="center"><? echo $data['kdcarabayar'];?> </td>
            <td width="7%" align="center"><? echo $data['kdtujuanrujuk'];?> </td>
            <td width="7%" align="center"><? echo $data['pasienbaru'];?> </td>
            <td width="6%" align="center"><? echo $data['kunjungan_bl'];?> </td>
            <td width="7%" align="center"><? echo $data['kasus_bl'];?> </td>
            <td align="center"><? echo $data['icd_code'];?> </td>            
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