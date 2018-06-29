<body onload="javascript:window.print();">
<?php session_start();
include '../include/connect.php';
include '../include/function.php';
include '../include/fungsi.php';
date_default_timezone_set('Asia/Jakarta');
$hr = date('Y-m-d H:i:s');
$hrini = date('Y-m-d');
$jamini = date('H:i');


$myquery = 'SELECT b.JENISKELAMIN, b.ALAMAT,b.TGLLAHIR, a.nobill, a.nomr AS NOMR, b.NAMA as pasien, a.TGLBAYAR, a.JAMBAYAR, a.TOTCOSTSHARING,a.JMBAYAR, a.UNIT, c.nama_unit,d.NAMA as carabayar
FROM t_bayarrajal a 
JOIN m_pasien b ON b.NOMR = a.NOMR 
JOIN m_unit c ON c.kode_unit = a.UNIT
JOIN m_carabayar d ON d.KODE = a.CARABAYAR 
WHERE a.NOMR = "'.$_REQUEST['nomr'].'"';
$get = mysql_query ($myquery)or die(mysql_error());
$userdata = mysql_fetch_assoc($get);

$myadmin = "SELECT * FROM t_admission WHERE id_admission='$_REQUEST[idx]'";
$hmyadmin = mysql_fetch_array(mysql_query($myadmin));
//echo $myadmin;
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
#title{float:right; text-align: center; width:400px;}
#info{float:left; text-align: center; width:400px;}
#kepada{float:right; width:350px;}
#kepada float:left; width:100px;
#kepada .value{float:left; width:250px;}
#kuitansi{text-align:center; font-size:14px; font-weight:bold; }
#no_kuitansi{text-align:left; font-size:16px;}
table#table_list{width:100%; font-size:12px; border-collapse:0; border-spacing:0px;}
tr th{border-bottom:1px solid #000; border-top:1px solid #000;}
#footer{width:100%; font-size:12px;}
#last_line{font-size:11px; font-style:inherit; width:100%;}
</style>
<div id="global_print" style="font-family:'Arial', Gadget, sans-serif; height:550px; width:780px;">
    <!--<div id="header">
        <div id="logo_cetak">
		</div>
        <div id="title">
        	<div id="title1">RSUI BANYUBENING</div>
            <div id="title2"><?=strtoupper($header2)?></div>
			<div id="title3" style="font-size:11px;">Jl. Raya Waduk Cengklik Ngargorejo Ngemplak Boyolali</div>
			<div id="title4" style="font-size:11px;">0276 320088</div>
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
			<div id="kepada4">
				<div class="field">NO Transaksi</div>
				<div class="value"><?php echo $userdata['nobill'];?> / ranap</div>
			</div>
			<br clear="all" />
        </div>
		</br>
    </div>-->
	</br>
    <br clear="all" />
   <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb">
    	<tr><td style="font-size: 20px;">RSUI BANYUBENING</td></tr>
    	<tr><td style="font-size: 14px;">Jl. Raya Waduk Cengklik Ngargorejo Ngemplak Boyolali</td></tr>
    	<tr><td style="font-size: 14px;">0276 320088</td></tr>
    </table>    
   <hr width="100%" style="margin-left: -0px;">
   <!--<center><strong>Kuitansi Pembayaran</strong></center>-->
   <?php $dokter=mysql_fetch_array(mysql_query("SELECT * FROM m_dokter WHERE KDDOKTER='$hmyadmin[dokter_penanggungjawab]'")); ?>
    <?php $ruang=mysql_fetch_array(mysql_query("SELECT * FROM m_ruang WHERE no='$hmyadmin[noruang]'")); ?>
    <h3 align="center">KUITANSI PEMBAYARAN<br>NO : <?php echo $userdata['nobill'];?>/<?php echo $userdata['carabayar'];?></h3>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb">
		<tr><td>Nama Pasien</td><td>:<?php echo $userdata['pasien'];?></td>
			<td>No RM</td><td>:<?php echo $userdata['NOMR'];?></td></tr>
		<tr><td>Umur</td><td>:<?php echo hitung_umur_tahun($userdata['TGLLAHIR']);?></td><td>Jenis Kelamin</td><td>:<?php echo $userdata['JENISKELAMIN'];?></td></tr>
		<tr><td>Alamat</td><td colspan="3">:<?php echo $userdata['ALAMAT'];?></td></tr>
		<tr><td>Tanggal Masuk</td><td>:<?php echo tampilTanggal(substr($hmyadmin['masukrs'],0,10));?></td><td>Jam Masuk</td><td>:<?php echo substr($hmyadmin['masukrs'],11,5);?></td></tr>
		<!--<tr><td>Tanggal Keluar</td><td>:<?php //echo tampilTanggal(substr($hmyadmin['keluar'],0,10));?></td><td>Jam Keluar</td><td>:<?php //echo substr($hmyadmin['keluarrs'],11,5);?></td></tr>
		-->
		<tr><td>Tanggal Keluar</td><td>:<?php echo tampilTanggal($hrini);?></td><td>Jam Keluar</td><td>:<?php echo $jamini;?></td></tr>
		<tr><td>Dokter</td><td>:<?php echo $dokter['NAMADOKTER'];?></td><td></td><td></td></tr>
		<tr><td>Ruang Perawatan</td><td>:<?php echo $ruang['nama'].' / '.$hmyadmin['nott'];?></td><td>Cara Bayar</td><td>:<?php echo $userdata['carabayar'];?></td></tr>
		<tr><td></td><td></td><td></td><td></td></tr>
	</table>
    
	<h3 align="center" style="width:100%">Rekap Bill Pasien</h3>
    <div id="frame">
		<table>
						<?
				$sql3	= "SELECT d.nama_tindakan AS nama_jasa, d.nama_tindakan,b.IDXDAFTAR, b.TARIFRS,b.QTY,b.nomr
							FROM t_billrajal b
							Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
							Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
							Left JOIN t_admission e on e.nomr=b.NOMR
							LEFT JOIN m_statuskeluar k on c.status=k.status
							WHERE c.status='2' and b.KODETARIF != '07' and b.idxdaftar='".$_REQUEST['idx']."' 
							group by IDXBILL
							UNION ALL
							SELECT d.nama_tindakan AS nama_jasa, b.IDXDAFTAR, d.nama_tindakan,b.TARIFRS,b.QTY,b.nomr
							FROM  t_billranap b
							Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
							Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
							Left JOIN t_admission e on e.nomr=b.NOMR
							LEFT JOIN m_statuskeluar k on c.status=k.status
							WHERE c.status='2' and b.KODETARIF != '07' and b.idxdaftar='".$_REQUEST['idx']."' 
							group by IDXBILL
							UNION ALL
							SELECT l.LUNAS, d.nama_tindakan AS nama_jasa, d.nama_tindakan,b.IDXDAFTAR, b.TARIFRS,b.QTY
							FROM t_billrajal b
							Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
							Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
							Left JOIN t_admission e on e.nomr=b.NOMR
							LEFT JOIN m_statuskeluar k on c.status=k.status
							Left Join t_bayarrajal l On l.NOBILL=b.NOBILL
							JOIN m_pasien x ON c.NOMR = x.NOMR 
							WHERE c.status='2' and b.KODETARIF != '07' and x.PARENT_NOMR='".$_REQUEST['nomr']."' 
							group by IDXBILL
							";
							
				
				$qry3 = mysql_query($sql3)or die(mysql_error());
				$data2=mysql_fetch_array($qry3);
				?>
				
			</table>
			<?php  "SELECT d.nama_tindakan AS nama_jasa, d.nama_tindakan,b.IDXDAFTAR, b.TARIFRS,b.QTY,b.nomr
							FROM t_billrajal b
							Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
							Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
							Left JOIN t_admission e on e.nomr=b.NOMR
							LEFT JOIN m_statuskeluar k on c.status=k.status
							WHERE c.status='2' and b.KODETARIF != '07' and b.idxdaftar='".$_REQUEST['idx']."' 
							group by IDXBILL
							UNION ALL
							SELECT d.nama_tindakan AS nama_jasa, b.IDXDAFTAR, d.nama_tindakan,b.TARIFRS,b.QTY,b.nomr
							FROM  t_billranap b
							Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
							Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
							Left JOIN t_admission e on e.nomr=b.NOMR
							LEFT JOIN m_statuskeluar k on c.status=k.status
							WHERE c.status='2' and b.KODETARIF != '07' and b.idxdaftar='".$_REQUEST['idx']."' 
							group by IDXBILL
							UNION ALL
							SELECT l.LUNAS, d.nama_tindakan AS nama_jasa, d.nama_tindakan,b.IDXDAFTAR, b.TARIFRS,b.QTY
							FROM t_billrajal b
							Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
							Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
							Left JOIN t_admission e on e.nomr=b.NOMR
							LEFT JOIN m_statuskeluar k on c.status=k.status
							Left Join t_bayarrajal l On l.NOBILL=b.NOBILL
							JOIN m_pasien x ON c.NOMR = x.NOMR 
							WHERE c.status='2' and b.KODETARIF != '07' and x.PARENT_NOMR='".$_REQUEST['nomr']."' 
							group by IDXBILL"; ?>

            <table width="100%" border="1" cellpadding="0" cellspacing="0" class="tb">
                <tr>
					<th style="width:10%;text-align:center;">No</th>
					<th style="width:10%;"">Kode</th>
                    <th style="width:40%;">Jenis Tindakan</th>
                    <th style="width:10%;">QTY</th>
					<th style="width:20%;" >Jumlah Harga</th>
					<th style="width:10%; text-align: center;" >Ket</th>
					
                </tr>
                        <?php
                        $sql="SELECT l.LUNAS, d.nama_tindakan AS nama_jasa, d.kode AS kdbpjs,b.IDXDAFTAR, b.TARIFRS,b.QTY FROM t_billrajal b
							Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR 
							Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
							Left JOIN t_admission e on e.nomr=b.NOMR 
							LEFT JOIN m_statuskeluar k on c.status=k.status 
							Left Join t_bayarrajal l On l.NOBILL=b.NOBILL WHERE c.status='2' and b.idxdaftar='$_REQUEST[idx]' group by IDXBILL UNION ALL SELECT l.LUNAS,d.nama_tindakan AS nama_jasa, d.kode AS kdbpjs, b.IDXDAFTAR,b.TARIFRS,b.QTY FROM t_billranap b Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan Left JOIN t_admission e on e.nomr=b.NOMR LEFT JOIN m_statuskeluar k on c.status=k.status Left Join t_bayarranap l On l.NOBILL=b.NOBILL WHERE c.status='2' and b.idxdaftar='$_REQUEST[idx]' group by IDXBILL";

						//$sql = "SELECT l.LUNAS, d.nama_tindakan AS nama_jasa, d.kode AS kdbpjs,b.IDXDAFTAR, b.TARIFRS,b.QTY FROM t_billrajal b Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan Left JOIN t_admission e on e.nomr=b.NOMR LEFT JOIN m_statuskeluar k on c.status=k.status Left Join t_bayarrajal l On l.NOBILL=b.NOBILL WHERE c.status='2' and b.idxdaftar='".$_REQUEST['idx']."' group by IDXBILL UNION ALL SELECT l.LUNAS,d.nama_tindakan AS nama_jasa, b.IDXDAFTAR, d.nama_tindakan,b.TARIFRS,b.QTY FROM t_billranap b Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan Left JOIN t_admission e on e.nomr=b.NOMR LEFT JOIN m_statuskeluar k on c.status=k.status Left Join t_bayarranap l On l.NOBILL=b.NOBILL WHERE c.status='2' and b.idxdaftar='".$_REQUEST['idx']."' group by IDXBILL";
				  
						$total	= 0;
						$no = 1;
						
                        $qry = mysql_query($sql)or die(mysql_error());
                        
						//echo $sql;
						$sqlrekap= "SELECT * FROM m_bpjs ORDER BY kdtindakan ASC";
						$qrekap=mysql_query($sqlrekap);
						$totrekap=0;
						$totrekapo=0;
						$qtyrekap = 0;
						while ($hrekap=mysql_fetch_array($qrekap)) {
							$kdrekap=$hrekap['kdtindakan'];
							 $tote = 0;
							 $qtye = 0;
							 $toteo = 0;?>	
							<tr>
								
								 	<?php 
								 		$sqltot="SELECT l.LUNAS, d.nama_tindakan AS nama_jasa, d.kode AS kdbpjs,b.IDXDAFTAR, b.TARIFRS,b.QTY FROM t_billrajal b
							Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR 
							Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
							Left JOIN t_admission e on e.nomr=b.NOMR 
							LEFT JOIN m_statuskeluar k on c.status=k.status 
							Left Join t_bayarrajal l On l.NOBILL=b.NOBILL WHERE c.status='2' and b.idxdaftar='$_REQUEST[idx]'  and d.kode='$kdrekap' group by IDXBILL UNION ALL SELECT l.LUNAS,d.nama_tindakan AS nama_jasa, d.kode AS kdbpjs, b.IDXDAFTAR,b.TARIFRS,b.QTY FROM t_billranap b Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan Left JOIN t_admission e on e.nomr=b.NOMR LEFT JOIN m_statuskeluar k on c.status=k.status Left Join t_bayarranap l On l.NOBILL=b.NOBILL WHERE c.status='2' and b.idxdaftar='$_REQUEST[idx]' and d.kode='$kdrekap' group by IDXBILL";
							$qrytot = mysql_query($sqltot);
							//echo $sqltot;
							while($dt = mysql_fetch_array($qrytot)) {							
									$tote = $tote + ( $dt['QTY'] * $dt['TARIFRS']);
									$qtye = $qtye+1;
									//echo $tote.'<br/>';
							} 
									$totrekap=$totrekap+$tote;
									$qtyrekap=$qtyrekap+$qtye;
									if ($tote<>'' ){
							?>
								<td align="center"><?php echo $no++; ?></td>
								<td align="center"><?php echo $hrekap['kdtindakan'];?></td>
								<td><?php echo $hrekap['nmtindakan'];?></td>
								<td align="center"><?php echo $qtye;?></td>
								<td align="right"><?php echo "Rp.  ".curformat($tote);?></td>
								<?php }?>
								
							</tr>

						<?php } ?>
								
			                	<?php
						
                        while($data = mysql_fetch_array($qry)) {
							
				$tot = $tot + ( $data['QTY'] * $data['TARIFRS']);
				?>	
                
				
                    <?php } ?>
                    <?php 
								while($data = mysql_fetch_array($qry)) {
									$tot = $tot + ( $data['QTY'] * $data['TARIFRS']);								
								} ?>
			                	<tr>
			                			<td align="center"><?php echo $no++; ?></td>
										<td align="center">17</td>
										<td>Farmasi</td>
										<td align="center"><?php echo $_GET['qtyne']-$qtyrekap;?></td>
										<td align="right"><?php echo "Rp.  ".curformat($tot-$totrekap);?></td>
			                	</tr>	
                <tr>
                <td colspan="4" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;font-size: 14px;"><? echo "SUBTOTAL"; ?></td>
				
				<td colspan="2" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;font-size: 14px;"><? echo "RP. ".curformat($tot); ?></td>
				</tr>
			                	 <?php
									$sqlrtn="SELECT sum(harga*jumlah) AS harga FROM retur_apotek WHERE idxdaftar='$_REQUEST[idx]'";
									$qryrtn= mysql_query($sqlrtn);
									$hrtn=mysql_fetch_array($qryrtn);
									$jmlrtn=$hrtn['harga'];
									if ($jmlrtn>0){?>
									<tr>
			                			<td align="center"><?php echo $no++; ?></td>
										<td align="center">20</td>
										<td>Retur Farmasi</td>
										<td align="center">1</td>
										<td align="right"><?php echo "Rp.  ".curformat($jmlrtn);?></td>
			                	</tr>
			                	<tr>
                <td colspan="4" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;font-size: 14px;"><? echo "SUBTOTAL";?><input type="hidden" name="qtyn" id="qtyn" value="<?php echo $qtyne;?>"></td>
				<td colspan="2" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;font-size: 14px;">(<? echo "RP. ".curformat($jmlrtn); ?>)</td>
					
				</tr> 
			                	<?php }?>
<?php
						$sqlrtn2="SELECT sum(TOTCOSTSHARING) AS TOTCOSTSHARING FROM t_bayarranap WHERE idxdaftar='$_REQUEST[idx]'";
						$qryrtn2= mysql_query($sqlrtn2);
						$hrtn2=mysql_fetch_array($qryrtn2);
						$jmlrtn2=$hrtn2['TOTCOSTSHARING'];
						if ($jmlrtn2>0){?>			
                <tr>
			                			<td align="center"><?php echo $no++; ?></td>
										<td align="center">21</td>
										<td>Keringanan Biaya</td>
										<td align="center">1</td>
										<td align="right"><?php echo "Rp.  ".curformat($jmlrtn2);?></td>
			                	</tr>
                 <tr>
                <td colspan="4" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;font-size: 14px;"><? echo "SUBTOTAL";?><input type="hidden" name="qtyn" id="qtyn" value="<?php echo $qtyne;?>"></td>
				<td  colspan="2" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;font-size: 14px;">(<? echo "RP. ".curformat($jmlrtn2); ?>)</td>
					
				</tr>               
            
             <?php } ?>
             	<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
                </tr>
             		<tr>
                <td colspan="4" style="background:#999; font-weight:bold; font-size: 14px; text-align:right; padding-right:10px;font-size: 16px;"><? echo "TOTAL";?><input type="hidden" name="qtyn" id="qtyn" value="<?php echo $qtyne;?>"></td>
				<td  colspan="2" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;font-size: 18px;"><? echo "RP. ".curformat($tot-$jmlrtn-$jmlrtn2); ?></td>
					
				</tr>   
             </table>
			
    </div>
    <p></p>
    <div id="footer">
    	<!-- <div id="footer1" style="float:left; width:400px; height:100px;">
        	<br />
            Catatan :<br />
            Lembar 1 : Pasien / Penjamin <br />
            Lembar 2 : Kasir <br />
            Lembar 3 : Keuangan <br />
		</div> -->
        <div id="footer2" style="float:left; width:200px;">
			<div style="text-align:center; width:100%;">Kasir</div>
            <div style="text-align:center; width:100%; padding-top:70px;">( <?php echo $_SESSION['NIP'];?> )</div>
        </div>
    	<br clear="all" />
    </div>
</div>

</body>