
<?php
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
}else{
    $tgl_kunjungan =date('Y/m/d'); 
}

$tgl_kunjungan2 = "";
if(!empty($_GET['tgl_kunjungan2'])){
	$tgl_kunjungan2 =$_GET['tgl_kunjungan2']; 
}else{
    $tgl_kunjungan2 =date('Y/m/d'); 
}
?>
<div id="frame_title" ><h3>SENSUS LABORATORIUM</h3></div>
          <table width="95%"  border="1" cellspacing="1" cellspading="1" class="tb">
            <tr align="center">
              <th width="2%" rowspan="3">NO </th>
              <th width="6%" rowspan="3">JENIS PEMERIKSAAN</th>
              <th width="4%" colspan="3" rowspan="2">GOLONGAN</th>
			  <?$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');?>
              <th height="21" colspan="<?=mysql_num_rows($ss);?>">CARA PEMBAYARAN</th>
              <th width="8%" rowspan="3">JUMLAH PASIEN</th>
              <th width="7%" rowspan="3">KET</th>
            </tr>
            <tr align="center">
			  <?$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
			  while($ds = mysql_fetch_array($ss)){
				echo '<th rowspan="2">'.$ds['NAMA'].'</th>';
			  }?>
            </tr>
            <tr align="center">
              <th width="4%">SEDERHANA</th>
              <th width="4%">SEDANG</th>
              <th width="4%">CANGGIH</th>
            </tr>
            <?
	 $sql="SELECT jenis_pemeriksaan,SUM(Canggih) AS Canggih,SUM(Sedang) AS Sedang,SUM(Sederhana) AS Sederhana,";
	$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
	while($ds = mysql_fetch_array($ss)){
		$sql=$sql."SUM(`".$ds['NAMA']."`) AS '".$ds['NAMA']."',";
	}
	$sql = substr_replace($sql ,"",-1);
	$sql = $sql." FROM ( SELECT jenis_pemeriksaan,nourut,
SUM(IF(golongan='Canggih',1,NULL)) AS Canggih,
SUM(IF(golongan='Sedang',1,NULL)) AS Sedang,
SUM(IF(golongan='Sederhana',1,NULL)) AS Sederhana, ";
	$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
	while($ds = mysql_fetch_array($ss)){
		$sql=$sql."SUM(IF(b.carabayar=".$ds['KODE'].",1,NULL)) AS '".$ds['NAMA']."',";
	}
	$sql = substr_replace($sql ,"",-1);
	$sql = $sql." FROM tpl_report_labrm  a
INNER JOIN t_billrajal b ON a.kode_tindakan=b.KODETARIF
INNER JOIN t_bayarrajal c ON b.IDXDAFTAR=c.IDXDAFTAR AND b.NOBILL=c.NOBILL AND c.status='LUNAS' AND TGLBAYAR between '".$tgl_kunjungan."' and '".$tgl_kunjungan2."' 
GROUP BY jenis_pemeriksaan 
UNION
SELECT jenis_pemeriksaan,nourut,
SUM(IF(golongan='Canggih',1,NULL)) AS Canggih,
SUM(IF(golongan='Sedang',1,NULL)) AS Sedang,
SUM(IF(golongan='Sederhana',1,NULL)) AS Sederhana, ";
	$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
	while($ds = mysql_fetch_array($ss)){
		$sql=$sql."SUM(IF(b.carabayar=".$ds['KODE'].",1,NULL)) AS '".$ds['NAMA']."',";
	}
	$sql = substr_replace($sql ,"",-1);
	$sql = $sql." FROM tpl_report_labrm  a
INNER JOIN t_billranap b ON a.kode_tindakan=b.KODETARIF
INNER JOIN t_bayarranap c ON b.IDXDAFTAR=c.IDXDAFTAR AND b.NOBILL=c.NOBILL AND c.status='LUNAS' AND TGLBAYAR between '".$tgl_kunjungan."' and '".$tgl_kunjungan2."' 
GROUP BY jenis_pemeriksaan )
AS newtbl2 
GROUP BY jenis_pemeriksaan
ORDER BY nourut";

$qry	= mysql_query($sql);	
$count=0;
while($data = mysql_fetch_array($qry)){	
?>
            <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
              <td> <?=$count?></td>
              <td><?=$data['jenis_pemeriksaan']?></td>
              <td><?=$data['Sederhana']?></td>
              <td><?=$data['Sedang']?></td>
              <td><?=$data['Canggih']?></td>
              <? $ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
				while($ds = mysql_fetch_array($ss)){
					echo "<td>".$data[$ds['NAMA']]."</td>";
				}?>
              <td><?=$data['lain']?></td>
              <td><?=$data['Sederhana']+$data['Sedang']+$data['Canggih']?></td>
              <td>&nbsp;</td>
            </tr>
            <?php
           }
			?>
          </table>
