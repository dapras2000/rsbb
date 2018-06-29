<?php 
session_start();
include("include/connect.php");
 
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
<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title">
      <h3>SENSUS LAYANAN Radiologi</h3></div>
    <div align="right" style="margin:5px;">
   
<form name="formsearch" method="get" >
     <table width="286" border="0" cellspacing="0" class="tb">
  <tr>
    <td width="78">Dari Tanggal</td>
    <td width="204"><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan!=""){
			  echo $tgl_kunjungan;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
  <tr>
    <td>Sampai Tanggal</td>
    <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan2!=""){
			  echo $tgl_kunjungan2;}?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>

  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
      <input type="hidden" name="link" value="1313" /></td>
  </tr>
</table>

    </form> 

     <div id="table_search">
         <div>    
          <table width="95%"  border="0" cellspacing="1" cellspading="1" class="tb">
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
           <form action="report_rm/sensus_radiologi_xls.php" method="get">
       <input type="hidden" name="tgl_kunjungan" id="tgl_kunjungan" value=<?=$tgl_kunjungan?> />
                <input type="hidden" name="tgl_kunjungan2" id="tgl_kunjungan2" value=<?=$tgl_kunjungan2?> />                
                   <input type="submit" value="export xls" />
                </form>
  </div>
         
      </div>
    </div>
</div>
</div>
<p></p>
