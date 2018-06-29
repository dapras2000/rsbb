<?
	function getPost($name){
		if(isset($_POST[$name])) 
		  return (get_magic_quotes_gpc() ? $_POST[$name] : addslashes($_POST[$name]));
		else
		  return false;
	}
	if(isset($_POST['id'])){
		include("../../include/connect.php");
        $kode = getPost('kode');
        $group_jasa = getPost('group_jasa');
        $nama = getPost('nama');
        $tarif = getPost('tarif');
		  if($kode && $group_jasa && $nama ){
			if($id){
			  $SQLUpdate = "UPDATE m_tarif SET					
							 kode = '$id',
							 group_jasa = '$group_jasa',
							 nama_jasa = '$nama',
							 tarif = '$tarif'
							WHERE kode = '$id'";											
			  $query = mysql_query($SQLUpdate) or die(mysql_error());
			  echo '{status:3}'; 
			  exit;
			  //header("Location:index.php");
			}else{	  
			  $SQLInsert = "INSERT INTO m_tarif
								(kode,group_jasa,nama_jasa,tarif)
							  VALUES('$kode','$group_jasa','$nama','$tarif')";				
			  $query = mysql_query($SQLInsert) or die(mysql_error());
			  $lastID = mysql_insert_id();
			  echo '{status:2,Kode:'.$lastID.'}';
			}
		  }else echo '{status:1,text:"Kode, Group, Nama Harus Diinput"}';
	}
?>
