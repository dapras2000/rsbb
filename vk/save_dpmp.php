<?php 
include("../include/connect.php");

if(isset($_POST['KETERANGAN'])){
	if(empty($_POST['SHIFT'])){
		
		echo "<div style='border:1px solid #DF7; width:95%; padding:5px; margin:5px; color:#F30; background-color:#FFF;' align='left'>";
	    echo "<strong>Maaf Shift Belum dipilih</strong>p<br>";
	    echo "</div>";
		
		}else{
						
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
                  <th width="4%">TYPEMAKANAN</th>
              <th width="5%">KETERANGAN</th>
              <th width="9%">JENISMAKANAN</th>
              <th width="10%" align="left">SHIFT</th>
                 <th width="5%">&nbsp;</th>
            </tr>
            <?
	 if(empty($_POST['IDXDAFTAR'])){
		$idx=$_GET['idx'];
	 }else{
	 	$idx=$_POST['IDXDAFTAR'];
	 }
	 $sql="SELECT A.IDX, A.NOMR, A.SHIFT, A.KETERANGANTAMBAHAN, A.TANGGAL,
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
 				   when 2 then 'LUNAK' 
				   when 3 then 'BUBUR SARING' 
                   when 4 then 'CAIR' 
				   when 5 then 'SONDE'
				   ELSE '-'
		 end as JENISMAKANAN,

	              B.NAMA AS NAMAPASIEN, 
		          P.nama AS NAMAPOLY 
           FROM t_dpmp A, m_pasien B, t_pendaftaran D,
           m_poly P
		   WHERE A.IDXDAFTAR=D.IDXDAFTAR AND A.NOMR=B.NOMR
           AND A.POLY=P.kode AND D.IDXDAFTAR='".$idx."'";
$NO=0;
$rs=mysql_query($sql);
while($data = mysql_fetch_array($rs)) {?>
            <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?> valign="top" align="center">
              <td><? echo $data['NOMR'];?></td>
              <td align="left"><? echo $data['NAMAPASIEN']; ?></td>
              <td><? echo $data['TYPEMAKANAN']; ?></td>
               <td><? echo $data['KETERANGAN']; ?></td>
              <td><? echo $data['JENISMAKANAN'];?></td>
              <td><? echo $data['SHIFT'];?></td>
                <td><a href="vk/del_makan.php?link=51&menu=6&nomr=<?=$data['NOMR']?>&idx=<?=$idx?>&idxorder=<?=$data['IDX']?>" class="text">BATAL</a></td>
            </tr>
            <?	} ?>
	
  </table>
</div>
<input type="button" class="text" value="PRINT" onclick="printIt()" />
