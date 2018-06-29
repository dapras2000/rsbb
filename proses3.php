<?php
	include( 'include/connect.php' );
	$q = strtolower( $_GET['q'] );

	if (!$q) {
		return null;
	}

	
	$sql = mysql_query( '' . 'select code_group,description from m_rl42 where description LIKE \'%' . $q . '%\' or code_group LIKE \'%' . $q . '%\'' );
	

	while ($r = mysql_fetch_array( $sql )) {
		
		$description = $r['description'];
		
		$code = $r['code_group'];
		echo '' . $code . '-' . $description . ' 
';
	}

?>