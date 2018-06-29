<?
$idoperasi=$_POST['idoperasi'];
//echo "<br>";
$kd=$_POST['kd'];
$kodejasa= $_POST['kodejasa'];
$namajasa=$_POST['namajasa'];
$tarif=$_POST['tarif'];
include("../include/connect.php");
for ($i=0;$i<count($kd);$i++)
{
//echo $idoperasi;
//echo $kd[$i];
$qcari="SELECT nama_jasa,tarif FROM m_tarif WHERE kode_jasa='".$kd[$i]."'";
$hasil=mysql_query($qcari);
while($baris=@mysql_fetch_array($hasil))
{
$nama= $baris[0];
$tarif=$baris[1];
}
//echo $kodejasa[$i];
//echo $namajasa[$i];
//echo $tarif[$i];
$qcari1="INSERT INTO t_operasi_tindakan_medis VALUES('','".$idoperasi."','".$kd[$i]."','".$nama."','".$tarif."')";
mysql_query($qcari1);

}
header('Location:'._BASE_.'/index.php?link=209&idoperasi='.$idoperasi.'&tanggal='.$_GET['tanggal']);
?>