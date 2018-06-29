<?php 
include("include/connect.php");
require_once('ps_pagebill.php');

?>
<script>
jQuery(document).ready(function(){
	jQuery('.print').click(function(){
		var nomr	= jQuery(this).attr('svn');
		var idxbayar	= jQuery(this).attr('rel');
		jQuery.get('<?php echo _BASE_; ?>print_pembayaran_ranap.php?nobill='+idxbayar+'&nomr='+nomr,function(data){
			jQuery('#tmp_print').empty().html(data);
			w=window.open();
			//w.document.write(jQuery('#show_print').html());
			w.document.write(jQuery('#tmp_print').html());
			w.print();
			w.close();
			//jQuery('#show_print').empty();
		});
	});
});
</script>

<style type="text/css" media="screen">
#tmp_print{display:none;}
</style>
<style type="text/css" media="print">
#tmp_print{display:block;}
</style>

<div id="tmp_print"></div>
<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>TAGIHAN RAWAT INAP NO RM <?php echo $_REQUEST[nomr];?></h3></div>
             <div id="cari_poly">



           <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="0" title="Tagihan Data Pasien Per Hari Ini">
            <tr align="center">
            <th width="20px">NO</th>
              <th width="100px">NO RM</th>
              <th style="text-align:left;">Nama Pasien</th>
              <th width="100px">Poly</th>
              <th width="100px">Cara Bayar</th>
              <th width="70px">Status</th>
              <th width="100px">Aksi</th>
            </tr>
            <?

	$kondisi=$knama.$knomr.$kpoly.$kbyr.$waktu;


	$sql	= 'select DISTINCT r.NOMR,r.IDXDAFTAR, m_pasien.NAMA, r.KDPOLY, m_poly.nama as POLY1, m_carabayar.NAMA as CARABAYAR1 
					from t_pendaftaran r 
					join m_pasien ON r.NOMR = m_pasien.NOMR 
					join t_bayarrajal b ON b.idxdaftar = r.idxdaftar
					join m_poly ON m_poly.kode = r.KDPOLY 
					join m_carabayar ON m_carabayar.KODE = r.KDCARABAYAR 
					where r.STATUS = 2 AND 1 = 1 '.$kondisi.' and r.IDXDAFTAR = '.$_REQUEST[idxb].'
			  UNION ALL
					select DISTINCT r.NOMR,r.IDXDAFTAR, x.NAMA, r.KDPOLY, m_poly.nama as POLY1, m_carabayar.NAMA as CARABAYAR1 
					from t_pendaftaran r 
					join m_pasien x ON r.NOMR = x.NOMR 
					join t_bayarrajal b ON b.idxdaftar = r.idxdaftar
					join m_poly ON m_poly.kode = r.KDPOLY 
					join m_carabayar ON m_carabayar.KODE = r.KDCARABAYAR 
					where r.STATUS != 2 AND 1 = 1  
					and x.PARENT_NOMR = '.$_REQUEST['nomr'].'
				'; 
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
				if($sqry['tagihan'] == 1){
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
              <td align="center"><a href="index.php?link=34&nomr=<?php echo $data['NOMR']; ?>&poly=<?php echo $data['KDPOLY'];?>&idxdaftar=<?php echo $data['IDXDAFTAR'];?>"> <input type="button" class="text" value="PROSES" /></a> <!--<a href="index.php?link=33batal&idxb=<? echo $data['NOBILL'];?>&idxdaftar=<? echo $data['IDXDAFTAR'];?>"><input type="button" class="text" value="Batal" /></a>--></td>
            </tr>
            <?	} 
	
?>
          </table>




          <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="Tagihan Data Pasien Per Hari Ini">
            <tr align="center">
            <th style="width:20px;">NO </th>
              <th style="width:60px;">NO RM</th>
              <th>Nama Pasien</th>
              <th style="width:100px;">Ruang</th>
              <th style="width:50px;">No Tempat Tidur</th>
              <th style="width:80px;">Tanggal Masuk</th>
              <th style="width:80px;">Tanggal Keluar</th>
              <th style="width:50px;">Cara Bayar</th>
              <th style="width:80px;">Tarif</th>
              <th style="width:100px;">Aksi</th>
            </tr>
            <?
$kondisi='';
$kbyr	= ' ';
if ($_GET['cruang']!=0){
	$kruang=' and c.noruang = '.$_GET['cruang'];
}
if ($_GET['crbayar']!=''){
	$kbyr=' and e.KODE = '.$_GET['crbayar'];
}
if ($_GET['cnama']!=""){
	$knama=" and b.NAMA like '%".$_GET['cnama']."%'";
}
if ($_GET['cnomr']!=0){
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

$kondisi=$knama.$knomr.$kruang.$kbyr;


$sql = "SELECT a.NOMR as NOMR, b.NAMA, d.nama AS RUANG, e.NAMA AS CARABAYAR1, SUM(a.TARIFRS * a.QTY) AS TOTTARIFRS,
c.id_admission,c.masukrs,c.keluarrs,c.noruang,c.nott,a.NOBILL, h.TGLBAYAR
FROM t_billranap a
JOIN t_bayarranap h on h.NOBILL = a.NOBILL
JOIN m_pasien b ON a.nomr = b.nomr 
JOIN t_admission c ON a.IDXDAFTAR = c.id_admission
JOIN m_ruang d ON c.noruang = d.no
JOIN m_carabayar e ON c.statusbayar = e.KODE
WHERE  c.keluarrs IS NULL and h.TOTTARIFRS != '0' 
".$kondisi."  and c.id_admission = ".$_REQUEST['idxb']."
GROUP BY a.NOBILL, a.NOMR,d.NAMA,b.NAMA,e.NAMA,c.id_admission 
";
//WHERE  a.KODETARIF NOT LIKE '07%' and c.keluarrs IS NULL and h.TOTTARIFRS != '0' 

$NO=0;

	$pager = new PS_Pagebill($connect, $sql, 15, 5, "&cruang=".$_GET['cruang']. "&cnama=".$_GET['nama']. "&cnomr=".$_GET['cnomr']."&crbayar=".$_GET['crbayar'],"index.php?link=33a");
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
              <td><? #print_r($data);
			  
			  $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?></td>
              <td><? echo $data['NOMR'];?></a></td>
              <td><? echo $data['NAMA']; ?></td>
            <td><? echo $data['RUANG']; ?></td>
            <td><? echo $data['nott']; ?></td>
            <td><? echo $data['masukrs']; ?></td>
            <td><? echo $data['keluarrs']; ?></td>
              <td><? echo $data['CARABAYAR1'];?></td>
              <td style="text-align:right;"><? echo curformat($data['TOTTARIFRS']);?></td>
              <td align="center">
              <?php if( ($data['TGLBAYAR'] == '0000-00-00') or ($data['TGLBAYAR'] == '') ): ?>
              <a href="index.php?link=34a&idxb=<? echo $data['id_admission'];?>&nobill=<?php echo $data['NOBILL'];?>&t=<? echo $data['TOTTARIFRS']; ?>"><input type="button" class="text" name="simpan" value="PROSES" /></a>
              <input type="button" class="text print" name="simpan" value="PRINT" svn="<?php echo $data['NOMR'];?>" rel="<? echo $data['NOBILL'];?>" />
              <?php else: ?>
              <input type="button" class="text print" name="simpan" value="PRINT" svn="<?php echo $data['NOMR'];?>" rel="<? echo $data['NOBILL'];?>" />
              <a href="index.php?link=34a&idxb=<? echo $data['id_admission'];?>&nobill=<?php echo $data['NOBILL'];?>&t=<? echo $data['TOTTARIFRS']; ?>"><input type="button" class="text" name="simpan" value="EDIT" /></a>
              <?php endif;?>

              </td>
            </tr>
            <?	} 

	
	//Display the full navigation in one go
	//echo $pager->renderFullNav();
	
	//Or you can display the inidividual links
	/*echo "<div style='padding:5px;' align=\"center\"><br />";
	
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
	
	echo "</div>";*/
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