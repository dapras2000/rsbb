<div align="center">
<div id="frame" style="width:100%">
	<div id="frame_title"><h3>Rekap 10 Penyakit Terbanyak</h3></div>
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

$peringkat = 0;
if(!empty($_GET['peringkat'])) {
    $peringkat =$_GET['peringkat'];
}


?>
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
    <td>Peringkat</td>
    <td><input type="text" name="peringkat" id="peringkat"  class="text" value="<?  echo $peringkat;?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
    <input type="hidden" name="link" value="private24" /></td>
  </tr>
</table>

    </form>     
<br />
<!--<div style="overflow:scroll;width:98%;height:auto;">-->
<!--<table width="148%" style="font-size:9px;" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">-->
<table  style="font-size:9px;" border="0" align="center" class="tb" cellpadding="1" cellspacing="1">
  <tr>

    <th colspan="6">Kunjungan Rawat Jalan</th>
  </tr>
  <tr>
    <th colspan="3">Penyakit Terbanyak</th>
    </tr>
  <tr>
    <th>ICD</th>
    <th>Nama</th>
    <th>Jumlah</th>
    </tr>
  <?php  
  $sql = "SELECT a.ICD_CODE,b.jenis_penyakit, COUNT(a.ICD_CODE) AS jumlah FROM t_diagnosadanterapi a,icd b WHERE a.icd_code=b.icd_code and a.tanggal BETWEEN '$tgl_kunjungan' and '$tgl_kunjungan2' GROUP BY a.ICD_CODE ORDER BY jumlah DESC limit ".$peringkat;
       $rs=mysql_query($sql);
	  if(!$rs) die(mysql_error());
       while ($data = mysql_fetch_array($rs)) {
		 
		   ?>
<tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>    
    <td width="33"><?=$data['ICD_CODE'];?></td>
    <td width="33"><?=$data['jenis_penyakit'];?></td>
    <td width="33"><?=$data['jumlah'];?></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
   
  </tr>
  
</table><br />
</div>
</div></div>
