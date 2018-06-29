<?php
include("../include/connect.php");
if (isset($_GET['id']) && $_GET['id'] != '') {
    $sql_delete = "DELETE FROM `t_indikator_kep` WHERE `id` = " . $_GET['id'];
//    echo $sql_delete;
    mysql_query($sql_delete);
} else {
//    echo 'test';
}
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
        <th align="center">TGL</th>
        <th align="center">RUANG</th>
        <th align="center">JML</th>
        <th align="center">#</th>
    </tr>
    <?
    include("../include/connect.php");
    $sql_list = "SELECT k.*,r.NAMA as nama_ruang FROM t_indikator_kep k JOIN m_ruang r ON r.no = k.ruang WHERE jenis='Restrain'";
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
            <td width="150" align="center"><?= date('d-m-Y', strtotime($data['TANGGAL'])) ?>&nbsp;</td>
            <td width="500"><?= $data['nama_ruang'] ?>&nbsp;</td>
            <td width="200" align="center"><?= $data['jumlah'] ?>&nbsp;</td>
            <td widht="200" align="center"><a type="button" class="text" onClick="return checkMe('<?= $data['id'] ?>')">Delete</a>&nbsp;</td>
        </tr>
        <?php
    }
    ?>
</table>