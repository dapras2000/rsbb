<div align="center">
<div id="frame" style="width:100%">
	<div id="frame_title">
	  <h3>Detil Status Pulang Rawat Jalan</h3></div>
<?php 
include "../include/connect.php";
$tgl=$_GET['tglreg'];
$kdpoly=$_GET['kdpoly']; 
$status=$_GET['status'];

?>

<!--<div style="overflow:scroll;width:98%;height:auto;">-->
<div>
  <table width="148%" style="font-size:9px;" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">
    <tr>
      <th width="34" rowspan="2">Tanggal</th>
      <th colspan="5">Detil Status Keluar Rawat Jalan</th>
    </tr>
    <tr>
      <th>NOMR</th>
      <th>Nama</th>
      <th>Cara Bayar</th>
      <th>Poly</th>
      <th>Keterangan</th>
      </tr>
    <?php   


       $sql="SELECT a.tglreg,a.nomr,b.nama,c.nama AS carabayar, d.nama AS poly,a.KETERANGAN_STATUS,
CASE a.STATUS WHEN 0 THEN 'Belum Pulang ' ELSE (SELECT keterangan FROM m_statuskeluar e WHERE e.status=a.STATUS )END AS keterangan,
CASE a.STATUS 
WHEN 6 THEN (SELECT z.nama FROM m_dasarrujuk z WHERE z.kode = a.KETERANGAN_STATUS) 
WHEN 5 THEN (SELECT z.nama FROM m_poly z WHERE z.kode = a.KETERANGAN_STATUS) 
ELSE '-' END AS st
FROM t_pendaftaran a
INNER JOIN m_pasien b ON a.NOMR=b.NOMR
INNER JOIN m_carabayar c ON c.KODE=a.KDCARABAYAR
LEFT JOIN m_poly d ON d.kode=a.KDPOLY
WHERE a.tglreg='$tgl' AND a.kdpoly='$kdpoly' AND a.status=$status";
       $rs=mysql_query($sql);
	  if(!$rs) die(mysql_error());
	   $count=0;
       while ($data = mysql_fetch_array($rs)) {
		 if($data['st'] == '-'){
			 $st = '';
		 }else{
			 $st = '&nbsp;&nbsp;( '.$data['st'].' )';
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
      <td><? echo $data['tglreg'];?></td>
      <td width="33"> <?=$data['nomr'];?> </td>
      <td width="33"> <?=$data['nama'];?> </td>
      <td width="33"> <?=$data['carabayar'];?> </td>
      <td width="33"> <?=$data['poly'];?> </td>
      <td width="33"> <?=$data['keterangan'].$st;?> </td>
      </tr>
    <?php } ?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    </table>
</div>
</div></div>
