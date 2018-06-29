
<?php
			$sqlorder = "SELECT 
					  m_barang_group.nama_group,
					  m_barang.kode_barang,
					  m_barang.no_batch,
				      DATE_FORMAT(m_barang.expiry, '%d -%m -%Y') as expiry,
					  m_barang.nama_barang,
					  m_barang.satuan,
					  t_permintaan_barang.NIP,
					  t_permintaan_barang.KDUNIT,
					  DATE_FORMAT(t_permintaan_barang.tglpesan, '%d -%m -%Y') as tglpesan,
					  t_permintaan_barang.jumlahpesan,
					  DATE_FORMAT(t_permintaan_barang.tglkeluar, '%d -%m -%Y') as tglkeluar,
					  t_permintaan_barang.jmlkeluar,
					  t_permintaan_barang.NIP_keluar,
					  t_permintaan_barang.`NO`,
					  t_permintaan_barang.statusacc
					FROM
					  m_barang
					  INNER JOIN m_barang_group ON (m_barang.farmasi = m_barang_group.farmasi)
					  AND (m_barang.group_barang = m_barang_group.group_barang)
					  INNER JOIN t_permintaan_barang ON (m_barang.kode_barang = t_permintaan_barang.kodebarang)
					WHERE t_permintaan_barang.status_save = '1' AND t_permintaan_barang.NO = '".$_GET['nobatch']."'";
?>
    
    <fieldset class="fieldset">
      <legend>Permintaan Barang </legend>
      <div id="listbarang" >
      <table class="tb" border="0" cellpadding="1" cellspacing="1">
        <tr>
          <th>Kode</th>
          <th>Nama Barang</th>
          <th>Group</th>
          <th>No Batch</th>
          <th>Tgl Expire</th>
          <th>Jumlah Permintaan</th>
          <th>Satuan</th>
          <th>Tanggal Pesan</th>
          <th>Jml Disetujui</th>
          <th>Tgl Disetujui</th>
          <th>Status</th>
          </tr>
<?php        
   $roworder = mysql_query($sqlorder)or die(mysql_error()); 
   $i = 1;
   $nobatch = "";
   while ( $dataorder = mysql_fetch_array($roworder)){
?>
  <tr>
          <td><?=$dataorder['kode_barang']?></td>
          <td><?=$dataorder['nama_barang']?></td>
          <td><?=$dataorder['nama_group']?></td>
          <td><?=$dataorder['no_batch']?></td>
          <td><?=$dataorder['expiry']?></td>
          <td align="right"><?=$dataorder['jumlahpesan']?></td>
          <td><?=$dataorder['satuan']?></td>
          <td><?=$dataorder['tglpesan']?></td>
          <td align="right"><?=$dataorder['jmlkeluar']?></td>
          <td><?=$dataorder['tglkeluar']?></td>
          <td><? if($dataorder['statusacc']=="1"){
		  echo "Disetujui"; } else {
		  echo "Tdk Disetujui"; }?></td>
         
         
  </tr>
<?php } ?>        
      </table>
      </div>
      <br />
     
      </fieldset>