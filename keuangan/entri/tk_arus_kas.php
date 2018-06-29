<?php 	
class tk_arus_kas {	
	var $db_host;
	var $db_user;
	var $db_pass;
    var $allFields = array();
	var $strDBError       = "";
    var $intRow        = 0;

	public function getAllFieldsById($id,$tahun){
	    $sql="select a.*,b.name from  mk_arus_kas b left join tk_arus_kas a on a.id=b.id and a.tahun='$tahun' where b.id='$id' order by a.id";	
		$res=mysql_query($sql);
		$allFields=array();
		$allFields=mysql_fetch_array($res);
		return $allFields;			
	}	
	
	public function updateTKAkun($id,$tahun,$nilai){
		$strSQL1 = "select * from tk_arus_kas where Id='$id' and tahun='$tahun'";
		$resQuery1 = mysql_query($strSQL1);
		 if ($resQuery1 && (mysql_num_rows($resQuery1) != 0) && (mysql_error() == "")) {
			$strSQL2	="update tk_arus_kas set  nilai='$nilai'  where Id='$id' and tahun='$tahun'";
			$resQuery2  = mysql_query($strSQL2);
		 }
		 else {
			$strSQL2	="insert into tk_arus_kas(id,tahun,nilai) values('$id','$tahun','$nilai')";
			$resQuery2  = mysql_query($strSQL2);			 
		 }
		 
		if ($resQuery2 ) {
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