<?php
include("include/connect.php");
require_once('new_pagination.php');
if($_REQUEST['tgl_reg'] != ''){
	$start	= $_GET['tgl_reg'];
	$end	= $_GET['tgl_reg2'];
	if($start == ''){
		$start = date('Y-m-d');
	}
	if($end	== ''){
		$end	= date('Y-m-d');
	}
	$search	= 'and (TGLBAYAR between "'.$start.'" and "'.$end.'")';
}else{
	$search	= 'and (TGLBAYAR between "'.date('Y-m-d').'" and "'.date('Y-m-d').'")';
}
?>

<div align="center">
	<div id="frame" style="width:80%;">
		<div id="frame_title">
			<h3>REKAP KLAIM ASURANSI</h3></div>
			<div align="right" style="margin:5px;">
				<form name="formsearch" method="get" action="<?php $_SERVER['PHP_SELF']; ?>" >
				<table width="248" border="0" cellspacing="0" class="tb">
				<tr><td>Tanggal</td><td><input type="text" name="tgl_reg" id="tgl_pesan" readonly="readonly" class="text" value="<? if($tgl_reg!="") {
echo $tgl_reg; }?>" style="width:100px;"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td><td ></td><td></td>
				</tr>
                <tr><td>Sd</td><td><input type="text" name="tgl_reg2" id="tgl_pesan2" readonly="readonly" class="text" value="<? if($tgl_reg2!="") {
echo $tgl_reg2;}?>" style="width:100px;" /><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td><td ><input type="hidden" name="link" value="144_rekap" /></td><td><input type="submit" value=" C a r i " class="text"/></td>
				</tr>
				</table>
				</form>
			</div>
            <?php
				$sql	= 'select TGLBAYAR, SHIFT from t_bayarrajal where TGLBAYAR is not null and STATUS = "LUNAS" '.$search.' group by TGLBAYAR';
				$qry	= mysql_query($sql);
			?>
			<div id="table_search" style="min-height:300px;">
				<table width="95%" border="0" class="tb" cellspacing="0" cellspading="0">
					<tr align="center"><th width="156">TGL BAYAR</th><th width="129">SHIFT I</th><th width="130">SHIFT II</th><th width="116">SHIFT III</th><th width="204">Total Pendapatan Perhari</th></tr>
                    <?php
					while($data = mysql_fetch_array($qry)){
						$sql_1	= mysql_query('SELECT TGLBAYAR, SHIFT,TOTTARIFRS,SUM(JMBAYAR) AS total FROM t_bayarrajal WHERE TGLBAYAR ="'.$data['TGLBAYAR'].'" AND SHIFT ="1" AND STATUS = "LUNAS" and CARABAYAR not in (1)');
						$shift_1= mysql_fetch_array($sql_1);
						
						$sql_2	= mysql_query('SELECT TGLBAYAR, SHIFT,TOTTARIFRS,SUM(JMBAYAR) AS total FROM t_bayarrajal WHERE TGLBAYAR ="'.$data['TGLBAYAR'].'" AND SHIFT ="2" AND STATUS = "LUNAS" and CARABAYAR not in (1)');
						$shift_2= mysql_fetch_array($sql_2);
						
						$sql_3	= mysql_query('SELECT TGLBAYAR, SHIFT,TOTTARIFRS,SUM(JMBAYAR) AS total FROM t_bayarrajal WHERE TGLBAYAR ="'.$data['TGLBAYAR'].'" AND SHIFT ="3" AND STATUS = "LUNAS" and CARABAYAR not in (1)');
						$shift_3= mysql_fetch_array($sql_3);

						echo '<tr>
								<td>'.$data['TGLBAYAR'].'  ['.'<a href="index.php?link=144_pertanggal&tgl='.$data['TGLBAYAR'].'">Rekap</a>
								<a href="index.php?link=144_pertanggal_det&tgl='.$data['TGLBAYAR'].'"> | Det ]</a>
								</td>
								<td align="right">'.curformat($shift_1['total']).'</td>
								<td align="right">'.curformat($shift_2['total']).'</td>
								<td align="right">'.curformat($shift_3['total']).'</td>
								<td align="right">'.curformat($shift_1['total']+$shift_2['total']+$shift_3['total']).'</td></tr>';
					}
					?>
				</table>
            </div>
		</div>             
	</div>
</div>