<?php
	include( 'include/connect.php' );
	$q = strtolower( $_GET['q']);;

	if (!$q) {
		return null;
	}

	$sql = mysql_query( '' . 'select description from m_rl2 where description LIKE \'%' . $q . '%\' limit '.$_GET['limit'] );

	while ($r = mysql_fetch_array( $sql )) {
		$description = $r['description'];
		echo "$description\n";
	}

?>