<?php 	
class rla {	
	var $db_host;
	var $db_user;
	var $db_pass;
    var $allFields = array();
	var $strDBError       = "";
    var $intRow        = 0;

	public function getAllFields(){
		$sql="select * from mk_realisasi_anggaran order by Id,position";	
		$res=mysql_query($sql);
		$allFields=array();
		while($val=mysql_fetch_assoc($res)) {
			array_push($allFields,$val);
		}
		return $allFields;			
	}
	public function getAllFieldsById($id){
		$sql="select * from mk_realisasi_anggaran where Id='$id' order by Id";	
		$res=mysql_query($sql);
		$allFields=array();
		$allFields=mysql_fetch_array($res);
		return $allFields;			
	}	
	public function updateAkun($id,$namaakun,$parentId,$icon){
		$strSQL	="update mk_realisasi_anggaran set name='$namaakun', parentId='$parentId',slave='$icon' where Id='$id'";
		$resQuery        = mysql_query($strSQL);
		if ($resQuery ) {
		  $this->intRow  = mysql_affected_rows();
		  return true;
		} else {
		  $this->strDBError   = mysql_error();
		  return false;
		}
	}	

	public function insertAkun($id,$namaakun,$parent){
		$strSQL	="insert into mk_realisasi_anggaran(Id,NAME,parentId) values('$id','$namaakun','$parent') ";
		$resQuery        = mysql_query($strSQL);
		if ($resQuery ) {
		  $this->intRow  = mysql_affected_rows();
		  return true;
		} else {
		  $this->strDBError   = mysql_error();
		  return false;
		}
	}	

	public function db_connect(){
		$conn = mysql_connect($this->db_host, $this->db_user, $this->db_pass); 
		if($conn) {
			mysql_select_db($this->db_database, $conn);
		} 
		return $conn;
	}
		
	public function db_disconnect(){
		mysql_close();
	}
} 
?>