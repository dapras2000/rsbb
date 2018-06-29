<?php
if(isset($_REQUEST['idx']) && isset($_REQUEST['poly'])){
	include("include/connect.php");
	$idx	= $_REQUEST['idx'];
	$poly	= $_REQUEST['poly'];
	
	$sql	= 	'select t_pendaftaran.NOMR, m_pasien.nama as pasien, m_poly.nama as poly, m_carabayar.nama as carabayar, t_pendaftaran.NIP, t_pendaftaran.PASIENBARU from t_pendaftaran 
				join m_pasien on t_pendaftaran.NOMR = m_pasien.NOMR 
				join m_poly on m_poly.kode = t_pendaftaran.KDPOLY
				join m_carabayar on m_carabayar.KODE = t_pendaftaran.KDCARABAYAR 
				where t_pendaftaran.KDPOLY ='.$poly.' and TGLREG ="'.date('Y-m-d').'" and t_pendaftaran.IDXDAFTAR="'.$idx.'"';
	$res	= mysql_query($sql) or die(mysql_error());
	$a		= mysql_num_rows($res);
	$data	= mysql_fetch_array($res);
	echo '<div id="print_tracer_ah">';
		//echo 'Anda Pasien Ke =>'.$a;
		if($data['PASIENBARU'] == 0){
			$tpb = 'LAMA';
		}else{
			$tbp = 'BARU';
		}
		?>
        <table width="396px">
        <tr><th colspan="2"> TRACER </th></tr>
        <tr><td>STATUS PASIEN</td><td><?php echo $tbp; ?></td></tr>
        <tr><td>NAMA</td><td><?php echo $data['pasien']; ?></td></tr>
        <tr><td>NOMOR RM</td><td><?php echo $data['NOMR'];?></td></tr>
        <tr><td>TUJUAN</td><td><?php echo $data['poly']; ?></td></tr>
        <tr><td>TANGGAL</td><td><?php echo date('Y-m-d'); ?></td></tr>
        <tr><td>CARA BAYAR</td><td><?php echo $data['carabayar']; ?></td></tr>
        <tr><td>PETUGAS</td><td><?php echo $data['NIP'];?></td></tr>
        <tr><td colspan="2" align="center">F-<?=strtoupper($singhead1)?> YANMED-10-12</td><td></td></tr>
        <!--
        <tr><td colspan="2">----------------------------------------</td><td></td></tr>
        <tr><td>NOMOR RM</td><td><?php echo $data['NOMR'];?></td></tr>
        <tr><td>TUJUAN</td><td><?php echo $data['poly']; ?></td></tr>
        <tr><td>CARA BAYAR</td><td><?php echo $data['carabayar']; ?></td></tr>
        <tr><td colspan="2">----------------------------------------</td><td></td></tr>
        <tr><td>NOMOR RM</td><td><?php echo $data['NOMR'];?></td></tr>
        <tr><td>TUJUAN</td><td><?php echo $data['poly']; ?></td></tr>
        <tr><td>CARA BAYAR</td><td><?php echo $data['carabayar']; ?></td></tr>
        -->
        </table>
        <?php
	echo '</div>';
}