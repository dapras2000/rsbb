<?php
	include( '../include/connect.php' );
	mysql_query( '' . 'delete from rl2 where code_list=\'' . $_GET['id'] . '\' and smt=\'' . $_GET['smt'] . '\' and tahun=\'' . $_GET['tahun'] . '\'' );
	header( 'location:../index.php?link=rl2' );
?>