<? session_start();
$sql_rad = "SELECT DISTINCT m_radiologi.kd_rad, m_radiologi.gr_rad, m_radiologi.nama_rad
			FROM m_radiologi
			WHERE m_radiologi.gr_rad = '-' AND m_radiologi.tab_view = 2 AND paket = '2'";
$get_rad = mysql_query($sql_rad);

$sql_rad2 = "SELECT DISTINCT m_radiologi.kd_rad, m_radiologi.gr_rad, m_radiologi.nama_rad
			FROM m_radiologi
			WHERE m_radiologi.gr_rad = '-' AND m_radiologi.tab_view = 1 AND paket = '2'";
$get_rad2 = mysql_query($sql_rad2);
?>
<form name="rontagen" id="rontagen" action="radiologi/rad/valid_rontgen.php" method="post">
    <table width="75%" >
        <tr><td valign="top" width="50%">
                <table  border="0" cellspacing="0" width="100%" >
                    <? while($dat_rad2 = mysql_fetch_array($get_rad2)) { ?>
                    <tr>
                        <td colspan="4"><strong><?=$dat_rad2['nama_rad']?></strong></td>
                    </tr>
                        <?
                        $sql_rads2 = "SELECT DISTINCT m_radiologi.kd_rad, m_radiologi.gr_rad, m_radiologi.nama_rad
			FROM m_radiologi
			WHERE m_radiologi.gr_rad = '".$dat_rad2['kd_rad']."'";
                        $get_rads2 = mysql_query($sql_rads2);
                        while($dat_rads2 = mysql_fetch_array($get_rads2)) {
                            ?>
                    <tr>
                        <td width="5%">&nbsp;</td>
                        <td width="95%" colspan="3">
                            <input type="checkbox" name="rad<?=$dat_rads2['kd_rad']?>" value="<?=$dat_rads2['kd_rad']?>" />&nbsp;<?=$dat_rads2['nama_rad']?></td>
                    </tr>
                            <? }
                    }
                    ?>
                </table>
            </td>
            <td valign="top">

                <table width="100%" border="0" cellspacing="0" >
                    <? while($dat_rad = mysql_fetch_array($get_rad)) { ?>
                    <tr>
                        <td colspan="4"><strong><?=$dat_rad['nama_rad']?></strong></td>
                    </tr>
                        <?
                        $sql_rads = "SELECT DISTINCT m_radiologi.kd_rad, m_radiologi.gr_rad, m_radiologi.nama_rad
			FROM m_radiologi
			WHERE m_radiologi.gr_rad = '".$dat_rad['kd_rad']."'";
                        $get_rads = mysql_query($sql_rads);
                        while($dat_rads = mysql_fetch_array($get_rads)) {
                            ?>
                    <tr>
                        <td width="5%">&nbsp;</td>
                        <td width="95%" colspan="3">
                            <input type="checkbox" name="rad<?=$dat_rads['kd_rad']?>" value="<?=$dat_rads['kd_rad']?>" />&nbsp;<?=$dat_rads['nama_rad']?></td>
                    </tr>
                            <? }
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>
    <div align="left" style="margin:5px; padding:5px;">
        <table>
            
            <tr><td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" >
                    <input name="txtNoMR" id="txtNoMR" type="hidden" value=<?php echo $nomr; ?> >
                    <input name="txtIdxDaftar" id="txtIdxDaftar" type="hidden" value=<?php echo $idxdaftar; ?> >
                    <input name="txtTglReg" id="txtTglReg" type="hidden" value=<?php echo $tglreg; ?> >
                    <input name="txtNip" id="txtNip" type="hidden" value=<?php echo $_SESSION['NIP'];?> >
                    <input type="submit" name="saved" class="text" value=" S i m p a n " onsubmit="newsubmitform (document.getElementById('rontagen'),'radiologi/rad/valid_rontgen.php','val_rontagen',validatetask); return false;"/>
                </td>
            </tr>
        </table>
    </div>
</form>