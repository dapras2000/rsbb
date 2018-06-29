<?php
		include("../include/connect.php");
		include("../include/fungsi.php");
		//$skrg = date('Y-m-d');
		$link = $_GET['link'];
		$nomr = $_GET['nomr'];
		$idx = $_GET['idx'];
		$idxbill = $_GET['idxbill'];
		# HAPUS DATA 
		$sqlhapusproker = "DELETE FROM t_billranap WHERE idxdaftar='$idx' AND idxbill='$idxbill'";
   		mysql_query( $sqlhapusproker );
		//message_back($sqlhapuspiketterlambat);
   		$urle="../index.php?link=".$link."&nomr=".$nomr."&idx=".$idx;
	    message_url('Data Sudah Di Hapus',$urle);
?>