<?php 
include '../include/connect.php';

if(isset($_POST['KETERANGAN'])) {
    if(empty($_POST['SHIFT'])) {

        echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
        echo "<strong>Maaf Shift Belum dipilih</strong>p<br>";
        echo "</div>";

    }else {

        $date=date("Y/m/d");
        $poly = $_POST['POLY'];

        $sql = "SELECT * FROM m_poly WHERE kode = '$poly'";
        $q = mysql_query($sql);
        $poly = mysql_fetch_assoc($q);

        mysql_query("INSERT INTO t_dpmp (IDXDAFTAR,NOMR,POLY,TYPEMAKANAN,KETERANGAN,JENISMAKANAN,SHIFT,TANGGAL,IDXTGL) VALUES ('$_POST[IDXDAFTAR]','$_POST[NOMR]','$_POST[POLY]','$_POST[TYPEMAKANAN]','$_POST[KETERANGAN]','$_POST[JENISMAKANAN]','$_POST[SHIFT]', NOW(),CURDATE())")or die(mysql_error());
        mysql_query("INSERT INTO t_notification VALUES('','<strong>No RM : $_POST[nomr]<br>POLY : $poly[nama]<br> Request :<br> $_POST[KETERANGAN]</strong>',NULL,'15')");
        echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
        echo "<div style='color:#090;'><strong>Input Data Sukses!</strong></div>";
        echo "</div>";
    }
}
?>
<div id="valid">
    <div id="head_report" style="display:none" align="center">
        <div align="center" style="clear:both; padding:20px">
            <div style="letter-spacing:-1px; font-size:16px; font:bold;"><?=strtoupper($header1)?></div>
            <div style="letter-spacing:-2px; font-size:24px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
					<div><?=$header3?><br /><?=$header4?></div>
            <hr style="margin:5px;" />

        </div>
    </div>

    <table width="95%" class="tb" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Pemesan Makanan Per Hari">
        <tr align="LEFT">
            <th width="6%"> NOMR</th>
            <th width="10%">NAMA</th>
            <th width="5%">POLY</th>
            <th width="4%">TYPEMAKANAN</th>
            <th width="5%">KETERANGAN</th>
            <th width="9%">JENISMAKANAN</th>
            <th width="10%" align="left">SHIFT</th>
            <th width="10%">REQUEST</th>
        </tr>
        <?

        if(empty($_POST['IDXDAFTAR'])) {
            $idx=$_GET['idx'];
        }else {
            $idx=$_POST['IDXDAFTAR'];
        }
        $sql="SELECT A.NOMR, A.TYPEMAKANAN, A.KETERANGAN, A.JENISMAKANAN, A.SHIFT, A.KETERANGANTAMBAHAN, A.TANGGAL,
	              B.NAMA AS NAMAPASIEN, 
		          C.NAMA AS POLY, C.NAMA AS RRUANG 
           FROM t_dpmp A, m_pasien B, m_poly C, t_pendaftaran D
		   WHERE A.POLY=C.kode AND A.IDXDAFTAR=D.idxdaftar AND A.NOMR=B.NOMR  AND D.idxdaftar='".$idx."'";
        $NO=0;
        $rs=mysql_query($sql);
        while($data = mysql_fetch_array($rs)) {?>
        <tr <?   echo "class =";
            $count++;
            if ($count % 2) {
                echo "tr1";
            }
            else {
                echo "tr2";
                }
    ?> valign="top" align="center">
            <td><? echo $data['NOMR'];?></td>
            <td align="left"><? echo $data['NAMAPASIEN']; ?></td>
            <td><? echo $data['POLY']; ?></td>
            <td><? echo $data['TYPEMAKANAN']; ?></td>
            <td><? echo $data['KETERANGAN']; ?></td>
            <td><? echo $data['JENISMAKANAN'];?></td>
            <td><? echo $data['SHIFT'];?></td>
            <td><? echo $data['KETERANGANTAMBAHAN'];?></td>
        </tr>
    <?	} ?>

    </table>
</div>
<input type="button" class="text" value="PRINT" onclick="printIt()" />
