<?php 
include("include/connect.php");
require_once('ps_pagebill.php');

?>

<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>DAFTAR PASIEN APS / HARI INI</h3></div>
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
		<input type="hidden" name="link" value="adminrajal_aps" />
		<input type="submit" class="text" value="Cari" />
    </form>     
        <div id="cari_poly">
        <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" title="Tagihan Data Pasien Per Hari Ini">
            <tr align="center">
                <th width="20px">NO </th>
                <th width="100px">NO RM</th>
                <th style="text-align:left;">Nama Pasien</th>
                <!--<th width="100px">Poly</th>-->
                <th width="100px">Cara Bayar</th>
                <!--<th width="100px">Billing</th>-->
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
$kondisi=$knama.$knomr.$kpoly.$kbyr;
			
	#$sql="SELECT A.NOMR,A.NAMA,B.NAMA AS POLY1,C.NAMA AS CARABAYAR1,r.TOTTARIFRS, E.IDXDAFTAR, r.NOBILL, SUM(r.TOTTARIFRS) as ttotals
	#      FROM t_bayarrajal r, m_pasien A, m_poly B, m_carabayar C, t_pendaftaran E   		  
    #      WHERE r.idxdaftar=E.idxdaftar AND A.NOMR=R.NOMR AND E.KDPOLY=B.KODE AND E.KDCARABAYAR=C.KODE 
    #            AND TGLBAYAR is null AND E.TGLREG=curdate()".$kondisi." GROUP BY A.NOMR ORDER BY IDXBAYAR DESC";
	$sql	= 'select t_pendaftaran_aps.NOMR, m_pasien_aps.NAMA, m_carabayar.NAMA as carabayar, t_pendaftaran_aps.IDXDAFTAR from t_pendaftaran_aps join m_pasien_aps ON t_pendaftaran_aps.NOMR = m_pasien_aps.NOMR join m_carabayar ON m_carabayar.KODE = t_pendaftaran_aps.KDCARABAYAR where t_pendaftaran_aps.TGLREG = "'.date('Y-m-d').'"'.$kondisi;
	$NO=0;
	$pager = new PS_Pagebill($connect, $sql, 15, 5, "poly=".$_GET['poly']."cnama=".$_GET['cnama']."cnomr=".$_GET['cnomr']."&crbayar=".$_GET['crbayar'],"index.php?link=adminrajal_aps&");
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {
				#$sql_c	= mysql_query('SELECT t_billrajal.NOMR,t_billrajal.NOBILL,TARIFRS,QTY,t_billrajal.KDPOLY, t_bayarrajal.TGLBAYAR, SUM(t_billrajal.TARIFRS * t_billrajal.QTY) AS total FROM t_billrajal JOIN t_bayarrajal ON t_bayarrajal.NOBILL = t_billrajal.NOBILL WHERE t_billrajal.NOMR = "'.$data['NOMR'].'" AND TGLBAYAR IS NULL and t_billrajal.KDPOLY = "'.$data['KDPOLY'].'"');
				#$cex	= mysql_fetch_array($sql_c);
				#print_r($cex);
                $count++;
                if ($count % 2){
                	echo '<tr class="tr1">'; 
				}else {
                	echo '<tr class="tr2">';
                }
        		?>
              <td align="center"><? $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?></td>
              <td align="center"><? echo $data['NOMR'];?></td>
              <td align="left"><? echo $data['NAMA']; ?></td>
              <!--<td align="center"><? echo $data['nama_poly']; ?></td>-->
              <td align="center"><? echo $data['carabayar'];?></td>
              <!--<td align="right"><?php echo curformat($cex['total'],2);?></td>-->
              <td><a href="index.php?link=cartbill_aps&nomr=<?php echo $data['NOMR']; ?>&idxdaftar=<?php echo $data['IDXDAFTAR'];?>"> <input type="button" class="text" value="Prosess" /></a> <!--<a href="index.php?link=33batal&idxb=<? echo $data['NOBILL'];?>&idxdaftar=<? echo $data['IDXDAFTAR'];?>"><input type="button" class="text" value="Batal" /></a>--></td>
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
