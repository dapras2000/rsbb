<? session_start();
include("../include/connect.php");
require_once("ps_pagevalid.php");
?>
<div align="center">
    <div id="frame" style="width:100%">
        <div id="frame_title"><h3>List Pendaftaran Pasien Jamkesmas</h3></div>
	    <div align="right" style="margin:5px; margin-right:10px;"> 
<?
  echo $pmb -> begin_round("600px","FFF","CCC","CCC"); //  (width, fillcolor, edgecolor, shadowcolor)
?>
        <form name="cari" id="cari" method="get" action="<?php $_SERVER['PHP_SELF']; ?>">  
            <div align="right" style="margin:5px;">
             	NOMR	<input type="text" name="nomr" size="20" value="<?php echo $_REQUEST['nomr'];?>" class="text" />
                Nama 	<input type="text" name="nama" size="20" class="text"  value="<?php echo $_REQUEST['nama'];?>" /><br /><br />
            	Tanggal <input type="text" name="TGLREG" value="<?php if($_REQUEST['TGLREG'] != ''): echo $_REQUEST['TGLREG']; else: echo date('Y/m/d'); endif;?>"  id="TGLREG" readonly="readonly" class="text"/><a href="javascript:showCal('Calendar2')"><img align="top" src="img/date.png" border="0" /></a>
                &nbsp;&nbsp;
                s/d Tanggal <input type="text" name="TGLREG2" value="<?php if($_REQUEST['TGLREG2'] != ''): echo $_REQUEST['TGLREG2']; else: echo date('Y/m/d'); endif;?>"  id="TGLREG2" class="text"/><a href="javascript:showCal('Calendar15')"><img align="top" src="img/date.png" border="0" /></a>
                &nbsp;&nbsp;
                Shift	<select name="shift" id="shift" class="text" >
                            <option value="">-Pilih Shift-</option>
                            <option value="1" <?php if($_REQUEST['shift'] == 1): echo 'selected="selected"'; endif; ?>> Shift 1 </option>
                            <option value="2" <?php if($_REQUEST['shift'] == 2): echo 'selected="selected"'; endif; ?>> Shift 2 </option>
                            <option value="3" <?php if($_REQUEST['shift'] == 3): echo 'selected="selected"'; endif; ?>> Shift 3 </option>
                        </select><br /><br />
                List Berdasarkan <select name="carabayar" id="carabayar" class="text" >
                       				<option value="">-PILIH CARABAYAR-</option>
                       				<?php 
					   				$s = mysql_query('select * from m_carabayar where JMKS = "1"');
								    while($ds = mysql_fetch_array($s)){
										if($_REQUEST['carabayar'] == $ds['KODE']): $sel = 'selected="selected"'; else: $sel = ''; endif;
										echo '<option value="'.$ds['KODE'].'" '.$sel.'>'.$ds['NAMA'].'</option>';
								    }
					   				?>
               					</select> 
               	
                Poly	<select name="poly" id="poly" class="text" >
                            <option value="">-PILIH POLY-</option>
                            <?php 
                            $s = mysql_query('select * from m_poly');
                            while($ds = mysql_fetch_array($s)){
								if($_REQUEST['poly'] == $ds['kode']): $sel = 'selected="selected"'; else: $sel = ''; endif;
                                echo '<option value="'.$ds['kode'].'">'.$ds['nama'].'</option>';
                            }
                            ?>
                        </select> 
                 
              <input type="hidden" name="link" value="14_" />
        <input type="submit" class="text" value="Cari" />
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
              <th >CaraBayar</th>
              <th >Rujukan</th>
              <th >B/L</th>
              <th >Shift</th>
              <th >Status</th>
              <th>Proses</th>
            </tr>
            <?
			$kondisi='';
			#$tgls=" AND a.TGLREG=CURDATE() ";
			$knomr='';
			
			if($_REQUEST['poly'] != ''){
				$poly = ' AND a.KDPOLY = "'.$_REQUEST['poly'].'"';
			}
			if($_REQUEST['shift'] != ''){
				$shift = ' AND a.SHIFT = "'.$_REQUEST['shift'].'"';
			}
			
			if($_REQUEST['nama'] != ''){
				$nama = ' AND b.NAMA like "%'.$_REQUEST['nama'].'%"';
			}
			$tgls	= date('Y/m/d');
			$tgle	= date('Y/m/d');
			if($_GET['TGLREG']!= ''){
				$tgls = $_GET['TGLREG']; 
			}
			if($_GET['TGLREG2']!= ''){
				$tgle = $_GET['TGLREG2']; 
			}
			$tgl	= ' AND ( a.TGLREG BETWEEN "'.$tgls.'" AND "'.$tgle.'" )';
			
			if($_GET['carabayar']!=0){
				$kcarabayar = " AND a.KDCARABAYAR=".$_GET['carabayar'];
			}else{
				$kcarabayar = " AND a.KDCARABAYAR != 1";
			}
			if($_GET['nomr']!=0){
				$knomr = " AND a.NOMR=".$_GET['nomr'];
			}
			
		$sql = 'SELECT a.NOMR,b.NAMA,b.JENISKELAMIN,b.ALAMAT, c.nama AS POLY1, d.NAMA AS CARABAYAR1, e.NAMA AS RUJUKAN1, a.TGLREG, a.SHIFT, f.NAMADOKTER,
a.IDXDAFTAR, g.IDXDAFTAR AS IDVERIFIKASI, g.KTP, g.KARTU, g.RUJUKAN,a.MINTA_RUJUKAN, a.KETRUJUK,
CASE a.PASIENBARU WHEN 1 THEN "B" ELSE "L" END AS B_L
FROM t_pendaftaran a
JOIN m_pasien b ON a.NOMR = b.NOMR
JOIN m_poly c ON a.KDPOLY = c.kode
JOIN m_carabayar d ON a.KDCARABAYAR = d.KODE
JOIN m_rujukan e ON a.KDRUJUK = e.KODE
LEFT JOIN m_dokter f ON a.KDDOKTER = f.KDDOKTER 
LEFT JOIN t_data_verifikasi g ON g.IDXDAFTAR = a.IDXDAFTAR
WHERE a.KDCARABAYAR NOT IN (1,2) '.$kcarabayar.$tgl.$nama.$shift.$poly.$knomr.'
ORDER BY a.IDXDAFTAR desc';
$NO=0;
	$pager = new PS_Pagevalid($connect, $sql, 15, 5, "carabayar=".$_GET['carabayar']."&nomr=".$_GET['nomr']."&TGLREG=".$_GET['TGLREG']."&TGLREG2=".$_REQUEST['TGLREG2'],"index.php?link=14_&");
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
              <td><? echo $data['POLY1']; ?></td>
              <td><? echo $data['NAMADOKTER']; ?></td>
              <td><? echo $data['CARABAYAR1'];?></td>
              <td><? echo $data['RUJUKAN1'].$rjk;?></td>
              <td><? echo $data['B_L'];?></td>
              <td><? echo $data['SHIFT'];?></td>
              <td align="center" ><? 
			  if($data['IDVERIFIKASI']==$data['IDXDAFTAR']){
				if($data['POLY1']=="UGD"){
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
<?php } else {
				if ($data['POLY1']=='RUJUKAN'){
					echo '<a href="?link=14rujukan&idx='.$data['IDXDAFTAR'].'&nomr='.$data['NOMR'].'&crbyr='.$data['CARABAYAR1'].'&poly='.$data['POLY1'].'">
                <input type="button" value=" Verifikasi " class="text" />
              	</a>';
				} else {
					if($data['KTP']==1 && $data['KARTU']==1){
						echo '<a href="?link=14verifikasi&idx='.$data['IDXDAFTAR'].'&nomr='.$data['NOMR'].'&crbyr='.$data['CARABAYAR1'].'&poly='.$data['POLY1'].'"><input type="button" value=" Edit " class="text" /></a>';
					}else{
						echo '<a href="?link=14verifikasi&idx='.$data['IDXDAFTAR'].'&nomr='.$data['NOMR'].'&crbyr='.$data['CARABAYAR1'].'&poly='.$data['POLY1'].'"><input type="button" value=" Verifikasi " class="text" /></a>';
					}
               		
              	}
			} ?>
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
          </div>
    </div>
</div>
<form action="daftarklaim/rekasuransi_listpendaftaran_xls.php" method="get">
<input type="hidden" name="nomr" id="nomr" value="<?=$_REQUEST['nomr']?>" />
<input type="hidden" name="nama" id="nama" value="<?=$_REQUEST['nama']?>" />
<input type="hidden" name="TGLREG" id="nama" value="<?=$_REQUEST['TGLREG']?>" />
<input type="hidden" name="TGLREG2" id="nama" value="<?=$_REQUEST['TGLREG2']?>" />
<input type="hidden" name="shift" id="shift" value="<?=$_REQUEST['shift']?>" />
<input type="hidden" name="carabayar" id="carabayar" value="<?=$_REQUEST['carabayar']?>" />
<input type="hidden" name="poly" id="poly" value="<?=$_REQUEST['poly']?>" />
<input type="submit" value="export xls" />
</form>