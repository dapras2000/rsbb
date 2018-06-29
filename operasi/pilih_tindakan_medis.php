<?php 
include("../include/connect.php");
$ret_operasi="select a.nomr,b.nama from t_operasi a, m_pasien b where a.id_operasi='".$_GET['idoperasi']."' and a.nomr=b.nomr";
$res_operasi=mysql_query($ret_operasi);
$row_operasi=mysql_fetch_array($res_operasi);

$ret_operasi1="SELECT YEAR(NOW())-YEAR(TGLLAHIR) as usia from m_pasien where nomr='".$row_operasi[0]."'";
$res_operasi1=mysql_query($ret_operasi1);
$row_operasi1=@mysql_fetch_array($res_operasi1);

$ret_operasi2="select a.noruang,a.nott,b.nama, b.kelas from t_admission a,m_ruang b where a.noruang=b.no and a.nomr='".$row_operasi[0]."'";
$res_operasi2=mysql_query($ret_operasi2);
$row_operasi2=@mysql_fetch_array($res_operasi2);

$ret_operasi3="select * from t_operasi  where id_operasi='".$_GET['idoperasi']."'";
$res_operasi3=mysql_query($ret_operasi3);
$row_operasi3=mysql_fetch_array($res_operasi3);
#$sql	= mysql_query('select * from t_operasi where id_operasi = "'.$_REQUEST['id_operasi'].'"');


?>
<div align="center">
  <div id="frame" style="width:100%;">
  <div id="frame_title">
  <h3 align="left">TINDAKAN MEDIS</h3></div>

<form id="form1" name="form1" method="POST" action="">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb" align="center">
<tr valign="top"><td colspan="4"><input name="id" type="hidden" id="id" value="<? echo $_GET['idoperasi'];?>"></td></tr>
<tr valign="top"><td width="31%">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr><td>Nama</td><td>:</td><td><strong><?=$row_operasi[1];?></strong></td></tr>
	<tr><td>Umur</td><td>:</td><td><strong><?=$row_operasi1[0];?></strong>Tahun</td></tr>
	<tr><td>NOMR</td><td>:</td><td><strong><?=$row_operasi[0];?></strong></td></tr>
	<tr><td>Ruang Rawat</td><td>:</td><td><strong><? echo $row_operasi2[2]."/".$row_operasi2[1];?></strong></td></tr>
	<tr><td>Tanggal Operasi</td><td>:</td><td><strong><?=$row_operasi3[2];?></strong></td></tr>
	</table>
</td><td width="27%">&nbsp;</td><td width="42%" colspan="2">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr><td>Diagnosa</td><td>:</td><td><strong><?=$row_operasi3[5];?></strong></td></tr>
    <tr><td>Tindakan</td><td>:</td><td><strong><?=$row_operasi3[6];?></strong></td></tr>
	<tr><td>Dokter Operator</td><td>:</td><td><strong><?=$row_operasi3['dokteroperator'];?></strong></td></tr>
	<tr><td>Dokter Anestesi</td><td>:</td><td><strong><?=$row_operasi3['dokteranastesi'];?></strong></td></tr>
	<tr><td>Asisten Operator</td><td>:</td><td><strong><?=$row_operasi3['asistenoperator'];?></strong></td></tr>
	<tr><td>Asisten Anestesi</td><td>:</td><td><strong><?=$row_operasi3['asistenanastesi'];?></strong></td></tr>
    </table>
</td></tr>
    <tr valign="top">
      <td colspan="4">
      	<div align="center">
        <a href="index.php?link=20" class="text">KEMBALI KE LIST</a> 
        <?php if($row_operasi3['dokteroperator'] != ''){ ?>
        <a href="index.php?link=tindakan_operasi&nomr=<?=$row_operasi3['nomr']?>&idx=<?=$row_operasi3['IDXDAFTAR']?>&idoperasi=<?=$_GET['idoperasi']?>&tanggal=<?=$_GET['tanggal']?>&kelas=<?php echo $row_operasi2['kelas'];?>" class="text">PILIH TINDAKAN MEDIS</a>
        <a href="index.php?link=tindakan_operasilain&nomr=<?=$row_operasi3['nomr']?>&idx=<?=$row_operasi3['IDXDAFTAR']?>&idoperasi=<?=$_GET['idoperasi']?>&tanggal=<?=$_GET['tanggal']?>&kelas=<?php echo $row_operasi2['kelas'];?>" class="text">PILIH TINDAKAN MEDIS LAIN</a>
        <?php }else{ ?>
        <a href="index.php?link=setting_dokter_operasi&nomr=<?=$row_operasi3['nomr']?>&idx=<?=$row_operasi3['IDXDAFTAR']?>&idoperasi=<?=$_GET['idoperasi']?>&tanggal=<?=$_GET['tanggal']?>&kelas=<?php echo $row_operasi2['kelas'];?>" class="text">PILIH DOKTER OPERATOR & DOKTER ANASTESI</a>
        <?php } ?>
      </div>
      <table width="600" cellpadding="1" cellspacing="1" align="center" class="tb">
      <?
	  		echo "<tr>";
		echo "<th align=center>KODE JASA</th>";
			echo "<th align=left>NAMA JASA</th>";
			echo "<th align=center>TARIF</th>";
			echo "<th align=center>QTY</th>";
			echo "</tr>";
		$det1	 = 'select a.KODETARIF, a.TARIFRS, a.QTY, b.nama_tindakan 
		from t_billranap a 
		join m_tarif2012 b on b.kode_tindakan = a.KODETARIF 
		where a.IDXDAFTAR = "'.$row_operasi3['IDXDAFTAR'].'" and a.NOMR = "'.$row_operasi['nomr'].'"';
		
	  
	  #$det1="select t.IDX,t.IDXDAFTAR,t.KODETARIF,m.nama_jasa,m.tarif from t_tindakan_medis t 
	  #INNER JOIN m_tarif m on (t.KODETARIF = m.kode)
	  #where t.IDXDAFTAR='".$row_operasi3['IDXDAFTAR']."'";
      //$det1="select nourut,kode_obat,nama_obat,pemakaian,terima from t_operasi_pemakaian_obat  where idoperasi='".$_GET['idoperasi']."' group by idoperasi,kode_obat,pemakaian,terima";
		$res_det1=mysql_query($det1);
		while($row_det1=mysql_fetch_array($res_det1))
		{
			echo "<tr>";
			echo "<td align=center>".$row_det1['KODETARIF']."</td>";
			echo "<td align=left>".$row_det1['nama_tindakan']."</td>";
			echo "<td align=right>".curformat($row_det1['TARIFRS'])."</td>";
			echo "<td align=center>".$row_det1['QTY']."</td>";
			echo "</tr>";
			}


	  ?>
    </table> 
</td></tr>
<tr valign="top"><td colspan="4"></td></tr>
</table>
</form>
</div></div>