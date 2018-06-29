<?php 
include("include/connect.php");
require_once('ps_pagebill.php');


?>

<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>TAGIHAN RAWAT JALAN NO RM <?php echo $_REQUEST['nomr'] ?></h3></div>
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

	$nomrsing	= substr($_REQUEST['nomr'],0,4);
	
	$sql	= 'select DISTINCT r.NOMR,r.IDXDAFTAR, x.NAMA, r.KDPOLY, m_poly.nama as POLY1, m_carabayar.NAMA as CARABAYAR1 
	from t_pendaftaran r 
	join m_pasien x ON r.NOMR = x.NOMR 
	join t_bayarrajal b ON b.idxdaftar = r.idxdaftar
	join m_poly ON m_poly.kode = r.KDPOLY 
	join m_carabayar ON m_carabayar.KODE = r.KDCARABAYAR 
	where r.STATUS != 2 AND 1 = 1  
	and r.NOMR = '.$_REQUEST['nomr'].' and r.KDPOLY =  '.$_REQUEST['poli'].' and r.idxdaftar =  '.$_REQUEST['idxdaftar'].'
	UNION ALL
	select DISTINCT r.NOMR,r.IDXDAFTAR, x.NAMA, r.KDPOLY, m_poly.nama as POLY1, m_carabayar.NAMA as CARABAYAR1 
	from t_pendaftaran r 
	join m_pasien x ON r.NOMR = x.NOMR 
	join t_bayarrajal b ON b.idxdaftar = r.idxdaftar
	join m_poly ON m_poly.kode = r.KDPOLY 
	join m_carabayar ON m_carabayar.KODE = r.KDCARABAYAR 
	where r.STATUS != 2 AND 1 = 1  
	and x.PARENT_NOMR = '.$_REQUEST['nomr'].' and r.KDPOLY =  '.$_REQUEST['poli'].' 
	
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
              
              <td>
              	<a href="index.php?link=34&nomr=<?php echo $data['NOMR']; ?>&poly=<?php echo $data['KDPOLY'];?>&idxdaftar=<?php echo $data['IDXDAFTAR'];?>"> <input type="button" class="text" value="Prosess" /></a> 
              </td>
            </tr>
            <?	} 
	
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
