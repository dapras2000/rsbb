<?php
class database{
	function connect($host, $db_user, $db_pass, $db_name) {
		global $conf,$main;
		mysql_connect("$host","$db_user","$db_pass") or die(mysql_error()) ;
		mysql_select_db("$db_name") or die($main->redirect('http://'.$conf[main_url].'/template/nodb.php',''));
	}
	function closedb(){
		mysql_close($this->connect);
	}
	function Query($table){
		$query = mysql_query("select * from '".$table."'")or die (mysql_error());
		echo $query;
		return $query;
	}
	function saveQuery($sql){
		$query = mysql_query ($sql) or die (mysql_error());
		return $query;
		
	}
	function loadQuery($query){
		$sql = $this->saveQuery($query);
		$array = array();
		while ($rows = mysql_fetch_array( $sql )){
			$array[] = $rows;
		}
		mysql_free_result( $sql );
		return $array;
	}
	function insert($var,$table,$where,$id){
		foreach($var as $key=>$val){
			$txts[] = " $key = '".$val."'";  
		}
		$val = join(",\n",$txts);
		if($id == ''){
			$sql = 'insert into '.$table.' set '.$val.''; 
		}else{
			$sql = "update ".$table." set ".$val." where ".$where." = '".$id."'"; 
		}
		mysql_query($sql) or die ('error');
	}
	function delete($var,$table,$where,$id){
			$sql = 'delete from '.$table.' where '.$where.' = "'.$id.'"'; 
			$this->saveQuery($sql); 
	}
	function bindparam($_param, $fldlist,$ret = 1) {
		if(!trim($fldlist)) return;
		if(!is_array($fldlist))
			$fldlist = split(',',str_replace(' ','',$fldlist));
		$par = array();
		foreach($fldlist as $fld) {
			global ${$fld};
			${$fld} = $_param[$fld];

			$par[$fld] = $_param[$fld];
		}
		
		if($ret) return $par;
	}
	function bindrequest($fldlist) {
		return bindparam($_REQUEST,$fldlist);
	}
	function publish($table,$where,$id,$default){
		if($default == '1'){ $val = '0';	}else{ $val = '1' ;	}
		$sql = "update ".$table." set published =".$val." where ".$where." = '".$id."'";		
		$this->saveQuery($sql); 
	}
	function Fpage($table,$where,$id,$default){
		if($default == '1'){ $val = '0';	}else{ $val = '1' ;	}
		$sql = "update ".$table." set fp=".$val." where ".$where." = '".$id."'";		
		$this->saveQuery($sql); 
	}
	function getTotal($query){
		$sql = $this->saveQuery($query);
		$rows = mysql_num_rows( $sql );
		mysql_free_result( $sql );
		return $rows;
	}
	function getOrder($query){
		$sql 	= $this->saveQuery($query);
		$rows 	= mysql_fetch_array( $sql );
		$row 	= $rows[0] + 1;
		mysql_free_result( $sql );
		return $row;
	}
	function getPublish($query){
		$sql 	= $this->saveQuery($query);
		$rows 	= mysql_fetch_array( $sql );
		$row	= $rows[0];
		mysql_free_result( $sql );
		return $row;
	}
	function getFpage($query){
		$sql 	= $this->saveQuery($query);
		$rows 	= mysql_fetch_array( $sql );
		$row	= $rows[0];
		mysql_free_result( $sql );
		return $row;
	}
}