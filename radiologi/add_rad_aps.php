<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title">
            <h3>ORDER RADIOLOGI APS</h3></div>
        <?php
        

        $idx_daftar = $_GET["idx"];
        ?>
        <fieldset class="fieldset">
            <legend>Identitas Pasien</legend>
            <?php
            $myquery = "SELECT
				  t_pendaftaran_aps.KDCARABAYAR,
				  t_pendaftaran_aps.IDXDAFTAR,
				  m_pasien_aps.NOMR,
				  m_pasien_aps.NAMA,
				  m_pasien_aps.JENISKELAMIN,
				  m_pasien_aps.ALAMAT,
				  m_pasien_aps.TGLLAHIR,
				  m_pasien_aps.TEMPAT,
				  m_carabayar.NAMA AS CARABAYAR
				FROM
				  t_pendaftaran_aps
				  INNER JOIN m_pasien_aps ON (t_pendaftaran_aps.NOMR = m_pasien_aps.NOMR)
				  INNER JOIN m_carabayar ON (t_pendaftaran_aps.KDCARABAYAR = m_carabayar.KODE)
				WHERE  t_pendaftaran_aps.IDXDAFTAR=".$idx_daftar;
            $get = mysql_query ($myquery)or die(mysql_error());
            $userdata = mysql_fetch_assoc($get);
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
        <fieldset class="fieldset">
            <legend>Pemeriksaan Radilogi</legend>
<? include("rad/order_rad.php"); ?>

        </fieldset>          
        <div id="addrad"></div>

    </div>
</div>
