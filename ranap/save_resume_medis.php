<?php 
include("../include/connect.php");

/*if(isset($_POST['tgl_keluar'])){*/

if(/*$_POST['tgl_keluar']=="" || */$_POST['keluhan']=="" || $_POST['pemeriksaan_fisik']=="" || $_POST['pemeriksaan_penunjuang']=="" || $_POST['konsultasi']=="" || $_POST['diagnosa_akhir']=="" || $_POST['keadaan_pasien']=="" || $_POST['anjuran']=="" || $_POST['diagnosa']==""){
	echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
	echo"<p><strong>Maaf Data Yang Anda Masukan Belum Lengkap</strong></p>";
	/*if($_POST['tgl_keluar']=="" ){
	echo"- Maaf Tanggal Keluar Belum Diisi<br>";
	}*/
	if($_POST['keluhan']=="" ){
	echo"- Maaf Keluhan Belum Diisi<br>";
	}
	if($_POST['pemeriksaan_fisik']=="" ){
	echo"- Maaf Pemeriksaan Fisik Belum Diisi<br>";
	}
	if($_POST['pemeriksaan_penunjuang']=="" ){
	echo"- Maaf Pemeriksaan Penunjuang Belum Diisi<br>";
	}
	if($_POST['konsultasi']=="" ){
	echo"- Maaf Konsultasi Belum Diisi<br>";
	}
	if($_POST['diagnosa_akhir']=="" ){
	echo"- Maaf Diagnosa Akhir Belum Diisi<br>";
	}
	if($_POST['keadaan_pasien']=="" ){
	echo"- Maaf Keadaan Pasien Belum Diisi<br>";
	}
	if($_POST['anjuran']=="" ){
	echo"- Maaf Anjuran Belum Diisi<br>";
	}
	if($_POST['diagnosa']=="" ){
	echo"- Maaf Diagnosa Belum Diisi<br>";
	}
  echo "</div>";
}else if(isset($_POST['idx'])){
	mysql_query("UPDATE t_resumemedis SET IDXRANAP = '$_POST[id_admission]', NOMR = '$_POST[nomr]', TANGGALMASUK = '$_POST[masukrs]', KELUHANUTAMA = '$_POST[keluhan]', PEMERIKSAANFISIK = '$_POST[pemeriksaan_fisik]', PEMERIKSAANPENUNJANG = '$_POST[pemeriksaan_penunjuang]', JALANNYAPENYAKIT = '$_POST[konsultasi]', DIAGNOSAAKHIR = '$_POST[diagnosa_akhir]', PASIENWAKTUPULANG = '$_POST[keadaan_pasien]', ANJURAN = '$_POST[anjuran]', PROGNOSA = '$_POST[diagnosa]' WHERE IDX = '$_POST[idx]';")or die(mysql_error());
	echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
	echo "<div style='color:#090;'><strong>Input Data Sukses!</strong></div>";	
	echo "</div>";
}else{
	mysql_query("INSERT INTO t_resumemedis VALUES('','$_POST[id_admission]','$_POST[nomr]','$_POST[masukrs]','0000-00-00 00:00:00','$_POST[keluhan]','$_POST[pemeriksaan_fisik]','$_POST[pemeriksaan_penunjuang]','$_POST[konsultasi]','$_POST[diagnosa_akhir]','$_POST[keadaan_pasien]','$_POST[anjuran]','$_POST[diagnosa]')")or die(mysql_error());
	echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
	echo "<div style='color:#090;'><strong>Input Data Sukses!</strong></div>";	
	echo "</div>";
}
//}
?>
<!--<div id="valid">
            <div id="head_report" style="display:none" align="center">
                <div align="center" style="clear:both; padding:20px">
                    <div style="letter-spacing:-1px; font-size:16px; font:bold;"><?=strtoupper($header1)?></div>
                    <div style="letter-spacing:-2px; font-size:24px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
					<div><?=$header3?><br /><?=$header4?></div>
                    <hr style="margin:5px;" />
                    
                </div>            
            </div>
<table width="90%" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr align="center" valign="top">
    <th>Tanggal Keluar</th>
    <th>Keluhan utama dan riwayat penyakit yang positif</th>
    <th>Pemeriksaan fisik</th>
    <th>Pemeriksaan Penunjang (Lab, Ro, dll)</th>
    <th>Jalannya penyakit selama perawatan (konsultasi, pemeriksaan khusus)</th>
    <th>Diagnosa Akhir ( Satu atau Lebih )</th>
    <th>Keadaan pasien waktu dipulangkan dan obat-obatan yang diberikan</th>
    <th>Anjuran / Pemeriksaan lanjut</th>
    <th>Diagnosa</th>
  </tr>
<?php 
// view data
$sql = "SELECT * FROM t_resumemedis WHERE IDXRANAP = '$_POST[id_admission]' ORDER BY IDX DESC LIMIT 10";
$qry = mysql_query($sql);
while($data = mysql_fetch_array($qry)){
?>
          <tr valign="top" <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
    <td><?=$data['TANGGALKELUAR']?></td>
    <td><?=$data['KELUHANUTAMA']?></td>
    <td><?=$data['PEMERIKSAANFISIK']?></td>
    <td><?=$data['PEMERIKSAANPENUNJANG']?></td>
    <td><?=$data['JALANNYAPENYAKIT']?></td>
    <td><?=$data['DIAGNOSAAKHIR']?></td>
    <td><?=$data['PASIENWAKTUPULANG']?></td>
    <td><?=$data['ANJURAN']?></td>
    <td><?=$data['PROGNOSA']?></td>
  </tr>
<? } ?>
</table>
</div>
<input type="button" class="text" value="PRINT" onclick="printIt()" />-->




