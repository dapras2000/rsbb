<script>
jQuery(document).ready(function(){
	jQuery('.delete').click(function(){
		var href = jQuery(this).attr('href');
		jQuery.get(href,function(data){
			if(!data){
				location.reload();
			}
		});
	});
});
</script>
<div align="center">
    <div id="frame" style="width: 100%;">
        <div id="frame_title"><h3>DETAIL BILLING LAB</h3></div>
        <div align="left" style="margin:5px;">
        		<?php
				$sql = 'SELECT j.IDXDAFTAR, j.TANGGAL, j.DRPENGIRIM, m.NAMADOKTER, j.KDPOLY, n.NAMA AS POLY, j.NOMR, k.NAMA AS NAMA, l.carabayar, o.NAMA AS CARABAYAR, l.NOBILL
FROM t_orderlab j
JOIN m_pasien k ON k.nomr = j.nomr
JOIN t_bayarrajal l ON l.idxdaftar = j.idxdaftar
JOIN m_dokter m ON m.kddokter = j.drpengirim
JOIN m_poly n ON n.KODE = j.KDPOLY
JOIN m_carabayar o ON o.KODE = l.carabayar
WHERE j.IDXDAFTAR = '.$_REQUEST['idx'].' and l.NOBILL = '.$_REQUEST['nobill'].' 
GROUP BY j.IDXDAFTAR, j.TANGGAL, j.DRPENGIRIM, m.NAMADOKTER, j.KDPOLY';
				$sql 	= mysql_query($sql);
				$row	= mysql_fetch_array($sql);
				?>
                <table width="400px" border="0" cellspacing="0" class="tb">
                <tr><td width="150">No RM</td><td><?php echo $row['NOMR']?></td></tr>
                <tr><td>Nama</td><td><?php echo $row['NAMA'];?></td></tr>
                <tr><td>Tanggal Daftar</td><td><?php echo $row['TANGGAL'];?></td></tr>
                <tr><td>Poly</td><td><?php echo $row['POLY'];?></td></tr>
                <tr><td>Dokter Pengirim</td><td><?php echo $row['NAMADOKTER'];?></td></tr>
                <tr><td>Carabayar</td><td><?php echo $row['CARABAYAR'];?></td></tr>
                </table>
            <div id="table_search">
            	<div style="text-align:right; width:95%;">
                <a href="?link=formorderlab_tambahan&idxdaftar=<?php echo $_REQUEST['idx'];?>&nobill=<?php echo $_REQUEST['nobill'];?>"><input type="button" name="tambah" value="Tambah Pemeriksaan" id="tambah" class="text"></a></div>
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
				<tr align="center" ><th style="width:20px;">No</th><th>Nama Tindakan / Pemeriksaan</th><th style="width:150px;">Tarif</th><th style="width:50px;">Qty</th><th width="70px">Aksi</th></tr>
                    <?
                    $NO=0;
                    $rs = mysql_query('SELECT a.KODETARIF, a.QTY, a.TARIFRS, b.nama_tindakan, a.IDXBILL
FROM t_billrajal a 
JOIN m_tarif2012 b ON b.kode_tindakan = a.KODETARIF
WHERE a.nobill = "'.$_REQUEST['nobill'].'"');
                    if(!$rs) die(mysql_error());
					$i = 1;
					$count = 1;
                    while($data = mysql_fetch_array($rs)) {?>
                    <?php
                        $count++;
                        if ($count % 2){ echo '<tr class="tr1">'; }else{ echo '<tr class="tr1">';}
                        ?>
                        <td align="center"><?php if( (!isset($_REQUEST['page'])) or ($_REQUEST['page'] == 1) ){ echo $i; }else{ echo ($_REQUEST['page'] - 1) * 15 + $i; } ?></td>
                        <td><? echo $data['nama_tindakan'];?></td>
                        <td align="right" style="padding-right:5px;"><? echo curformat($data['TARIFRS'],2);?></td>
                        <td align="center"><? echo $data['QTY']; ?></td>
                        <td>
						<?php
							echo '<a href="#"><input href="'._BASE_.'lab/remove_billing.php?idxbill='.$data['IDXBILL'].'&nomr='.$_REQUEST['nomr'].'&nobill='.$_REQUEST['nobill'].'&idxdaftar='.$_REQUEST['idx'].'" type="button" value="BATAL" class="text delete"/></a>';
						?>
                        </td>
                    </tr>
                        <?	$i++;
					}
    ?>
    </table>
    </div>
           