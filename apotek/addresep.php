<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title"><h3>TAMBAH RESEP</h3></div>
        <div align="left" style="margin:5px;">
            <div id="idpasien" >
                <fieldset class="fieldset">
                    <legend>Detail Resep</legend>
                    <?php
                    $xquery = "SELECT
  m_login.NIP,
  m_login.DEPARTEMEN,
  m_login.KDUNIT
FROM
  m_login
WHERE  m_login.NIP='".$_SESSION['NIP']."'";
                    $xget = mysql_query ($xquery)or die(mysql_error());
                    $xdata = mysql_fetch_assoc($xget);
                    $nip=$xdata['NIP'];
                    $kdunit=$xdata['KDUNIT'];
                    $bagian=$xdata['DEPARTEMEN'];


                    $myquery = "SELECT DISTINCT
				  view_orderresep.CARABAYAR,
				  view_orderresep.NOMR,
				  view_orderresep.NAMA,
				  view_orderresep.ALAMAT,
				  view_orderresep.TGLLAHIR,
				  view_orderresep.NAMADOKTER,
				  view_orderresep.KDPOLY,
				  view_orderresep.NAMAPOLY,
				  view_orderresep.NORESEP,
				  view_orderresep.TANGGAL,
				  view_orderresep.NAMAOBAT,
				  view_orderresep.NIP,
				  view_orderresep.IDXRESEP,
				  view_orderresep.KETERANGAN,
				  CONCAT(view_orderresep.NORESEP, MONTH(view_orderresep.TANGGAL), YEAR(view_orderresep.TANGGAL)) AS XNORESEP
				FROM
				  view_orderresep
				WHERE CONCAT(view_orderresep.NORESEP, MONTH(view_orderresep.TANGGAL), YEAR(view_orderresep.TANGGAL)) ='".$_GET['noresep']."'";
                    $get = mysql_query ($myquery)or die(mysql_error());
                    $userdata = mysql_fetch_assoc($get);
                    $nomr=$userdata['NOMR'];
                    $nama=$userdata['NAMA'];
                    $alamat=$userdata['ALAMAT'];
                    $dokter=$userdata['NAMADOKTER'];
                    $poly=$userdata['NAMAPOLY'];
                    $tanggal=$userdata['TANGGAL'];
                    $idx=$userdata['IDXRESEP'];
                    $cbayar=$userdata['CARABAYAR'];
                    $nip_resep=$userdata['NIP'];
                    $noresep=$userdata['XNORESEP'];

                    $tgl = date("d M Y");
                    $a = datediff($userdata['TGLLAHIR'], date("Y/m/d"));

                    $sql_resep = "SELECT t_resep_detail.NAMA_OBAT, t_resep_detail.SEDIAAN, t_resep_detail.ATURAN_PAKAI, t_resep_detail.JUMLAH
  			FROM t_resep_detail
			WHERE CONCAT(t_resep_detail.NORESEP, MONTH(t_resep_detail.TANGGAL), YEAR(t_resep_detail.TANGGAL)) = '".$noresep."'";
                    $get_resep = mysql_query($sql_resep);
                    if(!empty($userdata['KETERANGAN'])) {
                        $resep=$userdata['KETERANGAN'];
                    }else {
                        $resep = "<p>";
                        while($dat_resep = mysql_fetch_array($get_resep)) {

                            $resep = $resep ." ".$dat_resep['NAMA_OBAT']."
		".$dat_resep['JUMLAH']." ".$dat_resep['SEDIAAN']." 
		".$dat_resep['ATURAN_PAKAI']."<br>";

                        }
                        $resep = $resep."</p>";
                    }
                    ?>

                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>No MR</td>
                            <td>: <?php echo $nomr;?></td>
                        </tr>
                        <tr>
                            <td width="21%">Nama Pasien</td>
                            <td width="79%">: <?php echo $nama;?></td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td>: <?php echo $a[years].' tahun '.$a[months].' bulan '.$a[days].' hari'; ?></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td valign="top">Alamat</td>
                            <td>: <?php echo $alamat;?></td>
                        </tr>
                        <tr>
                            <td valign="top">Dokter</td>
                            <td>: <?php echo $dokter;?></td>
                        </tr>
                        <tr>
                            <td valign="top">Unit/Ruang</td>
                            <td>: <?php echo $poly;?></td>
                        </tr>
                        <tr>
                            <td valign="top">Tanggal</td>
                            <td>: <?php echo $tanggal;?></td>
                        </tr>
                        <tr>
                            <td valign="top">Cara Bayar</td>
                            <td>: <?php echo $cbayar;?></td>
                        </tr>
                        <tr>
                            <td valign="top">Resep</td>
                            <td rowspan="4">: <?php echo $resep;?></td>
                        </tr>
                        <tr>
                            <td valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                            <td valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                            <td valign="top"><a href="apotek/printresep.php?noresep=<? echo $noresep; ?>" class="text" target="_blank">
                                    PRINT RESEP</a></td>
                        </tr>
                    </table>
                </fieldset>
            </div>
            <fieldset class="fieldset">
                <legend>Add Obat </legend>
                <form name="addbarang" id="addbarang" method="post" action="apotek/addobatresep.php" >
                    <table>
                        <tr>
                            <td width="92">Tanggal</td>
                            <td width="342"><input type="text" class="text" name="tgl"  value="<?=date('Y-m-d H:i:s')?>" readonly="readonly" /></td>
                        </tr>
                        <tr>
                            <td>Nama Obat</td>
                            <td><input type="text" class="text" name="nm_barang"  id="nm_barang" style="width:250px" onkeypress="autocomplete_apotek(this.value, event)"  onblur="document.getElementById('autocompletediv'); Efect.appear('autocompletediv'); " /></td>
                        </tr>
                        <tr>
                            <td>Kode Obat</td>
                            <td><input type="text" class="text" name="kd_barang" id="kd_barang" readonly="readonly"/></td>
                        </tr>
                        <tr>
                            <td>No Batch</td>
                            <td><input type="text" name="no_batch"  id="no_batch" class="text" readonly="readonly"/></td>
                        </tr>
                        <tr>
                            <td>Tgl Kadaluarsa</td>
                            <td><input type="text" name="tgl_kadaluarsa"  id="tgl_kadaluarsa" class="text" readonly="readonly"/></td>
                        </tr>

                        <tr>
                            <td>Jumlah </td>
                            <td><input type="text" class="text" name="jml_permintaan" id="jml_permintaan" /></td>
                        </tr>
                        <tr>
                            <td>Aturan Minum </td>
                            <td><select name="aturan" id="aturan" >
     <option value="-" > -- </option>
     <option value="3 x 1 tablet" >3 x 1 tablet</option>
     <option value="3 x 1 sendok takar" >3 x 1 sendok takar</option>
     <option value="3 x 1 sendok makan" >3 x 1 sendok makan</option>
     <option value="3 x 0.1 ml" >3 x 0.1 ml</option>
     <option value="3 x 0.2 ml" >3 x 0.2 ml</option>
     <option value="3 x 0.3 ml" >3 x 0.3 ml</option>
     <option value="3 x 0.4 ml" >3 x 0.4 ml</option>
     <option value="3 x 0.5 ml" >3 x 0.5 ml</option>
     <option value="3 x 0.6 ml" >3 x 0.6 ml</option>
     <option value="3 x 0.7 ml" >3 x 0.7 ml</option>
     <option value="3 x 0.8 ml" >3 x 0.8 ml</option>
     <option value="3 x 0.9 ml" >3 x 0.9 ml</option>
     <option value="3 x 2 tetes" >3 x 2 tetes</option>
  </select></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td ><input type="checkbox" name="non_generik" id="non_generik"  value="1" />
                                Non Generik</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td ><input type="checkbox" name="obat_luar" id="obat_luar"  value="1" />
                                Obat Luar</td>
                        </tr>
                        <tr>
                            <td colspan="2" ><input type="submit" class="text" value="A d d" onclick="newsubmitform (document.getElementById('addbarang'),'apotek/addobatresep.php','validbarang',validatetask); document.getElementById('nm_barang').value = ''; document.getElementById('kd_barang').value = '';  document.getElementById('jml_permintaan').value = ''; document.getElementById('aturan').value = '';  document.getElementById('no_batch').value = ''; document.getElementById('tgl_kadaluarsa').value = '';
                                return false;" /></td>
                        </tr>
                    </table>

                    <? $sql_unit_resep = "SELECT KDUNIT FROM m_login WHERE NIP = '".$nip_resep."'";
                    $get_unit_resep = mysql_query($sql_unit_resep);
                    $dat_unit_resep = mysql_fetch_assoc($get_unit_resep); ?>

                    <input type="hidden" name="IDXRESEP" value="<?php echo $idx;?>" />
                    <input type="hidden" name="KDUNIT" value="<?php echo $dat_unit_resep['KDUNIT'];?>" />
                    <input type="hidden" name="NIP" value="<?php echo $nip_resep;?>" />

                </form>
            </fieldset>
            <div id="autocompletediv" class="autocomp"></div>
            <div id="validbarang" ></div>
        </div>
    </div>
</div>
