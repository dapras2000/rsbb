<?php
include("../include/connect.php");
if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
    $sql_delete = "DELETE FROM `t_penugasan_primer` WHERE `id` = " . $_GET['id'];
//    echo $sql_delete;
    mysql_query($sql_delete);
} else {
//    echo 'test';
}
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
        <th align="center">TGL</th>
        <th align="center">Ketua Tim</th>
        <th align="center">Anggota</th>
        <th align="center">Perawat Primer</th>
		<th align="center">Perawat Associate</th>
		<th align="center">CCM</th>
		<th align="center">Edit</th>
		<th align="center">Delete</th>
    </tr>
    <?
    include("../include/connect.php");
    $sql_list = "SELECT a.id, a.KETUATIM as ketua,a.ANGGOTATIM,a.ANGGOTATIM2 as anggota2,a.ANGGOTATIM3 as anggota3,a.ANGGOTATIM4 as anggota4,a.ANGGOTATIM5 as anggota5,a.TANGGAL,a.MODULER1,a.MODULER2,a.CCM,b.NAMA FROM m_penugasan_perawat a 
        LEFT JOIN m_perawat b ON a.KETUATIM = b.IDPERAWAT";
        
    $rs_list = mysql_query($sql_list);
    while ($data = mysql_fetch_array($rs_list)) {
	
        $sql1="SELECT NAMA FROM m_perawat where IDPERAWAT='$data[ANGGOTATIM]'";
		$h1=mysql_query($sql1);
		$o1=mysql_fetch_array($h1);
		$sql2="SELECT NAMA FROM m_perawat where IDPERAWAT='$data[anggota2]'";
		$h2=mysql_query($sql2);
		$o2=mysql_fetch_array($h2);
		$sql3="SELECT NAMA FROM m_perawat where IDPERAWAT='$data[anggota3]'";
		$h3=mysql_query($sql3);
		$o3=mysql_fetch_array($h3);
		$sql4="SELECT NAMA FROM m_perawat where IDPERAWAT='$data[anggota4]'";
		$h4=mysql_query($sql4);
		$o4=mysql_fetch_array($h4);
		$sql5="SELECT NAMA FROM m_perawat where IDPERAWAT='$data[anggota5]'";
		$h5=mysql_query($sql5);
		$o5=mysql_fetch_array($h5);
		$sql6="SELECT NAMA FROM m_perawat where IDPERAWAT='$data[MODULER1]'";
		$h6=mysql_query($sql6);
		$o6=mysql_fetch_array($h6);
		$sql7="SELECT NAMA FROM m_perawat where IDPERAWAT='$data[MODULER2]'";
		$h7=mysql_query($sql7);
		$o7=mysql_fetch_array($h7);
		$sql8="SELECT NAMA FROM m_perawat where IDPERAWAT='$data[CCM]'";
		$h8=mysql_query($sql8);
		$o8=mysql_fetch_array($h8);

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
            <td width="150" align="center"><? echo"$data[TANGGAL]";?>&nbsp;</td>
            <td width="400"><? echo"$data[NAMA]";?>&nbsp;</td>
            <td width="400" align="center"><? echo"$o1[NAMA]";?><br>
			<? echo"$o2[NAMA]";?><br>
			<? echo"$o3[NAMA]";?><br>
			<? echo"$o4[NAMA]";?><br>
			<? echo"$o5[NAMA]";?>
			</td>
			 <td width="400" align="center"><? echo"$o6[NAMA]";?>&nbsp;&nbsp;</td>
			  <td width="400" align="center"><? echo"$o7[NAMA]";?>&nbsp;&nbsp;</td>
			   <td width="400" align="center"><? echo"$o8[NAMA]";?>&nbsp;&nbsp;</td>
			   <td width="400" align="center"><? echo"<a href=http://localhost/simrs/index.php?link=met_gas&id=$data[id]>Edit</a>" ?>&nbsp;&nbsp;</td>
         <td width="400" align="center"><? echo"<a href=http://localhost/simrs/index.php?link=met_gas&id=$data[id]&idel=1>Delete</a>" ?>&nbsp;&nbsp;</td>
        </tr>
        <?php
    }
    ?>
</table>