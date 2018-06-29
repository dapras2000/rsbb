<?php session_start();
include 'include/connect.php';
include 'include/function.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
    <style>
    * {
        font-family: tahoma;
        font-size: 11pt;
    }
    </style>
    
</head>
<body onload="javascript:window.print()" > 


<?php
$myquery = 'SELECT a.nomr AS NOMR, a.nobill, b.NAMA as pasien, a.TGLBAYAR, a.JAMBAYAR, a.TOTCOSTSHARING,a.JMBAYAR, a.UNIT, c.nama_unit,d.NAMA as carabayar
FROM t_bayarrajal a 
JOIN m_pasien b ON b.NOMR = a.NOMR 
JOIN m_unit c ON c.kode_unit = a.UNIT
JOIN m_carabayar d ON d.KODE = a.CARABAYAR 
WHERE a.NOMR = "'.$_REQUEST['nomr'].'" and a.IDXDAFTAR = "'.$_REQUEST['idxdaftar'].'"';
$get = mysql_query ($myquery)or die(mysql_error());
$userdata = mysql_fetch_assoc($get);
		?>
<style type="text/css">
    .fonte{  }
    .lebar{width: 100%;}
    
}
</style>
<div style="width: 100%;text-align: center;font-weight: bold; ">RSI BANYUBENING</div>
<div style="width: 100%;text-align: center; ">Jl. Raya Waduk Cengklik Ngargorejo, Ngemplak Boyolali 0276-320088</div>
<table  class="fonte" cellpadding="0", cellspacing="0">
    <tr><td>Kepada Yth</td><td></td></tr>
    <tr><td>Nama Pasien</td><td>&nbsp;:&nbsp;<?php echo $userdata['pasien'];?></td></tr>
    <tr><td>No RM</td><td>&nbsp;:&nbsp;<?php echo $userdata['NOMR'];?></td></tr>
    <tr><td>Unit</td><td>&nbsp;:&nbsp;<?php echo $userdata['nama_unit'];?></td></tr>
    <tr><td>Pembayaran</td><td>&nbsp;:&nbsp;<?php echo $userdata['carabayar'];?></td></tr>
    <tr><td><div style="height:10px;"></div></td></tr>
    <tr><td>NO Transaksi</td><td>&nbsp;:&nbsp;<b><?php echo $userdata['nobill'];?> / rajal</b></td></tr>   
</table>
<div style="width: 100%;text-align: center;font-weight: bold; ">Rekap Bill Pasien</div>

<table style="width: 100%; ">
<tr><th style=" border-top: solid 1px black; border-bottom: solid 1px black;" align="left">No</th><th style="border-top: solid 1px black; border-bottom: solid 1px black;" align="left">Jenis Tindakan</th><th style="border-top: solid 1px black; border-bottom: solid 1px black;" align="left">Qty</th><th style="border-top: solid 1px black; border-bottom: solid 1px black;" align="left">Harga</th><th style="border-top: solid 1px black; border-bottom: solid 1px black;" align="left">Jumlah Harga</th><th style="border-top: solid 1px black; border-bottom: solid 1px black;" align="left">Ket</th></tr>
<tbody>
    <?php
    $sql = "SELECT a.kode_tindakan AS kode, a.nama_tindakan AS nama_jasa, b.qty, b.TARIFRS,c.NAMADOKTER
            FROM m_tarif2012 a, t_billrajal b
                            LEFT JOIN m_dokter c ON c.KDDOKTER = b.KDDOKTER
                            WHERE a.kode_tindakan=b.KODETARIF 
                            AND b.NOMR='".$_REQUEST['nomr']."' and b.IDXDAFTAR = '".$_REQUEST['idxdaftar']."'
                            UNION ALL 
                            SELECT a.kode_tindakan AS kode, a.nama_tindakan AS nama_jasa, b.qty, b.TARIFRS,c.NAMADOKTER
                            FROM m_tarif2012 a, t_billrajal b
                            LEFT JOIN m_dokter c ON c.KDDOKTER = b.KDDOKTER
                            JOIN m_pasien d ON b.NOMR=d.NOMR
                            WHERE a.kode_tindakan=b.KODETARIF 
                            AND d.PARENT_NOMR='".$_REQUEST['nomr']."'";
                        $total  = 0;
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

                    $tot = $tot + ( $data['qty'] * $data['TARIFRS']);
                    $total = $data['qty'] * $data['TARIFRS'];

        echo '<tr><td align="left">'.$no++.'</td><td align="left">'.$data['nama_jasa'].'</td><td align="left">'.$data['qty'].'</td><td align="left">'.curformat($data['TARIFRS']).'</td><td align="left">'.curformat($total).'</td><td align="left">'.$st.'</td></tr>';
            }
    ?>
</tbody>

</table>
<hr>
<table style="width: 100%;" class="fonte"><tr><td><em>Terbilang: <?php echo Terbilang($tot);?> rupiah</em></td><td align="left">Total Harga</td><td align="left" ><b> Rp.<?php echo curformat($tot); ?></b></td></tr></table>

<div class="fonte" align="right" style="width: 100%; ">
<br/>
<div align="center">
Kasir<br /><br /><br />
( <?php echo $_SESSION['NIP'];?> )
</div>

</div>


<style type="text/css" media="screen">

table#table_list{width:90%;  border-collapse:0; border-spacing:0px;}
tr th{border-bottom:1px solid #000; border-top:1px solid #000;}
#footer{width:90%; }
#last_line{ font-style:inherit; width:90%;}
</style>


<div class="page-break"></div>
<?php
$base		= './pdf_pembayaran/';
$folder		= date('Ymd');
$ext		= '.pdf';
if(file_exists($base.$folder)){
	$folder_simpan	= $base.$folder;
	if(file_exists($folder_simpan.'/'.$namafile.$ext)){
		$uniq 		= date('His');
		$filesave	= $folder_simpan.'/'.$namafile.'_('.$uniq.')'.$ext;
	}else{
		$filesave	= $folder_simpan.'/'.$namafile.$ext;
	}
}else{
	mkdir($base.$folder,0777);
	$folder_simpan  = $base.$folder;
	$filesave		= $folder_simpan.'/'.$namafile.$ext;
}
$dompdf = new DOMPDF();
$dompdf->load_html($report);
$dompdf->set_paper("A5","landscape");
$dompdf->render();
$pdf = $dompdf->output();
file_put_contents($filesave,$pdf);
?>

</body>
</html>