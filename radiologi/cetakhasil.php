<?php include("../include/connect.php"); ?>
<?php require_once("../include/function.php");
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$query_rscetak = "SELECT a.idxorderrad,a.no_film,a.nomr, b.nama as namapasien, b.jeniskelamin, b.tgllahir, a.polypengirim,e.nama, c.namadokter, d.nama_rad as nama_rad, f.kdcarabayar,g.nama as carabayar, a.tglperiksa as tglorder, 
DATE_FORMAT(a.tglperiksa, '%d -%m -%Y') as tglperiksa,
a.tglambil,a.jenisfilm,a.jumlahfilm_baik,a.jumlahfilm_rusak, a.hasilresume,a.diagnosa  FROM t_radiologi a, m_pasien b, m_dokter c, m_radiologi d,m_poly e,t_pendaftaran f, m_carabayar g WHERE a.nomr = b.nomr AND c.kddokter = a.drpengirim AND a.jenisphoto = d.kd_rad AND a.polypengirim=e.kode AND a.nomr=f.nomr and a.idxdaftar=f.idxdaftar and f.kdcarabayar=g.kode and a.jenisfilm <>'' and a.idxorderrad='".$_GET['idorder']."'";
$rscetak = mysql_query($query_rscetak) or die(mysql_error());
$row_rscetak = mysql_fetch_assoc($rscetak);
$totalRows_rscetak = mysql_num_rows($rscetak);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Laporan Hasil Pemeriksaan</title>
<style type="text/css">
<!--
.style3 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }
.style5 {font-size: 11px; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
</head>

<body onLoad="window.print();">
<table width="700" border="0" align="center" cellpadding="1" cellspacing="1">
  <tr>
    <td ><table border="0" cellpadding="0" cellspacing="2" style="font-family:'Courier New', Courier, monospace">
      <tr>
        <td colspan="6" valign="top"><div align="center">
			<div id="head_report" >
            <img src="img/log.png" style="float:left" >
                <div align="left" style="padding:20px">
                    <div style="letter-spacing:-1px; font-size:16px; font:bold;"><?=strtoupper($header1)?></div>
                    <div style="letter-spacing:-2px; font-size:24px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
					<div><?=$header3?><br /><?=$header4?></div>
                    <div> <br /> </div>
                    <hr style="margin:5px;" />
                    <h2>Hasil Pemeriksaan Radiologi</h2>
                </div>            
      </div>
       </div></td>
        </tr>
      <tr>
        <td colspan="2" valign="top"><span class="style3">No. Foto</span></td>
        <td width="216" valign="top"><span class="style3"><?=": ".$row_rscetak['no_film']?></span></td>
        <td width="129" valign="top"><div align="left"><span class="style3">Nama Poliklinik Pengirim</span></div></td>
        <td width="0" valign="top"></td>
        <td width="215" valign="top"><span class="style3"><?php echo ": ".$row_rscetak['nama']; ?></span></td>
      </tr>
      <tr>
        <td width="114" valign="top"><div align="left"><span class="style3">NOMR</span></div></td>
        <td width="8" valign="top"></td>
        <td valign="top"><span class="style3"><?php echo ": ".$row_rscetak['nomr']; ?></span></td>
        <td valign="top"><div align="left"><span class="style3">Dokter Pengirim</span></div></td>
        <td valign="top"></td>
        <td valign="top"><span class="style3"><?php echo ": ".$row_rscetak['namadokter']; ?></span></td>
      </tr>
      <tr>
        <td valign="top"><div align="left"><span class="style3">Nama Pasien</span></div></td>
        <td valign="top">&nbsp;</td>
        <td valign="top"><span class="style3"><?php echo ": ".$row_rscetak['namapasien']; ?></span></td>
        <td valign="top"><div align="left"><span class="style3">Tanggal Periksa</span></div></td>
        <td valign="top"></td>
        <td valign="top"><span class="style3"><?php echo ": ".$row_rscetak['tglperiksa']; ?></span></td>
      </tr>
      <tr>
        <td valign="top"><div align="left"><span class="style3">Jenis Kelamin</span></div></td>
        <td valign="top">&nbsp;</td>
        <td valign="top"><span class="style3"><?php 
		if(strtoupper($row_rscetak['jeniskelamin']=="L")){ echo ": "."Laki - laki"; } else{ echo ": "."Perempuan";}?></span></td>
        <td valign="top"><div align="left"><span class="style3">Jenis Pemeriksaan</span></div></td>
        <td valign="top"></td>
        <td valign="top"><span class="style3">
          <?=": ".$row_rscetak['nama_rad']?>
        </span></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><span class="style3">Umur</span></td>
        <td valign="top"><span class="style3">
          <?php
		  $a = datediff($row_rscetak['tgllahir'], $row_rscetak['tglorder']);
		  echo ": ".$a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?>
        </span></td>
        <td colspan="2" valign="top"><span class="style3">Diagnosa</span></td>
        <td rowspan="2" valign="top"><span class="style3"><?=": ".$row_rscetak['diagnosa']?></span></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><span class="style3">Cara Pembayaran</span></td>
        <td valign="top"><span class="style3"><?=": ".$row_rscetak['carabayar']?></span></td>
        <td colspan="2" valign="top">&nbsp;</td>
        </tr>
<?           
$no_film = substr("00000",0,5-strlen($row_rscetak['idxorderrad'])).$row_rscetak['idxorderrad'];
?>           
      
      <tr>
        <td colspan="6" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="6" valign="top"><span class="style3">Teman Sejawat YTH.</span></td>
        </tr>
      <tr>
        <td colspan="6" valign="top">
          <fieldset style="height:400px">
            <legend class="style3">HASIL RESUME</legend>
            <span class="style5"><?php echo $row_rscetak['hasilresume']; ?></span>
          </fieldset></td>
      </tr>
      <tr>
        <td colspan="2" valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td colspan="2" valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><span class="style3">Petugas :</span></td>
        <td valign="top">&nbsp;</td>
        <td colspan="2" valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" valign="top">
		  <span class="style3">
		  <?
        $sel="select t_radiologi_petugas.namapetugas,t_radiologi_petugas.keterangan, (select m_dokter.NAMADOKTER
		from m_dokter where m_dokter.KDDOKTER = t_radiologi_petugas.namapetugas 
		and t_radiologi_petugas.keterangan = 'DOKTER') as NAMADOKTER from t_radiologi_petugas 
		where idxorderrad='".$_GET['idorder']."'";
		$hasil=mysql_query($sel);
		while($baris=@mysql_fetch_array($hasil))
		{
		if ($baris[1]=='PETUGAS')
		{
		echo $baris[0];
		}
		else
		{
		$dok=$baris[2];
		}
			
		echo "<br>";
		}
		?>
		  </span></td>
        <td colspan="3" valign="top"><div align="right" class="style3">Jakarta, 
          <?=date('d M Y');?><br> Dokter Pemeriksa<BR><BR><BR><BR><BR>
        <?=$dok;?>
        </div></td>
        </tr>
      <tr>
        <td colspan="2" valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        <td colspan="2" valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($rscetak);
?>
