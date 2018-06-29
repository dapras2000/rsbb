<?php 
include("../include/connect.php");
 
if(isset($_POST['nama_obat'])){
	if($_POST['jenis_obat']=="" || $_POST['nama_obat']=="" || $_POST['waktu']=="" || $_POST['keterangan']==""){
		echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
		echo"<p><strong>Maaf Data Yang Anda Masukan Belum Lengkap</strong></p>";
			if($_POST['jenis_obat']=="-pilih-"){
				echo "- Data jenis Obat Belum Dipilih<br>";
			}
			if($_POST['nama_obat']==""){
				echo "- Data Nama Obat Belum Diisi<br>";
			}
			if($_POST['waktu']==""){
				echo "- Data waktu Belum Diisi<br>";
			}
		echo "</div>";	
	}else{
		if(isset($_POST['idxberiobat'])){
			mysql_query("UPDATE t_pemberianobat set IDXRANAP='$_POST[id_admission]', NOMR='$_POST[nomr]', TANGGAL='$_POST[tanggal]', DOKTER='$_POST[kddokter]', JENIS='$_POST[jenis_obat]', NAMA='$_POST[nama_obat]', WAKTU='$_POST[waktu]', KETERANGAN='$_POST[keterangan]' where IDXBERIOBAT='$_POST[idxberiobat]';")or die(mysql_error());
			echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
			echo "<div style='color:#090;'><strong>Edit Data Sukses!</strong></div>";
			echo "</div>";	
		}else{
			mysql_query("INSERT INTO t_pemberianobat VALUES('','$_POST[id_admission]','$_POST[nomr]',now(),'$_POST[kddokter]','$_POST[jenis_obat]','$_POST[nama_obat]','$_POST[waktu]','$_POST[keterangan]')")or die(mysql_error());
			echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
			echo "<div style='color:#090;'><strong>Input Data Sukses!</strong></div>";
			echo "</div>";	
		}
	}
}
?>
<div id="valid">
            <div id="head_report" style="display:none" align="center">
                <div align="center" style="clear:both; padding:20px">
                    <div style="letter-spacing:-1px; font-size:16px; font:bold;"><?=strtoupper($header1)?></div>
                    <div style="letter-spacing:-2px; font-size:24px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
					<div><?=$header3?><br /><?=$header4?></div>
                    <hr style="margin:5px;" />
                    
                </div>            
            </div>

<table width="90%" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr>
    <th>Kategori Obat</th>
    <th>Nama Obat</th>
    <th>Tgl / Jam</th>
    <th>Waktu</th>
    <th>Keterangan</th>
	<th>Aksi</th>
  </tr>
<?php 
$sql = "SELECT * FROM t_pemberianobat WHERE IDXRANAP = '$_POST[id_admission]' ORDER BY IDXBERIOBAT DESC LIMIT 10";
$qry = mysql_query($sql);
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
    <td><? if($data['JENIS']=="1"){ echo "Antibiotika (Oral)"; }
        elseif($data['JENIS']=="2"){ echo "Obat-Obatan (Oral) Lainnya"; }
        elseif($data['JENIS']=="3"){ echo "Obat - Obatan Suntik"; }
        elseif($data['JENIS']=="4"){ echo "Peralatan Medik"; }
        elseif($data['JENIS']=="5"){ echo "Syrup"; }?></td>
    <td><? echo $data['NAMA'];?></td>
    <td><? echo $data['TANGGAL'];?></td>
    <td><? if($data['WAKTU']=="1"){ echo "Pagi"; }
      elseif($data['WAKTU']=="2"){ echo "Siang"; }
      elseif($data['WAKTU']=="3"){ echo "Sore"; }
      elseif($data['WAKTU']=="4"){ echo "Malam"; } ?></td>
    <td><? echo $data['KETERANGAN'];?></td>
	<td><input type="submit" size="50" name="edit" value="Edit" class="text" onclick="newsubmitform (document.getElementById('ranap'),'ranap/form_ranap.php?edit=ok&idxberiobat=<?=$data['IDXBERIOBAT']?>&id_admission=<?=$_POST['id_admission']?>&nomr=<?=$_POST['nomr']?>&kddokter=<?=$_POST['kddokter']?>&jenis=<?=$data['JENIS']?>&nama=<?=$data['NAMA']?>&tanggal=<?=$data['TANGGAL']?>&waktu=<?=$data['WAKTU']?>&keterangan=<?=$data['KETERANGAN']?>','loadform',validatetask); return false;"/></td>
  </tr>
<?php } ?>
</table>
</div>
<input type="button" class="text" value="PRINT" onclick="printIt()" />
