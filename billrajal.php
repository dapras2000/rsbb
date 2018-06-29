<?php 
include("include/connect.php");
require_once('ps_pagebill.php');

$kondisi='';
if ($_GET['poly']!=0){
	$kpoly=' and r.KDPOLY = '.$_GET['poly'];
}
if($_GET['crbayar'] !=''){
	$kbyr=' and r.KDCARABAYAR = '.$_GET['crbayar'];
}
if ($_GET['cnama']!=""){
	$knama=" and x.NAMA like '%".$_GET['cnama']."%'";
}
if ($_GET['cnomr']!=""){
	$knomr=" and r.NOMR = '".$_GET['cnomr']."'";
}
$start	= 'CURDATE()';
$end	= 'CURDATE()';
if ($_GET['start']!=""){
	$start 	= "'".$_REQUEST['start']."'";
}
if ($_GET['end']!=""){
	$end 	= "'".$_REQUEST['end']."'";
}
$waktu	= ' and (r.TGLREG between '.$start.' and '.$end.')';

?>

<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>TAGIHAN RAWAT JALAN/ HARI INI</h3></div>
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
            <?php 
			$sql_jespel = mysql_query('select * from m_carabayar');
			while($djespel = mysql_fetch_array($sql_jespel)){
			echo '<option value="'.$djespel['KODE'].'">'.$djespel['NAMA'].'</option>';
		}
		?>
        </select>
      <input type="hidden" name="link" value="33" />
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
			
/*	$sql="SELECT DISTINCT A.NOMR,A.NAMA,p.NAMA AS POLY1,C.NAMA AS CARABAYAR1, r.IDXDAFTAR, r.KDPOLY  FROM t_billrajal r
JOIN m_pasien A ON r.nomr=A.nomr
JOIN t_bayarrajal b ON b.idxdaftar = r.idxdaftar
JOIN m_poly p ON r.KDPOLY=p.KODE
JOIN m_carabayar C ON r.CARABAYAR=C.KODE 
WHERE 1 = 1 ".$kondisi;*/
	$nomrsing	= substr('r.NOMR',0,4);
    $sql	= 'select DISTINCT r.NOMR,r.IDXDAFTAR, x.NAMA, r.KDPOLY, m_poly.nama as POLY1, m_carabayar.NAMA as CARABAYAR1 
	from t_pendaftaran r 
	join m_pasien x ON r.NOMR = x.NOMR 
	join t_bayarrajal b ON b.idxdaftar = r.idxdaftar
	join m_poly ON m_poly.kode = r.KDPOLY 
	join m_carabayar ON m_carabayar.KODE = r.KDCARABAYAR 
	where  1 = 1 '.$kondisi.'';
	//  and x.PARENT_NOMR is NUll
	$NO=0;
	$pager = new PS_Pagebill($connect, $sql, 15, 5, "start=".$_GET['start']."&end=".$_GET['end']."&poly=".$_GET['poly']."&cnama=".$_GET['cnama']."&cnomr=".$_GET['cnomr']."&crbayar=".$_GET['crbayar'],"index.php?link=33&");
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
              <td align="center"><? echo $data['POLY1']; ?></td>
              <td align="center"><? echo $data['CARABAYAR1'];?></td>
              <td align="center"><? echo $status_billing;?></td>
              
              <!--<td align="right"><?php echo curformat($cex['total'],2);?></td>-->
              <td align="center">
              	<a href="index.php?link=33detail&nomr=<?php echo $data['NOMR'];?>&poli=<?php echo $data['KDPOLY'];?>&idxdaftar=<?php echo $data['IDXDAFTAR'];?>"> <input type="button" class="text" value="DETAIL" /></a> 
              	<br><br><a href="index.php?link=33rekapbill&nomr=<?php echo $data['NOMR'];?>&poli=<?php echo $data['KDPOLY'];?>&idxdaftar=<?php echo $data['IDXDAFTAR'];?>"> <input type="button" class="text" value="REKAP BILL" /></a> 
            
              </td>
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
