<?php
include( '../include/connect.php' );
mysql_query( "delete from rl36 where code_list='{$_GET['id']}' and smt='{$_GET['bln']}' and tahun='{$_GET['tahun']}'" );
header( 'location:../index.php?link=rl36' );
?>
