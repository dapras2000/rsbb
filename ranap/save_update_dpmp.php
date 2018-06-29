<?php
include("./include/connect.php");

if(isset($_POST['KETERANGAN'])) {
    if(empty($_POST['SHIFT'])) {

        echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
        echo "<strong>Maaf Shift Belum dipilih</strong>p<br>";
        echo "</div>";

    }else {

        $date=date("Y/m/d");
        $noruang = $_POST['RUANG'];

        $sql = "SELECT * FROM m_ruang WHERE no = '$noruang'";
        $q = mysql_query($sql);
        $ruang = mysql_fetch_assoc($q);
        $vSql = "INSERT INTO t_dpmp (IDXDAFTAR,NOMR,RUANG,TYPEMAKANAN,KETERANGAN,JENISMAKANAN,SHIFT,KETERANGANTAMBAHAN,TANGGAL,SNACK,IDXTGL) VALUES ('$_POST[IDXDAFTAR]','$_POST[NOMR]','$_POST[RUANG]','$_POST[TYPEMAKANAN]','$_POST[KETERANGAN]','$_POST[JENISMAKANAN]','$_POST[SHIFT]','$_POST[KETERANGANTAMBAHAN]', NOW(),'$_POST[SNACK]',CURDATE())";
        if(@mysql_query($vSql)) {
            mysql_query("INSERT INTO t_notification VALUES('','<strong>No RM : $_POST[nomr]<br>Ruang : $ruang[nama]<br> Request :<br> $_POST[KETERANGAN]</strong>',NULL,'15')");
            echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
            echo "<div style='color:#090;'><strong>Input Data Sukses!</strong></div>";
            echo "</div>";
        }else {
            echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
            echo "<div style='color:#090;'><strong>Input Data Gagal!</strong></div>";
            echo "</div>";
        }
    }
}

if(!empty($_POST['IDXDAFTAR'])) {
    $idx = $_POST['IDXDAFTAR'];
}else if(!empty($_GET['id_admission'])) {
    $idx = $_GET['id_admission'];
}else {
    $idx = $id_admission;
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
            <th width="5%">KELAS</th>
            <th width="5%">RUANG</th>
            <th width="4%">TYPEMAKANAN</th>
            <th width="5%">KETERANGAN</th>
            <th width="9%">JENISMAKANAN</th>
            <th width="10%" align="left">SHIFT</th>
            <th width="10%" align="left">SNACK</th>
            <th width="10%">REQUEST</th>
        </tr>
        <?

        $sql = "SELECT A.NOMR, A.RUANG, A.KETERANGANTAMBAHAN, A.TANGGAL,
			 case A.TYPEMAKANAN 
					   when 1 then 'PASIEN YANG MENDAPAT MAKANAN BIASA' 
					   when 2 then 'PASIEN YANG MENDAPAT MAKANAN KHUSUS'
					   ELSE '-'
			 end as TYPEMAKANAN,
	 		 case A.KETERANGAN 
		 		   when 1 then 'TKTP' 
 				   when 2 then 'RG' 
				   when 3 then 'DL' 
                   when 4 then 'DH' 
				   when 5 then 'DM'
				   when 6 then 'DJ'
				   when 7 then 'TP'
				   when 8 then 'RP.r'
				   when 9 then 'RP'
				   ELSE '-'
		 end as KETERANGAN,
 	     case A.JENISMAKANAN 
		           when 1 then 'NASI' 
				   when 6 then 'NASI TIM'
 				   when 2 then 'LUNAK / BUBUR' 
				   when 3 then 'BUBUR SARING' 
                   when 4 then 'CAIR' 
				   when 5 then 'SONDE'
				   ELSE '-'
		 end as JENISMAKANAN,

                 case A.SHIFT
		           when 1 then 'Pagi'
 				   when 2 then 'Siang'
				   when 3 then 'Sore'
                 end as SHIFT,
                 case A.SNACK
		           when 1 then 'Pagi'
                            when 2 then 'Siang'
                 end as SNACK,


	              B.NAMA AS NAMAPASIEN, 
		          C.KELAS, C.NAMA AS RRUANG 
           FROM t_dpmp A, m_pasien B, m_ruang C, t_admission D
		   WHERE A.RUANG=C.NO AND A.IDXDAFTAR=D.id_admission AND A.NOMR=B.NOMR AND D.id_admission='".$idx."'";
        $NO=0;
        $rs=mysql_query($sql) or die(mysql_error());
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
            <td><? echo $data['KELAS']; ?></td>
            <td><? echo $data['RRUANG']; ?></td>
            <td><? echo $data['TYPEMAKANAN']; ?></td>
            <td><? echo $data['KETERANGAN']; ?></td>
            <td><? echo $data['JENISMAKANAN'];?></td>
            <td><? echo $data['SHIFT'];?></td>
            <td><? echo $data['SNACK'];?></td>
            <td><? echo $data['KETERANGANTAMBAHAN'];?></td>
        </tr>
            <?	} ?>

    </table>
</div>
<input type="button" class="text" value="PRINT" onclick="printIt()" />
