
<script language="javascript" src="include/cal3.js"></script>
<script language="javascript" src="include/cal_conf3.js"></script>

<!--<script src="jquery.validate.js"></script>-->
<script language="javascript">
    function checkMe() {
        if (confirm("Are you sure")) {
            return true;
        } else {
            return false;
        }
    }
</script>
<script src="js/jquery-1.7.min.js" language="JavaScript" type="text/javascript"></script>
<script src="js/jquery.validate.js" language="JavaScript" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $("#formku").validate();

        jQuery("#TEMKER").change(function() {
            var selectValues = jQuery("#TEMKER").val();

            if (selectValues == 0) {
                var msg = "<select name=\"TEMKER2\" id=\"TEMKER2\" class=\"text\"><option value=\"0\"> --pilih-- </option></select>";
                jQuery('#tempatkerja').html(msg);

            } else if (selectValues == 1) {

//                var msg = '<select name="TEMKER2" id="TEMKER2" class="text" onchange="pilih()"><option value="0"> --pilih-- </option><option value="Penyakit dalam">Penyakit dalam</option><option value="Bedah">Bedah</option><option value="Anak">Anak</option><option value="Maternitas">Maternitas</option><option value="Jiwa">Jiwa</option><option value="L">Lain-lain</option></select>';
                jQuery('#tempatkerja').load('kep/combo_ruang.php');
//                jQuery('#tempatkerja').html(msg);
            } else if (selectValues == 2) {
                var msg = "<select name=\"TEMKER2\" id=\"TEMKER2\" class=\"text\" onchange=\"pilih()\"><option value=\"0\"> --pilih-- </option><option value=\"Poliklinik Penyakit dalam\">Poliklinik Penyakit dalam</option><option value=\"Poliklinik bedah\">Poliklinik bedah</option><option value=\"Poliklinik anak\">Poliklinik anak</option><option value=\"Poliklinik kean\">Poliklinik kean</option><option value=\"L\">Lain-lain</option></select>";
                jQuery('#tempatkerja').html(msg);
            } else if (selectValues == 3) {
                var msg = "<select name=\"TEMKER2\" id=\"TEMKER2\" class=\"text\" onchange=\"pilih()\"><option value=\"0\"> --pilih-- </option><option value=\"Intensif care\">Intensif care</option><option value=\"Kamar operasi\">Kamar operasi</option><option value=\"Unit Luka Bakar\">Unit Luka Bakar</option><option value=\"NAPZA\">NAPZA</option><option value=\"Haemodialisa\">Haemodialisa</option><option value=\"L\">Lain-lain</option></select>";
                jQuery('#tempatkerja').html(msg);
            } else if (selectValues == 4) {
                var msg = "<select name=\"TEMKER2\" id=\"TEMKER2\" class=\"text\"><option value=\"0\"> --pilih-- </option><option value=\"IGD\">IGD</option></select>";
                jQuery('#tempatkerja').html(msg);
            }
            jQuery('#lain').html("");
        });
    });
</script>

<style type="text/css">
    label.error {
        color: red; padding-left: .5em;
    }
</style>

<?php
require_once('./ps_pagination_x.php');
$sql_view = "SELECT NIP,NAMA FROM m_perawat WHERE NIP LIKE '%" . $_GET['NIP'] . "%'";
$rs_view = mysql_query($sql_view);
$row_view = mysql_fetch_row($rs_view);
//print_r($row_view);


if (isset($_POST['simpan'])) {
    if (isset($_GET['act']) & $_GET['act'] == 'edit') {
        $sql_update = "UPDATE `kep_m_tuj_header` SET `nama` = '" . $_POST['nama'] . "' WHERE `id_header` =" . $_POST['id'];
        mysql_query($sql_update);
    } else {
        $sql_insert = "INSERT INTO  `m_perawat_rkerja` 
            (`id` ,`nip` ,`ruang` ,`tmt`,`sk`)
VALUES (NULL ,'" . $_GET['NIP'] . "',  '" . $_POST['TEMKER2'] . "',  '" . date('Y-m-d', strtotime($_POST['tmt'])) . "',  '" . $_POST['sk'] . "')";
        mysql_query($sql_insert);
    }
    ?>
    <script>
        alert("Data berhasil disimpan");
    </script>
    <?php
}




if (isset($_GET['act']) && $_GET['act'] == 'delete') {
    $sql_delete = "DELETE FROM `m_perawat_rkerja` WHERE `id` = " . $_GET['id'];
//    echo $sql_delete;
    mysql_query($sql_delete);
    ?>
    <script>
        alert("Data berhasil dihapus");
    </script>
    <?php
//    $sql_delete = "DELETE FROM `kep_m_tuj_item` WHERE `header` = " . $_GET['id'];
//    mysql_query($sql_delete);
}
?>
<script>
    /*
     Masked Input plugin for jQuery
     Copyright (c) 2007-2011 Josh Bush (digitalbush.com)
     Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license) 
     Version: 1.3
     */


    jQuery(document).ready(function() {

        $("#formku").validate();
        jQuery('#TGLLAHIR').blur(function() {
            var tgl = jQuery(this).val();
            if (tgl == ('0000/00/00') || tgl == ('0000-00-00') || tgl == ('00-00-0000') || tgl == ('00/00/0000')) {
                alert('Tanggal Lahir Tidak Boleh 00-00-0000');
                jQuery(this).val('');
            }
        });
        jQuery('#myform').validate();
        jQuery("#TGLLAHIR").mask("99/99/9999");

        jQuery("#TEMKER").change(function() {
            var selectValues = jQuery("#TEMKER").val();

            if (selectValues == 0) {
                var msg = "<select name=\"TEMKER2\" id=\"TEMKER2\" class=\"text\"><option value=\"0\"> --pilih-- </option></select>";
                jQuery('#tempatkerja').html(msg);

            } else if (selectValues == 1) {

//                var msg = '<select name="TEMKER2" id="TEMKER2" class="text" onchange="pilih()"><option value="0"> --pilih-- </option><option value="Penyakit dalam">Penyakit dalam</option><option value="Bedah">Bedah</option><option value="Anak">Anak</option><option value="Maternitas">Maternitas</option><option value="Jiwa">Jiwa</option><option value="L">Lain-lain</option></select>';
                jQuery('#tempatkerja').load('kep/combo_ruang.php');
//                jQuery('#tempatkerja').html(msg);
            } else if (selectValues == 2) {
                var msg = "<select name=\"TEMKER2\" id=\"TEMKER2\" class=\"text\" onchange=\"pilih()\"><option value=\"0\"> --pilih-- </option><option value=\"Poliklinik Penyakit dalam\">Poliklinik Penyakit dalam</option><option value=\"Poliklinik bedah\">Poliklinik bedah</option><option value=\"Poliklinik anak\">Poliklinik anak</option><option value=\"Poliklinik kean\">Poliklinik kean</option><option value=\"L\">Lain-lain</option></select>";
                jQuery('#tempatkerja').html(msg);
            } else if (selectValues == 3) {
                var msg = "<select name=\"TEMKER2\" id=\"TEMKER2\" class=\"text\" onchange=\"pilih()\"><option value=\"0\"> --pilih-- </option><option value=\"Intensif care\">Intensif care</option><option value=\"Kamar operasi\">Kamar operasi</option><option value=\"Unit Luka Bakar\">Unit Luka Bakar</option><option value=\"NAPZA\">NAPZA</option><option value=\"Haemodialisa\">Haemodialisa</option><option value=\"L\">Lain-lain</option></select>";
                jQuery('#tempatkerja').html(msg);
            } else if (selectValues == 4) {
                var msg = "<select name=\"TEMKER2\" id=\"TEMKER2\" class=\"text\"><option value=\"0\"> --pilih-- </option><option value=\"IGD\">IGD</option></select>";
                jQuery('#tempatkerja').html(msg);
            }
            jQuery('#lain').html("");
        });

        jQuery("#KDPROVINSI").change(function() {
            var selectValues = jQuery("#KDPROVINSI").val();
            jQuery.post('<?php echo _BASE_; ?>include/ajaxload.php', {kdprov: selectValues, load_kota: 'true'}, function(data) {
                jQuery('#kotapilih').html(data);
                jQuery('#kecamatanpilih').html("<select name=\"KDKECAMATAN\" class=\"text required\" title=\"*\" id=\"KDKECAMATAN\"><option value=\"0\"> --pilih-- </option></select>");
                jQuery('#kelurahanpilih').html("<select name=\"KELURAHAN\" class=\"text required\" title=\"*\" id=\"KELURAHAN\"><option value=\"0\"> --pilih-- </option></select>");
            });
        });

        jQuery("#KOTA").change(function() {
            var selectValues = jQuery("#KOTA").val();
            jQuery.post('./include/ajaxload.php', {kdkota: selectValues, load_kecamatan: 'true'}, function(data) {
                jQuery('#kecamatanpilih').html(data);
                jQuery('#kelurahanpilih').html("<select name=\"KELURAHAN\" class=\"text required\" title=\"*\" id=\"KELURAHAN\"><option value=\"0\"> --pilih-- </option></select>");
            });
        });

        jQuery("#KDKECAMATAN").change(function() {
            var selectValues = jQuery("#KDKECAMATAN").val();
            jQuery.post('./include/ajaxload.php', {kdkecamatan: selectValues, load_kelurahan: 'true'}, function(data) {
                jQuery('#kelurahanpilih').html(data);
            });
        });
    });

    function pilih() {
        if (document.getElementById('TEMKER2').value == "L") {
            document.getElementById('lain').innerHTML = '<input class="text" type="text" name="NAMALAIN" size="25" id="NAMALAIN" />';
        } else {
            document.getElementById('lain').innerHTML = '';
        }
    }

</script>
<div id="frame_title"><h3 align="left"> <a href="?link=kep2&NIP=<?=$_GET['NIP'];?>&PERID=<?=$_GET['PERID']?>"  style="font-weight: bolder;padding: 5px" name="daftar2" class="text" value="Riwayat Pekerjaan">IDENTITAS PERAWAT</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?link=kep_riw_kerja&NIP=<?=$data['NIP'];?>&PERID=<?=$_GET['PERID']?>"  style="font-weight: bolder;padding: 5px" name="daftar2" class="text" value="Riwayat Pekerjaan">Riwayat Pekerjaan</a></h3></div>
<form id="formku" action="" method="POST">
    <table width="100%" border="0" cellpadding="4" cellspacing="2">
        <tr>
            <td>NIP/ NIK </td>
            <td><label>
                    <input type="text" name="NIP" readonly="true" value="<?= $row_view[0] ?>" style="background-color: #E0E0DD">
                </label></td>
        </tr>
        <tr>
            <td>Nama Lengkap </td>
            <td><input name="NAMA" type="text" size="50" readonly="true" value="<?= $row_view[1] ?>" style="background-color: #E0E0DD"></td>
        </tr>
        <tr>
            <td width="200">TMT</td>
            <td><input type="text" name="tmt"> <b>(format:dd-mm-YYYY)</b></td>
        </tr>
        <tr>
            <td valign="top">Tempat Kerja Sesuai Area</td>
            <td colspan="4"><select name="TEMKER" id="TEMKER" class="text">
                    <option value="0"> --pilih-- </option>
                    <option value="1" <? if ($data['TEMKER'] == "1") echo "selected=Selected"; ?> >Rawat Inap</option>
                    <option value="2" <? if ($data['TEMKER'] == "2") echo "selected=Selected"; ?> >Rawat Jalan</option>
                    <option value="3" <? if ($data['TEMKER'] == "3") echo "selected=Selected"; ?> >Rawat Khusus</option>
                    <option value="4" <? if ($data['TEMKER'] == "4") echo "selected=Selected"; ?> >Kegawatdaruratan</option>
                </select></td>
        </tr>
        <tr>
            <td valign="top"></td>
            <td colspan="4"><div id="tempatkerja">
                    <? if ($data['TEMKER'] == "1") { ?>
                        <select name="TEMKER2" id="TEMKER2" class="text" onChange="pilih()">
                            <option value="" selected="true"> --pilih-- </option>
                            <?php
                            $sql_combo_ruang = mysql_query("SELECT * FROM m_ruang");

                            while ($data_combo_ruang = mysql_fetch_array($sql_combo_ruang)) {
                                if (isset($data['TEMKER2']) && $data['TEMKER2'] == $data_combo_ruang['no']) {
                                    ?>
                                    <option value="<?php echo $data_combo_ruang['no']; ?>" selected="true"><?php echo $data_combo_ruang['nama']; ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $data_combo_ruang['no']; ?>"><?php echo $data_combo_ruang['nama']; ?></option>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            ?>
                        </select>
                        <!--                                        <select name="TEMKER2" id="TEMKER2" class="text" onchange="pilih()">
                                                                                    <option value="0"> --pilih-- </option>
                                                                                    <option value="Penyakit dalam" <? if ($data['TEMKER2'] == "Penyakit dalam") echo "selected=Selected"; ?> >Penyakit dalam</option>
                                                                                    <option value="Bedah" <? if ($data['TEMKER2'] == "Bedah") echo "selected=Selected"; ?> >Bedah</option>
                                                                                    <option value="Anak" <? if ($data['TEMKER2'] == "Anak") echo "selected=Selected"; ?> >Anak</option>
                                                                                    <option value="Maternitas" <? if ($data['TEMKER2'] == "Maternitas") echo "selected=Selected"; ?> >Maternitas</option>
                                                                                    <option value="Jiwa" <? if ($data['TEMKER2'] == "Jiwa") echo "selected=Selected"; ?> >Jiwa</option>
                                                                                    <option value="L" <? if (substr($data['TEMKER2'], 0, 2) == "L ") echo "selected=Selected"; ?> >Lain-lain</option>
                                                                                </select>-->
                    <? }else if ($data['TEMKER'] == "2") { ?>
                        <select name="TEMKER2" id="TEMKER2" class="text" onChange="pilih()">
                            <option value="0"> --pilih-- </option>
                            <option value="Poliklinik Penyakit dalam" <? if ($data['TEMKER2'] == "Poliklinik Penyakit dalam") echo "selected=Selected"; ?> >Poliklinik Penyakit dalam</option>
                            <option value="Poliklinik bedah" <? if ($data['TEMKER2'] == "Poliklinik bedah") echo "selected=Selected"; ?> >Poliklinik bedah</option>
                            <option value="Poliklinik anak" <? if ($data['TEMKER2'] == "Poliklinik anak") echo "selected=Selected"; ?> >Poliklinik anak</option>
                            <option value="Poliklinik kean" <? if ($data['TEMKER2'] == "Poliklinik kean") echo "selected=Selected"; ?> >Poliklinik kean</option>
                            <option value="L" <? if (substr($data['TEMKER2'], 0, 2) == "L ") echo "selected=Selected"; ?> >Lain-lain</option>
                        </select>
                    <? }else if ($data['TEMKER'] == "3") { ?>
                        <select name="TEMKER2" id="TEMKER2" class="text" onChange="pilih()">
                            <option value="0"> --pilih-- </option>
                            <option value="Intensif care" <? if ($data['TEMKER2'] == "Intensif care") echo "selected=Selected"; ?> >Intensif care</option>
                            <option value="Kamar operasi" <? if ($data['TEMKER2'] == "Kamar operasi") echo "selected=Selected"; ?> >Kamar operasi</option>
                            <option value="Unit Luka Bakar" <? if ($data['TEMKER2'] == "Unit Luka Bakar") echo "selected=Selected"; ?> >Unit Luka Bakar</option>
                            <option value="NAPZA" <? if ($data['TEMKER2'] == "NAPZA") echo "selected=Selected"; ?> >NAPZA</option>
                            <option value="Haemodialisa" <? if ($data['TEMKER2'] == "Haemodialisa") echo "selected=Selected"; ?> >Haemodialisa</option>
                            <option value="L" <? if (substr($data['TEMKER2'], 0, 2) == "L ") echo "selected=Selected"; ?> >Lain-lain</option>
                        </select>
                    <? }else if ($data['TEMKER'] == "4") { ?>
                        <select name="TEMKER2" id="TEMKER2" class="text">
                            <option value="0"> --pilih-- </option>
                            <option value="IGD" <? if ($data['TEMKER2'] == "IGD") echo "selected=Selected"; ?> >IGD</option>
                        </select>
                    <? }else { ?>
                        <select name="TEMKER2" id="TEMKER2" class="text">
                            <option value="0"> --pilih-- </option>
                        </select>
                    <? } ?>
                </div>                      <div align="left" id="lain" >
                    <?
                    if (substr($data['TEMKER2'], 0, 2) == "L ") {
                        $val = explode("L ", $data['TEMKER2'])
                        ?>
                        <input class="text" type="text" value= "<?= $val[1] ?>"name="NAMALAIN" size="25" id="NAMALAIN" />
                    <? } ?>
                </div></td>
        </tr>
        <tr>
            <td>SK</td>
            <td><input name="sk" type="text" size="50"></td>
        </tr>
        <tr height="30px">
            <td><input type="submit" name="simpan" class="text" value="  S a v e  "/>&nbsp;
                <a type="submit" name="daftar" class="text" href="?link=kep2&NIP=<?= $_GET['NIP']; ?>&PERID=<?= $_GET['PERID'] ?>">Data Induk </a></td>
            <td>&nbsp;</td>
        </tr>
    </table>
</form>
<br>
<br>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
        <th align="center">TMT</th>
        <th align="center">RUANG</th>
        <th align="center">SK</th>
        <th align="center">#</th>
    </tr>
    <?
    $sql_list = "SELECT * FROM m_perawat_rkerja WHERE NIP = '" . $_GET['NIP'] . "'";
    $rs_list = mysql_query($sql_list);
    while ($data = mysql_fetch_array($rs_list)) {
        ?>
        <tr <?
        echo "class =";
        $count++;
        if ($count % 2) {
            echo "tr1";
        } else {
            echo "tr2";
        }
        ?>>
            <td width="150" align="center"><?= date('d-m-Y', strtotime($data['tmt'])) ?>&nbsp;</td>
            <td width="250"><?= $data['ruang'] ?>&nbsp;</td>
            <td width="500"><?= $data['sk'] ?>&nbsp;</td>
            <td widht="200"align="center"><a href="?link=kep_riw_kerja&act=delete&id=<?= $data['id']; ?>&NIP=<?= $_GET['NIP']; ?>&PERID=<?= $_GET['PERID'] ?>"><input type="button" value="Delete" class="text" onClick="return checkMe()"/></a>&nbsp;</td>
        </tr>
        <?php
    }
    ?>
</table>
