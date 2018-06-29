<?
include("../include/connect.php");
$query="select NOMR,NAMA,TEMPAT,TGLLAHIR,JENISKELAMIN,ALAMAT from m_pasien WHERE nomr='".$_GET['no']."'";
$hasil=mysql_query($query);
$baris=@mysql_fetch_array($hasil); ?>

<script language="javascript">
window.location="index.php?link=17&no=<?=$_GET['no']?>";
</script>
