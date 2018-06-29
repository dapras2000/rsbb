<html>
<form action="tambah_pemakaian_obat.php" method="post" name="kirim">
<table border="1" CELLSPACING="0" CELLPADDING="1" align="center">
<?php
include("../include/connect.php");
$numcols = 4; // how many columns to display
$numcolsprinted = 0; // no of columns so far

// get the results to be displayed
$query = "select kode_barang,nama_barang from m_barang where KDUNIT='15'";
$mysql_result = mysql_query($query);

$count = 1;
$column = 1;
echo "<tr><td>Kode Obat</td><td>Nama Obat</td><td>P</td><td>T</td><td>Kode Obat</td><td>Nama Obat</td><td>P</td><td>T</td></tr>";
//loop statement

while ($myrow = mysql_fetch_array ($mysql_result))
{
// first column display


if ($column == 1)
{
echo "<input type=hidden name=kode[] value=".$myrow['kode_barang'].">";
echo "<input type=hidden name=nama[] value=".$myrow['nama_barang'].">";

//field is the column in your table
printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td>",$myrow["kode_barang"],$myrow['nama_barang'],
"<input type=checkbox name=pemakaian[] value=P:".$myrow['kode_barang'].">",
"<input type=checkbox name=terima[] value=T:".$myrow['kode_barang'].">");

}

else{
//second column display 
echo "<input type=hidden name=kode[] value=".$myrow['kode_barang'].">";
echo "<input type=hidden name=nama[] value=".$myrow['nama_barang'].">";

printf("<td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",$myrow["kode_barang"],$myrow['nama_barang'],
"<input type=checkbox name=pemakaian[] value=P:".$myrow['kode_barang'].">",
"<input type=checkbox name=terima[] value=T".$myrow['kode_barang'].">");

}

$count += 1;

$column = $count % 2;
}
?> 
</table>
<div align="center">
<input type="submit" name="Submit" id="Submit" value="Pilih BHP/Obat">
</div>
</form>

</html>