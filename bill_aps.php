<?php 
include("include/connect.php");
require_once('ps_pagebill.php');

?>

<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>TAGIHAN PASIEN APS / HARI INI</h3></div>
      <form name="cari" id="cari" method="get">
        cari nama  <input type="text" name="cnama" class="text"/>
        / No MR 
        <input type="text" name="cnomr" size="10" class="text"/> 
        Berdasarkan
        <select name="poly" id="poly" class="text" >
        <option value="0">-Pilih Poly-</option>
             <?php 
			 	$qrypoly = mysql_query("SELECT * FROM m_poly ORDER BY kode ASC")or die (mysql_error());
				while ($listpoly = mysql_fetch_array($qrypoly)){
			 ?>
                <option value="<? echo $listpoly['kode'];?>"><? echo $listpoly['nama'];?></option>
			 <? } ?>
        </select>
       <select name="crbayar" id="crbayar" class="text" >
             <option value="0">-Pilih Cara Bayar-</option>
             <option value="1">UMUM</option>
             <option value="2">BPJS</option>
             <!--<option value="3">JAMKESMAS</option>
             <option value="4">SKTM</option>-->
        </select>
        <input type="text" size="10" class="text" id="TGLREG" name="start" value="<?php if($_REQUEST['start'] != ''): echo $_REQUEST['start']; else: echo date('Y/m/d'); endif;?>" /><a href="javascript:showCal('Calendar2')"><img align="top" src="img/date.png" border="0" /></a> - 
      <input type="text" size="10" class="text" id="TGLREG2" name="end" value="<?php if($_REQUEST['end'] != ''): echo $_REQUEST['end']; else: echo date('Y/m/d'); endif;?>" /><a href="javascript:showCal('Calendar15')"><img align="top" src="img/date.png" border="0" /></a>
		<input type="hidden" name="link" value="billaps" />
		<input type="submit" class="text" value="Cari" />
    </form>     
        <div id="cari_poly">
        <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" title="Tagihan Data Pasien Per Hari Ini">
            <tr align="center">
                <th width="20px">NOMOR </th>
                <th width="100px">NO RM</th>
                <th style="text-align:left;">Nama Pasien</th>
                <th width="100px">Nama Dokter</th>
                <th width="100px">Cara Bayar</th>
                <!--<th width="100px">Billing</th>-->
                <th width="100px">Status</th>
                <th width="100px">Aksi</th>
        </tr>
            <?
$kondisi='';
if ($_GET['poly']!=0){
	$kpoly=' and t_pendaftaran_aps.kdpoly = '.$_GET['poly'];
}
if ($_GET['crbayar']!=0){
	$kbyr=' and t_pendaftaran_aps.KDCARABAYAR = '.$_GET['crbayar'];
}
if ($_GET['cnama']!=""){
	$knama=" and m_pasien_aps.NAMA like '%".$_GET['cnama']."%'";
}
if ($_GET['cnomr']!=""){
	$knomr=" and m_pasien_aps.NOMR = '".$_GET['cnomr']."'";
}
$start	= 'CURDATE()';
$end	= 'CURDATE()';
if ($_GET['start']!=""){
	$start 	= "'".$_REQUEST['start']."'";
}
if ($_GET['end']!=""){
	$end 	= "'".$_REQUEST['end']."'";
}
$waktu	= ' and (t_pendaftaran_aps.TGLREG between '.$start.' and '.$end.')';
$kondisi=$knama.$knomr.$kpoly.$kbyr.$waktu;

	$sql	= 'SELECT t_pendaftaran_aps.NOMR, m_pasien_aps.NAMA, m_carabayar.NAMA AS carabayar, t_pendaftaran_aps.IDXDAFTAR,t_billrajal.NOBILL,
t_billrajal.KDDOKTER, m_dokter.NAMADOKTER, t_bayarrajal.STATUS,t_pendaftaran_aps.IDXDAFTAR
FROM t_pendaftaran_aps
JOIN m_pasien_aps ON t_pendaftaran_aps.NOMR = m_pasien_aps.NOMR
JOIN t_billrajal ON t_billrajal.IDXDAFTAR = t_pendaftaran_aps.IDXDAFTAR
LEFT JOIN m_dokter ON m_dokter.KDDOKTER = t_billrajal.KDDOKTER
JOIN t_bayarrajal ON t_bayarrajal.NOBILL = t_billrajal.NOBILL
JOIN m_carabayar ON m_carabayar.KODE = t_pendaftaran_aps.KDCARABAYAR 
WHERE t_pendaftaran_aps.NOMR is not null '.$kondisi.' group by t_billrajal.nobill';
	$NO=0;
	$pager = new PS_Pagebill($connect, $sql, 15, 5, "poly=".$_GET['poly']."cnama=".$_GET['cnama']."cnomr=".$_GET['cnomr']."&crbayar=".$_GET['crbayar'],"index.php?link=billaps&");
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {
                $count++;
                if ($count % 2){
                	echo '<tr class="tr1">'; 
				}else {
                	echo '<tr class="tr2">';
                }
				$ssql	= mysql_query('select COUNT(*) as tagihan from t_bayarrajal where NOMR = "'.$data['NOMR'].'" and IDXDAFTAR = "'.$data['IDXDAFTAR'].'" AND LUNAS = 0');
				$sqry 	= mysql_fetch_array($ssql);
				if($sqry['tagihan'] == 0){
					$status_billing = 'Lunas';
				}else{
					$status_billing = '';
				}
        		?>
              <td align="center"><? $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?></td>
              <td align="center"><? echo $data['NOMR'];?></td>
              <td align="left"><? echo $data['NAMA']; ?></td>
              <td align="left"><? echo $data['NAMADOKTER']; ?></td>
              <!--<td align="center"><? echo $data['nama_poly']; ?></td>-->
              <td align="center"><? echo $data['carabayar'];?></td>
              <!--<td align="right"><?php echo curformat($cex['total'],2);?></td>-->
              <td align="center"><? echo $status_billing;?></td>
              <td><a href="index.php?link=cartbill_aps&nomr=<?php echo $data['NOMR']; ?>&idxdaftar=<? echo $data['IDXDAFTAR'];?>"> <input type="button" class="text" value="Prosess" /></a> <!--<a href="index.php?link=33batal&idxb=<? echo $data['NOBILL'];?>&idxdaftar=<? echo $data['IDXDAFTAR'];?>"><input type="button" class="text" value="Batal" /></a>--></td>
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
