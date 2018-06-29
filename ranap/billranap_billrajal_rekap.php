<script>
jQuery(document).ready(function(){
	jQuery('.print').click(function(){
		var idxdaftar	= jQuery(this).attr('rel');
		jQuery.get('<?php echo _BASE_; ?>print_rekapbill.php?idxdaftar='+idxdaftar+'&nomr=<?php echo $_REQUEST['nomr']; ?>',function(data){
			jQuery('#tmp_print').empty().html(data);
			w=window.open();
			//w.document.write(jQuery('#show_print').html());
			w.document.write(jQuery('#tmp_print').html());
			w.print();
			//w.close();
			//jQuery('#show_print').empty();
		});
	});
});
</script>
<div align="left">
<style type="text/css" media="screen">
#tmp_print{display:none;}
</style>
<style type="text/css" media="print">
#tmp_print{display:block;}
</style>

<div id="tmp_print"></div>
    <div id="frame">
        <div id="frame_title"><h3>Diagnosa Pulang Pasien</h3></div>
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
				<tr style="border:1px;">
						<td> 
							<input type="button" name="back" onClick="javascript:history.back(1)" value="Kembali">
						</td>
						<td> 
							<input type="button" name="back" onClick="window.open('ranap/billranap_billrajal_rekap_print.php?idx=<?php echo $_REQUEST['idx']; ?>&nomr=<?php echo $_REQUEST['nomr']; ?>&qtyne=<?php echo $_REQUEST['qtyne']; ?>','_blank')" value="Print">
						</td>
				</tr>
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
            <table width="80%" border="0" cellpadding="0" cellspacing="0" class="tb">
                <tr>
					<th style="width:10%;text-align:center;">No</th>
					<th style="width:10%;"">Kode Tindakan</th>
                    <th style="width:30%;">Jenis Tindakan</th>
                    <th style="width:30%;">QTY</th>
					<th style="width:20%;" >Jumlah Harga</th>
					<th style="width:30%; text-align: center;" >Ket</th>
					
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
								<td><?php echo $qtye;?></td>
								<td align="right"><?php echo "Rp.  ".curformat($tote);?></td>
								<?php }?>
								
							</tr>

						<?php } ?>
						<?php 
								while($data = mysql_fetch_array($qry)) {
									$tot = $tot + ( $data['QTY'] * $data['TARIFRS']);								
								} ?>
			                	<tr>
			                			<td align="center"><?php echo $no++; ?></td>
										<td align="center">17</td>
										<td>Farmasi</td>
										<td><?php echo $_GET['qtyne']-$qtyrekap;?></td>
										<td align="right"><?php echo "Rp.  ".curformat($tot-$totrekap);?></td>
			                	</tr>		
			                	
								

						<?php //echo $totrekap;
						
                        while($data = mysql_fetch_array($qry)) {
							
				$tot = $tot + ( $data['QTY'] * $data['TARIFRS']);
				?>
				<?php } ?>
				<tr>
                <td colspan="4" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;"><? echo "SUBTOTAL"; ?></td>
				
				<td colspan="2" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;"><? echo "RP. ".curformat($tot); ?></td>
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
										<td>1</td>
										<td align="right"><?php echo "Rp.  ".curformat($jmlrtn);?></td>
			                	</tr>
			                	<tr>
                <td colspan="4" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;"><? echo "SUBTOTAL";?><input type="hidden" name="qtyn" id="qtyn" value="<?php echo $qtyne;?>"></td>
				<td colspan="2" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;">(<? echo "RP. ".curformat($jmlrtn); ?>)</td>
					
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
										<td>1</td>
										<td align="right"><?php echo "Rp.  ".curformat($jmlrtn2);?></td>
			                	</tr>
                 <tr>
                <td colspan="4" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;"><? echo "SUBTOTAL";?><input type="hidden" name="qtyn" id="qtyn" value="<?php echo $qtyne;?>"></td>
				<td  colspan="2" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;">(<? echo "RP. ".curformat($jmlrtn2); ?>)</td>
					
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
                <td colspan="4" style="background:#999; font-weight:bold; font-size: 14px; text-align:right; padding-right:10px;"><? echo "TOTAL";?><input type="hidden" name="qtyn" id="qtyn" value="<?php echo $qtyne;?>"></td>
				<td  colspan="2" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;font-size: 14px;"><? echo "RP. ".curformat($tot-$jmlrtn-$jmlrtn2); ?></td>
					
				</tr>   
             </table>
			
    </div>
</div>