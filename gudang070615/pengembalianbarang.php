<?php
$farmasi ="x";
if($_SESSION['KDUNIT']=="12"){
	 $farmasi ="1";
}else if($_SESSION['KDUNIT']=="13"){
	 $farmasi ="0";
}
		$sql_x = "SELECT DISTINCT 
					  t_pengembalian_barang.tglkeluar,
				      t_pengembalian_barang.NIP,
					  t_pengembalian_barang.KDUNIT,
					   m_login.DEPARTEMEN
				   FROM
					  t_pengembalian_barang
					INNER JOIN m_barang ON (t_pengembalian_barang.kodebarang = m_barang.kode_barang)
					INNER JOIN m_login ON (t_pengembalian_barang.NIP = m_login.NIP)
					WHERE  m_barang.farmasi = '".$farmasi."' AND t_pengembalian_barang.NIP = '".$_GET['nip']."' AND t_pengembalian_barang.KDUNIT = '".$_GET['unit']."'
					AND  t_pengembalian_barang.tglkeluar = '".$_GET['tanggal']."'";
		
$get_x = mysql_query($sql_x);
$dat_x = mysql_fetch_assoc($get_x);
		
		$sqlorder = "SELECT  
					  t_pengembalian_barang.tglkeluar,
					  m_barang.farmasi,
					  t_pengembalian_barang.IDXBARANG,
					  t_pengembalian_barang.NIP,
					  t_pengembalian_barang.KDUNIT,
					  t_pengembalian_barang.kodebarang,
					  m_barang.nama_barang,
					  m_barang.satuan,
					  t_pengembalian_barang.jmlkeluar,
					  t_pengembalian_barang.`status`
					FROM
					  t_pengembalian_barang
					  INNER JOIN m_barang ON (t_pengembalian_barang.kodebarang = m_barang.kode_barang)
					WHERE  m_barang.farmasi = '".$farmasi."' AND t_pengembalian_barang.`status` IS NULL 
					AND t_pengembalian_barang.NIP = '".$_GET['nip']."' AND t_pengembalian_barang.KDUNIT = '".$_GET['unit']."'
					AND  t_pengembalian_barang.tglkeluar = '".$_GET['tanggal']."'";
?>
   
    <fieldset class="fieldset">
      <legend>Pengembalian Barang </legend>
      <p>
        <table class="tb">
          <tr>
              <td>Tanggal &nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td>: &nbsp;&nbsp;<?=$dat_x['tglkeluar']?></td>
          </tr>
          <tr>
              <td>Unit</td>
              <td>: &nbsp;&nbsp;<?=$dat_x['DEPARTEMEN']?></td>
          </tr>
          <tr>
              <td>Nama</td>
              <td>: &nbsp;&nbsp;<?=$dat_x['NIP']?></td>
          </tr>
        </table>
      </p>
      <div id="listbarang" >
      <table class="tb">
        <tr>
          <th>Kode</th>
          <th>Nama Barang</th>
          <th>Jml</th>
          <th>Satuan</th>
          <th>Option</th>
        </tr>
<?php        
   $roworder = mysql_query($sqlorder)or die(mysql_error()); 
   $i = 1;
   $nobatch = "";
   while ( $dataorder = mysql_fetch_array($roworder)){
?>
  <tr>
          <td><?=$dataorder['kodebarang']; $nobatch = $dataorder['NO'];?></td>
          <td><?=$dataorder['nama_barang']?></td>
          <td align="right"><?=$dataorder['jmlkeluar']?></td>
          <td><?=$dataorder['satuan']?></td>
          <td><a href="gudang/savepengembalian.php?idxbarang=<?=$dataorder['IDXBARANG']?>&kdbarang=<?=$dataorder['kodebarang']?>&jml=<?=$dataorder['jmlkeluar']?>&nip=<?=$_GET['nip']?>&tanggal=<?=$_GET['tanggal']?>&unit=<?=$_GET['unit']?>" ><input type="button" value="Terima" class="text" /></a>
		  </td>
  </tr>
<?php } ?>        
      </table>
      </div>
      <br />
       
      </fieldset>

   