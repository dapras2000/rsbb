<?php session_start();
include("include/connect.php");
include("include/function.php");

if(!empty($_GET['tambah_deposit'])){
	mysql_query("INSERT INTO t_deposit (NOMR,IDADMISSION,DEPOSIT,TANGGAL) VALUES ('".$_GET['nomr']."','".$_GET['idx']."','".$_GET['tambah_deposit']."',now())") or die(mysql_error());
	$sqlview = "SELECT SUM(DEPOSIT) AS TOTAL FROM t_deposit WHERE IDADMISSION = '".$_GET['idx']."'";
	$qryview = mysql_query($sqlview);
	$chexdata = mysql_fetch_assoc($qryview);
	
	$dep = "SELECT deposit FROM t_admission WHERE id_admission = '".$_REQUEST['idx']."' and nomr = '".$_REQUEST['nomr']."'";
	$dep = mysql_query($dep);
	$olddep = mysql_fetch_assoc($dep);
	$total	= $chexdata['TOTAL'];
	
	mysql_query('update t_admission set deposit = "'.$total.'" WHERE id_admission = "'.$_REQUEST['idx'].'" and nomr = "'.$_REQUEST['nomr'].'"');
	?>
    <strong>Total Tambahan Deposit :</strong>
    <h1>Rp. <?php echo curformat($chexdata['TOTAL']).",00";?></h1><br />
    TOTAL DEPOSIT Rp. <?php echo curformat($total).",00"; ?>
<? } ?>