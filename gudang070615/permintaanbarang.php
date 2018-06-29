<?php
$farmasi ="x";
if($_SESSION['KDUNIT']=="12") {
    $farmasi ="1";
}else if($_SESSION['KDUNIT']=="13") {
    $farmasi ="0";
}
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
		WHERE  m_barang.farmasi = '".$farmasi."' AND status_save = '0' AND t_permintaan_barang.`NO` = '".$_GET['nobatch']."'";

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
						  (SELECT saldo FROM t_barang_stok WHERE kode_barang = m_barang.kode_barang AND KDUNIT = 12 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR
						FROM
						  t_permintaan_barang
						  INNER JOIN m_barang ON (t_permintaan_barang.kodebarang = m_barang.kode_barang)
						   INNER JOIN m_barang_group ON (m_barang.group_barang = m_barang_group.group_barang)
  AND (m_barang.farmasi = m_barang_group.farmasi)
						WHERE  t_permintaan_barang.`NO` = '".$_GET['nobatch']."' AND m_barang.farmasi = '".$farmasi."' ";
?>

<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>PERMINTAAN BARANG</h3></div>
        <div align="left" style="margin:5px;">
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

            <div id="listbarang" >
                <table class="tb">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>No Batch</th>
                        <th>Tgl Kadaluarsa</th>
                        <th>Group</th>
                        <th>Jml Pesan</th>
                        <th>Satuan</th>
                        <th>Tanggal Pesan</th>
                        <th>Stok Unit</th>
                        <th>Jml Disetujui</th>
                        <th>Status</th>
                        <th>Option</th>
                    </tr>
                    <?php
                    $roworder = mysql_query($sqlorder)or die(mysql_error());
                    $i = 1;
                    $nobatch = "";
                    while ( $dataorder = mysql_fetch_array($roworder)) {
                        ?>
                    <tr>
                        <td><?=$dataorder['kode_barang'];
    $nobatch = $dataorder['NO'];?></td>
                        <td><?=$dataorder['nama_barang']?></td>
                        <td><?=$dataorder['no_batch'];?></td>
                        <td><?=$dataorder['expiry'];?></td>
                        <td><?=$dataorder['nama_group'];?></td>
                        <td align="right"><?=$dataorder['jumlahpesan']?></td>
                        <td><?=$dataorder['satuan']?></td>
                        <td><?=$dataorder['tglpesan']?></td>
                        <td align="right"><?=$dataorder['STOKAKHIR']?></td>
                        <td align="right"><input type="text" class="text" name="jml<?=$dataorder['IDXBARANG']?>" id="jml<?=$dataorder['IDXBARANG']?>"style="width:30px"/></td>

                        <td><div id="div<?=$dataorder['IDXBARANG']?>" ></div></td>

                        <td><a href="#" onclick="javascript: MyAjaxRequest('div<?=$dataorder['IDXBARANG']?>','gudang/saveorderbarangpengeluaran.php?idxbarang=<?=$dataorder['IDXBARANG']?>&amp;opt=1&amp;jml=' + document.getElementById('jml<?=$dataorder['IDXBARANG']?>').value); return false;" >Setujui</a>
                            &nbsp; | <a href="#" onclick="javascript: MyAjaxRequest('div<?=$dataorder['IDXBARANG']?>','gudang/saveorderbarangpengeluaran.php?idxbarang=<?=$dataorder['IDXBARANG']?>&amp;opt=2'); return false;" >Tidak Disetujui</a>
                        </td>
                    </tr>
    <?php } ?>
                </table>
            </div>
            <br />
            <a href="gudang/saveorderbarangpengeluaran.php?nobatch=<?=$nobatch?>&amp;opt=3" ><input type="button" value="Simpan" class="text" /></a>
        </div>
    </div>
</div>
<br />
<form name="formprint" method="get" action="gudang/print_permintaan.php" target="_blank" >
    <input type="hidden" name="NO" value="<?=$_GET['nobatch']?>" />
    <input type="submit" value="P R I N T" class="text" />
</form>
