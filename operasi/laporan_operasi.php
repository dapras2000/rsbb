<?php 
include"../include/connect.php";
include"../include/function.php";
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
  <h3 align="left">LAPORAN OPERASI</h3></div>

<form id="form1" name="form1" method="POST" action="">
  <table width="90%" border="0" cellpadding="0" cellspacing="0" class="tb" align="center">
    <tr valign="top">
      <td colspan="4"><div align="center">
        <h2>  LAPORAN OPERASI PASIEN</h2><hr />
        <input name="id" type="hidden" id="id" value="<? echo $_GET['idoperasi'];?>">
      </div></td>
    </tr>
    <tr valign="top">
      <td colspan="4"><table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi[1];?>
          </strong></td>
          <td>&nbsp;</td>
          <td>Nomer Pasien (NOMR)</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi[0];?>
          </strong></td>
        </tr>
        <tr>
          <td>RUANG/Nomer Tempat Tidur</td>
          <td>:</td>
          <td><strong><? echo $row_operasi2[2]."/".$row_operasi2[1];?></strong></td>
          <td>&nbsp;</td>
          <td>Umur</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi1[0];?>
          </strong>Tahun</td>
        </tr>
        <tr>
          <td>Nama Ahli Bedah </td>
          <td>:</td>
          <td><strong>
            <?php
			$sq	= mysql_query('SELECT DISTINCT a.dokter, b.namadokter
FROM t_operasi_tindakan_medis a
JOIN m_dokter b ON a.dokter = b.KDDOKTER
WHERE a.idoperasi = "'.$_REQUEST['idoperasi'].'"');
			$dok = '';
			if(mysql_num_rows($sq) > 0){
				while($da = mysql_fetch_array($sq)){
					if($dok != ''){
						$dok = $dok.' - ';
					}
					$dok = $dok.$da['namadokter'];
				}
			}else{
            	$dok  = $row_operasi3['dokteroperator'];
			}
			echo $dok;
			?>
          </strong></td>
          <td>&nbsp;</td>
          <td>Nama Asisten</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3['asistenoperator'];?>
          </strong></td>
        </tr>
        <tr>
          <td>Nama Ahli Anesthesi</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3['dokteranastesi'];?>
          </strong></td>
          <td>&nbsp;</td>
          <td>Nama Perawat</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3['perawatinstrumen'];?>,
            <?=$row_operasi3['perawatsirkuler'];?>
          </strong></td>
        </tr>
        <tr>
          <td>Nama Ahli Anak</td>
          <td>:</td>
          <td><strong><?php echo $row_operasi3['dokteranak'];?></strong></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Jenis Anesthesi</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3['jenisanastesi'];?>/
            <?=$row_operasi3['metodeanastesi'];?>
          </strong></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">Diagnosa</td>
          <td valign="top">:</td>
          <td valign="top"><strong>
            <?=$row_operasi3['diagnosa'];?>
          </strong></td>
          <td valign="top">&nbsp;</td>
          <td valign="top">Macam Pembedahan</td>
          <td valign="top">:</td>
          <td valign="top"><strong>
            <?=$row_operasi3['pembedahan'];?>
          </strong></td>
        </tr>
        <tr>
          <td>Diagnosa post-operatif</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3['tindakan'];?>
          </strong></td>
          <td>&nbsp;</td>
          <td>Dikirim untuk Pemeriksaan PA</td>
          <td>:</td>
          <td><strong>
            <?=$row_operasi3['pemeriksaanPA'];?>
          </strong></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
      </tr>
    <tr valign="top">
      <td width="31%"> :</td>
      <td width="27%">&nbsp;</td>
      <td colspan="2"> :</td>
    </tr>
    <tr valign="top">
      <td colspan="2">Jaringan yang di-Eksisis-Insisi : <br>
         <strong><?=$row_operasi3['jaringan'];?>
      <label></label></td>
      <td colspan="2"><p>
          <label></label>
          Nama/Macam Operasi : <br>
          <strong> <?=$row_operasi3['macamoperasi'];?></strong>
      </p></td>
    </tr>
    
    <tr valign="top">
      <td>Tanggal Operasi : <br><strong><?=$row_operasi3['tanggal'];?></strong></td>
      <td>Jam Operasi dimulai : <br><strong><?=$row_operasi3['jammulai'];?></strong></td>
      <td colspan="2">Jam Operasi Selesai : <br><strong> <?=$row_operasi3['jamselesai'];?></strong>
        <label></label></td>
    </tr>
    <tr valign="top">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td width="20%">&nbsp;</td>
      <td width="22%">&nbsp;</td>
    </tr>
    <tr valign="top">
      <td colspan="4"><p>&nbsp;</p>
            <label><br>
          </label></td>
    </tr>
  </table>
</form>
</div></div>