<?php
include("include/connect.php");
require_once('new_pagination.php');
$tgl	= $_GET['tgl'];
if($_GET['tgl'] == ''){
	$tgl	= date('Y-m-d');
}
$crb	= 'and t_bayarranap.CARABAYAR > 1';
if($_REQUEST['carabayar'] != ''){
	$crb	= 'and t_bayarranap.CARABAYAR ='.$_REQUEST['carabayar'];
}

?>

<div align="center">
	<div id="frame" style="width:80%;">
		<div id="frame_title">
			<h3>REKAP KLAIM ASURANSI RANAP TANGGAL <?php echo $_REQUEST['tgl'];?></h3></div>
			<div align="right" style="margin:5px;">
			</div>
            <?php
			$sql	= 'SELECT TGLBAYAR, t_bayarranap.SHIFT, t_bayarranap.NOMR, t_bayarranap.NIP, t_bayarranap.NOBILL, TBP, 
        t_billranap.CARABAYAR, t_bayarranap.APS, 
        SUM((t_billranap.TARIFRS*t_billranap.QTY)-t_billranap.COSTSHARING-t_billranap.ASKES) AS JMBAYAR, m_carabayar.NAMA AS carabayar_nama 
, CASE t_bayarranap.aps WHEN 1 THEN (SELECT nama FROM m_pasien_aps WHERE m_pasien_aps.NOMR=t_bayarranap.NOMR) ELSE 
(SELECT nama FROM m_pasien WHERE m_pasien.NOMR=t_bayarranap.NOMR) END
AS nama
FROM t_bayarranap 
INNER JOIN t_billranap ON t_billranap.IDXDAFTAR=t_bayarranap.IDXDAFTAR AND t_billranap.NOBILL = t_bayarranap.NOBILL AND t_billranap.CARABAYAR not in (1) '.$crb.'
JOIN m_carabayar ON m_carabayar.kode = t_billranap.CARABAYAR 
WHERE TGLBAYAR = "'.$tgl.'"
 AND t_bayarranap.STATUS = "LUNAS" 
 GROUP BY  TGLBAYAR, t_bayarranap.SHIFT, t_bayarranap.NOMR, t_bayarranap.NIP, t_bayarranap.NOBILL, TBP, 
        t_billranap.CARABAYAR, t_bayarranap.APS
ORDER BY t_bayarranap.NOBILL ASC';
				$qry	= mysql_query($sql);
				?>
			<div id="table_search">
            <form action="daftarklaim/rekasuransi_pertgl_ranap_xls.php" method="get">
                <input type="hidden" name="tgl" id="tgl" value=<?=$tgl?> />
                <input type="hidden" name="crb" id="tgl" value="<?=$_REQUEST['carabayar']?>" />
                   <input type="submit" value="export xls" />
                </form>
				<table width="95%" border="0" class="tb" cellspacing="0" cellspading="0">
					<tr align="center"><th width="100px">NO BILLING</th>
					  <th>No RM</th>
				    <th>Nama Pasien</th><th width="100px">CARA BAYAR</th><th width="70px">SHIFT I</th><th width="70px">SHIFT II</th><th width="70px">SHIFT III</th></tr>
                    <?php
					#$s1=0; $s2=0; $s3=0;
					while($data = mysql_fetch_array($qry)){
						if($data['APS'] == '1'){
							$aps	='( APS )';
						}else{
							$aps	= '';
						}
						$total	= mysql_query('select JMBAYAR, SHIFT from t_bayarranap where NOBILL = "'.$data['NOBILL'].'" '.$crb.'');
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
								<td align="left">'.$data['NOMR'].'</td>
								<td align="left">'.$data['nama'].$aps.'</td>
								<td align="center">'.$data['carabayar_nama'].'</td>
								<td align="right">'.curformat($s1).'</td>
								<td align="right">'.curformat($s2).'</td>
								<td align="right">'.curformat($s3).'</td></tr>';
								//$s1=0; $s2=0; $s3=0;
					}					
					?>
				</table>
				<p></p>
            </div>
		</div>             
	</div>
</div>