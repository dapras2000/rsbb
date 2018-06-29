<?php session_start();
include 'include/connect.php';
include 'include/function.php';

$myquery = 'SELECT a.nomr AS NOMR, b.NAMA as pasien, a.TGLBAYAR, a.JAMBAYAR, a.TOTCOSTSHARING,a.JMBAYAR, a.UNIT, c.nama_unit,d.NAMA as carabayar
FROM t_bayarrajal a 
JOIN m_pasien b ON b.NOMR = a.NOMR 
JOIN m_unit c ON c.kode_unit = a.UNIT
JOIN m_carabayar d ON d.KODE = a.CARABAYAR 
WHERE a.NOMR = "'.$_REQUEST['nomr'].'"';
$get = mysql_query ($myquery)or die(mysql_error());
$userdata = mysql_fetch_assoc($get);
?>
<style type="text/css" media="screen">
#global_print{width:900px;}
#header{ height:100px; width:100%;}
#logo_cetak{float:left; height:100px; width:100px;}
#title{float:left; width:400px;}
#kepada{float:right; width:350px;}
#kepada .field{float:left; width:100px;}
#kepada .value{float:left; width:250px;}
#kuitansi{text-align:center; font-size:14px; font-weight:bold;}
#no_kuitansi{text-align:left; font-size:16px;}
table#table_list{width:100%; font-size:12px; border-collapse:0; border-spacing:0px;}
tr th{border-bottom:1px solid #000; border-top:1px solid #000;}
#footer{width:100%; font-size:12px;}
#last_line{font-size:11px; font-style:inherit; width:100%;}
</style>
<style type="text/css" media="print">
#global_print{width:900px;}
#header{ height:100px; width:100%;}
#logo_cetak{float:left; height:100px; width:100px;}
#title{float:left; width:400px;}
#kepada{float:right; width:350px;}
#kepada .field{float:left; width:100px;}
#kepada .value{float:left; width:250px;}
#kuitansi{text-align:center; font-size:14px; font-weight:bold; }
#no_kuitansi{text-align:left; font-size:16px;}
table#table_list{width:100%; font-size:12px; border-collapse:0; border-spacing:0px;}
tr th{border-bottom:1px solid #000; border-top:1px solid #000;}
#footer{width:100%; font-size:12px;}
#last_line{font-size:11px; font-style:inherit; width:100%;}
</style>
<div id="global_print" style="font-family:'Arial', Gadget, sans-serif; height:550px; width:780px;">
    <div id="header">
        <div id="logo_cetak">
		</div>
        <div id="title">
        	<div id="title1"><?=strtoupper($header1)?></div>
            <div id="title2"><?=strtoupper($header2)?></div>
			<div id="title3" style="font-size:11px;"><?=$header3?></div>
			<div id="title4" style="font-size:11px;"><?=$header4?></div>
        </div>
        <div id="kepada" style="padding-top:10px; font-size:12px;">
        	<div id="kepada1">Kepada Yth</div>
            <div id="kepada2"><div class="field">Nama pasien</div>
				<div class="value"><?php echo $userdata['pasien'];?></div>
			</div><br clear="all" />
            <div id="kepada3">
				<div class="field">No RM</div>
				<div class="value"><?php echo $userdata['NOMR'];?></div>
			</div><br clear="all" />
            <div id="kepada4">
				<div class="field">UNIT</div>
				<div class="value"><?php echo $userdata['nama_unit'];?></div>
			</div><br clear="all" />
            <div id="kepada4">
				<div class="field">Carabayar</div>
				<div class="value"><?php echo $userdata['carabayar'];?></div>
			</div><br clear="all" />
        </div>
    </div>
    <br clear="all" />
    <div id="kuitansi"> Diagnosa Pasien
	</div><br><br>

    <table id="table_list">
    	<tr></tr>
		<tr id="header_table">
			<th style="text-align:center;">No</th>
			<th style="text-align:left;">Nama Tindakan</th>
			<th style="text-align:left;">Jenis Tindakan</th>
		</tr>
			<tbody style="height:200px;">
				<?php
				$sql	= "SELECT d.nama_tindakan AS nama_jasa, d.nama_tindakan,b.IDXDAFTAR,d.kode_tindakan
								FROM t_billrajal b
								Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
								Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
								Left JOIN t_admission e on e.nomr=b.NOMR
								LEFT JOIN m_statuskeluar k on c.status=k.status
								WHERE c.status='2' and b.idxdaftar='".$_REQUEST['idxdaftar']."' 
								group by IDXBILL
							UNION ALL
								SELECT d.nama_tindakan AS nama_jasa, b.IDXDAFTAR, d.nama_tindakan,d.kode_tindakan
								FROM  t_billranap b
								Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
								Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
								Left JOIN t_admission e on e.nomr=b.NOMR
								LEFT JOIN m_statuskeluar k on c.status=k.status
								WHERE c.status='2' and b.idxdaftar='".$_REQUEST['idxdaftar']."' 
								group by IDXBILL";
								
				$total	= 0;
				$no = 1;
				$tot = 0;
                $qry = mysql_query($sql)or die(mysql_error());
                while($data = mysql_fetch_array($qry)) {
					$tot = $tot + ( $data['QTY'] * $data['TARIFRS']);
					if (substr($data['kode_tindakan'],0,2) == "01"){
						$st="Jasa Rawat Jalan";}
					else if (substr($data['kode_tindakan'],0,2) == "02"){
						$st="Jasa Tindakan Rajal";}
					else if (substr($data['kode_tindakan'],0,2) == "03"){
						$st="Rawat Inap";}
					else if (substr($data['kode_tindakan'],0,2) == "04"){
						$st="Kamar Operasi";}
					else if (substr($data['kode_tindakan'],0,5) == "06.01"){
						$st="Laboratorium";}
					else if (substr($data['kode_tindakan'],0,5) == "06.02"){
						$st="Radiologi";}
					else if (substr($data['kode_tindakan'],0,5) == "06.03"){
						$st="Elekteromedis";}
					else if (substr($data['kode_tindakan'],0,5) == "06.04"){
						$st="CT SCAN - MRI";}
					else if (substr($data['kode_tindakan'],0,5) == "07.01"){
						$st="Pelayanan Kesehatan";}
					else {
						$st=" ";
					}
					
					echo '<tr style="height:10px;">
							<td>'.$no++.'</td>
							<td>'.$data['nama_jasa'].'</td>
							<td>'.$st.'</td>
						  </tr>';
				}
				?>
			</tbody>
	</table>
	



    <br /><br />
	
    <div id="footer">
    	<div id="footer1" style="float:left; width:400px; height:100px;">
        	<br />
            Catatan :<br />
            Lembar 1 : Pasien / Penjamin <br />
            Lembar 2 : Kasir <br />
            Lembar 3 : Keuangan <br />
		</div>
        <div id="footer2" style="float:left; width:200px;">
			<div style="text-align:center; width:100%;">Kasir</div>
            <div style="text-align:center; width:100%; padding-top:70px;">( <?php echo $_SESSION['NIP'];?> )</div>
        </div>
    	<br clear="all" />
    </div>
    <div id="last_line"> Dicetak oleh : <?php echo $_SESSION['NIP']; ?> sebanyak [ 5 ] tanggal <?php echo date('d/m/Y H:i:s'); ?></div>
</div>