<?php session_start();
require_once("../../include/connect.php"); 

if (isset($_SESSION['KDUNIT']))
{
	$id_admin=$_SESSION['KDUNIT'];

     $id     = isset($_POST['id'])       ? $_POST['id']            : "";
	 $sql="DELETE FROM mk_arus_kas  WHERE Id = '$id'";
	$query = mysql_query($sql);
	if(mysql_affected_rows() >= 1) echo 'ok';
	else echo 'Gagal menghapus';
?>
<?php     
}else{
	?><script language="javascript">document.location.href="index.php?<?php echo 'status=forbidden'?>"</script><?php
}
?>    