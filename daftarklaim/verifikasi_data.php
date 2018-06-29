<div align="center">
    <div id="frame">
        <div id="frame_title"><h3>Verifikasi Data Pendaftaran <?=$_GET['crbyr']?></h3></div>
        <div align="center">
            <table border="0" class="tb">
                <tr>
                    <?
                    $sql  =  "SELECT NAMA, ALAMAT, NOTELP, NOKTP,
  			CASE JENISKELAMIN 
				WHEN 'L' THEN 'Laki-laki' 
				WHEN 'P' THEN 'Perempuan' 
				ELSE '-' 
			END AS JENISKELAMIN,  
			(select a.nama from m_carabayar a where a.kode = KDCARABAYAR) AS KDCARABAYAR 
			FROM m_pasien WHERE NOMR='".$_GET['nomr']."'";
                    $qry  = mysql_query($sql);
                    $data = mysql_fetch_assoc($qry);
                    ?>
                    <td valign="top"><table width="400" class="tb" border="0" cellpadding="1" cellspacing="1" style="float:left; margin-right:20px;">
                            <tr>
                                <th colspan="3"><h3>Data Pasien</h3></th>
                            </tr>
                            <tr>
                                <td width="154">Nama</td>
                                <td colspan="2"><?=$data['NAMA']?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td colspan="2"><?=$data['ALAMAT']?></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td colspan="2"><?=$data['JENISKELAMIN']?></td>
                            </tr>
                            <tr>
                                <td>No Telepon</td>
                                <td colspan="2"><?=$data['NOTELP']?></td>
                            </tr>
                            <tr>
                                <td>No KTP</td>
                                <td colspan="2"><?=$data['NOKTP']?></td>
                            </tr>
                            <tr>
                                <td>Cara Bayar</td>
                                <td colspan="2"><?=$data['KDCARABAYAR']?></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td width="200">&nbsp;</td>
                                <td width="36">&nbsp;</td>
                            </tr>
                        </table></td>
                    <td valign="top">
                        <? if($_GET['crbyr']=='JMKS'|| $_GET['crbyr']=='JMKSD BGR' ) { 	?>
                        <form name="jmks" id="jmks" action="<? echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>" method="post">
                                <?
                                if($_POST['Submit']) {
                                    include("daftarklaim/verifikasi_data_valid.php");
                                }

                                $SqlVerifikasi = "SELECT * FROM t_data_verifikasi WHERE IDXDAFTAR='".$_GET['idx']."'";
                                $QryVerifikasi = mysql_query($SqlVerifikasi)or die(mysql_error());
                                $verifikasidata = mysql_fetch_assoc($QryVerifikasi);

                                if($verifikasidata['IDXDAFTAR']==$_GET['idx']) {
                                    if($verifikasidata['KTP']=="" || $verifikasidata['KARTU']=="" || $verifikasidata['RUJUKAN']=="") {
                                        echo "<div style='border:1px solid #CCC; padding:5px; color:#F00;'><strong>Data Pending</strong></div>";
                                    }
                                }
                                ?>
                            <table width="499" border="0" class="tb" cellpadding="1" cellspacing="1">
                                <tr>
                                    <th colspan="3"><h3>Proses akseptasi sebelum diterbitkan form jaminan pelayanan [ FJP ]</h3></th>
                                </tr>
                                <tr>
                                    <td colspan="3">Data Verifikasi Yang Harus Dilengkapi :</td>
                                </tr>
                                <tr>
                                    <td width="20"><input name="KTP" type="checkbox" value="1" <? if(!empty($verifikasidata['KTP'])) {
        echo"checked='checked'";
    }?>  ></td>
                                    <td colspan="2">KTP.</td>
                                </tr>
                                <tr>
                                    <td><input name="KPJ" type="checkbox" value="1" <? if(!empty($verifikasidata['KARTU'])) {
        echo"checked='checked'";
    }?>></td>
                                    <td colspan="2"><? if($_GET['crbyr']=='JMKS') echo "Kartu Peserta Jamkesmas."; ?>
                                    <? if($_GET['crbyr']=='JMKSD BGR') echo "Kartu peserta Jamkesda."; ?></td>
                                </tr>
                                <tr>
                                    <td><input name="RP" type="checkbox" value="1" <? if(!empty($verifikasidata['RUJUKAN'])) {
        echo"checked='checked'";
    }?>></td>
                                    <td colspan="2">Rujukan Puskesmas (Acc. Dinkes).</td>
                                </tr>
                                <tr>
                                    <td><input name="KK" type="checkbox" value="1" <? if(!empty($verifikasidata['KK'])) {
        echo"checked='checked'";
    }?>></td>
                                    <td colspan="2"> Kartu Keluarga.</td>
                                </tr>
                                <tr>
                                    <td><input name="LAINLAIN" type="checkbox" value="1" <? if(!empty($verifikasidata['LAINLAIN'])) {
        echo"checked='checked'";
    }?>></td>
                                    <td colspan="2"> Lain-lain.</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><input name="REC" type="checkbox" value="1" <? if(!empty($verifikasidata['DINAS_SOSIAL'])) {
        echo"checked='checked'";
                                            }?>>
                                        Rekomendasi Dari Dinas Sosial.</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><textarea name="KET" cols="50" rows="4"><? if(!empty($verifikasidata['KET'])) {
        echo $verifikasidata['KET'];
    }?></textarea></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="2" align="right"><input type="hidden" name="IDXDAFTAR" value="<?=$_GET['idx']?>">
                                        <input type="hidden" name="NOMR" value="<?=$_GET['nomr']?>">
                                        <input type="hidden" name="CARABAYAR" value="<?=$_GET['crbyr']?>">
                                            <?
    if( ($_GET['poly']=="UGD") or ($_GET['poly']=="VK") ) {
        if($verifikasidata['KTP']==1 && $verifikasidata['KARTU']==1) { ?>
                                        <a href="?link=14rujukan&idx=<?=$_GET['idx']?>&nomr=<?=$_GET['nomr']?>&crbyr=<?=$_GET['crbyr']?>">
                                            <input type="button" value=" Rujukan " class="text" />
                                        </a>
                                        <a href="?link=14fjp&idx=<?=$_GET['idx']?>&nomr=<?=$_GET['nomr']?>&crbyr=<?=$_GET['crbyr']?>">
                                            <input type="button" value=" Form FJP " class="text" />
                                        </a>
                                        <input type="submit" name="Submit" value="Proses" class="text">
                                                    <? }else { ?>
                                        <input type="submit" name="Submit" value="Proses" class="text">
                                                    <? }
    }else {
        if($verifikasidata['KTP']==1 && $verifikasidata['KARTU']==1 && $verifikasidata['RUJUKAN']==1) {?>
                                        <a href="?link=14rujukan&idx=<?=$_GET['idx']?>&nomr=<?=$_GET['nomr']?>&crbyr=<?=$_GET['crbyr']?>">
                                            <input type="button" value=" Rujukan " class="text" />
                                        </a>
                                        <a href="?link=14fjp&idx=<?=$_GET['idx']?>&nomr=<?=$_GET['nomr']?>&crbyr=<?=$_GET['crbyr']?>">
                                            <input type="button" value=" Form FJP " class="text" />
                                        </a>
                                        <input type="submit" name="Submit" value="Proses" class="text">
                                    <? }else { ?>
                                        <input type="submit" name="Submit" value="Proses" class="text">
            <? }
                                }
                                ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td width="212">&nbsp;</td>
                                    <td width="257">&nbsp;</td>
                                </tr>
                            </table>
                        </form>
                                <? } ?>
                            <? if($_GET['crbyr']=='JMKSD DPK' || $_GET['crbyr']=='JAMPERSAL' ) { ?>
                        <form name="sktm" id="sktm"  action="<? echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>"  method="post">
    <?


					
    if($_POST['Submit']) {
        include("daftarklaim/verifikasi_data_valid.php");
    }
    $SqlVerifikasi = "SELECT * FROM t_data_verifikasi WHERE IDXDAFTAR='".$_GET['idx']."'";
    $QryVerifikasi = mysql_query($SqlVerifikasi)or die(mysql_error());
    $verifikasidata = mysql_fetch_assoc($QryVerifikasi);

    if($verifikasidata['IDXDAFTAR']==$_GET['idx']) {
        if($verifikasidata['KTP']=="" || $verifikasidata['KARTU']=="" || $verifikasidata['RUJUKAN']=="") {
            echo "<div style='border:1px solid #CCC; padding:5px; color:#F00;'><strong>Data Pending</strong></div>";
        }
    }
    ?>

                            <table width="499" border="0" class="tb" cellpadding="1" cellspacing="1">
                                <tr>
                                    <th colspan="3"><h3>Proses akseptasi sebelum diterbitkan form jaminan pelayanan [ FJP ]</h3></th>
                                </tr>
                                <tr>
                                    <td colspan="3">Data Verifikasi Yang Harus Dilengkapi :</td>
                                </tr>
                                <tr>
                                    <td width="20"><input name="KTP" type="checkbox" value="1" <? if(!empty($verifikasidata['KTP'])) {
        echo"checked='checked'";
    }?>></td>
                                    <td colspan="2">KTP</td>
                                </tr>
                                <tr>
                                    <td><input name="SKTM" type="checkbox" value="1" <? if(!empty($verifikasidata['KARTU'])) {
        echo"checked='checked'";
    }?>></td>
                                    <td colspan="2">Surat Keterangan Tidak Mampu (SKTM)</td>
                                </tr>
                                <tr>
                                    <td><input name="RP" type="checkbox" value="1"  <? if(!empty($verifikasidata['RUJUKAN'])) {
        echo"checked='checked'";
    }?>></td>
                                    <td colspan="2">Rujukan Puskesmas (Acc. Dinkes)</td>
                                </tr>
                                <tr>
                                    <td><input name="KK" type="checkbox" value="1"  <? if(!empty($verifikasidata['KK'])) {
                                                echo"checked='checked'";
    }?>></td>
                                    <td colspan="2"> Kartu Keluarga</td>
                                </tr>
                                <tr>
                                    <td><input name="LAINLAIN" type="checkbox" value="1" <? if(!empty($verifikasidata['LAINLAIN'])) {
        echo"checked='checked'";
    }?>></td>
                                    <td colspan="2"> Lain-lain</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><input name="REC" type="checkbox" value="1"  <? if(!empty($verifikasidata['DINAS_SOSIAL'])) {
        echo"checked='checked'";
    }?>>
                                        Rekomendasi Dari Dinas Sosial</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="2"><textarea name="KET" cols="50" rows="4"> <? if(!empty($verifikasidata['KET'])) {
        echo $verifikasidata['KET'];
    }?></textarea></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="2" align="right"><input type="hidden" name="IDXDAFTAR" value="<?=$_GET['idx']?>">
                                        <input type="hidden" name="NOMR" value="<?=$_GET['nomr']?>">
                                        <input type="hidden" name="CARABAYAR" value="<?=$_GET['crbyr']?>">
    <? if($verifikasidata['KTP']==1 && $verifikasidata['KARTU']==1 && $verifikasidata['RUJUKAN']==1) { ?>

                                        <a href="?link=14rujukan&idx=<?=$_GET['idx']?>&nomr=<?=$_GET['nomr']?>&crbyr=<?=$_GET['crbyr']?>">
                                            <input type="button" value=" Rujukan " class="text" />
                                        </a>
                                        <a href="?link=14fjp&idx=<?=$_GET['idx']?>&nomr=<?=$_GET['nomr']?>&crbyr=<?=$_GET['crbyr']?>">
                                            <input type="button" value=" Form FJP " class="text" />
                                        </a>
                                        <input type="submit" name="Submit" value="Proses" class="text">
        <? }else { ?>
                                        <input type="submit" name="Submit" value="Proses" class="text">
        <? } ?>      </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td width="212">&nbsp;</td>
                                    <td width="257">&nbsp;</td>
                                </tr>
                            </table>
                        </form>
    <? } ?>

                    </td>
                </tr>
            </table>

        </div>

    </div>
</div>
