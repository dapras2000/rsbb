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
			<h3>REKAP PENDAPATAN RANAP</h3></div>
			<div align="right" style="margin:5px;">
				<form name="formsearch" method="get" action="<?php $_SERVER['PHP_SELF']; ?>" >
				<table width="248" border="0" cellspacing="0" class="tb">
				<tr><td>Tanggal</td><td><input type="text" name="tgl_reg" id="tgl_pesan" readonly="readonly" class="text" 
				value="<? if($_REQUEST['tgl_reg'] !=""): echo $_REQUEST['tgl_reg']; else: echo date('Y/m/d'); endif;
?>" style="width:100px;"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td><td ></td><td></td>
				</tr>
                <tr><td>Sd</td><td><input type="text" name="tgl_reg2" id="tgl_pesan2" readonly="readonly" class="text" 
				value="<?if($_REQUEST['tgl_reg2'] !=""): echo $_REQUEST['tgl_reg2']; else: echo date('Y/m/d'); endif;
?>" style="width:100px;" /><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td><td ><input type="hidden" name="link" value="35" /></td><td><input type="submit" value=" C a r i " class="text"/></td>
				</tr>
				</table>
				</form>
			</div>
            <?php
				 $sql	= 'select TGLBAYAR, t_bayarranap.SHIFT from t_bayarranap 
				INNER JOIN t_billranap ON t_billranap.IDXDAFTAR=t_bayarranap.IDXDAFTAR AND t_billranap.CARABAYAR=1
				where  IFNULL(TGLBAYAR,"0000-00-00")<> "0000-00-00"  and t_bayarranap.STATUS = "LUNAS" '.$search.' group by TGLBAYAR';
				$qry	= mysql_query($sql);
			?>
			<div id="table_search" style="min-height:300px;">
				<table width="95%" border="0" class="tb" cellspacing="0" cellspading="0">
					<tr align="center"><th width="156">TGL BAYAR</th><th width="129">SHIFT I</th><th width="130">SHIFT II</th><th width="116">SHIFT III</th><th width="204">Total Pendapatan Perhari</th></tr>
                    <?php
					while($data = mysql_fetch_array($qry)){
						 $sql_1	= mysql_query('SELECT TGLBAYAR, t_bayarranap.SHIFT,TOTTARIFRS,SUM((t_billranap.TARIFRS*t_billranap.QTY)-t_billranap.COSTSHARING-t_billranap.ASKES) AS total 
											  FROM t_bayarranap 
											  INNER JOIN t_billranap ON t_billranap.IDXDAFTAR=t_bayarranap.IDXDAFTAR AND t_billranap.NOBILL = t_bayarranap.NOBILL AND t_billranap.NOBILL = t_bayarranap.NOBILL AND t_billranap.CARABAYAR=1 
											  WHERE TGLBAYAR ="'.$data['TGLBAYAR'].'" AND t_bayarranap.SHIFT ="1" AND t_bayarranap.STATUS = "LUNAS" ');
						$shift_1= mysql_fetch_array($sql_1);
						
						$sql_2	= mysql_query('SELECT TGLBAYAR, t_bayarranap.SHIFT,TOTTARIFRS,SUM((t_billranap.TARIFRS*t_billranap.QTY)-t_billranap.COSTSHARING-t_billranap.ASKES) AS total 
											  FROM t_bayarranap 
											  INNER JOIN t_billranap ON t_billranap.IDXDAFTAR=t_bayarranap.IDXDAFTAR AND t_billranap.NOBILL = t_bayarranap.NOBILL AND t_billranap.CARABAYAR=1 
											  WHERE TGLBAYAR ="'.$data['TGLBAYAR'].'" AND t_bayarranap.SHIFT ="2" AND t_bayarranap.STATUS = "LUNAS" ');
						$shift_2= mysql_fetch_array($sql_2);
						
						$sql_3	= mysql_query('SELECT TGLBAYAR, t_bayarranap.SHIFT,TOTTARIFRS,SUM((t_billranap.TARIFRS*t_billranap.QTY)-t_billranap.COSTSHARING-t_billranap.ASKES) AS total 
											FROM t_bayarranap 
											INNER JOIN t_billranap ON t_billranap.IDXDAFTAR=t_bayarranap.IDXDAFTAR AND t_billranap.CARABAYAR=1 
											WHERE TGLBAYAR ="'.$data['TGLBAYAR'].'" AND t_bayarranap.SHIFT ="3" AND t_bayarranap.STATUS = "LUNAS" ');
						$shift_3= mysql_fetch_array($sql_3);

						echo '<tr>
								<td>'.$data['TGLBAYAR'].'  ['.'<a href="index.php?link=35pertanggal&tgl='.$data['TGLBAYAR'].'">Rekap</a>
								<a href="index.php?link=35pertanggal_det&tgl='.$data['TGLBAYAR'].'"> | Det ]</a>
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