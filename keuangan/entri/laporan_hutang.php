<link href="keuangan/doc/stylesheets/cell.css" rel="stylesheet" type="text/css" />
  <link href="keuangan/css/thickbox.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="keuangan/doc/javascripts/jquery.js"></script>  
<script language="javascript" src="keuangan/javascript/thickbox.js"></script>
<script language="javascript" src="keuangan/javascript/jquery.form.js"></script>
  <script type="text/javascript" src="keuangan/doc/javascripts/jquery.ui.js"></script>


  <!-- BEGIN Plugin Code -->

  <link href="keuangan/src/stylesheets/jquery.treeTable.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="keuangan/src/javascripts/jquery.treeTable.js"></script>
  
<?php 
require_once("include/connect.php"); 
$tahun	= isset($_REQUEST['TGLREG']) ? $_REQUEST['TGLREG'] : date('Y/m/d');
?>
<style>
td span.folder{font-weight:bold;}
</style>
<form action="?<?php echo 'link=laporan_hutang' ?>" method="post" class="input_tahun" id="cari" name="cari">
Tahun <input type="text" name="TGLREG" id="TGLREG" value="<?php echo $tahun ?>"/><a href="javascript:showCal('Calendar2')"><img align="top" src="img/date.png" border="0" /></a><input type="submit" name="btTahun" id="btTahun"  value="Open"/>
</form>

<table class="example" id="dnd-example">
  <thead>
    <tr>
      <th>Nama Akun</th>
      <th>Tahun <?php echo $tahun?></th>      
      <th>Aksi</th>      
    </tr>
  </thead>
  <tbody>
	<?php
	$sql	= mysql_query('SELECT a.name, b.tahun, b.nilai, a.slave
FROM mk_realisasi_anggaran a
LEFT JOIN tk_realisasi_anggaran b ON a.Id = b.id AND MONTH(b.tahun) = MONTH("'.$tahun.'") AND YEAR(b.tahun) = YEAR("'.$tahun.'")
WHERE a.Id LIKE "10%" ');
	if(mysql_num_rows($sql) > 0)
	{
		while($data = mysql_fetch_array($sql))
		{
			if($data['slave']	== 0){
				echo '<tr><th colspan="3">'.$data['name'].'</th></tr>';
			}else{
				echo '<tr><td>'.$data['name'].'</td><td>'.$data['tahun'].'</td><td>'.number_format($data['nilai'],0).'<td></tr>';
			}
		}
	}
	?>
  </tbody>
</table> 