<?php 
include("include/connect.php");
require_once('ps_pagebill.php');

$kondisi='';
if ($_GET['poly']!=0){
	$kpoly=' and a.KDPOLY = '.$_GET['poly'];
}
if($_GET['crbayar'] !=''){
	$kbyr=' and a.CARABAYAR = '.$_GET['crbayar'];
}
if ($_GET['cnama']!=""){
	$knama=" and c.NAMA like '%".$_GET['cnama']."%'";
}
if ($_GET['cnomr']!=""){
	$knomr=" and a.NOMR = '".$_GET['cnomr']."'";
}
$start	= 'CURDATE()';
$end	= 'CURDATE()';
if ($_GET['start']!=""){
	$start 	= "'".$_REQUEST['start']."'";
}
if ($_GET['end']!=""){
	$end 	= "'".$_REQUEST['end']."'";
}
$waktu	= ' and (a.tanggal between '.$start.' and '.$end.')';

?>

<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>TAGIHAN FARMASI RAWAT JALAN/ HARI INI</h3></div>
      <form name="cari" id="cari" method="get" action="<?php $_SERVER['PHP_SELF']; ?>">
        cari nama  <input type="text" name="cnama" class="text" <?php echo $_REQUEST['cnama']; ?>/>
        / No MR 
        <input type="text" name="cnomr" size="10" class="text" <?php echo $_REQUEST['cnomr']; ?>/> 
        Berdasarkan
        <select name="poly" id="poly" class="text" >
        <option value="0">-Pilih Poly-</option>
             <? 
			 	$qrypoly = mysql_query("SELECT * FROM m_poly ORDER BY kode ASC")or die (mysql_error());
				while ($listpoly = mysql_fetch_array($qrypoly)){
			 	?>
                <option value="<? echo $listpoly['kode'];?>" <?php if($listpoly['kode'] == $_REQUEST['poly']): echo 'selected="selected"'; endif; ?> ><? echo $listpoly['nama'];?></option>
			 	<? 
			 	} 
			 ?>
        </select>
       <select name="crbayar" id="crbayar" class="text" >
             <option value="" <?php if($_GET['crbayar'] == ''): echo 'selected="selected"'; endif; ?>>-Pilih Cara Bayar-</option>
             <option value="1" <?php if(($_GET['crbayar'] == 1) or (isset($_GET['crbayar'])==0)): echo 'selected="selected"'; endif; ?>>UMUM</option>
             <option value="2" <?php if($_GET['crbayar'] == 2): echo 'selected="selected"'; endif; ?>>BPJS</option>
<!--             <option value="3" <?php if($_GET['crbayar'] == 3): echo 'selected="selected"'; endif; ?>>JAMKESMAS</option>
             <option value="4" <?php if($_GET['crbayar'] == 4): echo 'selected="selected"'; endif; ?>>SKTM</option>-->
        </select>
      <input type="hidden" name="link" value="33depo_rajal" />
      <input type="text" size="10" class="text" id="TGLREG" name="start" value="<?php if($_REQUEST['start'] != ''): echo $_REQUEST['start']; else: echo date('Y/m/d'); endif;?>" /><a href="javascript:showCal('Calendar2')"><img align="top" src="img/date.png" border="0" /></a> - 
      <input type="text" size="10" class="text" id="TGLREG2" name="end" value="<?php if($_REQUEST['end'] != ''): echo $_REQUEST['end']; else: echo date('Y/m/d'); endif;?>" /><a href="javascript:showCal('Calendar15')"><img align="top" src="img/date.png" border="0" /></a>
<input type="submit" class="text" value="Cari" />

    </form>     
        <div id="cari_poly">
          <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" title="Tagihan Data Pasien Per Hari Ini">
            <tr align="center">
            <th width="20px">NO</th>
              <th width="100px">NO RM</th>
              <th style="text-align:left;">Nama Pasien</th>
              <th width="100px">Poly</th>
              <th width="100px">Cara Bayar</th>
              <th width="70px">Status</th>
              <!--<th width="100px">Billing</th>-->
              <th width="100px">Aksi</th>
            </tr>
            <?

$kondisi=$knama.$knomr.$kpoly.$kbyr.$waktu;
			
	$sql="SELECT a.NOMR, TRIM(c.NAMA) AS NAMA, d.nama AS POLY, e.NAMA AS CARABAYAR, b.STATUS, a.NOBILL,a.IDXDAFTAR
FROM t_billrajal a
JOIN t_bayarrajal b ON a.NOBILL = b.NOBILL
JOIN m_pasien c ON a.NOMR = c.NOMR
JOIN m_poly d ON d.kode = a.KDPOLY
JOIN m_carabayar e ON a.CARABAYAR = e.KODE
WHERE a.KODETARIF LIKE '07%'".$kondisi." GROUP BY a.IDXDAFTAR";
	#$sql	= 'select t_pendaftaran.NOMR,t_pendaftaran.IDXDAFTAR, m_pasien.NAMA, t_pendaftaran.KDPOLY, m_poly.nama as nama_poly, m_carabayar.NAMA as carabayar from t_pendaftaran join m_pasien ON t_pendaftaran.NOMR = m_pasien.NOMR join m_poly ON m_poly.kode = t_pendaftaran.KDPOLY join m_carabayar ON m_carabayar.KODE = t_pendaftaran.KDCARABAYAR where t_pendaftaran.TGLREG = curdate()'.$kondisi;
	$NO=0;
	$pager = new PS_Pagebill($connect, $sql, 15, 5, "start=".$_GET['start']."&end=".$_GET['end']."&poly=".$_GET['poly']."&cnama=".$_GET['cnama']."&cnomr=".$_GET['cnomr']."&crbayar=".$_GET['crbayar'],"index.php?link=33depo_rajal&");
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
              <td align="center"><? echo $data['POLY']; ?></td>
              <td align="center"><? echo $data['CARABAYAR'];?></td>
              <td align="center"><? echo $status_billing;?></td>
              
              <!--<td align="right"><?php echo curformat($cex['total'],2);?></td>-->
              <td><a href="index.php?link=34depo_rajal&nomr=<?php echo $data['NOMR']; ?>&poly=<?php echo $data['KDPOLY'];?>&idxdaftar=<?php echo $data['IDXDAFTAR'];?>"> <input type="button" class="text" value="Prosess" /></a> <!--<a href="index.php?link=33batal&idxb=<? echo $data['NOBILL'];?>&idxdaftar=<? echo $data['IDXDAFTAR'];?>"><input type="button" class="text" value="Batal" /></a>--></td>
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
