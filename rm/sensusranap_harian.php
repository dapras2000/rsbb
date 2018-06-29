<?php 
session_start();
include '../include/connect.php';
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan = $_GET['tgl_kunjungan']; 
}else{
	$tgl_kunjungan =DATE('Y/m/d');  
}
?>
<div align="center">
    <div id="frame" style="width:95%">
    <div id="frame_title">
      <h3>LAPORAN HARIAN</h3></div>
    <div align="center">
    
        <div id="table_search">
         <div style="overflow:scroll;width:100%;height:auto;" > 
         <!--<div> -->
	<form name="formsearch" method="get" >
            <table width="248" border="0" cellspacing="0" class="tb">
            <tr>
            	<td>Tanggal</td>
            	<td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" value="<? if($tgl_kunjungan!="curdate()"){ echo $tgl_kunjungan;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
            </tr>
            <tr>
            	<td>&nbsp;</td>
            	<td><input type="submit" value="Cari" class="text"/><input type="hidden" name="link" value="122harian" /></td>
            </tr>
            </table>

    </form>
    	<table width="45%" border="1" cellspacing="0" cellspading="0" class="tb" style="float:left; margin:10px;">
		<tr><th colspan="5"> PASIEN MASUK </th></tr>
		<tr><th>No</th><th>NOMR</th><th>Nama Pasien</th><th>Kelas</th><th>Ruang</th></tr>
        <?php
		$sql1 = mysql_query('SELECT DATE_FORMAT(a.masukrs,"%Y/%m/%d") AS tglmasuk, a.nomr, b.NAMA, c.kelas, c.nama as ruang
FROM t_admission a
JOIN m_pasien b ON a.nomr = b.NOMR
JOIN m_ruang c ON a.noruang = c.no
WHERE ( DATE(a.masukrs) BETWEEN "'.$tgl_kunjungan.'" AND "'.$tgl_kunjungan.'") and a.noruang != 15');
		$i = 1;
		while($data1 = mysql_fetch_array($sql1)){
			echo '<tr><td>'.$i.'</td><td>'.$data1['nomr'].'</td><td>'.$data1['NAMA'].'</td><td>'.$data1['kelas'].'</td><td>'.$data1['ruang'].'</td></tr>';
			$i++;
		}
		?>
        </table>
        
        <table width="45%" border="1" cellspacing="0" cellspading="0" class="tb" style="float:right; margin:10px;">
		<tr><th colspan="5"> Pasien Pindahan </th></tr>
		<tr><th>No</th><th>NOMR</th><th>Nama Pasien</th><th>Kelas</th><th>Ruang</th></tr>
		<?php
		$sql2 = mysql_query('SELECT DATE(a.masukrs)AS tglmasuk,a.tgl_pindah,a.nomr, b.NAMA, c.nama AS ruang_akhir, d.nama AS ruang_awal
FROM t_admission a
JOIN m_pasien b ON a.nomr = b.NOMR
LEFT JOIN m_ruang c ON a.noruang = c.no
LEFT JOIN m_ruang d ON a.noruang_asal = d.no
WHERE a.noruang <> a.noruang_asal AND ( DATE(a.tgl_pindah) BETWEEN "'.$tgl_kunjungan.'" AND "'.$tgl_kunjungan.'")');
		$x = 1;
		while($data2 = mysql_fetch_array($sql2)){
			echo '<tr><td>'.$x.'</td><td>'.$data2['nomr'].'</td><td>'.$data2['NAMA'].'</td><td>'.$data2['ruang_awal'].'</td><td>'.$data2['ruang_akhir'].'</td></tr>';
			$x++;
		}
		?>
        </table>
        <br clear="all" />
        
<p><form action="rm/sensusranap_harian_xls.php" method="get">
				 <input type="hidden" name="tgl_kunjungan" id="tgl_kunjungan" value=<?=$tgl_kunjungan?> />
                    <input type="submit" value="export xls"  />
                </form></p>            
          </div>
          
        </div>
    </div>
</div>
</div>
<p></p>
