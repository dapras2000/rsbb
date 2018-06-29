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

      <h3>SENSUS RADIOLOGI</h3>

          <table width="95%"  border="1" cellspacing="1" cellspading="1" class="tb">
            <tr align="center">
              <th width="3%" rowspan="2">NO </th>
              <th width="33%" rowspan="2">JENIS PEMERIKSAAN</th>
			  <?$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');?>
              <th height="21" colspan="<?=mysql_num_rows($ss);?>">CARA PEMBAYARAN</th>
              <th width="8%" rowspan="2">JUMLAH PASIEN</th>
              <th width="7%" rowspan="2">KET</th>
            </tr>
            <tr align="center">
              <?$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
			  while($ds = mysql_fetch_array($ss)){
				echo '<th width="11%">'.$ds['NAMA'].'</th>';
			  }?>
            </tr>
            <?
	 $sql="SELECT nama_tindakan as jenis_pemeriksaan,";
	$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
	while($ds = mysql_fetch_array($ss)){
		$sql=$sql."SUM(`".$ds['NAMA']."`) AS '".$ds['NAMA']."',";
	}
	$sql = substr_replace($sql ,"",-1);
	$sql = $sql." FROM (SELECT nama_tindakan,";
	$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
	while($ds = mysql_fetch_array($ss)){
		$sql=$sql."SUM(IF(b.carabayar=".$ds['KODE'].",1,NULL)) AS '".$ds['NAMA']."',";
	}
	$sql = substr_replace($sql ,"",-1);
	$sql = $sql." FROM t_billrajal b 
INNER JOIN t_bayarrajal c ON b.IDXDAFTAR=c.IDXDAFTAR AND b.NOBILL=c.NOBILL AND c.status='LUNAS' AND TGLBAYAR BETWEEN '".$tgl_kunjungan."' AND '".$tgl_kunjungan2."' 
INNER JOIN  m_tarif2012 d ON d.kode_tindakan=b.KODETARIF
WHERE kode_tindakan LIKE '06.02%'  OR kode_tindakan LIKE '06.03%' OR kode_tindakan LIKE '06.04%'  
GROUP BY nama_tindakan
UNION
SELECT nama_tindakan,";
	$ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
	while($ds = mysql_fetch_array($ss)){
		$sql=$sql."SUM(IF(b.carabayar=".$ds['KODE'].",1,NULL)) AS '".$ds['NAMA']."',";
	}
	$sql = substr_replace($sql ,"",-1);
	$sql = $sql." FROM t_billranap b 
INNER JOIN t_bayarranap c ON b.IDXDAFTAR=c.IDXDAFTAR AND b.NOBILL=c.NOBILL AND c.status='LUNAS' AND TGLBAYAR BETWEEN '".$tgl_kunjungan."' AND '".$tgl_kunjungan2."' 
INNER JOIN  m_tarif2012 d ON d.kode_tindakan=b.KODETARIF
WHERE kode_tindakan LIKE '06.02%'  OR kode_tindakan LIKE '06.03%' OR kode_tindakan LIKE '06.04%'  
GROUP BY nama_tindakan)
AS newtbl2 
GROUP BY nama_tindakan";

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
              <? $jumCaraBayar = 0;
			    $ss	= mysql_query('select * from m_carabayar order by ORDERS ASC');
				while($ds = mysql_fetch_array($ss)){
					echo "<td>".$data[$ds['NAMA']]."</td>";
					$jumCaraBayar = $jumCaraBayar + $data[$ds['NAMA']];
				}?>
              <td><?=$jumCaraBayar;?></td>
              <td>&nbsp;</td>
            </tr>
            <?php
           }
			?>
          </table>
          
