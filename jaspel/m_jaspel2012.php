<?php 	
class m_jaspel2012 {	
	var $db_host;
	var $db_user;
	var $db_pass;
    var $allFields = array();
	var $strDBError       = "";
    var $intRow        = 0;

	public function getAllFields(){
		$sql="select kode_tindakan,nama_tindakan,tarif,jasa_sarana,jasa_pelayanan,dr_spesialis,dr_umum,manajemen_sp,pendukung_sp,asisten_sp,manajemen_um,pendukung_um,asisten_um,manajemen_bd,pendukung_bd,asisten_bd,drOperator,drAnestesi,drAnak from m_tarif2012 order by kode_tindakan limit 20";	
		$res=mysql_query($sql);
		$allFields=array();
		while($val=mysql_fetch_assoc($res)) {
			array_push($allFields,$val);
		}
		return $allFields;			
	}
	public function getAllFieldsById($id){
		$sql="select * from m_tarif2012 where kode_tindakan='$id' order by kode_tindakan";	
		$res=mysql_query($sql);
		$allFields=array();
		$allFields=mysql_fetch_array($res);
		return $allFields;			
	}	
	
	public function updateAkun($id, $dr_spesialis , $dr_umum, $manajemen_sp , $pendukung_sp , $asisten_sp ,$manajemen_um, $pendukung_um , $asisten_um ,$bidan,$manajemen_bd , $pendukung_bd , $asisten_bd , $drOperator , $drAnestesi , $drAnak, $perawat_ok  , $perawat_perina , $manajemen_ok , $asisten_ok , $pendukung_ok ){
		echo $strSQL	="update m_tarif2012 set dr_spesialis ='$dr_spesialis' , dr_umum='$dr_umum', manajemen_sp='$manajemen_sp' , pendukung_sp='$pendukung_sp' , asisten_sp='$asisten_sp' ,manajemen_um='$manajemen_um', pendukung_um='$pendukung_um' , asisten_um='$asisten_um' ,bidan='$bidan',manajemen_bd='$manajemen_bd' , pendukung_bd='$pendukung_bd' , asisten_bd='$asisten_bd' ,  drOperator='$drOperator' , drAnestesi='$drAnestesi' , drAnak='$drAnak', perawat_ok='$perawat_ok'  , perawat_perina='$perawat_perina' , manajemen_ok='$manajemen_ok' , asisten_ok='$asisten_ok' , pendukung_ok='$pendukung_ok'  where kode_tindakan='$id'";
		$resQuery        = mysql_query($strSQL);
		if ($resQuery ) {
		  $this->intRow  = mysql_affected_rows();
		  return true;
		} else {
		  $this->strDBError   = mysql_error();
		  return false;
		}
	}	

	public function insertAkun($id,$namaakun,$parent,$jasa_sarana,$jasa_pelayanan,$tarif){
		$strSQL	="insert into m_tarif2012(kode_tindakan,nama_tindakan,kode_gruptindakan,jasa_sarana,jasa_pelayanan,tarif) values('$id','$namaakun','$parent','$jasa_sarana','$jasa_pelayanan','$tarif') ";
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