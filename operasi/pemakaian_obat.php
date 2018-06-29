<? include"../include/connect.php";
$ret_operasi="select a.nomr,b.nama from t_operasi a, m_pasien b where a.id_operasi='".$_GET['idoperasi']."' and a.tanggal='".$_GET['tanggal']."' and a.nomr=b.nomr";
$res_operasi=mysql_query($ret_operasi);
$row_operasi=@mysql_fetch_array($res_operasi);

$ret_operasi1="SELECT YEAR(NOW())-YEAR(TGLLAHIR) as usia from m_pasien where nomr='".$row_operasi[0]."'";
$res_operasi1=mysql_query($ret_operasi1);
$row_operasi1=@mysql_fetch_array($res_operasi1);

$ret_operasi2="select a.noruang,a.nott,b.nama from t_admission a,m_ruang b where a.noruang=b.no and a.nomr='".$row_operasi[0]."'";
$res_operasi2=mysql_query($ret_operasi2);
$row_operasi2=@mysql_fetch_array($res_operasi2);

$ret_operasi3="select * from t_operasi  where id_operasi='".$_GET['idoperasi']."'";
$res_operasi3=mysql_query($ret_operasi3);
$row_operasi3=@mysql_fetch_array($res_operasi3);


?>
<div align="center">
  <div id="frame" style="width:100%;">
  <div id="frame_title">
  <h3 align="left">PEMAKAIAN BHP/ OBAT</h3></div>

<form id="form1" name="form1" method="POST" action="">
  <table width="85%" border="0" cellpadding="0" cellspacing="0" class="tb" align="center">
    <tr valign="top">
      <td colspan="4">
          <input name="id" type="hidden" id="id" value="<? echo $_GET['idoperasi'];?>">
      </td>
    </tr>
    <tr valign="top">
      <td width="31%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi[1];?>
          </strong></td>
        </tr>
        <tr>
          <td>Umur</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi1[0];?>
          </strong>Tahun</td>
        </tr>
        <tr>
          <td>NOMR</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi[0];?>
          </strong></td>
        </tr>
        <tr>
          <td>Ruang Rawat</td>
          <td>:</td>
          <td><strong><? echo $row_operasi2[2]."/".$row_operasi2[1];?></strong></td>
        </tr>
        <tr>
          <td>Tanggal Operasi</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3[2];?>
          </strong></td>
        </tr>
      </table>        </td>
      <td width="27%">&nbsp;</td>
      <td width="42%" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>Diagnosa</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3[5];?>
          </strong></td>
        </tr>
        <tr>
          <td>Tindakan</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3[6];?>
          </strong></td>
        </tr>
        <tr>
          <td>Dokter Operator</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3[9];?>
          </strong></td>
        </tr>
        <tr>
          <td>Dokter Anestesi</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3[10];?>
          </strong></td>
        </tr>
        <tr>
          <td>Asisten Operator</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3[12];?>
          </strong></td>
        </tr>
        <tr>
          <td>Asisten Anestesi</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3[13];?>
          </strong></td>
        </tr>
      </table></td>
    </tr>
    <tr valign="top">
      <td colspan="4"><div align="center"><br />
        <a href="index.php?link=20" class="text">KEMBALI KE LIST</a> 
        <a href="index.php?link=op1&idxorder=<? echo $_GET['idoperasi'];?>&tanggal=<? echo $_GET['tanggal'];?>" class="text">TAMBAH BHP/OBAT</a>
         
      </div>
      
    <table width="600" cellpadding="1" cellspacing="1" align="center" class="tb">
    <tr valign="top">
      <td colspan="4" align="center">
      <?
	  		echo "<tr>";
			echo "<th align=center>Kode BHP/Obat</th>";
			echo "<th align=left>Nama BHP/Obat</th>";
			echo "<th align=center>No Batch</th>";
			echo "<th align=center>Jumlah</th>";
			echo "<th align=center>&nbsp;</th>";
			echo "</tr>";
			
	  
	  
      $det1="SELECT m_barang.nama_barang,
			  t_operasi_barang.IDX_BARANG,
			  t_operasi_barang.IDXOPERASI,
			  t_operasi_barang.KD_BARANG,
			  t_operasi_barang.NO_BATCH,
			  t_operasi_barang.JUMLAH
			FROM
			  t_operasi_barang
			  INNER JOIN m_barang ON (t_operasi_barang.KD_BARANG = m_barang.kode_barang)
			WHERE t_operasi_barang.IDXOPERASI =".$_GET['idoperasi'];
		$res_det1=mysql_query($det1);
		while($row_det1=@mysql_fetch_array($res_det1))
		{
			echo "<tr>";
			echo "<td align=center>".$row_det1['KD_BARANG']."</td>";
			echo "<td align=left>".$row_det1['nama_barang']."</td>";
			echo "<td align=left>".$row_det1['NO_BATCH']."</td>";
			echo "<td align=right>".$row_det1['JUMLAH']."</td>";
			echo "<td align=right>"; ?>
			<a href="index.php?link=x206&idoperasi=<?=$_GET['idoperasi']?>&idxbarang=<?=$row_det1['IDX_BARANG']?>&tanggal=<?=$_GET['tanggal']?>" class="text">B A T A L</a> 
			<? echo "</td>";
			echo "</tr>";
			}


	  ?></td>
      </tr>
    </table> 
    
    </td>
      </tr>
    
    
    <tr valign="top">
      <td colspan="4"><p>&nbsp;</p>
            <label><br>
            </label></td>
    </tr>
  </table>
</form>
</div></div>