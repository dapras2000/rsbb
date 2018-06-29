<?php 


$conn = mysql_connect("localhost","root","") or die(mysql_error()) ;
mysql_select_db("simrs_product") or die('Error'. mysql_error());


$datas=json_decode($_POST['dataRetur']);


foreach($datas as $data){

    
    
    $sql = "INSERT INTO `simrs_product`.`retur_apotek` (`idxdaftar`, `kode`, `nama`, `harga`, `jumlah`) VALUES ('".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."')";
    mysql_query($sql);
}
header('Location: index.php');
?>