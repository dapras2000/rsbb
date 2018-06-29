<?php
include("include/connect.php");
require_once('new_pagination.php');
$tgl	= $_REQUEST['tgl'];
$nomr	= $_REQUEST['nomr'];
if($_REQUEST['tgl'] == ''){
	$tgl	= date('Y-m-d');
}
if($_REQUEST['nomr'] == ''){
	$nomr 	= '';
}else{
	$nomr 	= ' and a.nomr = "'.$_REQUEST['nomr'].'"';
}

$crb	= 'and a.CARABAYAR > 1';
if($_REQUEST['carabayar'] != ''){
	$crb	= 'and a.CARABAYAR ='.$_REQUEST['carabayar'];
}

?>

<div align="center">
	<div id="frame" style="width:100%;">
		<div id="frame_title">
			<h3> DETIL REKAP ASURANSI TANGGAL <?php echo $_REQUEST['tgl'];?> </h3></div>
			<div align="right" style="margin:5px;">
			</div>
            <?php
				//$sql	= 'SELECT TGLBAYAR, SHIFT, NOMR, NIP, NOBILL, TBP, CARABAYAR, APS, JMBAYAR, m_carabayar.NAMA AS carabayar_nama , CASE aps WHEN 1 THEN (SELECT nama FROM m_pasien_aps WHERE m_pasien_aps.NOMR=t_bayarrajal.NOMR) ELSE (SELECT nama FROM m_pasien WHERE m_pasien.NOMR=t_bayarrajal.NOMR) END AS nama FROM t_bayarrajal JOIN m_carabayar ON m_carabayar.kode = t_bayarrajal.CARABAYAR WHERE TGLBAYAR = "'.$tgl.'" AND t_bayarrajal.CARABAYAR= 1 AND STATUS != "BATAL" ORDER BY NOBILL ASC';
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
JOIN m_carabayar ON m_carabayar.kode = a.CARABAYAR  WHERE TGLBAYAR = "'.$tgl.'" '.$nomr.' '.$crb.' AND a.STATUS = "LUNAS" ORDER BY a.NOMR,a.NOBILL ASC';
								
				$qry	= mysql_query($sql);
				?>
			<div id="table_search">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
            NOMR <input type="text" name="nomr" class="text" value="<?php echo $_REQUEST['nomr'];?>" />
            	 <input type="hidden" name="tgl" id="tgl" value="<?=$tgl?>" />
                 <input type="hidden" name="link" id="tgl" value="144_pertanggal_det" /> 
                 <input type="hidden" name="carabayar" id="carabayar" value="<?php echo $_REQUEST['carabayar'];?>" /> 
            	 <input type="submit" name="submit" value="Cari" />
            </form>
            <form action="daftarklaim/rekasuransi_pertgldet_rajal_xls.php" method="get">
                <input type="hidden" name="tgl" id="tgl" value="<?=$tgl?>" />
                	<input type="hidden" name="nomr" class="text" value="<?php echo $_REQUEST['nomr'];?>" />
                    <input type="hidden" name="crb" id="crb" value="<?php echo $_REQUEST['carabayar'];?>" /> 
                   	<input type="submit" value="export xls" />
                </form>
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
						$total	= mysql_query('select a.JMBAYAR, a.SHIFT from t_bayarrajal a where a.NOBILL = "'.$data['NOBILL'].'" '.$crb.'');
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