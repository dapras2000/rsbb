<?php
include("../include/connect.php");
?>
<div id="cari_poly">
	<table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
    	<tr align="center">
            <th>NO</th>
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
		</tr>
            <?
			$kondisi='';
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
	$rs = mysql_query($sql);
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
							echo "Telah di Verifikasi";
						}else{
							echo "Data Pending";
						}
			  	}elseif($data['KTP']=="" || $data['KARTU']=="" || $data['RUJUKAN']==""){ 
					echo "Data Pending"; 
				}else{
					if($data['KTP']==1 && $data['KARTU']==1 && $data['RUJUKAN']==1){
						echo "Telah di Verifikasi";
					}
				}
			  }
			  ?>
</td>
			            
            </tr>
            <?	} 
	

?>
          </table>
          </div>