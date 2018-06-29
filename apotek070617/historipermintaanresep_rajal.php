<?php session_start();
include '../include/connect.php';
include '../include/function.php';
?>

<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>HISTORY PERMINTAAN OBAT</h3></div>
        <div align="left" style="margin:5px;">
            <div id="idpasien" >
                <fieldset class="fieldset" >
                    <legend>Detail Pasien</legend>
                   <?php
                   $sql_x = 'Select b.NAMADOKTER as namadokter, c.nama as namapoli, DATE_FORMAT(a.tgl_pesan, "%d -%m -%Y") as tgl_pesan, a.norm as NOMR, d.NAMA as NAMA, 
                                d.ALAMAT as ALAMAT, e.NAMA as carabayar, a.idxdaftar, a.no
                                from t_permintaan_apotek_rajal a
                                JOIN m_dokter b ON a.kddokter=b.KDDOKTER
                                JOIN m_poly c ON a.kdpoli=c.kode
                                JOIN m_pasien d ON a.norm=d.NOMR
                                JOIN m_carabayar e ON a.kdcarabayar=e.KODE
                                WHERE a.status_save="1" and a.no = "'.$_GET['no'].'" group by a.tgl_pesan, a.norm, a.kdpoli, a.idxdaftar' ;

					$get_x = mysql_query($sql_x);
					$dat_x = mysql_fetch_assoc($get_x);
					
					$sqlorder = "Select a.idxpesanobat, b.NAMADOKTER as namadokter, c.nama as namapoli, DATE_FORMAT(a.tgl_pesan, '%d -%m -%Y') as tgl_pesan, a.norm as NOMR, d.NAMA as NAMA, 
								d.ALAMAT as ALAMAT, e.NAMA as carabayar, a.idxdaftar, a.no,f.nama_barang,a.kode_obat,f.no_batch,
								f.expiry, a.jmlh_pesan, f.satuan, a.koderacik, a.jmlh_keluar, a.tgl_keluar, a.aturan_pakai,
								(SELECT saldo FROM t_barang_stok WHERE kode_barang = f.kode_barang AND KDUNIT = 14 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR
								
								from t_permintaan_apotek_rajal a
								JOIN m_dokter b ON a.kddokter=b.KDDOKTER
								JOIN m_poly c ON a.kdpoli=c.kode
								JOIN m_pasien d ON a.norm=d.NOMR
								JOIN m_carabayar e ON a.kdcarabayar=e.KODE
								JOIN m_barang f ON a.kode_obat=f.kode_barang
								WHERE a.status_save='1' and f.farmasi = '1'  and a.no = '".$_GET['no']."'
								UNION
								Select a.idxpesanobat, b.NAMADOKTER as namadokter, c.nama as namapoli, DATE_FORMAT(a.tgl_pesan, '%d -%m -%Y') as tgl_pesan, a.norm as NOMR, d.NAMA as NAMA, 
								d.ALAMAT as ALAMAT, e.NAMA as carabayar, a.idxdaftar, a.no,f.nama_obat,a.kode_obat,f.no_batch,
								f.expiry, a.jmlh_pesan, f.satuan, a.koderacik,a.jmlh_keluar, a.tgl_keluar, a.aturan_pakai,
								(SELECT saldo FROM t_barang_stok WHERE kode_barang = a.kode_obat AND KDUNIT = 14 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR
								
								from t_permintaan_apotek_rajal a
								JOIN m_dokter b ON a.kddokter=b.KDDOKTER
								JOIN m_poly c ON a.kdpoli=c.kode
								JOIN m_pasien d ON a.norm=d.NOMR
								JOIN m_carabayar e ON a.kdcarabayar=e.KODE
								JOIN m_obat f ON a.kode_obat=f.kode_obat
								WHERE a.status_save='1' and f.farmasi = '1'  and a.no = '".$_GET['no']."'
								UNION
								Select a.idxpesanobat, b.NAMADOKTER as namadokter, c.nama as namapoli, DATE_FORMAT(a.tgl_pesan, '%d -%m -%Y') as tgl_pesan, a.norm as NOMR, d.NAMA as NAMA, 
								d.ALAMAT as ALAMAT, e.NAMA as carabayar, a.idxdaftar, a.no,f.nama_tindakan,a.kode_obat,  f.asisten_rad, f.asisten_rad, a.jmlh_pesan, f.asisten_rad, 
								a.koderacik, a.jmlh_keluar, a.tgl_keluar, a.aturan_pakai,
								(SELECT saldo FROM t_barang_stok WHERE kode_barang = a.kode_obat AND KDUNIT = 14 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR
								
								from t_permintaan_apotek_rajal a
								JOIN m_dokter b ON a.kddokter=b.KDDOKTER
								JOIN m_poly c ON a.kdpoli=c.kode
								JOIN m_pasien d ON a.norm=d.NOMR
								JOIN m_carabayar e ON a.kdcarabayar=e.KODE
								JOIN m_tarif2012 f ON a.kode_obat=f.kode_tindakan
								WHERE a.status_save='1'  and a.no = '".$_GET['no']."'
								";
								
				
                    ?>

                    <table width="50%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>No MR</td>
                            <td>: <?php echo $dat_x['NOMR'];?></td>
                        </tr>
                        <tr>
                            <td width="21%">Nama </td>
                            <td width="79%">: <?php echo $dat_x['NAMA'];?></td>
                        </tr>
						<tr>
                            <td width="21%">Alamat </td>
                            <td width="79%">: <?php echo $dat_x['ALAMAT'];?></td>
                        </tr>
                        <tr>
                            <td valign="top">Dokter</td>
                            <td>: <?php echo $dat_x['namadokter'];?></td>
                        </tr>
                        <tr>
                            <td valign="top">Poli</td>
                            <td>: <?php echo $dat_x['namapoli'];?></td>
                        </tr>
                        <tr>
                            <td valign="top">Tanggal</td>
                            <td>: <?php echo $dat_x['tgl_pesan'];?></td>
                        </tr>
                        <tr>
                            <td valign="top">Cara Bayar</td>
                            <td>: <?php echo $dat_x['carabayar'];?></td>
                        </tr>
                                               
                    </table>
                </fieldset>
            </div>
           			
			<div id="listbarang" >
                <table class="tb" cellpadding="1">
                    <tr>
						<!--<th width="30px" align="center">Kode Barang</th>-->
						<th>Nama Obat</th>
                        <th>No Batch</th>
                        <th>Tgl Kadaluarsa</th>
                        <th>Jmlh Didisetujui</th>
                        <th>Satuan</th>
                        <th>Tgl Keluar</th>
						<th>Aturan Pakai</th>
                    </tr>
                    <?php
                    $roworder = mysql_query($sqlorder)or die(mysql_error());
					
                    $i = 1;
                    $no = "";
                    while ( $dataorder = mysql_fetch_array($roworder)) {
                        ?>
                    <tr valign="top">
						<!--<td align="center"><?=$dataorder['kode_obat']?></td>-->
						<?php $no = $dataorder['no'];?>
						<td>
                            <?=$dataorder['nama_barang']?>
                            <br>
                            <?php
                                if (substr($dataorder['kode_obat'],0,1) == "R"){
                                    echo "<table>";
                                    echo "<tr>";
                                    echo "<th width=150px>Nama Racikan</th>";
                                    echo "<th>Jumlh Permintaan</th>";
									echo "<th>Stok Unit</th>";
									echo "<th align='center' width='30px'>Jmlh Didisetujui</th>";
                                    echo "</tr>";
                                    $sqlr = "SELECT *,b.farmasi,a.koderacik, a.jmlh_keluar as jmlh_keluar_acc_racik,
                                            (SELECT saldo FROM t_barang_stok WHERE kode_barang = a.kode_obat AND KDUNIT = 14 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR2
                                                FROM t_permintaan_apotek_rajal_racikan a
                                                JOIN m_barang b ON a.kode_obat=b.kode_barang
                                                JOIN t_permintaan_apotek_rajal c ON a.idxpesanobat=c.idxpesanobat
                                                WHERE a.idxpesanobat=$dataorder[idxpesanobat] and b.farmasi='1' ";
                                            $rowor = mysql_query($sqlr)or die(mysql_error());
                                            while ( $datar = mysql_fetch_array($rowor)) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $datar['nama_barang'];
                                    echo "</td>";
                                    echo "<td align='center'>";
                                    echo $datar['jumlah'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $datar['STOKAKHIR2'];
                                    echo "</td>";
                                    echo "<td align='center'>";
                                    echo $datar['jmlh_keluar_acc_racik'];
                                    echo "</td>";
                                    echo "</tr>";
                                    }
                                    echo "</table>";
                                }
                            ?>
                        </td>
                        <td><?=$dataorder['no_batch'];?></td>
                        <td><?=$dataorder['expiry'];?></td>
                        <td align="center"><?=$dataorder['jmlh_keluar']?></td>
                        <td><?=$dataorder['satuan']?></td>
                        <td><?=$dataorder['tgl_keluar']?></td>
						<td><?=$dataorder['aturan_pakai']?></td>
                    </tr>
					
    <?php } ?>
                </table>
            </div>

        </div>
    </div>
</div>
