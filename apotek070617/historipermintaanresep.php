<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>HISTORI RESEP</h3></div>
        <div align="left" style="margin:5px;">

<div id="idpasien" >
   <fieldset class="fieldset">
      <legend>Detail Resep</legend>
<?php
$myquery = "SELECT DISTINCT
				  view_orderresep.CARABAYAR,
				  view_orderresep.NOMR,
				  view_orderresep.NAMA,
				  view_orderresep.ALAMAT,
				  view_orderresep.NAMADOKTER,
				  view_orderresep.KDPOLY,
				  view_orderresep.NAMAPOLY,
				  view_orderresep.NORESEP,
				  view_orderresep.TANGGAL,
				  view_orderresep.NAMAOBAT,
				  view_orderresep.NIP,
				  view_orderresep.IDXRESEP
				FROM
				  view_orderresep
					WHERE view_orderresep.IDXRESEP ='".$_GET['noresep']."'";
  		$get = mysql_query ($myquery)or die(mysql_error());
		$userdata = mysql_fetch_assoc($get); 		
		$nomr=$userdata['NOMR'];
		$nama=$userdata['NAMA'];
		$alamat=$userdata['ALAMAT'];
		$dokter=$userdata['NAMADOKTER'];
		$poly=$userdata['NAMAPOLY'];
		$tanggal=$userdata['TANGGAL'];
		$resep=$userdata['KETERANGAN'];
		$idx=$userdata['IDXRESEP'];
		$cbayar=$userdata['CARABAYAR'];

$sqlresep = "SELECT 
		  m_barang.kode_barang,
		  m_barang.nama_barang,
		  m_barang.no_batch,
		  DATE_FORMAT(m_barang.expiry, '%d -%m -%Y') AS expiry,
	      m_barang.satuan,
		  t_permintaan_apotek.jmlkeluar,
		  DATE_FORMAT(t_permintaan_apotek.tglkeluar, '%d -%m -%Y %H:%i:%s') AS tglkeluar,
		  t_permintaan_apotek.ATURAN,
		  t_permintaan_apotek.non_generik,
		  t_permintaan_apotek.nama_generik
		FROM
		  t_permintaan_apotek
		  LEFT JOIN m_barang ON (t_permintaan_apotek.kodebarang = m_barang.kode_barang)
		WHERE t_permintaan_apotek.IDXRESEP ='".$_GET['noresep']."'";
?>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
       <tr>
          <td>No MR</td>
          <td><?php echo $nomr;?></td>
        </tr>
        <tr>
          <td width="21%">Nama </td>
          <td width="79%"><?php echo $nama;?></td>
        </tr>
        <tr>
          <td valign="top">Alamat</td>
          <td><?php echo $alamat;?></td>
        </tr>
          <tr>
          <td valign="top">Dokter</td>
          <td><?php echo $dokter;?></td>
        </tr>
          <tr>
          <td valign="top">Poly</td>
          <td><?php echo $poly;?></td>
        </tr>
          <tr>
          <td valign="top">Tanggal</td>
          <td><?php echo $tanggal;?></td>
        </tr>
         <tr>
          <td valign="top">Cara Bayar</td>
          <td><?php echo $cbayar;?></td>
        </tr>
          <tr>
          <td valign="top">Resep</td>
          <td rowspan="4"><?php echo $resep;?></td>
        </tr>
          <tr>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top">&nbsp;</td>
          </tr>
      </table>
    </fieldset>
</div>    
    <fieldset class="fieldset">
      <legend>Detail Obat </legend>
      <div id="listbarang" >
      <table class="tb" width="80%">
        <tr>
          <th>Kode</th>
          <th width="35%">Nama Obat</th>
          <th>Jumlah</th>
          <th>Satuan</th>
          <th>Aturan</th>
          <th>Tgl Keluar</th>
          </tr>
<?php        
   $rowresep = mysql_query($sqlresep)or die(mysql_error()); 
   $i = 1;
   $nobatch = "";
   while ($dataresep = mysql_fetch_array($rowresep)){
?>
  <tr>
  
<? 
if($dataresep['non_generik']!="1"){
	$kode_barang = $dataresep['kode_barang'];
	$nama_barang = $dataresep['nama_barang'];
}else{
    $kode_barang = "Non Generik";
	$nama_barang = $dataresep['nama_generik'];
}
?>         
  
          <td><?=$kode_barang?></td>
          <td ><?=$nama_barang?></td>
          <td align="right"><?=$dataresep['jmlkeluar']?></td>
          <td ><?=$dataresep['satuan']?></td>
          <td><?=$dataresep['ATURAN']?></td>
          <td><?=$dataresep['tglkeluar']?></td>
                 
         
  </tr>
<?php } ?>        
      </table>
      </div>
      <br />
     
      </fieldset>
        </div>
        </div>
    </div>