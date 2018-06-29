<?php
	error_reporting( 'E_ALL' );
	$file = $_GET[xml];
	$filePath = 'xml/' . $_GET[xml];

	if (file_exists( $filePath )) {
		$fileName = basename( $file );
		header( 'Cache-Control: private' );
		header( 'Content-Type: application/stream' );
		header( 'Content-Length: ' . $filePath );
		header( 'Content-Disposition: attachment; filename=' . $file );
		readfile( $filePath );
		exit(  );
	} 
else {
		exit( 'The provided file path is not valid.' );
	}

?>