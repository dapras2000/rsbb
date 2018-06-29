<?php 
session_start();
include("../include/connect.php");
include("../include/function.php");
require_once('ps_pagination.php');


$bulan = "";
if(!empty($_GET['bulan'])){
	$bulan =$_GET['bulan']; 
} 

$tahun = "";
if(!empty($_GET['tahun'])){
	$tahun =$_GET['tahun']; 
} 

$search = "";
if(!empty($bulan) && !empty($tahun)){
  $search = "WHERE MONTH(TANGGAL) = ".$bulan." AND YEAR(TANGGAL) =".$tahun."";
}



$rs = mysql_query($sql);
?>
<div align="center">
    <div id="frame" style="width:100%">
<?php
 $m = date('m');
?>
<? switch ($bulan)
{
	case "1" :
	$bulan_name = "Januari";
	break;
	case "2" :
	$bulan_name = "Pebruari";
	break;
	case "3" :
	$bulan_name = "Maret";
	break;
	case "4" :
	$bulan_name = "April";
	break;
	case "5" :
	$bulan_name = "Mei";
	break;
	case "6" :
	$bulan_name = "Juni";
	break;
	case "7" :
	$bulan_name = "Juli";
	break;
	case "8" :
	$bulan_name = "Agustus";
	break;
	case "9" :
	$bulan_name = "September";
	break;
	case "10" :
	$bulan_name = "Oktober";
	break;
	case "11" :
	$bulan_name = "Nopember";
	break;
	case "12" :
	$bulan_name = "Desember";
	break;
}
?>    
    
    <div id="frame_title"><h3>REKAPITULASI RESEP BULAN <?=$bulan_name." ".$tahun?></h3></div>
    <div align="right" style="margin:5px;">
        <div id="table_search">
            <form name="filterlap" id="filterlap" method="get" >
<input type="hidden" name="link" value="114" />
<table class="tb" style="width:20%">
<tr>

   <td>Bulan</td>
   <td><select name="bulan" id="bulan" class="text">
   <option value="1" <? if($m == "1"){ echo "selected=selected"; } ?> >Januari</option>
   <option value="2" <? if($m == "2"){ echo "selected=selected"; } ?> >Pebruari</option>
   <option value="3" <? if($m == "3"){ echo "selected=selected"; } ?> >Maret</option>
   <option value="4" <? if($m == "4"){ echo "selected=selected"; } ?> >April</option>
   <option value="5" <? if($m == "5"){ echo "selected=selected"; } ?> >Mei</option>
   <option value="6" <? if($m == "6"){ echo "selected=selected"; } ?> >Juni</option>
   <option value="7" <? if($m == "7"){ echo "selected=selected"; } ?> >Juli</option>
   <option value="8" <? if($m == "8"){ echo "selected=selected"; } ?> >Agustus</option>
   <option value="9" <? if($m == "9"){ echo "selected=selected"; } ?> >September</option>
   <option value="10" <? if($m == "10"){ echo "selected=selected"; } ?> >Oktober</option>
   <option value="11" <? if($m == "11"){ echo "selected=selected"; } ?> >Nopember</option>
   <option value="12" <? if($m == "12"){ echo "selected=selected"; } ?> >Desember</option>
   </select></td>
 </tr>
  <tr>
 <?php
  $akhtahun = date('Y') - 20;
  $c = date('Y');
 ?>
   <td>Tahun</td>
   <td><select name="tahun" id="tahun" class="text" >
 <? while($akhtahun <= $c){ ?>
   <option value="<?=$akhtahun?>" <? if($akhtahun == $c){ echo "selected=selected"; } ?>><?=$akhtahun?></option>
 <? $akhtahun++; } ?>
   </select></td>
 </tr>
   <tr>
   <td><input type="submit" value="Open" class="text" /></td>
   <td></td>
 </tr>
</table>
</form>

 
  <table width="99%" border="0" cellspacing="1" cellpadding="1" class="tb">
  <tr>
    <th width="75"><div align="center">TANGGAL</div></th>
    <th><div align="center">NO URUT RESEP</div></th>
    <th><div align="center">NO RM</div></th>
    <th><div align="center">NAMA PASIEN</div></th>
    <th><div align="center">CARABAYAR</div></th>
    <th><div align="center">ASAL RESEP</div></th>
    <th><div align="center">NAMA DOKTER</div></th>
    <th><div align="center">NAMA OBAT</div></th>
    <th><div align="center">SEDIAAN</div></th>
    <th><div align="center">ATURAN PAKAI</div></th>
    <th><div align="center">JUMLAH</div></th>
    <th><div align="center">HARGA</div></th>
    <th><div align="center">TOTAL</div></th>
  </tr>
<?
	$sql="SELECT a.idxdaftar, a.kode_obat, a.tanggal, a.noresep, a.qty, a.harga, a.sediaan, a.aturan_pakai, g.NAMA AS CARABAYAR,
	CASE SUBSTR(a.kode_obat,1,3) WHEN '07.' THEN (SELECT b.nama_tindakan FROM m_tarif2012 b WHERE b.kode_tindakan = a.kode_obat)
	ELSE ( SELECT b.nama_obat FROM m_obat b WHERE b.kode_obat = a.kode_obat) END AS nama_obat_layanan,
	c.nomr, d.nama,e.NAMADOKTER, f.NAMA AS poly
	FROM t_billobat_rajal a
	JOIN t_pendaftaran c ON c.idxdaftar = a.idxdaftar
	JOIN m_pasien d ON d.nomr = c.nomr
	JOIN m_carabayar g ON c.KDCARABAYAR = g.KODE
	LEFT JOIN m_dokter e ON e.KDDOKTER = a.DOKTER
	JOIN m_poly f ON f.KODE = c.KDPOLY
	".$search."
	UNION
	(SELECT a.idxdaftar, a.kode_obat, a.tanggal, a.noresep, a.qty, a.harga, a.sediaan, a.aturan_pakai, g.NAMA AS CARABAYAR,
	CASE SUBSTR(a.kode_obat,1,3) WHEN '07.' THEN (SELECT b.nama_tindakan FROM m_tarif2012 b WHERE b.kode_tindakan = a.kode_obat)
	ELSE ( SELECT b.nama_obat FROM m_obat b WHERE b.kode_obat = a.kode_obat) END AS nama_obat_layanan,
	c.nomr, d.nama,e.NAMADOKTER, f.NAMA AS poly
	FROM t_billobat_ranap a
	JOIN t_admission c ON c.id_admission = a.idxdaftar
	JOIN m_pasien d ON d.nomr = c.nomr
	LEFT JOIN m_dokter e ON e.KDDOKTER = a.DOKTER
	JOIN m_ruang f ON f.no = c.noruang
	JOIN m_carabayar g on c.statusbayar = g.KODE
	".$search.")
	ORDER BY noresep";	
	$pager = new PS_Pagination($connect, $sql, 15, 5, "bulan=".$bulan."&tahun=".$tahun,"index.php?link=144&");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	$x= 1;
	while($data = mysql_fetch_array($rs)) {?>
          <tr class="tr1">
            
            
      <td><?=$data['tanggal']?></td>
    <td><?=$data['noresep']?></td>
    <td><?=$data['nomr']?></td>
    <td><?=$data['nama']?></td>
    <td><?=$data['CARABAYAR']?></td>
    <td><?=$data['poly']?></td>
    <td><?=$data['NAMADOKTER']?></td>
    <td><?php echo $data['nama_obat_layanan'];?></td>
    <td><?php echo $data['sediaan'];?></td>
    <td><?php echo $data['aturan_pakai'];?></td>
    <td align="center"><?php echo $data['qty'];?></td>
    <td align="right"><?php echo curformat($data['harga'],2);?></td>
    <td align="right"><?php echo curformat($data['harga'] * $data['qty'],2);?></td>
  </tr>
<? 
$sql_resep = "SELECT
  m_barang.nama_barang,
  m_barang.satuan,
  m_barang.harga,
  t_permintaan_apotek.ATURAN,
  t_permintaan_apotek.non_generik,
  t_permintaan_apotek.nama_generik,
  t_permintaan_apotek.jmlkeluar,
  t_permintaan_apotek.tglkeluar,
  t_permintaan_apotek.IDXRESEP
FROM
  t_permintaan_apotek
  LEFT JOIN m_barang ON (t_permintaan_apotek.kodebarang = m_barang.kode_barang)
WHERE t_permintaan_apotek.IDXRESEP = ".$data['IDXRESEP'];

$get_resep = mysql_query($sql_resep );
while($dat_resep = mysql_fetch_array($get_resep)) {
?>  
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
<?
  if($dat_resep['non_generik']=="1"){
      $nama_barang = $dat_resep['nama_generik'];
  }else{
      $nama_barang = $dat_resep['nama_barang'];
  }
?>
    
    <td><?=$nama_barang?></td>
    <td align="right"><?=$dat_resep['jmlkeluar']?></td>
    <td><?=$dat_resep['ATURAN']?></td>
    <td align="center"><?  if($dat_resep['non_generik']=="1") echo "v"; ?></td>
    <td>&nbsp;</td>
    <td align="right"><?=$dat_resep['harga']?></td>
<? $jml = $dat_resep['jmlkeluar'] * $dat_resep['harga']?>    
    <td align="right"><?=$jml?></td>
  </tr>
<? } ?>  

	 <?	$x++;} ?>
     </table>
  <?   
	
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
<br />
<div id="msg" >
<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$sql?>" />
<input type="hidden" name="header" value="REKAP RESEP <?="Bulan ".$bulan." Tahun".$tahun?>" />
<input type="hidden" name="filename" value="rekap_resep" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>
<p></p>



