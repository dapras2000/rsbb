<?
include("../include/connect.php");
if(!empty($_GET['idxoperasi'])){
	mysql_query("UPDATE t_operasi SET status = 'batal' WHERE id_operasi = ".$_GET['idxoperasi']);
	$sql = mysql_query('select * from t_admission where id_admission = "'.$_REQUEST['idxdaftar'].'"');
	if(mysql_num_rows($sql) > 0){
		$data = mysql_fetch_array($sql);
		if($data['noruang'] == 15){
			mysql_query('delete t_admission where id_admission = "'.$_REQUEST['idxdaftar'].'"');
		}
	}
}
header("Location:../index.php?link=".$_GET['link']."&page=".$_GET['page']);
?>