<?php session_start(); 
include("../include/connect.php");
?>

<?
if(!empty($_GET['opt'])){
    if($_GET['opt']=="del"){
        mysql_query("delete from t_pp where idxpp =".$_GET['idxpp']);
    }

}
if(!empty($_POST['id_admission'])) {
    $id_admission = $_POST['id_admission'];
}else {
    $id_admission = $_GET['id_admission'];
}
if(isset($_POST['perjalanan_penyakit']) || isset($_POST['intruksi_dokter'])) {

    if(empty($_POST['perjalanan_penyakit']) || empty($_POST['intruksi_dokter'])) {
        echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
        echo "Isian Belum Lengkap<br>";
        if($_POST['perjalanan_penyakit']=="") {
            echo"- Data Perjalanan Penyakit Belum Diisi<br>";
        }
        if($_POST['intruksi_dokter']=="") {
            echo"- Data Intruksi Dokter Belum Diisi<br>";
        }
        echo "</div>";
    }else {
        $nomr = $_POST['nomr'];
        $noruang = $_POST['noruang'];        

        $date=date("d/m/Y");
		
        mysql_query("INSERT INTO t_pp VALUES('','$id_admission','$nomr','$noruang',NOW(),'$_POST[perjalanan_penyakit]','$_POST[intruksi_dokter]','$_SESSION[NIP]')")or die(mysql_error());
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
    <table align="center" width="95%" class="tb" border="0">
        <tr>
            <th width="11%">Tanggal / Jam</th>
            <th width="40%">Perjalanan Penyakit</th>
            <th width="36%">Intruksi Dokter</th>
            <th width="13%">NIP</th>
            <th width="5%">&nbsp;</th>
        </tr>
        <?php
// view data
        $sql = "SELECT * FROM t_pp WHERE IDXRANAP = '".$id_admission."' ORDER BY IDXPP DESC LIMIT 10";
        $qry = mysql_query($sql);
        while($data = mysql_fetch_array($qry)) {
            ?>
        <tr <?   echo "class =";
            $count++;
            if ($count % 2) {
                echo "tr1";
            }
            else {
                echo "tr2";
            }
                ?>>
            <td><?=$data['TANGGAL'];?></td>
            <td><?=$data['PERJALANAN_PENYAKIT'];?></td>
            <td><?=$data['INTRUKSI_DOKTER'];?></td>
            <td><?=$data['NIP'];?></td>
            <td><a href="#" class="text" onclick="javascript: MyAjaxRequest('valid_perjalanan_penyakit','ranap/save_perjalanan_penyakit.php?idxpp=<?=$data['IDXPP']?>&amp;id_admission=<?=$data['IDXRANAP']?>&amp;opt=del'); return false;" >Batal</a></td>
        </tr>
            <?php } ?>
    </table>
</div>
<input type="button" class="text" value="PRINT" onclick="printIt()" />
