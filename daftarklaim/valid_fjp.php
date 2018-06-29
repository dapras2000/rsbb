
<script language="javascript">
function printIt()
{
content=document.getElementById('print_area');
w=window.open('about:blank');
w.document.write( content.innerHTML );
w.document.writeln("<script>");
w.document.writeln("window.print()");
w.document.writeln("</"+"script>");
}
</script>

<? 
$SQL_MATCH = mysql_query("SELECT IDXFJP FROM t_fjp_jmks WHERE IDXDAFTAR=".$_POST['IDXDAFTAR']);
$QRYCHEX = @mysql_fetch_assoc($SQL_MATCH);

if($QRYCHEX['NOMR']==$_POST['NOMR']){
	$SQL = "UPDATE t_fjp_jmks SET `NOMR`='$_POST[NOMR]', `NIP`='$_POST[NIP]', `TGLPELAYANAN`='$_POST[TGLPELAYANAN]', `NAMAPASIEN`='$_POST[NAMAPASIEN]', `TEMPATLAHIR`='$_POST[TEMPATLAHIR]', `TGLLAHIR`='$_POST[TANGGALLAHIR]', `JENISKELAMIN`='$_POST[JENISKELAMIN]', `NOTELP`='$_POST[NOTELP]', `STATUSJAMINAN`='$_POST[STATUSJAMINAN]', `JENISPELAYANAN`='$_POST[JPELAYANAN]', `PETUGAS`='$_POST[PETUGAS]', `DOKTER`='$_POST[NAMADOKTER]', `DIAGNOSAAWAL`='$_POST[DIAGNOSAAWAL]', `DIAGNOSAAKHIR`='$_POST[DIAGNOSAAKHIR]', `DSEKUNDER1`='$_POST[DSEKUNDER1]', `DSEKUNDER2`='$_POST[DSEKUNDER2]', `DST`='$_POST[DST]', `TINDAKANMEDIS`='$_POST[TINDAKANMEDIS]', `WAKTUCETAK`=now() WHERE IDXDAFTAR='$_POST[IDXDAFTAR]'";	
}else{
	$SQL = "INSERT INTO t_fjp_jmks (IDXDAFTAR, NOMR, NIP, TGLPELAYANAN, NAMAPASIEN, TEMPATLAHIR, TGLLAHIR, JENISKELAMIN, NOTELP, STATUSJAMINAN, JENISPELAYANAN, PETUGAS, DOKTER, DIAGNOSAAWAL, DIAGNOSAAKHIR, DSEKUNDER1, DSEKUNDER2, DST, TINDAKANMEDIS, WAKTUCETAK) VALUES ('$_POST[IDXDAFTAR]','$_POST[NOMR]','$_POST[NIP]','$_POST[TGLPELAYANAN]','$_POST[NAMAPASIEN]','$_POST[TEMPATLAHIR]','$_POST[TANGGALLAHIR]','$_POST[JENISKELAMIN]','$_POST[NOTELP]','$_POST[STATUSJAMINAN]','$_POST[JPELAYANAN]','$_POST[PETUGAS]','$_POST[NAMADOKTER]','$_POST[DIAGNOSAAWAL]','$_POST[DIAGNOSAAKHIR]','$_POST[DSEKUNDER1]','$_POST[DSEKUNDER2]','$_POST[DST]','$_POST[TINDAKANMEDIS]',now())";
}
$QRY = mysql_query($SQL)or die(mysql_error());

//kondisi
if($QRY){
?>
<div align="center" style="margin-top:0px;"><div id="frame"><div id="frame_title"><h3>Print FJP</h3></div>
<div id="print_area" style="font-size:18px; font-family:Verdana, Geneva, sans-serif">
<? 
$SQL_FJP = "SELECT * FROM t_fjp_jmks WHERE IDXDAFTAR='".$_POST['IDXDAFTAR']."'  order by idxfjp desc limit 1";
$QUERY_FJP = mysql_query($SQL_FJP)or die(mysql_error());
$FILES = mysql_fetch_assoc($QUERY_FJP);
?>
<table cellspacing="0" width="1000" cellpadding="0" border="0" class="tb" style="font-size:16px; font-family:Verdana, Geneva, sans-serif">
	  <tr>
		<td colspan="5"> 
      				<div style="letter-spacing:-1px; font-size:20px; font:bold;">&nbsp;</div>
                    <div style="letter-spacing:-2px; font-size:28px; color:#666; font:bold;">&nbsp;</div>
        <div></div>        
        </td>
                
      </tr>
	  <tr>
	    <td colspan="5"><!--<hr style="margin:5px;" />-->&nbsp;</td>
      </tr>
	  <tr>
	    <td colspan="5"><h2>FORMULIR JAMINAN PELAYANAN (FJP)</h2></td>
      </tr>
	  <tr>
	    <td width="175">DATA PASIEN</td>
	    <td width="179"></td>
	    <td width="138"></td>
	    <td colspan="2">RINGKASAN PELAYANAN</td>
      </tr>
	  <tr>
	    <td>Nama Pasien</td>
	    <td>: <?=$FILES['NAMAPASIEN']?></td>
	    <td></td>
	    <td width="149">Diagnosa Awal</td>
	    <td width="309">: <?=$FILES['DIAGNOSAAWAL']?></td>
      </tr>
	  <tr>
	    <td>Tempat Lahir</td>
	    <td colspan="2">: <?=$FILES['TEMPATLAHIR']?></td>
	    <td>Diagnosa Akhir</td>
	    <td>: <?=$FILES['DIAGNOSAAKHIR']?></td>
      </tr>
	  <tr>
	    <td>Tanggal Lahir</td>
	    <td>: <?=$FILES['TGLLAHIR'];?></td>
	    <td></td>
	    <td></td>
	    <td>: <?=$FILES['DSEKUNDER1']?></tr>
	  <tr>
	    <td>Usia</td>
	    <td colspan="2">: <?php 
		  if ($FILES['TGLLAHIR']==""){
			  $a = datediff(date("Y/m/d"), date("Y/m/d"));
		  }
		  else {
		       $a = datediff($FILES['TGLLAHIR'], date("Y/m/d"));
		  }
		  ?>
          <?php echo 'umur '.$a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?></td>
	    <td></td>
	    <td>: <?=$FILES['DSEKUNDER2']?></td>
      </tr>
	  <tr>
	    <td>Jenis kelamin</td>
	    <td colspan="2">: <?=$FILES['JENISKELAMIN']?></td>
	    <td></td>
	    <td>: <?=$FILES['DST']?></td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td>Tindakan Medis</td>
	    <td>: <?=$FILES['TINDAKANMEDIS']?></td>
      </tr>
	  <tr>
	    <td colspan="2">DATA KUNJUNGAN</td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td>No. Rekam Medis</td>
	    <td colspan="2">: <?=$FILES['NOMR']?></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td>Status Jaminan</td>
	    <td colspan="2">: <?=$FILES['STATUSJAMINAN']?></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td colspan="2">&nbsp;</td>
	    <td></td>
	    <td></td>
	    <td></td>
	    </tr>
	  <tr>
	    <td colspan="2">DATA PELAYANAN</td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td>Tanggal Pelayanan</td>
	    <td colspan="2">: <?=date("d-m-Y")?></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td>Jenis Pelayanan</td>
	    <td colspan="2">: <?=$FILES['JENISPELAYANAN']?></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td colspan="2">Pasien/Keluarga    Pasien,</td>
	    <td>Petugas Verifikasi,</td>
	    <td></td>
	    <td>Dokter yg Memeriksa,</td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td></td>
	    <td>&nbsp;</td>
	    <td></td>
	    <td>&nbsp;</td>
      </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td></td>
	    <td>&nbsp;</td>
	    <td></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td></td>
	    <td>&nbsp;</td>
	    <td></td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td><U><?=$FILES['NAMAPASIEN']?></U></td>
	    <td></td>
	    <td><u><?=$FILES['PETUGAS']?></u></td>
	    <td></td>
	    <td><u><?=$FILES['DOKTER']?></u></td>
	    </tr>
	  <tr>
	    <td colspan="2">&nbsp;</td>
	    <td></td>
	    <td></td>
	    <td>NIP.<u><?=$FILES['NIP']?></u></td>
	    </tr>
	  <tr>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <td></td>
      </tr>
	  <tr>
	    <td>No. Tlp :
          <?=$FILES['NOTELP']?></td>
	    <td></td>
	    <td></td>
	    <td></td>
	    <!--<td>dicetak oleh:<?//=$FILES['PETUGAS']?> &lt;dicetak 4 kali&gt;</td>-->
        <td></td>
      </tr>
	  <tr>
	    <td colspan="4">&nbsp;</td>
	    <!--<td>waktu cetak: <?//=$FILES['WAKTU']?> WIB</td>-->
        <td></td>
	    </tr>
	  </table>
</div>
</div>
<span style="color:#0C0"> Sukses! </span>
    <a href=""><input class="text" type="button" onclick="printIt()" value="Print" /></a>
</div>
<?
}
?>

 