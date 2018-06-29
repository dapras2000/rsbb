<?php 	
class neraca {	
	var $db_host;
	var $db_user;
	var $db_pass;
    var $allFields = array();
	var $strDBError       = "";
    var $intRow        = 0;

	public function getAllFields(){
		require_once("ParentChild.php");
		
		/*$sql="select * from mk_neraca order by Id,parentId";	
		$res=mysql_query($sql);
		$all_childs=array();
		while($val=mysql_fetch_assoc($res)) {
			array_push($all_childs,$val);
		}*/
		return $all_childs;	
	}
	
	public function getAllFieldsById($id){
		echo $sql="select * from mk_neraca where Id='$id' order by Id";	
		$res=mysql_query($sql);
		$allFields=array();
		$allFields=mysql_fetch_array($res);
		return $allFields;			
	}	
	public function updateAkun($id,$namaakun,$parentId,$icon){
		 $strSQL	="update mk_neraca set  name='$namaakun', parentId='$parentId',slave='$icon' where Id='$id'";
		$resQuery        = mysql_query($strSQL);
		if ($resQuery ) {
		  $this->intRow  = mysql_affected_rows();
		  return true;
		} else {
		  $this->strDBError   = mysql_error();
		  return false;
		}
	}	

	public function insertAkun($id,$namaakun,$parent,$icon){
		 $strSQL	="insert into mk_neraca(Id,NAME,parentId,slave) values('$id','$namaakun','$parent','$icon') ";
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