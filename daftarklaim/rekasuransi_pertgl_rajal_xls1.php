<?php
include("../include/connect.php");
$tgl	= $_GET['tgl'];
$crb	= 'and t_bayarrajal.CARABAYAR > 1';
if($_REQUEST['crb'] != ''){
	$crb	= 'and t_bayarrajal.CARABAYAR ='.$_REQUEST['crb'];
}
?>
<div align="center">
	<div id="frame" style="width:80%;">
		<div id="frame_title">
			<h3>REKAP KLAIM ASURANSI TANGGAL <?php echo $_REQUEST['tgl'];?></h3></div>
			<div align="right" style="margin:5px;">
				
			</div>
            <?php
				$sql	= 'SELECT TGLBAYAR, SHIFT, NOMR, NIP, NOBILL, TBP, CARABAYAR, APS, JMBAYAR, m_carabayar.NAMA AS carabayar_nama 
, CASE aps WHEN 1 THEN (SELECT nama FROM m_pasien_aps WHERE m_pasien_aps.NOMR=t_bayarrajal.NOMR) ELSE 
(SELECT nama FROM m_pasien WHERE m_pasien.NOMR=t_bayarrajal.NOMR) END
AS nama
FROM t_bayarrajal 
JOIN m_carabayar ON m_carabayar.kode = t_bayarrajal.CARABAYAR 
WHERE TGLBAYAR = "'.$tgl.'" '.$crb.'
 AND STATUS = "LUNAS" ORDER BY NOBILL ASC';
				$qry	= mysql_query($sql);
				?>
			<div id="table_search">
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
						$total	= mysql_query('select JMBAYAR, SHIFT from t_bayarrajal where NOBILL = "'.$data['NOBILL'].'" '.$crb.'');
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
								<td align="right">'.($s1).'</td>
								<td align="right">'.($s2).'</td>
								<td align="right">'.($s3).'</td></tr>';
								//$s1=0; $s2=0; $s3=0;
					}					
					?>
				</table>
				
            </div>
		</div>             
	</div>
</div>