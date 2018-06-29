<? session_start();
include("../include/connect.php");
require_once("ps_pagevalid.php");
?>
<div align="center">
    <div id="frame" style="width:100%">
        <div id="frame_title"><h3>List Pendaftaran Pasien BPJS</h3></div>
	    <div align="right" style="margin:5px; margin-right:10px;"> 
<?
  echo $pmb -> begin_round("600px","FFF","CCC","CCC"); //  (width, fillcolor, edgecolor, shadowcolor)
?>
        <form name="cari" id="cari" method="get" action="<?php $_SERVER['PHP_SELF']; ?>">  
            <div align="right" style="margin:5px;">
            <table width="100%">
            <tr><td>NOMR</td>
            	<td><input type="text" name="nomr" value="<?php  echo $_REQUEST['nomr']; ?>" size="20" class="text" /></td>
                <td>NAMA</td>
                <td><input type="text" name="nama" size="20" class="text" value="<?php  echo $_REQUEST['nama']; ?>"/></td>
            </tr>
            <tr><td>TANGGAL</td>
            	<td><input type="text" name="TGLREG"  id="TGLREG" readonly="readonly"
						value="<?php  if($_REQUEST['TGLREG'] !=""): echo $_REQUEST['TGLREG']; else: echo date('Y/m/d'); endif;?>" 
						class="text"/><a href="javascript:showCal('Calendar2')"><img align="top" src="img/date.png" border="0" /></a></td>
                <td>Shift</td><td><select name="shift" id="shift" class="text" >
                                <option value="">-Pilih Shift-</option>
                                <option value="1" <?php if($_REQUEST['shift'] == 1): echo 'selected="selected"'; endif; ?>> Shift 1 </option>
                                <option value="2" <?php if($_REQUEST['shift'] == 2): echo 'selected="selected"'; endif; ?>> Shift 2 </option>
                                <option value="3" <?php if($_REQUEST['shift'] == 3): echo 'selected="selected"'; endif; ?>> Shift 3 </option>
                            </select></td>
			</tr>
            <tr><td>Poly</td>
            	<td><select name="poly" id="poly" class="text" >
                            <option value="">-PILIH POLY-</option>
                            <?php 
                            $s = mysql_query('select * from m_poly');
                            while($ds = mysql_fetch_array($s)){
								if($_REQUEST['poly'] == $ds['kode']): $sel = 'selected="selected"'; else: $sel = ''; endif;
                                echo '<option value="'.$ds['kode'].'" '.$sel.'>'.$ds['nama'].'</option>';
                            }
                            ?>
                        </select> </td>
				<td><input type="hidden" name="link" value="14_askes" /></td>
                <td><input type="submit" class="text" value="Cari" /></td>
			</tr>
            </table>
        
        </div>
                    
              </form>
<? 
  echo $pmb -> end_round();
?>    
		</div>
        <div id="cari_poly">
    		<table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
            <tr align="center">
            <th >NO </th>
              <th >NoRM</th>
              <th>Nama Pasien</th>
              <th>L/P</th>
              <th >Alamat</th>
              <th >Poly</th>
              <th >NamaDokter</th>
              <th >Rujukan</th>
              <th >B/L</th>
              <th >Shift</th>
              <!--
              <th >Status</th>
              <th>Proses</th>
              -->
            </tr>
            <?
			$kondisi= '';
			$tgls	= " AND a.TGLREG=CURDATE() ";
			$knomr	= '';
			$shift	= '';
			$poly	= '';
			if($_REQUEST['nama'] != ''){
				$nama = ' AND b.NAMA like "%'.$_REQUEST['nama'].'%"';
			}
			if($_GET['TGLREG']!=0){
				$tgls = " AND a.TGLREG ='".$_GET['TGLREG']."'"; 
			}
			if($_GET['nomr']!=0){
				$knomr = " AND a.NOMR=".$_GET['nomr'];
			}
			if($_REQUEST['shift'] != ''){
				$shift = " AND a.SHIFT = ".$_REQUEST['shift'];
			}
			if($_REQUEST['poly'] != ''){
				$poly = " AND a.KDPOLY = ".$_REQUEST['poly'];
			}

		$sql = "SELECT a.NOMR, b.NAMA, b.JENISKELAMIN, b.ALAMAT, c.nama AS POLY, d.NAMADOKTER, e.NAMA AS CARABAYAR, f.NAMA AS RUJUKAN, IF(a.PASIENBARU = '1','B','L') AS BL, a.KETRUJUK,
a.SHIFT, a.STATUS
FROM t_pendaftaran a
JOIN m_pasien b ON b.NOMR = a.NOMR
JOIN m_poly c ON c.kode = a.KDPOLY
JOIN m_dokter d ON d.KDDOKTER = a.KDDOKTER
JOIN m_carabayar e ON e.KODE = a.KDCARABAYAR
JOIN m_rujukan f ON f.KODE = a.KDRUJUK
WHERE a.KDCARABAYAR = 2 ".$nama.$tgls.$knomr.$shift.$poly." 
ORDER BY IDXDAFTAR DESC";
$NO=0;
	$pager = new PS_Pagevalid($connect, $sql, 15, 5, "nama=".$nama."&nomr=".$_GET['nomr']."&TGLREG=".$_GET['TGLREG'],"index.php?link=14_askes&");
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {	
		if($data['KETRUJUK'] != ''){
			$rjk = '( '.$data['KETRUJUK'].' )';
		}else{
			$rjk = '';
		}
	?>
            <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
              <td><? $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?></td>
              <td><? echo $data['NOMR'];?></td>
              <td><? echo $data['NAMA']; ?></td>
            <td><? echo $data['JENISKELAMIN']; ?></td>              
              <td><? echo $data['ALAMAT']; ?></td>
              <td><? echo $data['POLY']; ?></td>
              <td><? echo $data['NAMADOKTER']; ?></td>
              <td><? echo $data['RUJUKAN'].$rjk;?></td>
              <td><? echo $data['BL'];?></td>
              <td><? echo $data['SHIFT'];?></td>
              <!--<td align="center" ><? 
			  if($data['IDVERIFIKASI']==$data['IDXDAFTAR']){
				if($data['POLY']=="UGD"){
						if($data['KTP']==1 && $data['KARTU']==1){
							echo "<div style='color:#090;'><strong>Telah di Verifikasi</strong></div>";
						}else{
							echo "<div style='color:#F00;'><strong>Data Pending</strong></div>";
						}
			  	}elseif($data['KTP']=="" || $data['KARTU']=="" || $data['RUJUKAN']==""){ 
					echo "<div style='color:#F00;'><strong>Data Pending</strong></div>"; 
				}else{
					if($data['KTP']==1 && $data['KARTU']==1 && $data['RUJUKAN']==1){
						echo "<div style='color:#090;'><strong>Telah di Verifikasi</strong></div>";
					}
				}
			  }
			  ?>
</td>		
			  <td align="center">
<?php if ($data['MINTA_RUJUKAN']=='1'){?>
               <a href="?link=14rujukan&idx=<?=$data['IDXDAFTAR']?>&nomr=<?=$data['NOMR']?>&crbyr=<?=$data['CARABAYAR1']?>">
<input type="button" value=" Srt. Rujuk " class="text" />
</a>
<?php } else {?>
              <?php if ($data['POLY1']=='RUJUKAN'){ ?>
              <a href="?link=14rujukan&idx=<?=$data['IDXDAFTAR']?>&nomr=<?=$data['NOMR']?>&crbyr=<?=$data['CARABAYAR1']?>&poly=<?=$data['POLY1'];?>">
			  <?php }
			  else {?>		
               <a href="?link=14verifikasi&idx=<?=$data['IDXDAFTAR']?>&nomr=<?=$data['NOMR']?>&crbyr=<?=$data['CARABAYAR1']?>&poly=<?=$data['POLY1'];?>">		  
              <?php } ?>
                	<input type="button" value=" Verifikasi " class="text" />
              	</a>
<?php } ?>
              </td>       -->     
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
          </div>
    </div>
</div>
