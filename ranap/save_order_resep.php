<? session_start(); 
include("../include/connect.php");

if(isset($_POST['resep'])){
	if($_POST['resep']==""){
		echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
		echo"<p><strong>Maaf Resep Belum Diisi</strong></p>";
	    echo "</div>";	
	}else{
	$max = mysql_query("SELECT nomor FROM m_maxnorsp WHERE bulan=month(current_date()) and tahun=year(current_date())");
	$data = mysql_fetch_assoc($max);
	$maxnorsp=$data['nomor'];

	if(!$maxnorsp){
		$maxnorsp = 1;
		mysql_query("insert into m_maxnorsp (tahun,bulan,nomor) values( year(current_date()),month(current_date()),".$maxnorsp.")");
	}else{
		$maxnorsp = $maxnorsp+1;
		mysql_query("update m_maxnorsp set nomor=".$maxnorsp." where bulan=month(current_date()) and tahun=year(current_date())");	 
	}

		$sql = "INSERT INTO t_resep (IDXRESEP, IDXDAFTAR, NORESEP, TANGGAL, KDDOKTER, KDPOLY, NOMR, KDOBAT, NAMAOBAT, JUMLAH, ATURANPAKAI, KETERANGAN, NIP, STATUS, tgl_save) VALUES ('', '$_POST[id_admission]', '$maxnorsp', now(), '$_POST[kddokter]', '11', '$_POST[nomr]', '', '', '', '', '$_POST[resep]', '$_SESSION[NIP]', '0', now())";
		$qry = mysql_query($sql)or die(mysql_error());
		echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
		echo "<div style='color:#090;'><strong>Input Data Sukses!</strong></div>";
		echo "</div>";	
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
    <th>No Resep</th>
    <th>Tanggal</th>
    <th>Resep</th>
  </tr>
<?php 
$sql = "SELECT * FROM t_resep WHERE IDXDAFTAR = '$id_admission'";
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
    <td><? echo $data['NORESEP'];?></td>
    <td><? echo $data['TANGGAL'];?></td>
    <td><? echo $data['KETERANGAN'];?></td>
  </tr>
<?php } ?>
</table>
</div>
<input type="button" class="text" value="PRINT" onclick="printIt()" />
