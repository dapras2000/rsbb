<?
include("../include/connect.php");

if(!empty($_GET['idxoperasi'])){
mysql_query("UPDATE t_operasi_cito SET status = 'batal' 
			WHERE id_operasi = ".$_GET['idxoperasi']);
echo "Batal";
}
?>