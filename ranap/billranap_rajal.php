<script>
jQuery(document).ready(function(){
	jQuery('.print').click(function(){
		var idxdaftar	= jQuery(this).attr('rel');
		jQuery.get('<?php echo _BASE_; ?>print_diagnosa.php?idxdaftar='+idxdaftar+'&nomr=<?php echo $_REQUEST['nomr']; ?>',function(data){
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

	<div align="left">
		<div id="frame">
			<div id="frame_title"><h3>Diagnosa Pulang Pasien</h3>
			</div>
				<table>
					<?php
					$sql3	= "SELECT d.nama_tindakan AS nama_jasa, d.nama_tindakan,b.IDXDAFTAR,d.kode_tindakan
								FROM t_billrajal b
								Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
								Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
								Left JOIN t_admission e on e.nomr=b.NOMR
								LEFT JOIN m_statuskeluar k on c.status=k.status
								WHERE c.status='2' and b.idxdaftar='".$_REQUEST['idx']."' 
								group by IDXBILL
							UNION ALL
								SELECT d.nama_tindakan AS nama_jasa, b.IDXDAFTAR, d.nama_tindakan,d.kode_tindakan
								FROM  t_billrajal b
								Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
								Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
								Left JOIN t_admission e on e.nomr=b.NOMR
								LEFT JOIN m_statuskeluar k on c.status=k.status
								LEFT JOIN m_pasien x ON c.NOMR = x.NOMR 
								WHERE x.PARENT_NOMR='".$_REQUEST['nomr']."' 
								group by IDXBILL
							UNION ALL
								SELECT d.nama_tindakan AS nama_jasa, b.IDXDAFTAR, d.nama_tindakan,d.kode_tindakan
								FROM  t_billranap b
								Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
								Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
								Left JOIN t_admission e on e.nomr=b.NOMR
								LEFT JOIN m_statuskeluar k on c.status=k.status
								WHERE c.status='2' and b.idxdaftar='".$_REQUEST['idx']."' 
								group by IDXBILL
								";
					$qry3 = mysql_query($sql3)or die(mysql_error());
					$data2=mysql_fetch_array($qry3);
					?>
					<tr style="border:1px;">
						<td> 
							<!--<input type="button" name="print" value="Print" class="text print" id="print_<?php echo $data2['nomr']; ?>" rel="<?php echo $data2['IDXDAFTAR']; ?>"  style="display:block; float:right;"/><div id="callback_<?php echo $data2['nomr']; ?>" style="float:right;"></div>-->
							<input type="button" name="back" onClick="javascript:history.back(1)" value="Kembali">
						</td>
					</tr>
				</table>
				<table width="95%" border="0" cellpadding="0" cellspacing="0" class="tb">
					<tr>
						<th style="width:30px;text-align:center;">No</th>
						<th style="width:200px;text-align:center;" >Nama Tindakan</th>
						<th style="width:200px;text-align:center;" >Jenis Tindakan</th>
					</tr>
					<?php
						$sql = "SELECT d.nama_tindakan AS nama_jasa, d.nama_tindakan,b.IDXDAFTAR,d.kode_tindakan
								FROM t_billrajal b
								Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
								Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
								Left JOIN t_admission e on e.nomr=b.NOMR
								LEFT JOIN m_statuskeluar k on c.status=k.status
								WHERE c.status='2' and b.idxdaftar='".$_REQUEST['idx']."' 
								group by IDXBILL
							UNION ALL
								SELECT d.nama_tindakan AS nama_jasa, b.IDXDAFTAR, d.nama_tindakan,d.kode_tindakan
								FROM  t_billrajal b
								Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
								Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
								Left JOIN t_admission e on e.nomr=b.NOMR
								LEFT JOIN m_statuskeluar k on c.status=k.status
								LEFT JOIN m_pasien x ON c.NOMR = x.NOMR 
								WHERE x.PARENT_NOMR='".$_REQUEST['nomr']."' 
								group by IDXBILL
							UNION ALL
								SELECT d.nama_tindakan AS nama_jasa, b.IDXDAFTAR, d.nama_tindakan,d.kode_tindakan
								FROM  t_billranap b
								Left Join t_pendaftaran c On c.IDXDAFTAR=b.IDXDAFTAR
								Left JOIN m_tarif2012 d on b.KODETARIF = d.kode_tindakan
								Left JOIN t_admission e on e.nomr=b.NOMR
								LEFT JOIN m_statuskeluar k on c.status=k.status
								WHERE c.status='2' and b.idxdaftar='".$_REQUEST['idx']."' 
								group by IDXBILL
								";
						$total	= 0;
						$no 	= 1;
                        $qry 	= mysql_query($sql)or die(mysql_error());
                        while($data = mysql_fetch_array($qry)) {
						?>
					<tr>
						<td align ="center"><? echo $no++; ?></td>
						<td><? echo $data['nama_jasa']; ?></td>
						<?php 
						if (substr($data['kode_tindakan'],0,2) == "01"){
						?>
							<td><? echo "Jasa Rawat Jalan"; ?></td>
							<?php
							}else if(substr($data['kode_tindakan'],0,2) == "02"){
							?>
								<td><? echo "Jasa Tindakan Rajal"; ?></td>
							<?php
							}else if(substr($data['kode_tindakan'],0,2) == "03"){
							?>
								<td><? echo "Rawat Inap"; ?></td>
							<?php
							}else if(substr($data['kode_tindakan'],0,2) == "04"){
							?>
								<td><? echo "Kamar Operasi"; ?></td>
							<?php
							}else if(substr($data['kode_tindakan'],0,5) == "06.01"){
							?>
								<td><? echo "Laboratorium"; ?></td>
							<?php
							}else if(substr($data['kode_tindakan'],0,5) == "06.02"){
							?>
								<td><? echo "Radiologi"; ?></td>
							<?php
							}else if(substr($data['kode_tindakan'],0,5) == "06.03"){
							?>
								<td><? echo "Elektromedis"; ?></td>
							<?php
							}else if(substr($data['kode_tindakan'],0,5) == "06.04"){
							?>
								<td><? echo "CT Scan-MRI"; ?></td>
							<?php
							}else if(substr($data['kode_tindakan'],0,5) == "07.01"){
							?>
								<td><? echo "Pelayanan Kesehatan"; ?></td>
							<?php
							}else if(substr($data['kode_tindakan'],0,5) == "07"){
							?>
								<td><? echo "Pelayanan Farmasi"; ?></td>
							<?php
							}else{
							?>
								<td><? echo " "; ?></td>
							<?php
							}
							?>
					</tr>
						<?php 
						} 
						?>
                	
				</table>
				<table width="95%" >
					<tr >
                		<td></td>
                		<td></td>
                		<td >
							<input type="button" name="print" value="Print" class="text print" id="print_<?php echo $_REQUEST['nomr']; ?>" rel="<?php echo $data2['IDXDAFTAR']; ?>"  style="display:block; float:right;"/><div id="callback_<?php echo $_REQUEST['nomr']; ?>" style="float:right;"></div>
						</td>
					</tr>
				</table>
		</div>
	</div>
</div>