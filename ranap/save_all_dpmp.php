<?php include("../include/connect.php");
$Qry = $_POST['query'];
$Shf= $_POST['SHIFT'];

$Qry = str_replace("\\", "", $Qry);
$get_dpmp = mysql_query($Qry) or die(mysql_error());
while($dat_dpmp = mysql_fetch_array($get_dpmp)) {
    if($dat_dpmp['TYPEMAKANAN']!="") {
        @mysql_query("INSERT INTO t_dpmp (IDXDAFTAR,NOMR,RUANG,TYPEMAKANAN,KETERANGAN,JENISMAKANAN,SHIFT,KETERANGANTAMBAHAN,TANGGAL,SNACK,IDXTGL)
       VALUES ('".$dat_dpmp['id_admission']."','".$dat_dpmp['nomr']."','".$dat_dpmp['noruang']."','".$dat_dpmp['TYPEMAKANAN']."','".$dat_dpmp['KETERANGAN']."','".$dat_dpmp['JENISMAKANAN']."','".$Shf."','".$dat_dpmp['KETERANGANTAMBAHAN']."', NOW(),'".$dat_dpmp['SNACK']."',CURDATE())");
    }
}

if(mysql_numrows($get_dpmp) > 0) {
    @mysql_query("INSERT INTO t_notification VALUES('','Ada Pesanan Baru.',NULL,'15')");
}
?>


<script language="javascript" type="text/javascript" >
    alert("Data Telah Disimpan.");
    window.location="../index.php?link=129x";
</script>
