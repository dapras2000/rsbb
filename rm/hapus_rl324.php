<?php


	include( '../include/connect.php' );
	mysql_query( '' . 'delete from rl324 where code_list=\'' . $_GET['id'] . '\' and bulan=\'' . $_GET['bln'] . '\' and tahun=\'' . $_GET['tahun'] . '\'' );
	header( 'location:../index.php?link=rl324' );
?>