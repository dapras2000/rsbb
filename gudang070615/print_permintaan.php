<?php include("../include/connect.php");
		
		$sql_x = "SELECT DISTINCT
			t_permintaan_barang.`NO`,
			t_permintaan_barang.NIP,
			t_permintaan_barang.KDUNIT,
			DATE_FORMAT(t_permintaan_barang.tglpesan, '%d -%m -%Y') as tglpesan,
			t_permintaan_barang.status_save,
			m_login.DEPARTEMEN
		FROM t_permintaan_barang
		INNER JOIN m_login ON (t_permintaan_barang.KDUNIT = m_login.KDUNIT)
		INNER JOIN m_barang ON (t_permintaan_barang.kodebarang = m_barang.kode_barang)
		WHERE  m_barang.farmasi = '1' AND status_save = '0' AND t_permintaan_barang.`NO` = '".$_GET['NO']."'";
		
$get_x = mysql_query($sql_x);
$dat_x = mysql_fetch_assoc($get_x);
		$sqlorder = "SELECT 
						  t_permintaan_barang.IDXBARANG,
						  m_barang.kode_barang,
						  m_barang.nama_barang,
						  t_permintaan_barang.KDUNIT,
						  m_barang_group.nama_group,
						  m_barang.no_batch,
						  DATE_FORMAT(m_barang.expiry, '%d -%m -%Y') as expiry,
						  m_barang.satuan,
		  			      DATE_FORMAT(t_permintaan_barang.tglpesan, '%d -%m -%Y') as tglpesan,
						  t_permintaan_barang.jumlahpesan,
						  t_permintaan_barang.status_save,
						  t_permintaan_barang.statusacc,
					      DATE_FORMAT(t_permintaan_barang.tglkeluar, '%d -%m -%Y') as tglkeluar,
						  t_permintaan_barang.jmlkeluar,
						  t_permintaan_barang.NIP_keluar,
						  t_permintaan_barang.jmlkeluar_temp,
						  t_permintaan_barang.`NO`,
						  (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND KDUNIT = 
						   t_permintaan_barang.KDUNIT ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR
						FROM
						  t_permintaan_barang
						  INNER JOIN m_barang ON (t_permintaan_barang.kodebarang = m_barang.kode_barang)
						   INNER JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang)
  AND (m_barang.farmasi = m_barang_group.farmasi)
						WHERE  t_permintaan_barang.`NO` = '".$_GET['NO']."' AND m_barang.farmasi = '1' ";
?>
   
    <fieldset class="fieldset">
      <legend>Permintaan Barang </legend>
        <p>
        <table class="tb">
          <tr>
              <td>Tanggal &nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td>: &nbsp;&nbsp;<?=$dat_x['tglpesan']?></td>
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
          <th>No Batch</th>
          <th>Jml Pesan</th>
          <th>Satuan</th>
          <th>Tanggal Pesan</th>
          <th>Stok Unit</th>
       </tr>
<?php        
   $roworder = mysql_query($sqlorder)or die(mysql_error()); 
   $i = 1;
   $nobatch = "";
   while ( $dataorder = mysql_fetch_array($roworder)){
?>
  <tr>
          <td><?=$dataorder['kode_barang']; $nobatch = $dataorder['NO'];?></td>
          <td><?=$dataorder['nama_barang']?></td>
          <td><?=$dataorder['no_batch'];?></td>
          <td align="right"><?=$dataorder['jumlahpesan']?></td>
          <td><?=$dataorder['satuan']?></td>
          <td><?=$dataorder['tglpesan']?></td>
          <td align="right"><?=$dataorder['STOKAKHIR']?></td>
        
  </tr>
<?php } ?>        
      </table>
      </div>
     
</fieldset>
<script language="javascript">
window.print();
</script>
   