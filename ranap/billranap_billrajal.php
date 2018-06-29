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
							<input type="button" name="back" onClick="rekap();" value="Rekap Kelompok">
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
            <table width="95%" border="0" cellpadding="0" cellspacing="0" class="tb">
                <tr>
					<th style="width:30px;text-align:center;">No</th>
                    <th style="width:200px;text-align:center;" >Jenis Tindakan</th>
					<th style="width:100px;text-align:center;" >QTY</th>
					<th style="width:100px;text-align:center;" >Harga</th>
					<th style="width:100px;text-align:center;" >Jumlah Harga</th>
					<th style="width:30px;text-align:center;" >Ket</th>
					
                </tr>
                        <?php
						$sql = "SELECT l.LUNAS, d.nama_tindakan AS nama_jasa, d.nama_tindakan,b.IDXDAFTAR, b.TARIFRS,b.QTY FROM t_billrajal b Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan Left JOIN t_admission e on e.nomr=b.NOMR LEFT JOIN m_statuskeluar k on c.status=k.status Left Join t_bayarrajal l On l.NOBILL=b.NOBILL WHERE c.status='2' and b.idxdaftar='".$_REQUEST['idx']."' group by IDXBILL UNION ALL SELECT l.LUNAS,d.nama_tindakan AS nama_jasa, b.IDXDAFTAR, d.nama_tindakan,b.TARIFRS,b.QTY FROM t_billranap b Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan Left JOIN t_admission e on e.nomr=b.NOMR LEFT JOIN m_statuskeluar k on c.status=k.status Left Join t_bayarranap l On l.NOBILL=b.NOBILL WHERE c.status='2' and b.idxdaftar='".$_REQUEST['idx']."' group by IDXBILL";
				  
						$total	= 0;
						$no = 1;
						$tot = 0;
						$qtyne=0;
                        $qry = mysql_query($sql)or die(mysql_error());
						
                        while($data = mysql_fetch_array($qry)) {
                        	$qtyne=$qtyne+$data['QTY'];
							
				$tot = $tot + ( $data['QTY'] * $data['TARIFRS']);
				?>
				
                <tr>
					<td align ="center"><? echo $no++; ?></td>
					<td><? echo $data['nama_jasa']; ?></td>
					<td style="width:100px;text-align:center;"><? echo $data['QTY']; ?></td>
					<td style="text-align:right;"><? echo "Rp.  ".curformat($data['TARIFRS']); ?></td><?php
					$total = $data['QTY'] * $data['TARIFRS'];?>
					<td style="text-align:right;"><? echo "Rp.  ".curformat($total); ?></td>
					<td style="text-align:center;">
						<?php if ($data['LUNAS'] == '1'){
								echo "LUNAS";
							}else{
								echo "BELUM LUNAS";
								}?> 
					</td>
				                  
					
                </tr>
				
                    <?php } ?>
                <tr>
                <td colspan="5" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;"><? echo "SUBTOTAL";?><input type="hidden" name="qtyn" id="qtyn" value="<?php echo $qtyne;?>"></td>
				<td style="background:#999; font-weight:bold; text-align:right; padding-right:10px;"><? echo "RP. ".curformat($tot-$jmlrtn); ?></td>
					
				</tr>

					 <?php
						$sqlrtn="SELECT sum(harga*jumlah) AS harga FROM retur_apotek WHERE idxdaftar='$_REQUEST[idx]'";
						$qryrtn= mysql_query($sqlrtn);
						$hrtn=mysql_fetch_array($qryrtn);
						$jmlrtn=$hrtn['harga'];
						if ($jmlrtn>0){?>			
                <tr>
					<td align ="center"><? echo $no++; ?></td>
					<td>Retur Farmasi</td>
					<td style="width:100px;text-align:center;">1</td>
					<td style="text-align:right;"><? echo "Rp.  ".curformat($jmlrtn); ?></td>
					<td style="text-align:right;"><? echo "Rp.  ".curformat($jmlrtn); ?></td>
					<td style="text-align:center;"></td>
                </tr>
                 <tr>
                <td colspan="5" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;"><? echo "SUBTOTAL";?><input type="hidden" name="qtyn" id="qtyn" value="<?php echo $qtyne;?>"></td>
				<td style="background:#999; font-weight:bold; text-align:right; padding-right:10px;">(<? echo "RP. ".curformat($jmlrtn); ?>)</td>
					
				</tr>     
             <?php } ?>

			
				 <?php
						$sqlrtn2="SELECT sum(TOTCOSTSHARING) AS TOTCOSTSHARING FROM t_bayarranap WHERE idxdaftar='$_REQUEST[idx]'";
						$qryrtn2= mysql_query($sqlrtn2);
						$hrtn2=mysql_fetch_array($qryrtn2);
						$jmlrtn2=$hrtn2['TOTCOSTSHARING'];
						if ($jmlrtn2>0){?>			
                <tr>
					<td align ="center"><? echo $no++; ?></td>
					<td>Keringanan Biaya</td>
					<td style="width:100px;text-align:center;">1</td>
					<td style="text-align:right;"><? echo "Rp.  ".curformat($jmlrtn2); ?></td>
					<td style="text-align:right;"><? echo "Rp.  ".curformat($jmlrtn2); ?></td>
					<td style="text-align:center;"></td>
                </tr>
                 <tr>
                <td colspan="5" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;"><? echo "SUBTOTAL";?><input type="hidden" name="qtyn" id="qtyn" value="<?php echo $qtyne;?>"></td>
				<td style="background:#999; font-weight:bold; text-align:right; padding-right:10px;">(<? echo "RP. ".curformat($jmlrtn2); ?>)</td>
					
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
                <td colspan="5" style="background:#999; font-weight:bold; font-size: 14px; text-align:right; padding-right:10px;"><? echo "TOTAL";?><input type="hidden" name="qtyn" id="qtyn" value="<?php echo $qtyne;?>"></td>
				<td style="background:#999; font-weight:bold; text-align:right; padding-right:10px;font-size: 14px;"><? echo "RP. ".curformat($tot-$jmlrtn-$jmlrtn2); ?></td>
					
				</tr>   
             </table>
			<table width="95%" >
					<tr >
                		<td></td>
                		<td></td>
                		<td >
							<input type="button" name="print" value="Print" class="text print" id="print_<?php echo $_REQUEST['nomr']; ?>" rel="<?php echo $data2['IDXDAFTAR']; ?>"  style="display:block; float:right;"/><div id="callback_<?php echo $_REQUEST['nomr']; ?>" style="float:right;"></div>
						</td>
					</tr>
    </div>
</div>

<script>
					function rekap(){
						var jmle = jQuery('#qtyn').val();
							//alert(jmle);
						window.location.href='?link=31s3x&idx=<?php echo $_REQUEST['idx']; ?>&nomr=<?php echo $_REQUEST['nomr']; ?>&qtyne='+jmle;
					}
					</script>