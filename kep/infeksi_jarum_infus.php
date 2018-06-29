<?php
include("../include/connect.php");
?>


<script>
    $(document).ready(function() {
        $("#tgl_infeksi_infus").datepicker({dateFormat: 'dd-mm-yy'});
        $("#formInfeksiInfus").validate({
            debug: false,
            messages: {
                tgl: "wajib diisi !",
                jml: "wajib diisi !",
                ruang: "wajib diisi !",
            },
            submitHandler: function(form) {
                // do other stuff for a valid form
                $.post('kep/infeksi_jarum_infus_saved.php', $("#formInfeksiInfus").serialize(), function(data) {
                    alert('data berhasil disimpan');
                    $('#formInfeksiInfus').each(function() {
                        this.reset();
                    });
                    $('#table_infeksi_jarum_infus').load('kep/infeksi_jarum_infus_table.php');
//                    $('#results').html(data);
                });
            }
        });

        $('#table_infeksi_jarum_infus').load('kep/infeksi_jarum_infus_table.php');

    });

    function checkMe(id) {
        if (confirm("Are you sure")) {

//            return true;
            $.ajax({
                url: 'kep/pasien_jatuh_table.php?id=' + id,
                type: 'DELETE',
                success: function(response) {

                    $('#table_infeksi_jarum_infus').load('kep/infeksi_jarum_infus_table.php');
                }
            })
        } else {
            return false;
        }
    }
</script>


<style type="text/css">
    label.error { width: 250px; display: inline; color: red;}
</style>
<div id="loading" style="display:none;"><img src="loading.gif" alt="loading..." /></div>
<div id="result" ></div>
<fieldset><legend>Input Data Infeksi Karena Jarum Infus</legend>

    <form id="formInfeksiInfus" method="post" action="">
        <table width="100%" border="0" cellpadding="4" cellspacing="2">

            <tr>
                <td width="200"><label for="tgl_pasien_jth" id="tgl_pasien_jth_label">TMT</label></td>
                <td><input type="text" name="tgl" class="required" id="tgl_infeksi_infus"> <b>(format:dd-mm-YYYY)</b></td>
            </tr>

            <tr>
                <td><label for="ruang" id="ruang_label">Ruang</label></td>
                <td>
                    <select name="ruang" id="ruang" class="required">
                        <option value="" selected="true"> --pilih-- </option>
                        <?php
                        $sql_combo_ruang = mysql_query("SELECT * FROM m_ruang");

                        while ($data_combo_ruang = mysql_fetch_array($sql_combo_ruang)) {
                            ?>
                            <option value="<?php echo $data_combo_ruang['no']; ?>"><?php echo $data_combo_ruang['nama']; ?></option>
                        <?php }
                        ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="jml" id="jml_label">Jml</label></td>
                <td><input class="required" name="jml" type="text" size="50"></td>
            </tr>
            <tr height="30px">
                <td><input type="submit" name="simpan" class="text" value="  S a v e  "/>&nbsp;
                <td>&nbsp;</td>
            </tr>
        </table>
    </form>
</fieldset>
<br>
<br>
<div id="table_infeksi_jarum_infus">

</div>
