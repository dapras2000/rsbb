<?php

include("../include/connect.php");
if (isset($_POST['simpan'])) {

    if (isset($_GET['act']) & $_GET['act'] == 'edit') {
        $sql_update = "UPDATE `kep_m_tuj_header` SET `nama` = '" . $_POST['nama'] . "' WHERE `id_header` =" . $_POST['id'];
        mysql_query($sql_update);
    } else {
        echo 'test';
        ?>

<?php
        $sql_insert = "INSERT INTO  `t_indikator_kep` 
            (`id` ,`ruang` ,`TANGGAL`,`jumlah`,`jenis`)
VALUES (NULL ,'" . $_POST['ruang'] . "',  '" . date('Y-m-d', strtotime($_POST['tgl'])) . "',  '" . $_POST['jml'] . "','Pasien Jatuh')";
        echo $sql_insert;
        mysql_query($sql_insert);
    }
}
?>