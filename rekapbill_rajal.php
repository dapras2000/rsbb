<script>
jQuery(document).ready(function(){
	jQuery('.print').click(function(){
		var idxdaftar	= jQuery(this).attr('rel');
		jQuery.get('<?php echo _BASE_; ?>print_rekapbill_rajal.php?idxdaftar=<?php echo $_REQUEST['idxdaftar']; ?>&nomr=<?php echo $_REQUEST['nomr']; ?>',function(data){
			jQuery('#tmp_print').empty().html(data);
			w=window.open();
			w.document.write(jQuery('#tmp_print').html());
			w.print();
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
							WHERE c.status='2' and b.idxdaftar='".$_REQUEST['idx']."' 
							group by IDXBILL
							UNION ALL
							SELECT d.nama_tindakan AS nama_jasa, b.IDXDAFTAR, d.nama_tindakan,b.TARIFRS,b.QTY,b.nomr
							FROM  t_billranap b
							Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
							Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
							Left JOIN t_admission e on e.nomr=b.NOMR
							LEFT JOIN m_statuskeluar k on c.status=k.status
							WHERE c.status='2' and b.idxdaftar='".$_REQUEST['idx']."' 
							group by IDXBILL";
				$qry3 = mysql_query($sql3)or die(mysql_error());
				$data2=mysql_fetch_array($qry3);
				?>
				<tr style="border:1px;">
						<td> 
							<input type="button" name="back" onClick="javascript:history.back(1)" value="Kembali">
						</td>
				</tr>
			</table>
            <table width="95%" border="0" cellpadding="0" cellspacing="0" class="tb">
                <tr>
					<th style="width:30px;text-align:center;">No</th>
                    <th style="width:200px;text-align:center;" >Jenis Tindakan</th>
                    <th style="width:30px;text-align:center;" >Tindakan</th>
					<th style="width:100px;text-align:center;" >QTY</th>
					<th style="width:100px;text-align:center;" >Harga</th>
					<th style="width:100px;text-align:center;" >Jumlah Harga</th>
					<th style="width:30px;text-align:center;" >Ket</th>
					
                </tr>
                    <?php
					$sql = "SELECT a.kode_tindakan AS kode, a.nama_tindakan AS nama_jasa, b.qty, b.TARIFRS,c.NAMADOKTER,d.PARENT_NOMR
							FROM m_tarif2012 a, t_billrajal b
							LEFT JOIN m_dokter c ON c.KDDOKTER = b.KDDOKTER
							JOIN m_pasien d ON b.NOMR=d.NOMR
							WHERE a.kode_tindakan=b.KODETARIF 
							AND b.NOMR='".$_REQUEST['nomr']."' AND b.IDXDAFTAR = '".$_REQUEST['idxdaftar']."'
							UNION ALL 
							SELECT a.kode_tindakan AS kode, a.nama_tindakan AS nama_jasa, b.qty, b.TARIFRS,c.NAMADOKTER,d.PARENT_NOMR
							FROM m_tarif2012 a, t_billrajal b
							LEFT JOIN m_dokter c ON c.KDDOKTER = b.KDDOKTER
							JOIN m_pasien d ON b.NOMR=d.NOMR
							WHERE a.kode_tindakan=b.KODETARIF 
							AND d.PARENT_NOMR='".$_REQUEST['nomr']."'";
					$total	= 0;
					$no = 1;
					$tot = 0;
                    $qry = mysql_query($sql)or die(mysql_error());
                        
                    while($data = mysql_fetch_array($qry)) {
							$sql1=mysql_query("select b.STATUS,b.LUNAS from t_billrajal a left join t_bayarrajal b ON b.NOBILL=a.NOBILL where a.KODETARIF='".$data['kode']."'");
							$data1=mysql_fetch_array($sql1);
							if ($data1['STATUS']=='TRX'){
								if ($data1['LUNAS']=='1'){
									$st="L";}
								else{
									$st="BL";
								}
							}else{
							$st="BTL";}	
							if ($data['PARENT_NOMR'] != ""){
								$pn="Anak";
							}else{
								$pn="Ibu";}	
					$tot = $tot + ( $data['qty'] * $data['TARIFRS']);
					?>
                <tr>
					<td align ="center"><? echo $no++; ?></td>
					<td><? echo $data['nama_jasa']; ?></td>
					<td><? echo $pn; ?></td>
					<td style="width:100px;text-align:center;"><? echo $data['qty']; ?></td>
					<td style="text-align:right;"><? echo "Rp.  ".curformat($data['TARIFRS']); ?></td><?php
					$total = $data['qty'] * $data['TARIFRS'];?>
					<td style="text-align:right;"><? echo "Rp.  ".curformat($total); ?></td>
					<td style="text-align:center;"><? echo $st; ?></td>
				</tr>
				
                <?php } ?>

                <td colspan="4" style="background:#999; font-weight:bold; text-align:right; padding-right:10px;"><? echo "TOTAL"; ?></td>
				
				<td style="background:#999; font-weight:bold; text-align:right; padding-right:10px;"><? echo "RP. ".curformat($tot); ?></td>
					<td style="background:#999; font-weight:bold; text-align:right; padding-right:10px;"></td>
			</table>
			<table width="95%" >
					<tr >
                		<td></td>
                		<td></td>
                		<td >
							
							<!-- <input type="button" name="print" value="Print" class="text print" id="print_<?php echo $_REQUEST['nomr']; ?>" rel="<?php echo $data2['IDXDAFTAR']; ?>"  style="display:block; float:right;"/> -->
							<div id="callback_<?php echo $_REQUEST['nomr']; ?>" style="float:right;"></div>
							<?php
								echo '<a href="'._BASE_.'detail_rekaprajal_print.php?nomr='.$_REQUEST['nomr'].'&poli='.$_REQUEST['poli'].'&idxdaftar='.$_REQUEST['idxdaftar'].'" target="_blank"><input type="button" value="PRINT" class="text" style="display:block; float:right;"/></a>';
							?>
						</td>
					</tr>
			</table>
    </div>
</div>