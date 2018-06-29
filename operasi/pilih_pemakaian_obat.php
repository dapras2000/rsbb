<html>
<form action="operasi/tambah_pemakaian_obat.php" method="post" name="kirim">
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>DAFTAR PEMAKAIAN BHAP/OBAT KAMAR OPERASI</h3></div>

<table border="0" CELLSPACING="0" CELLPADDING="0" class="tb" align="center">
<?php
include("../include/connect.php");
$numcols = 4; // how many columns to display
$numcolsprinted = 0; // no of columns so far

// get the results to be displayed
$query = "select kode_barang,nama_barang from m_barang where KDUNIT='15'";
$mysql_result = mysql_query($query);
$total=mysql_num_rows($mysql_result);

$count = 1;
$column = 1;
echo "<tr><th>Kode Obat</th><th>Nama Obat</th><th>P</th><th>T</th><th>Kode Obat</th><th>Nama Obat</th><th>P</th><th>T</th></tr>";
//loop statement

while ($myrow = mysql_fetch_array ($mysql_result))
{
// first column display


if ($column == 1)
{
echo "<input type=hidden name=tanggal value=".$_GET['tanggal'].">";
echo "<input type=hidden name=kode[] value=".$myrow['kode_barang'].">";
echo "<input type=hidden name=nama[] value=".$myrow['nama_barang'].">";

//field is the column in your table
printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td>",$myrow["kode_barang"],$myrow['nama_barang'],
"<input type=checkbox name=pemakaian[] value=".$myrow['kode_barang'].">",
"<input type=checkbox name=terima[] value=".$myrow['kode_barang'].">");

}

else{
//second column display 
echo "<input type=hidden name=kode[] value=".$myrow['kode_barang'].">";
echo "<input type=hidden name=nama[] value=".$myrow['nama_barang'].">";

printf("<td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",$myrow["kode_barang"],$myrow['nama_barang'],
"<input type=checkbox name=pemakaian[] value=".$myrow['kode_barang'].">",
"<input type=checkbox name=terima[] value=".$myrow['kode_barang'].">");

}

$count += 1;

$column = $count % 2;
}
?> 
</table><BR>
</div></div>
<div align="center">
<input name="idoperasi" type="hidden" value="<?=$_GET['idoperasi'];?>">
<input name="ttl" type="hidden" value="<?=$total;?>">
<br><input type="submit" name="Submit" id="Submit" value="Pilih BHP/Obat" class="text">
</div>
</form>

</html>