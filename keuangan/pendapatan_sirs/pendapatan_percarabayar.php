<?php

$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
}else{
    $tgl_kunjungan =date('Y/m/d'); 
}

$tgl_kunjungan2 = "";
if(!empty($_GET['tgl_kunjungan2'])){
	$tgl_kunjungan2 =$_GET['tgl_kunjungan2']; 
}else{
    $tgl_kunjungan2 =date('Y/m/d'); 
}
$carabayar = "";
if(!empty($_GET['carabayar'])) {
    $carabayar =$_GET['carabayar'];
}
else $carabayar='1,2,3,4,5,6,7,8';
?>

<form name="formsearch" method="get" >
     <table width="286" border="0" cellspacing="0" class="tb">
  <tr>
    <td width="78">Dari Tanggal</td>
    <td width="204"><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan!=""){
			  echo $tgl_kunjungan;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
  <tr>
    <td>Sampai Tanggal</td>
    <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan2!=""){
			  echo $tgl_kunjungan2;}?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
<tr>
    <td>Cara Bayar</td>
    <td><select name="carabayar" id="carabayar" class="text" >
                                <option value=""> Semua Cara Bayar </option>
                                <?
                                $qrycarabayar = mysql_query("SELECT kode,nama FROM m_carabayar ORDER BY kode ASC")or die (mysql_error());
                                while ($listcarabayar = mysql_fetch_array($qrycarabayar)) {
                                    ?>
                                <option value="<? echo $listcarabayar['kode'];?>" <? if($listcarabayar['kode']==$carabayar) echo "selected=selected"; ?>><? echo $listcarabayar['nama'];?></option>
                                    <? } ?>
                            </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
      <input type="hidden" name="link" value="36k2" /></td>
  </tr>
</table>

    </form> 
  <form action="keuangan/pendapatan_sirs/pendapatan_pertindakan_xls.php" method="get">
                <input type="hidden" name="tgl_kunjungan" id="tgl_kunjungan" value=<?=$tgl_kunjungan?> />
                <input type="hidden" name="tgl_kunjungan2" id="tgl_kunjungan2" value=<?=$tgl_kunjungan2?> />                
                <input type="hidden" name="carabayar" id="carabayar" value=<?=$carabayar?> />                                
                   <input type="submit" value="export xls" />
                </form>
            <?php
				 
 $sql	= 'SELECT CASE kdprofesi 
          WHEN 0 THEN "Dokter Umum"
          WHEN 1 THEN "Dokter Spesialis"
          WHEN 2 THEN "Ahli Lain"
       END AS profesi, SUM(JMBAYAR) AS total
FROM t_bayarrajal a
INNER JOIN t_billrajal b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill
LEFT JOIN m_dokter d ON b.kddokter=d.kddokter
WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.CARABAYAR in('.$carabayar.') AND a.STATUS = "LUNAS" AND b.kodetarif LIKE "01.01%"
GROUP BY kdprofesi';								
$qry	= mysql_query($sql);				 
				?>
<table width="95%" border="0" class="tb" cellspacing="0" cellspading="0">
					<tr align="center">
					  <th>Nama Layanan</th>
					  <th>Pendapatan</th>
  </tr>
					<tr align="left">
					  <th width="843">1. Pelayanan Rawat Jalan</th>
				    <th width="100">&nbsp;</th></tr>
					<tr align="left">
					  <th width="843">a. Biaya Pemeriksaan & Konsultasi (RAJAL)</th>
				    <th width="100">&nbsp;</th></tr>                    
                    <?php					
				    if (mysql_num_rows($qry) > 0 )
						while($data = mysql_fetch_array($qry)){							
							echo '<tr>
									<td>'.$data['profesi'].'</td>
									<td align="right">'.curformat($data['total']).'</td></tr>';								
						}
					else {
							echo '<tr>
									<td>-</td>
									<td align="right">'.curformat(0).'</td></tr>';								
						
					}
					?>
					<tr align="left">
					  <th width="843">b. Tindakan (RAJAL)</th>
				    <th width="100">&nbsp;</th></tr>      
<?php
			$sql='SELECT nama_gruptindakan, SUM(JMBAYAR) AS total
			FROM t_bayarrajal a
			INNER JOIN t_billrajal b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill
			LEFT JOIN m_tarif2012 m ON b.kodetarif=m.kode_tindakan
			WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.CARABAYAR in('.$carabayar.') AND a.STATUS = "LUNAS" AND b.kodetarif LIKE "01.02%"
			GROUP BY nama_gruptindakan';
$qry	= mysql_query($sql);			
			 if (mysql_num_rows($qry) > 0 )	{
					while($data = mysql_fetch_array($qry)){

						echo '<tr>
								<td>'.$data['nama_gruptindakan'].'</td>
								<td align="right">'.curformat($data['total']).'</td></tr>';								
					}	
			 }
			else {
						echo '<tr>
								<td>-</td>
								<td align="right">'.curformat(0).'</td></tr>';								
			}			 
?>
			<tr align="left">
					  <th width="843">2. Pelayanan Unit Gawat Darurat</th>
				    <th width="100">&nbsp;</th></tr>
					<tr align="left">
					  <th width="843">a. Biaya Pemeriksaan & Konsultasi </th>
				    <th width="100">&nbsp;</th></tr>  
<?php					
 $sql	= 'SELECT CASE kdprofesi 
          WHEN 0 THEN "Dokter Umum"
          WHEN 1 THEN "Dokter Spesialis"
          WHEN 2 THEN "Ahli Lain"
       END AS profesi, SUM(JMBAYAR) AS total
FROM t_bayarrajal a
INNER JOIN t_billrajal b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill
LEFT JOIN m_dokter d ON b.kddokter=d.kddokter
WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.CARABAYAR in('.$carabayar.') AND a.STATUS = "LUNAS" AND b.kodetarif LIKE "02.01%"
GROUP BY kdprofesi';								
$qry	= mysql_query($sql);	
				    if (mysql_num_rows($qry) > 0 )
						while($data = mysql_fetch_array($qry)){							
							echo '<tr>
									<td>'.$data['profesi'].'</td>
									<td align="right">'.curformat($data['total']).'</td></tr>';								
						}
					else {
							echo '<tr>
									<td>-</td>
									<td align="right">'.curformat(0).'</td></tr>';								
						
					}
					?>   
<tr align="left">
					  <th width="843">b. ODC</th>
				    <th width="100">&nbsp;</th></tr>      
<?php
			$sql='SELECT nama_gruptindakan, SUM(JMBAYAR) AS total
			FROM t_bayarrajal a
			INNER JOIN t_billrajal b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill
			LEFT JOIN m_tarif2012 m ON b.kodetarif=m.kode_tindakan
			WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.CARABAYAR in('.$carabayar.') AND a.STATUS = "LUNAS" AND b.kodetarif LIKE "02.02%"
			GROUP BY nama_gruptindakan';
$qry	= mysql_query($sql);			
			 if (mysql_num_rows($qry) > 0 )	{
					while($data = mysql_fetch_array($qry)){

						echo '<tr>
								<td>'.$data['nama_gruptindakan'].'</td>
								<td align="right">'.curformat($data['total']).'</td></tr>';								
					}	
			 }
			else {
						echo '<tr>
								<td>-</td>
								<td align="right">'.curformat(0).'</td></tr>';								
			}			 
?>          
<tr align="left">
					  <th width="843">c. Tindakan</th>
				    <th width="100">&nbsp;</th></tr>      
<?php
			$sql='SELECT nama_gruptindakan, SUM(JMBAYAR) AS total
			FROM t_bayarrajal a
			INNER JOIN t_billrajal b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill
			LEFT JOIN m_tarif2012 m ON b.kodetarif=m.kode_tindakan
			WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.CARABAYAR in('.$carabayar.') AND a.STATUS = "LUNAS" AND (b.kodetarif LIKE "02.03%" or b.kodetarif LIKE "02.04%)"
			GROUP BY nama_gruptindakan';
$qry	= mysql_query($sql);			
			 if (mysql_num_rows($qry) > 0 )	{
					while($data = mysql_fetch_array($qry)){

						echo '<tr>
								<td>'.$data['nama_gruptindakan'].'</td>
								<td align="right">'.curformat($data['total']).'</td></tr>';								
					}	
			 }
			else {
						echo '<tr>
								<td>-</td>
								<td align="right">'.curformat(0).'</td></tr>';								
			}			 
?>                                   
<tr align="left">
					  <th width="843">3. Pelayanan Rawat Inap</th>
				    <th width="100">&nbsp;</th></tr>
					<tr align="left">
					  <th width="843">a. Akomodasi </th>
				    <th width="100">&nbsp;</th></tr>  
					  <th width="843">a1. Kelas Anak dan Dewasa </th>
				    <th width="100">&nbsp;</th></tr>  
                    
<?php					
$sql='SELECT nama_tindakan , SUM((b.qty*b.tarifrs)-b.askes-b.COSTSHARING) AS total
			FROM t_bayarranap a
			INNER JOIN t_billranap b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill AND a.CARABAYAR in('.$carabayar.') 
			LEFT JOIN m_tarif2012 m ON b.kodetarif=m.kode_tindakan
			WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.STATUS = "LUNAS" AND b.kodetarif LIKE "03.01.01%"
			GROUP BY nama_tindakan';							
$qry	= mysql_query($sql);	
				    if (mysql_num_rows($qry) > 0 )
						while($data = mysql_fetch_array($qry)){							
							echo '<tr>
									<td>'.$data['nama_tindakan'].'</td>
									<td align="right">'.curformat($data['total']).'</td></tr>';								
						}
					else {
							echo '<tr>
									<td>-</td>
									<td align="right">'.curformat(0).'</td></tr>';								
						
					}
					?>   
					  <th width="843">a2. Perinatologi</th>
				    <th width="100">&nbsp;</th></tr>  
                    
<?php					
$sql='SELECT nama_tindakan , SUM((b.qty*b.tarifrs)-b.askes-b.COSTSHARING) AS total
			FROM t_bayarranap a
			INNER JOIN t_billranap b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill AND a.CARABAYAR in('.$carabayar.') 
			LEFT JOIN m_tarif2012 m ON b.kodetarif=m.kode_tindakan
			WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.STATUS = "LUNAS" AND b.kodetarif LIKE "03.01.02%"
			GROUP BY nama_tindakan';							
$qry	= mysql_query($sql);	
				    if (mysql_num_rows($qry) > 0 )
						while($data = mysql_fetch_array($qry)){							
							echo '<tr>
									<td>'.$data['nama_tindakan'].'</td>
									<td align="right">'.curformat($data['total']).'</td></tr>';								
						}
					else {
							echo '<tr>
									<td>-</td>
									<td align="right">'.curformat(0).'</td></tr>';								
						
					}
					?>   
					  <th width="843">b. Visit dan Konsultasi </th>
				    <th width="100">&nbsp;</th></tr>  
					  <th width="843">b1. Kelas Anak dan Dewasa </th>
				    <th width="100">&nbsp;</th></tr>  
                    
<?php					
$sql='SELECT nama_tindakan , SUM((b.qty*b.tarifrs)-b.askes-b.COSTSHARING) AS total
			FROM t_bayarranap a
			INNER JOIN t_billranap b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill AND a.CARABAYAR in('.$carabayar.') 
			LEFT JOIN m_tarif2012 m ON b.kodetarif=m.kode_tindakan
			WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.STATUS = "LUNAS" AND b.kodetarif LIKE "03.02.01%"
			GROUP BY nama_tindakan';							
$qry	= mysql_query($sql);	
				    if (mysql_num_rows($qry) > 0 )
						while($data = mysql_fetch_array($qry)){							
							echo '<tr>
									<td>'.$data['nama_tindakan'].'</td>
									<td align="right">'.curformat($data['total']).'</td></tr>';								
						}
					else {
							echo '<tr>
									<td>-</td>
									<td align="right">'.curformat(0).'</td></tr>';								
						
					}
					?>   
					  <th width="843">b2. Perinatologi</th>
				    <th width="100">&nbsp;</th></tr>  
                    
<?php					
$sql='SELECT nama_tindakan , SUM((b.qty*b.tarifrs)-b.askes-b.COSTSHARING) AS total
			FROM t_bayarranap a
			INNER JOIN t_billranap b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill AND a.CARABAYAR in('.$carabayar.') 
			LEFT JOIN m_tarif2012 m ON b.kodetarif=m.kode_tindakan
			WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.STATUS = "LUNAS" AND b.kodetarif LIKE "03.02.02%"
			GROUP BY nama_tindakan';							
$qry	= mysql_query($sql);	
				    if (mysql_num_rows($qry) > 0 )
						while($data = mysql_fetch_array($qry)){							
							echo '<tr>
									<td>'.$data['nama_tindakan'].'</td>
									<td align="right">'.curformat($data['total']).'</td></tr>';								
						}
					else {
							echo '<tr>
									<td>-</td>
									<td align="right">'.curformat(0).'</td></tr>';								
						
					}
					?>   
 <th width="843">b3. Tindakan</th>
				    <th width="100">&nbsp;</th></tr>  
                    
<?php					
$sql='SELECT nama_tindakan , SUM((b.qty*b.tarifrs)-b.askes-b.COSTSHARING) AS total
			FROM t_bayarranap a
			INNER JOIN t_billranap b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill AND a.CARABAYAR in('.$carabayar.') 
			LEFT JOIN m_tarif2012 m ON b.kodetarif=m.kode_tindakan
			WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.STATUS = "LUNAS" AND (b.kodetarif LIKE "03.03% or b.kodetarif LIKE "03.04% or b.kodetarif LIKE "03.05%)"
			GROUP BY nama_tindakan';							
$qry	= mysql_query($sql);	
				    if (mysql_num_rows($qry) > 0 )
						while($data = mysql_fetch_array($qry)){							
							echo '<tr>
									<td>'.$data['nama_tindakan'].'</td>
									<td align="right">'.curformat($data['total']).'</td></tr>';								
						}
					else {
							echo '<tr>
									<td>-</td>
									<td align="right">'.curformat(0).'</td></tr>';								
						
					}
					?>                       
<th width="843">4. Kamar Operasi</th>
				    <th width="100">&nbsp;</th></tr>  
                    
<?php					
$sql='SELECT nama_gruptindakan , SUM((b.qty*b.tarifrs)-b.askes-b.COSTSHARING) AS total
			FROM t_bayarranap a
			INNER JOIN t_billranap b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill AND a.CARABAYAR in('.$carabayar.') 
			LEFT JOIN m_tarif2012 m ON b.kodetarif=m.kode_tindakan
			WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.STATUS = "LUNAS" AND b.kodetarif LIKE "04%"
			GROUP BY nama_gruptindakan';							
$qry	= mysql_query($sql);	
				    if (mysql_num_rows($qry) > 0 )
						while($data = mysql_fetch_array($qry)){							
							echo '<tr>
									<td>'.$data['nama_gruptindakan'].'</td>
									<td align="right">'.curformat($data['total']).'</td></tr>';								
						}
					else {
							echo '<tr>
									<td>-</td>
									<td align="right">'.curformat(0).'</td></tr>';								
						
					}
					?>                       
<th width="843">5. Pelayanan Kamar Bersalin</th>
				    <th width="100">&nbsp;</th></tr>  
<th width="843">a. Pemeriksaan dan Konsultasi</th>
				    <th width="100">&nbsp;</th></tr>                      
<?php					
 				
 $sql	= 'SELECT CASE kdprofesi 
          WHEN 0 THEN "Dokter Umum"
          WHEN 1 THEN "Dokter Spesialis"
          WHEN 2 THEN "Ahli Lain"
       END AS profesi, SUM(JMBAYAR) AS total
FROM t_bayarrajal a
INNER JOIN t_billrajal b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill
LEFT JOIN m_dokter d ON b.kddokter=d.kddokter
WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.CARABAYAR in('.$carabayar.') AND a.STATUS = "LUNAS" AND b.kodetarif LIKE "05.01%"
GROUP BY kdprofesi
';								
$qry	= mysql_query($sql);	
				    if (mysql_num_rows($qry) > 0 )
						while($data = mysql_fetch_array($qry)){							
							echo '<tr>
									<td>'.$data['profesi'].'</td>
									<td align="right">'.curformat($data['total']).'</td></tr>';								
						}
					else {
							echo '<tr>
									<td>-</td>
									<td align="right">'.curformat(0).'</td></tr>';								
						
					}
					?>     
<th width="843">b. Persalinan</th>
				    <th width="100">&nbsp;</th></tr>                      
<?php					
 				
			$sql='SELECT nama_tindakan, SUM(JMBAYAR) AS total
			FROM t_bayarrajal a
			INNER JOIN t_billrajal b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill
			LEFT JOIN m_tarif2012 m ON b.kodetarif=m.kode_tindakan
			WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.CARABAYAR in('.$carabayar.') AND a.STATUS = "LUNAS" AND b.kodetarif LIKE "05.02%"
			GROUP BY nama_tindakan
			union
SELECT nama_tindakan , SUM((b.qty*b.tarifrs)-b.askes-b.COSTSHARING) AS total
			FROM t_bayarranap a
			INNER JOIN t_billranap b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill AND a.CARABAYAR in('.$carabayar.') 
			LEFT JOIN m_tarif2012 m ON b.kodetarif=m.kode_tindakan
			WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.STATUS = "LUNAS" AND b.kodetarif LIKE "05.02%"
			GROUP BY nama_tindakan';				
			
	$qry	= mysql_query($sql);	
				    if (mysql_num_rows($qry) > 0 )
						while($data = mysql_fetch_array($qry)){							
							echo '<tr>
									<td>'.$data['nama_tindakan'].'</td>
									<td align="right">'.curformat($data['total']).'</td></tr>';								
						}
					else {
							echo '<tr>
									<td>-</td>
									<td align="right">'.curformat(0).'</td></tr>';								
						
					}
					?>    
<th width="843">c. Tindakan</th>
				    <th width="100">&nbsp;</th></tr>  
<th width="843">c1. Rawat Jalan</th>
				    <th width="100">&nbsp;</th></tr>                                          
<?php					
 				
			$sql='SELECT nama_tindakan, SUM(JMBAYAR) AS total
			FROM t_bayarrajal a
			INNER JOIN t_billrajal b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill
			LEFT JOIN m_tarif2012 m ON b.kodetarif=m.kode_tindakan
			WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.CARABAYAR in('.$carabayar.') AND a.STATUS = "LUNAS" AND b.kodetarif LIKE "05.03%"
			GROUP BY nama_tindakan
			';				
			
	$qry	= mysql_query($sql);	
				    if (mysql_num_rows($qry) > 0 )
						while($data = mysql_fetch_array($qry)){							
							echo '<tr>
									<td>'.$data['nama_tindakan'].'</td>
									<td align="right">'.curformat($data['total']).'</td></tr>';								
						}
					else {
							echo '<tr>
									<td>-</td>
									<td align="right">'.curformat(0).'</td></tr>';								
						
					}
					?>                                                          
<th width="843">c2. Rawat Inap</th>
				    <th width="100">&nbsp;</th></tr>                                          
<?php	                    
$sql='SELECT nama_tindakan , SUM((b.qty*b.tarifrs)-b.askes-b.COSTSHARING) AS total
			FROM t_bayarranap a
			INNER JOIN t_billranap b ON a.idxdaftar=b.idxdaftar AND a.nobill=b.nobill AND a.CARABAYAR in('.$carabayar.') 
			LEFT JOIN m_tarif2012 m ON b.kodetarif=m.kode_tindakan
			WHERE TGLBAYAR BETWEEN "'.$tgl_kunjungan.'" AND  "'.$tgl_kunjungan2.'" AND a.STATUS = "LUNAS" AND b.kodetarif LIKE "05.03%"
			GROUP BY nama_tindakan';
$qry	= mysql_query($sql);	
				    if (mysql_num_rows($qry) > 0 )
						while($data = mysql_fetch_array($qry)){							
							echo '<tr>
									<td>'.$data['nama_tindakan'].'</td>
									<td align="right">'.curformat($data['total']).'</td></tr>';								
						}
					else {
							echo '<tr>
									<td>-</td>
									<td align="right">'.curformat(0).'</td></tr>';								
						
					}
					?>       
				</table>                
