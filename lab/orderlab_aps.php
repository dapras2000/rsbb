<div align="center">
    <div id="frame" style="width:100%;">
        <div id="frame_title">
            <h3>ORDER LABORATORIUM APS</h3></div>
        <?php
        include("../include/connect.php");

        $idx_daftar = $_GET["idx"];

        $sql = "SELECT DISTINCT M.kode_jasa, M.nama_jasa FROM m_lab M
			  WHERE kode_jasa in(SELECT m_lab.group_jasa FROM
    		  m_lab inner join t_orderlab_aps on (m_lab.kode_jasa = t_orderlab_aps.KODE)
			  WHERE t_orderlab_aps.IDXDAFTAR = '$idx_daftar' AND t_orderlab_aps.STATUS = '0')";

        $row = mysql_query($sql)or die(mysql_error());
        ?>
        <fieldset class="fieldset">
            <legend>Identitas </legend>
            <?php $myquery = "SELECT DISTINCT
		  t_pendaftaran_aps.NOMR,
		  t_pendaftaran_aps.TGLREG,
		  m_pasien_aps.NAMA,
		  m_pasien_aps.ALAMAT,
		  t_orderlab_aps.DOKTER,
		  m_carabayar.NAMA AS CARABAYAR,
		  m_rujukan.NAMA AS RUJUKAN,
		  m_pasien_aps.TGLLAHIR,
		  m_pasien_aps.JENISKELAMIN,
		  t_pendaftaran_aps.IDXDAFTAR
		FROM
		  t_pendaftaran_aps
		  INNER JOIN m_pasien_aps ON (t_pendaftaran_aps.NOMR = m_pasien_aps.NOMR)
		  INNER JOIN m_carabayar ON (t_pendaftaran_aps.KDCARABAYAR = m_carabayar.KODE)
		  INNER JOIN t_orderlab_aps ON (t_pendaftaran_aps.IDXDAFTAR = t_orderlab_aps.IDXDAFTAR)
		  INNER JOIN m_rujukan ON (t_pendaftaran_aps.KDRUJUK = m_rujukan.KODE)
		WHERE t_pendaftaran_aps.IDXDAFTAR  ='".$_GET["idx"]."'";
            $get = mysql_query ($myquery)or die(mysql_error());
            $userdata = mysql_fetch_assoc($get);
            $nomr=$userdata['NOMR'];
            $idxdaftar=$userdata['IDXDAFTAR'];
            $kddokter=$userdata['DOKTER'];
            $tglreg=$userdata['TGLREG'];

            $thn = date("Y");
            $bln = date("m");

            $sql_nourut = "SELECT NOLAB FROM t_orderlab WHERE YEAR(TANGGAL) = '".$thn."'
                AND MONTH(TANGGAL) = '".$bln."'
				AND STATUS = '1'
				ORDER BY IDXORDERLAB DESC LIMIT 1";
            $get_nourut = mysql_query($sql_nourut);
            if(mysql_num_rows($get_nourut) > 0) {
                $dat_nourut = mysql_fetch_assoc($get_nourut);
                $no_last = $dat_nourut['NOLAB'] + 1;
                $nourut = substr("00000",0,5-strlen($no_last)).$no_last;
            }else {
                $nourut = "00001";
            }
            ?>


            <table class="tb" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>No MR</td>
                    <td width="80%"><?php echo $userdata['NOMR'];?></td>
                </tr>
                <tr>
                    <td width="21%">Nama Pasien</td>
                    <td width="79%"><?php echo $userdata['NAMA'];?></td>
                </tr>
                <tr>
                    <td valign="top">Alamat </td>
                    <td><?php echo $userdata['ALAMAT'];?></td>
                </tr>
                <tr>
                    <td valign="top">Jenis Kelamin</td>
                    <td colspan="2"><? if($userdata['JENISKELAMIN']=="l" || $userdata['JENISKELAMIN']=="L") {
                            echo"Laki-Laki";
                        }elseif($userdata['JENISKELAMIN']=="p" || $userdata['JENISKELAMIN']=="P") {
                            echo"Perempuan";
                        } ?> <?php echo"( ". $userdata['JENISKELAMIN']." )";?></td>
                </tr>
                <tr>
                    <td valign="top">Tanggal Lahir</td>
                    <td>
                        <?php echo $userdata['TGLLAHIR'];?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Umur</td>
                    <td><?php
                        $a = datediff($userdata['TGLLAHIR'], $tglreg);
                        echo $a[years]." tahun ".$a[months]." bulan ".$a[days]." hari"; ?></td>
                </tr>
                <tr>
                    <td valign="top">Cara Bayar</td>
                    <td><?php echo $userdata['CARABAYAR'];?></td>
                </tr>
                <tr>
                    <td valign="top">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>

            </table>
        </fieldset>

        <div id="addlab"></div>

        <fieldset class="fieldset">
            <legend>Hasil Periksa</legend>

            <div id="savelaborder" ></div>
            <form id="inpLab" name="inpLab" method="post" action="lab/savelab_aps.php">
                <table class="tb" width="100%">
                    <tr>
                        <td>Dokter Pengirim</td>
                        <td colspan="2" width="80%"><?php echo $kddokter?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Registrasi</td>
                        <td colspan="2"><?php echo $tglreg?></td>
                    </tr>
                    <tr>
                        <td>Jam Mulai</td>
                        <td colspan="2"><div id="mulai" ><input type="text" name="jamMulai" id="jamMulai" class="text" style="width:150px" />&nbsp;<input type="button" value="Skr" class="text" onclick="javascript: MyAjaxRequest('mulai','lab/getjam.php?mulai=1'); return false;" /></div></td>
                    </tr>
                    <tr>
                        <td>Jam Selesai</td>
                        <td colspan="2"><div id="selesai" ><input type="text" name="jamSelesai" id="jamSelesai" class="text" style="width:150px"/>&nbsp;<input type="button" value="Skr"class="text" onclick="javascript: MyAjaxRequest('selesai','lab/getjam.php?selesai=1'); return false;"/></div></td>
                    </tr>
                    <tr>
                        <td>Shift</td>
                        <td colspan="2"><input type="radio" name="SHIF" value="1" checked="checked" />
                            1
                            <input type="radio" name="SHIF" value="2" />
                            2
                            <input type="radio" name="SHIF" value="3" />
                            3</td>
                    </tr>
                    <tr>
                        <td>Petugas Laboratorium</td>
                        <td colspan="2"><input type="text" name="petugas" id="petugas" class="text" style="width:200px"/></td>
                    </tr>
                    <tr>
                        <td>No Lab</td>
                        <td colspan="2"><input type="text" name="nolab" id="nolab" value="<?=$nourut?>" class="text" style="width:200px" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td>Catatan</td>
                        <td colspan="2"><textarea name="keterangan" cols="75" rows="5" ></textarea></td>
                    </tr>
                </table>
                <br />

                <div id="orderlab" >
                    <table class="tb" width="100%">
                        <tr>
                            <th>No</th>
                            <th width="30%">Jenis Pemeriksaan</th>
                            <th>Hasil</th>
                            <th width="30%">Nilai Normal</th>
                            <th >Unit</th>
                        </tr>
                        <?php $i=1; while ( $data = mysql_fetch_array($row)) {  ?>
                        <tr>
                            <td colspan="2"><strong> - <?php echo $data['nama_jasa']?></strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                            <?
                            $sql_d = "SELECT t_orderlab_aps.IDXORDERLAB, t_orderlab_aps.KODE, t_orderlab_aps.IDXDAFTAR, t_orderlab_aps.HASIL_PERIKSA, t_orderlab_aps.KETERANGAN,
  			t_orderlab_aps.TGL_MULAI, t_orderlab_aps.TGL_SELESAI, t_orderlab_aps.`STATUS`, t_orderlab_aps.KET, m_lab.nama_jasa, t_orderlab_aps.TANGGAL,
            m_lab.nilai_normal, m_lab.kode_jasa, m_lab.unit
            FROM t_orderlab_aps
  			INNER JOIN m_lab ON (t_orderlab_aps.KODE = m_lab.kode_jasa)
			WHERE t_orderlab_aps.IDXDAFTAR = '$idx_daftar' AND t_orderlab_aps.STATUS = '0'
			AND m_lab.group_jasa ='".$data['kode_jasa']."'";
                            $get_d = mysql_query($sql_d);
                            while($row_d = mysql_fetch_array($get_d)) {
                                $ket = "";
                                if($row_d['KET'] != "") $ket = " (".$row_d['KET'].")";
                                ?>
                        <tr>
                            <td align="right"><?=$i?>.</td>
                            <td>&nbsp;<?=$row_d['nama_jasa'].$ket?></td>
                            <td>
                                        <? if($row_d['kode_jasa'] == "01010401" || $row_d['kode_jasa'] == "01010402") {?>
                                <textarea name="hsl<?php echo $row_d['IDXORDERLAB']?>" cols="50" rows="5" class="text" ></textarea>
                                            <? }else { ?>
                                <input type="text" name="hsl<?php echo $row_d['IDXORDERLAB']?>" class="text" style="width:80px" /></td>
                                            <? } ?>
                            <td><?=$row_d['nilai_normal']?></td>
                            <td><?=$row_d['unit']?></td>
                        </tr>
                                <?php $i++;
                            }
                        }
                        ?>
                    </table>
                </div>
                <input type="hidden" name="idxDaftar" value="<?php echo $idx_daftar ?>" />
                <!--
                   <input type="submit" value="A d d"  class="text" onclick="javascript: MyAjaxRequest('addlab','lab/addlab.php?idxDaftar=<?=$idx_daftar?>'); return false;" />
                -->
                <input type="submit" value="S i m p a n"  class="text" />
            </form>
        </fieldset>
    </div>
</div>
<script language="javascript" type="text/javascript" >
</script>