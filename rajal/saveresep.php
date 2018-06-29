<div style="border:1px solid #DF7; padding:5px; margin:5px; color:#093; width:95%; background-color:#FFF;" align="left">
<?php 
  //echo $_POST["idxnya"]; 
  include("../include/connect.php");

	$sql="CALL pr_savecartresep (".$_POST["idxnya"].")";
	//echo $sql; 
    mysql_query($sql); 
    echo "<p><strong style='color:green;'>Simpan Data Resep Pasien Berhasil.</strong></p>";
?>
</div>