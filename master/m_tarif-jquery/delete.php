<?
	function getPost($name){
		if(isset($_POST[$name])) 
		  return (get_magic_quotes_gpc() ? $_POST[$name] : addslashes($_POST[$name]));
		else
		  return false;
	}

	isset($_POST['kode']) or die('Kurang Parameter');
	
	include("../../include/connect.php");
	$ID = getPost('kode');
	$query = mysql_query("DELETE FROM m_tarif WHERE ID = '$ID'");
	die($query);
	if(mysql_affected_rows() == 1) echo 'ok';
	else echo 'failed';
?>
