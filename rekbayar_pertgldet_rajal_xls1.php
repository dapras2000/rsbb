<?php
include("include/connect.php");
$tgl	= $_REQUEST['tgl'];
if($_REQUEST['tgl'] == ''){
	$tgl	= date('Y-m-d');
}


?>

<div align="center">
	<div id="frame" style="width:100%;">
		<div id="frame_title">
			<h3> DETIL PENDAPATAN TANGGAL <?php echo $_REQUEST['tgl'];?></h3></div>
			<div align="right" style="margin:5px;">
				
			</div>
            <?php
$sql	= 'SELECT a.idxdaftar,a.TGLBAYAR, a.SHIFT,u.nama_unit,
a.nobill,a.TBP , t.nama_tindakan,qty,(qty*tarifrs)-askes-COSTSHARING AS JMBAYAR,
 a.NOMR, a.NIP, a.NOBILL, a.TBP, a.CARABAYAR, a.APS,  m_carabayar.NAMA AS carabayar_nama 
, CASE a.aps WHEN 1 THEN (SELECT nama FROM m_pasien_aps WHERE m_pasien_aps.NOMR=a.NOMR) ELSE 
(SELECT nama FROM m_pasien WHERE m_pasien.NOMR=a.NOMR) END
AS nama
FROM t_bayarrajal a
INNER JOIN t_billrajal b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill
INNER JOIN m_unit u ON u.kode_unit=b.unit
INNER JOIN m_tarif2012 t ON b.kodetarif=t.kode_tindakan
JOIN m_carabayar ON m_carabayar.kode = a.CARABAYAR  WHERE TGLBAYAR = "'.$tgl.'" AND a.CARABAYAR= 1 AND a.STATUS = "LUNAS" ORDER BY a.NOBILL ASC';
								
				$qry	= mysql_query($sql);
				?>
			<div id="table_search">
				<table width="95%" border="0" class="tb" cellspacing="0" cellspading="0">
					<tr align="center"><th width="100">NO BILLING</th>
					  <th width="162">No RM</th>
					  <th width="162">Nama Pasien</th>
					  <th width="159">Unit</th>
					  <th width="200">Tindakan</th>
				    <th width="100">CARA BAYAR</th><th width="70">SHIFT I</th><th width="70">SHIFT II</th><th width="70">SHIFT III</th></tr>
                    <?php
					#$s1=0; $s2=0; $s3=0;
					while($data = mysql_fetch_array($qry)){
						if($data['APS'] == '1'){
							$aps	='( APS )';
						}else{
							$aps	= '';
						}
						$total	= mysql_query('select JMBAYAR, SHIFT from t_bayarrajal where carabayar=1 and NOBILL = "'.$data['NOBILL'].'"');
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
								<td align="left">'.$data['nama_unit'].'</td>
								<td align="left">'.$data['nama_tindakan'].'</td>
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