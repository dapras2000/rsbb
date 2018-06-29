<?php session_start();
include '../include/connect.php';
include '../include/function.php';
?>

<script type='text/javascript' src='<?php echo _BASE_;?>js/facebox.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo _BASE_;?>css/facebox.css" />


<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>LIST PERMINTAAN OBAT</h3></div>
        <div align="left" style="margin:5px;">
            <div id="idpasien" >
                <fieldset class="fieldset">
                    <legend>Detail Pasien</legend>
                   <?php
                   $sql_x = 'Select b.NAMADOKTER as namadokter, c.nama as namapoli, DATE_FORMAT(a.tgl_pesan, "%d -%m -%Y") as tgl_pesan, a.norm as NOMR, d.NAMA as NAMA, 
                                d.ALAMAT as ALAMAT, e.NAMA as carabayar, a.idxdaftar, a.no
                                from t_permintaan_apotek_rajal a
                                JOIN m_dokter b ON a.kddokter=b.KDDOKTER
                                JOIN m_poly c ON a.kdpoli=c.kode
                                JOIN m_pasien d ON a.norm=d.NOMR
                                JOIN m_carabayar e ON a.kdcarabayar=e.KODE
                                WHERE a.status_save="0" and a.no = "'.$_GET['no'].'" group by a.tgl_pesan, a.norm, a.kdpoli, a.idxdaftar' ;

					$get_x = mysql_query($sql_x);
					$dat_x = mysql_fetch_assoc($get_x);
					
					$sqlorder = "Select a.idxpesanobat, b.NAMADOKTER as namadokter, c.nama as namapoli, DATE_FORMAT(a.tgl_pesan, '%d -%m -%Y') as tgl_pesan, a.norm as NOMR, d.NAMA as NAMA, 
								d.ALAMAT as ALAMAT, e.NAMA as carabayar, a.idxdaftar, a.no,f.nama_barang,a.kode_obat,f.no_batch,
								f.expiry, a.jmlh_pesan, f.satuan, a.koderacik, 
								(SELECT saldo FROM t_barang_stok WHERE kode_barang = f.kode_barang AND KDUNIT = 14 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR
								
								from t_permintaan_apotek_rajal a
								JOIN m_dokter b ON a.kddokter=b.KDDOKTER
								JOIN m_poly c ON a.kdpoli=c.kode
								JOIN m_pasien d ON a.norm=d.NOMR
								JOIN m_carabayar e ON a.kdcarabayar=e.KODE
								JOIN m_barang f ON a.kode_obat=f.kode_barang
								WHERE a.status_save='0' and f.farmasi = '1'  and a.no = '".$_GET['no']."'
								UNION
								Select a.idxpesanobat, b.NAMADOKTER as namadokter, c.nama as namapoli, DATE_FORMAT(a.tgl_pesan, '%d -%m -%Y') as tgl_pesan, a.norm as NOMR, d.NAMA as NAMA, 
								d.ALAMAT as ALAMAT, e.NAMA as carabayar, a.idxdaftar, a.no,f.nama_obat,a.kode_obat,f.no_batch,
								f.expiry, a.jmlh_pesan, f.satuan, a.koderacik,
								(SELECT saldo FROM t_barang_stok WHERE kode_barang = a.kode_obat AND KDUNIT = 14 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR
								
								from t_permintaan_apotek_rajal a
								JOIN m_dokter b ON a.kddokter=b.KDDOKTER
								JOIN m_poly c ON a.kdpoli=c.kode
								JOIN m_pasien d ON a.norm=d.NOMR
								JOIN m_carabayar e ON a.kdcarabayar=e.KODE
								JOIN m_obat f ON a.kode_obat=f.kode_obat
								WHERE a.status_save='0' and f.farmasi = '1'  and a.no = '".$_GET['no']."'
								UNION
								Select a.idxpesanobat, b.NAMADOKTER as namadokter, c.nama as namapoli, DATE_FORMAT(a.tgl_pesan, '%d -%m -%Y') as tgl_pesan, a.norm as NOMR, d.NAMA as NAMA, 
								d.ALAMAT as ALAMAT, e.NAMA as carabayar, a.idxdaftar, a.no,f.nama_tindakan,a.kode_obat,  f.asisten_rad, f.asisten_rad, a.jmlh_pesan, f.asisten_rad, 
								a.koderacik,(SELECT saldo FROM t_barang_stok WHERE kode_barang = a.kode_obat AND KDUNIT = 14 ORDER BY tanggal DESC, kd_stok DESC LIMIT 1 ) AS STOKAKHIR
								
								from t_permintaan_apotek_rajal a
								JOIN m_dokter b ON a.kddokter=b.KDDOKTER
								JOIN m_poly c ON a.kdpoli=c.kode
								JOIN m_pasien d ON a.norm=d.NOMR
								JOIN m_carabayar e ON a.kdcarabayar=e.KODE
								JOIN m_tarif2012 f ON a.kode_obat=f.kode_tindakan
								WHERE a.status_save='0'  and a.no = '".$_GET['no']."'
								";
								
				
                    ?>

                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>No MR</td>
                            <td>: <?php echo $dat_x['NOMR'];?></td>
                        </tr>
                        <tr>
                            <td width="21%">Nama Pasien</td>
                            <td width="79%">: <?php echo $dat_x['NAMA'];?></td>
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
                <table class="tb" cellpadding="1" width="100%">
                    <tr>
						<th>Nama Barang</th>
                        <th>No Batch</th>
                        <th>Tgl Kadaluarsa</th>
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
					
                    $i1 = 1;
                    $i2 = 1;
                    $i3 = 1;
                    $i4 = 1;
                    $no = "";
                    while ( $dataorder = mysql_fetch_array($roworder)) {
                        ?>
                    <tr valign="top">
						<td>
                            <?=$dataorder['nama_barang'];?>
                            <?php if (substr($dataorder['kode_obat'],0,1) == "R"){ ?>
                                    <script>
                                    jQuery(document).ready(function(){
                                        jQuery('#add_detail_racikan'+<?php echo $i1++; ?>).click(function(){ 
                                            jQuery.facebox.settings.overlay = 'false';
                                            jQuery.facebox(function() {
                                                var idxpesanobat     = jQuery('#idxpesanobat'+<?php echo $i3++; ?>).val();
                                                jQuery.post('<?php echo _BASE_;?>apotek/form_detail_proses_obatracik_rajal.php?no=<?php echo $_GET[no]; ?>&idxpesanobat='+idxpesanobat,jQuery().serialize(),function(data) {
                                                    jQuery.facebox(data)
                                                })
                                            })
                                        });
                                    });
                                    </script>
                                    <input name="idxpesanobat" id="idxpesanobat<?php echo $i4++; ?>" type="hidden" value="<?php echo $dataorder['idxpesanobat']; ?>" >
                                    <input type='button' value='Detail' id='add_detail_racikan<?php echo $i2++; ?>' class='text' />
                            <?php } ?>
                        </td>
                        <td><?=$dataorder['no_batch'];?></td>
                        <td><?=$dataorder['expiry'];?></td>
                        <td align="right"><?=$dataorder['jmlh_pesan']?></td>
                        <td><?=$dataorder['satuan']?></td>
                        <td><?=$dataorder['tgl_pesan']?></td>
                        <td align="right"><?=$dataorder['STOKAKHIR']?></td>
                        <td align="right"><input type="text" class="text" name="jml<?=$dataorder['idxpesanobat']?>" id="jml<?=$dataorder['idxpesanobat']?>"style="width:30px"/></td>

                        <td><div id="div<?=$dataorder['idxpesanobat']?>" ></div></td>

                        <td align="center"><a href="#" onclick="javascript: MyAjaxRequest('div<?=$dataorder['idxpesanobat']?>','apotek/save_permintaan_obat_rajal.php?cih=<?=$dataorder['kode_obat']?>&amp;idxpesanobat=<?=$dataorder['idxpesanobat']?>&amp;jml_pesan=<?=$dataorder['jmlh_pesan']?>&amp;opt=1&amp;jml=' + document.getElementById('jml<?=$dataorder['idxpesanobat']?>').value); return false;" >Setujui</a>
                             <br>--------<br><a href="#" onclick="javascript: MyAjaxRequest('div<?=$dataorder['idxpesanobat']?>','apotek/save_permintaan_obat_rajal.php?cih=<?=$dataorder['kode_obat']?>&amp;idxpesanobat=<?=$dataorder['idxpesanobat']?>&amp;opt=2'); return false;" >Tidak Disetujui</a>
                        </td>
                    </tr>
					<?php } ?>
                </table>
            </div>
			<a href="apotek/save_permintaan_obat_rajal.php?no=<?php echo $_GET[no]; ?>&amp;opt=3" ><input type="button" value="Simpan" class="text" /></a>
            <div id="autocompletediv" class="autocomp"></div>
            <div id="validbarang" ></div>
        </div>
    </div>
</div>
