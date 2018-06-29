<?php
include ('../include/connect.php');
$id		= $_REQUEST['id_operasi'];
$sql	= mysql_query('select * from t_operasi_tindakan_medis where idoperasi = "'.$id.'"');
if(mysql_num_rows($sql) > 0){
		$t	= 0;
		echo '<table style="width:100%;">';
		echo '<tr><th>Nama Pemeriksaan</th><th>Qty</th><th>Tarif</th></tr>';
		while($data = mysql_fetch_array($sql)){
			$t = $t + $data['tarif'];
			echo '<tr><td>'.$data['namajasa'].'</td><td>'.$data['qty'].'</td><td align="right">'.curformat($data['tarif']).'</td></tr>';													
		}
		echo '<tr><td colspan="2" style="border-top:1px solid #000; text-align:center;">Total</td><td style="border-top:1px solid #000; text-align:right;">'.curformat($t).'</td></tr>';
		echo '</table>';
};
?>