<?php 
include("../include/connect.php");

$idx_daftar = $_GET["idx"];
$nolab = trim($_GET["nolab"]);

$sql = "SELECT b.`nama_tindakan`, a.`HASIL_PERIKSA`, a.`nilai_normal`, a.`UNIT` 
FROM t_orderlab a
JOIN m_tarif2012 b ON a.`KODE` = b.`kode_tindakan` WHERE a.`NOLAB` = '".$nolab."'";
$rowxx= mysql_query($sql)or die(mysql_error());

$myquery = "SELECT a.`NOLAB`,a.`TANGGAL`,b.`NAMA`, b.`JENISKELAMIN`, b.`TGLLAHIR`, c.`NAMADOKTER`, a.`NOMR`, a.`IDXDAFTAR`
FROM t_orderlab a
JOIN m_pasien b ON a.`NOMR` = b.`NOMR`
JOIN m_dokter c ON a.`DRPENGIRIM` = c.`KDDOKTER`
WHERE a.`NOLAB` = '".$nolab."'";
//WHERE a.IDXDAFTAR = '".$_REQUEST['idx']."'";
//echo $myquery;
      $get = mysql_query ($myquery)or die(mysql_error());
    $userdata = mysql_fetch_assoc($get);    
    $nomr=$userdata['NOMR'];
    $idxdaftar=$userdata['IDXDAFTAR'];
    $kdpoly=$userdata['POLY'];
    $kddokter=$userdata['NAMADOKTER'];
    $tglreg=$userdata['TANGGAL'];

$sql_ext = "SELECT NOLAB, KETERANGAN FROM t_orderlab WHERE t_orderlab.IDXDAFTAR = '$idx_daftar' AND t_orderlab.STATUS = '1'
        AND t_orderlab.NOLAB = '$nolab'";
$get_ext = mysql_query($sql_ext);
$dat_ext = mysql_fetch_assoc($get_ext);
$nolab = $dat_ext['NOLAB'];
$keterangan = $dat_ext['KETERANGAN'];
?>
<script language="javascript">
function printIt()
{
content=document.getElementById('print_selection');
w=window.open('about:blank');
w.document.write( content.innerHTML );
w.document.writeln("<script>");
w.document.writeln("window.print()");
w.document.writeln("</"+"script>");
}
</script>
<div id="print_selection" >
<table width="829" height="377" border="0" cellspacing="0" class="tb">
  <tr>
    <td height="80" colspan="5"><div align="center">
      <strong><?=strtoupper($header1)?></strong><br />
      <strong>INSTALLASI LABORATORIUM KLINIK</strong><br /><?=$header3?>
    </div></td>
  </tr>
  <tr>
    <td colspan="5"><hr /></td>
  </tr>
  <tr>
    <td width="104">&nbsp;</td>
    <td width="212">&nbsp;</td>
    <td width="60">&nbsp;</td>
    <td width="112">&nbsp;</td>
    <td width="331">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;No Lab</td>
    <td>:&nbsp;<?php echo $nolab?></td>
    <td>&nbsp;</td>
    <td>Dokter</td>
    <td>:&nbsp;<?php echo $kddokter?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;Nama</td>
    <td>:&nbsp;<?php echo $userdata['NAMA'];?></td>
    <td>&nbsp;</td>
    <td>Ruangan</td>
    <td>:&nbsp;<?php echo $kdpoly?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;Jns Kelamin</td>
    <td>:&nbsp;<? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P"){echo"Perempuan";} ?> <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td>
    <td>&nbsp;</td>
    <td>Tanggal</td>
    <td>:&nbsp;<?=$tglreg?></td>
  </tr>
  
  <tr>
    <td>&nbsp;&nbsp;&nbsp;Umur</td>
    <td>:&nbsp;<?php
      $a = datediff($userdata['TGLLAHIR'], $tglreg);
      echo $a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td>
    <td>&nbsp;</td>
    <td>No RM</td>
    <td>:&nbsp;<?php echo $userdata['NOMR'];?></td>
  </tr>
  <tr>
    <td colspan="5"><hr /></td>
  </tr>
  <tr>
    <td height="91" colspan="5" valign="top"><table width="95%" border="0" cellspacing="1" class="tb">
      <tr>
        <th>Nama Test</th>
        <th>Hasil</th>
        <th>Nilai Normal</th>
        <th>Unit</th>
        <th>MICROS60</th>
      </tr>
<?php while($data = mysql_fetch_array($rowxx)){  ?>      
      <tr>
        <td><strong>-<?php echo $data['nama_tindakan']?></strong></td>
        <td><?php echo $data['HASIL_PERIKSA'];?></td>
        <td><?php echo $data['nilai_normal'];?></td>
        <td><?php echo $data['UNIT'];?></td>
        <td>&nbsp;</td>
      </tr>

<? 
}
/*
$sql_d = "SELECT t_orderlab.IDXORDERLAB, t_orderlab.KODE, t_orderlab.IDXDAFTAR, t_orderlab.HASIL_PERIKSA, t_orderlab.KETERANGAN,
      t_orderlab.TGL_MULAI, t_orderlab.TGL_SELESAI, t_orderlab.`STATUS`, t_orderlab.KET, m_lab.nama_jasa,     
      t_orderlab.TANGGAL,
            t_orderlab.nilai_normal, m_lab.kode_jasa, m_lab.unit
            FROM t_orderlab
        INNER JOIN m_lab ON (t_orderlab.KODE = m_lab.kode_jasa)
      WHERE t_orderlab.IDXDAFTAR = '$idx_daftar' AND t_orderlab.STATUS = '1'
      AND m_lab.group_jasa ='".$data['kode_jasa']."'";
   $get_d = mysql_query($sql_d);
   while($row_d = mysql_fetch_array($get_d)){
     */
?>   <!--          
      <tr>
        <td>&nbsp;&nbsp;<? #=$row_d['nama_jasa']?></td>
        <td><? #=$row_d['HASIL_PERIKSA']?></td>
        <td><? #=$row_d['unit']?></td>
        <td><? #=$row_d['nilai_normal']?></td>
        <td>&nbsp;</td>
      </tr>
<?php #$i++; } } ?>      
-->
      <tr>
        <td colspan="5">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
   <tr>
    <td colspan="5"><hr /></td>
  </tr>
  <tr>
    <td height="72" colspan="5">&nbsp;&nbsp;Catatan: <p><?=$keterangan?></p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
&nbsp;&nbsp;<a href="#" onClick="printIt()"><input type="button" class="text" value=" PRINT "/></a>