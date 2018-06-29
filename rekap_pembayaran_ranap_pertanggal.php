<?php
include("include/connect.php");
require_once('new_pagination.php');
$tgl	= $_REQUEST['tgl'];
if($_REQUEST['tgl'] == ''){
	$tgl	= date('Y-m-d');
}


?>

<div align="center">
	<div id="frame" style="width:80%;">
		<div id="frame_title">
			<h3>REKAP PENDAPATAN TANGGAL <?php echo $_REQUEST['tgl'];?></h3></div>
			<div align="right" style="margin:5px;">
				
			</div>
            <?php
 				#$sql	= 'SELECT TGLBAYAR, SHIFT, NOMR, NIP, NOBILL, TBP, CARABAYAR, APS, JMBAYAR, m_carabayar.NAMA AS carabayar_nama , CASE aps WHEN 1 THEN (SELECT nama FROM m_pasien_aps WHERE m_pasien_aps.NOMR=t_bayarranap.NOMR) ELSE (SELECT nama FROM m_pasien WHERE m_pasien.NOMR=t_bayarranap.NOMR) END AS nama FROM t_bayarranap JOIN m_carabayar ON m_carabayar.kode = t_bayarranap.CARABAYAR WHERE TGLBAYAR = "'.$tgl.'" AND t_bayarranap.CARABAYAR= 1 AND STATUS != "BATAL" ORDER BY NOBILL ASC';

$sql	= ' SELECT TGLBAYAR, t_bayarranap.SHIFT, t_bayarranap.NOMR, t_bayarranap.NIP, t_bayarranap.NOBILL, TBP, 
        t_billranap.CARABAYAR, t_bayarranap.APS, 
        SUM((t_billranap.TARIFRS*t_billranap.QTY)-t_billranap.COSTSHARING-t_billranap.ASKES) AS JMBAYAR, m_carabayar.NAMA AS carabayar_nama 
, CASE t_bayarranap.aps WHEN 1 THEN (SELECT nama FROM m_pasien_aps WHERE m_pasien_aps.NOMR=t_bayarranap.NOMR) ELSE 
(SELECT nama FROM m_pasien WHERE m_pasien.NOMR=t_bayarranap.NOMR) END
AS nama
FROM t_bayarranap 
INNER JOIN t_billranap ON t_billranap.IDXDAFTAR=t_bayarranap.IDXDAFTAR AND t_billranap.CARABAYAR=1
JOIN m_carabayar ON m_carabayar.kode = t_billranap.CARABAYAR 
WHERE TGLBAYAR = "'.$tgl.'" 
 AND t_bayarranap.STATUS = "LUNAS" 
 GROUP BY  TGLBAYAR, t_bayarranap.SHIFT, t_bayarranap.NOMR, t_bayarranap.NIP, t_bayarranap.NOBILL, TBP, 
        t_billranap.CARABAYAR, t_bayarranap.APS
ORDER BY t_bayarranap.NOBILL ASC';

				$qry	= mysql_query($sql);
				?>
			<div id="table_search">
				<table width="95%" border="0" class="tb" cellspacing="0" cellspading="0">
					<tr align="center"><th width="100px">NO BILLING</th><th>Nama Pasien</th><th width="100px">CARA BAYAR</th><th width="70px">SHIFT I</th><th width="70px">SHIFT II</th><th width="70px">SHIFT III</th></tr>
                    <?php
					#$s1=0; $s2=0; $s3=0;
					while($data = mysql_fetch_array($qry)){
						if($data['APS'] == '1'){
							$aps	='( APS )';
						}else{
							$aps	= '';
						}
						$total	= mysql_query('select SUM((t_billranap.TARIFRS*t_billranap.QTY)-t_billranap.COSTSHARING-t_billranap.ASKES) as JMBAYAR, SHIFT from t_billranap where NOBILL = "'.$data['NOBILL'].'"');
						$dtotal	= mysql_fetch_array($total);
						if($dtotal['SHIFT'] == '1'){
							$s1 = $data['JMBAYAR'];
							$s2 = 0;
							$s3 = 0;
						}elseif($dtotal['SHIFT'] == '2'){
							$s1 = 0;
							$s2 = $data['JMBAYAR'];
							$s3 = 0;
						}else{
							$s1 = 0;
							$s2 = 0;
							$s3 = $data['JMBAYAR'];
						}
						echo '<tr>
								<td>'.$data['NOBILL'].'</td>
								<td align="left">'.$data['nama'].$aps.'</td>
								<td align="center">'.$data['carabayar_nama'].'</td>
								<td align="right">'.curformat($s1).'</td>
								<td align="right">'.curformat($s2).'</td>
								<td align="right">'.curformat($s3).'</td></tr>';
								//$s1=0; $s2=0; $s3=0;
					}					
					?>
				</table>
            </div>
		</div>             
	</div>
</div>