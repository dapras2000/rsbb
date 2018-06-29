<html>
    <head><script language="javascript">
        fields = 1;
        field=1
        function addInputdokter() {
            if (fields != 10) {
                document.getElementById('inputdokter').innerHTML += "Dokter "+ fields+" : <input type='text' name='dokter[]' value='' /><br><br>";
                fields += 1;
            } else {
                document.getElementById('inputdokter').innerHTML += "<br />Hanya 10 Field Isian.";
                document.formperiksaradiologi.add.disabled=true;
            }
        }

        function addInputpetugas() {
            if (field != 10) {
                document.getElementById('inputpetugas').innerHTML += "Petugas "+ field+" : <input type='text' name='petugas[]' value='' class='text' /><br><br>";
                field += 1;
            } else {
                document.getElementById('inputpetugas').innerHTML += "<br />Hanya 10 Field Isian.";
                document.formperiksaradiologi.add2.disabled=true;
            }
        }

        </script>
    </head>
    <div align="center">
        <div id="frame" style="width:100%;">
            <div id="frame_title"><h3>FORM FOTO RADIOLOGI APS</h3></div>
            <form id="formperiksaradiologi" name="formperiksaradiologi" method="post" action="radiologi/updateperiksa_aps.php">
                <table width="700" border="0" cellspacing="0" cellpadding="2" align="center" class="tb">
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="2"><? if($_GET['psn'] !='') {
    echo $psn;
}?></td>
                    </tr>
                    <tr>
                        <?
                        $thn = date("Y");
                        $bln = date("m");
                        $sql_nourut_m = "SELECT NO_FILM FROM t_radiologi_aps WHERE YEAR(TGLORDER) = '".$thn."' AND MONTH(TGLORDER) = '".$bln."'
                  AND NO_FILM IS NOT NULL ORDER BY IDXORDERRAD DESC LIMIT 1";
                        $get_nourut_m = mysql_query($sql_nourut_m);
                        if(mysql_num_rows($get_nourut_m)) {
                            $dat_nourut_m = mysql_fetch_assoc($get_nourut_m);
                            $no_last_m = substr($dat_nourut_m['NO_FILM'],0,5) + 1;
                            $nourut_m = substr("00000",0,5-strlen($no_last_m)).$no_last_m."/".$bln."/".strtoupper($singsurat)."/".$thn;
                        }else {
                            $nourut_m = "00001/".$bln."/".strtoupper($singsurat)."/".$thn;
                        }

                        $sqltarif = "select t.IDXORDERRAD, t.JENISPHOTO, m.tarif
             from t_radiologi_aps t
             inner join m_radiologi r on (t.JENISPHOTO=r.kd_rad)
             inner join m_tarif m on (r.kode_tarif=m.kode)
             where t.IDXORDERRAD = '".$_GET['idxorder']."'";
                        $gettarif = mysql_query($sqltarif) or die(mysql_error());
                        $dattarif = mysql_fetch_assoc($gettarif);
$tarif = $dattarif['tarif'];
?>
                        <td width="158">No. Foto</td>
                        <td colspan="2"><input type="text" name="no_foto" value="<? echo $nourut_m;?>" class="text" style="width:165px" />
                            <input name="idxorder" type="hidden" id="idxorder" value="<? echo $_GET['idxorder'];?>" /></td>
                    </tr>
                    <tr valign="top">
                        <td> Petugas Radiologi</td>
                        <td colspan="2" rowspan="2"><label>
                                <input  class="text" type="button" onClick="addInputpetugas()" name="add2" id="add2" value="TAMBAH" />
                                <br /><br /><div id="inputpetugas"></div>


                            </label></td>
                    </tr>
                    <tr valign="top">
                        <td>&nbsp;</td>
                    </tr>
                    <tr valign="top">
                        <td colspan="3">


                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Jenis Film</td>
                        <td colspan="2"><select name="jenisfilm" id="jenisfilm">
                                <option value="35x35">35x35</option>
                                <option value="30x40">30x40</option>
                                <option value="24x30">24x30</option>
                                <option value="18x24">18x24</option>
                                <option value="GIGI">GIGI</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jumlah Film</td>
                        <td width="79">Baik&nbsp;<input  type="text" value="" name="jmlfilm_baik" id="jmlfilm_baik" size="5" class="text" /></td>
                        <td width="451">Rusak&nbsp;<input  type="text" value="" name="jmlfilm_rusak" id="jmlfilm_rusak" size="5" class="text" /></td>
                    </tr>
                    <tr>
                        <td>Alkes Habis Pakai/ Obat</td>
                        <td colspan="2">
                            <a href="index.php?link=rdx1&idxorder=<? echo $_GET['idxorder'];?>&nofoto=<?=$nourut_m?>" target="_self" class="text">
                                Tambah</a></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Tarif</td>
                        <td colspan="2"><?=$tarif?></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="2"><input class="text" type="submit" name="submit"  value="S i m p a n" />

                            <input class="text" type="button" name="kembali" id="kembali" value="B a t a l" onClick="history.back();" />        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                </table>
            </form>
        </div></div>
</html>