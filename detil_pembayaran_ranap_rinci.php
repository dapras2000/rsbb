<div align="center">
<div id="frame">
<div id="frame_title"><h3>List Pembayaran</h3></div>
<fieldset>
	<legend>Detil Pembayaran Retribusi Pasien</legend>
<?   $sql = "SELECT a.kode, a.nama_jasa, DATE_FORMAT(b.TANGGAL,'%d/%m/%Y') as TGL1, b.qty, b.TARIFRS, c.NAMA FROM m_tarif a, t_billranap b, m_pasien c WHERE a.kode=b.KODETARIF AND b.nomr=c.nomr AND b.idxdaftar='".$_GET["idxb"]."'";
 $getName = mysql_query($sql);
 $dt = mysql_fetch_assoc($getName);
 echo "<div align=left><strong><h1>Atas Nama : $dt[NAMA]</h1></strong></div>";
 ?>

<table width="95%" border="0" cellpadding="0" cellspacing="0" class="tb">
  <tr>
    <th width="27%">Nama Retribusi</th>
    <th width="17%">Tanggal </th>
    <th align="right" width="20%">Tarif</th>
    <th width="7%" colspan="2">Quantity</th>
    </tr>
            <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
    <?php
  $qry = mysql_query($sql)or die(mysql_error());
  while($data = mysql_fetch_array($qry)){
  ?>
  	<tr>
    <td><? echo $data['nama_jasa']; ?></td>
    <td align="center"><? echo $data['TGL1']; ?></td>
    <td align="right"><? echo "Rp. ".number_format($data['TARIFRS'], 0).",00"; ?></td>
    <td align="center"><? echo $data['qty']; ?></td>
    </tr>
    <?php } ?>
  </table>
	<form action="gudang/excelexport.php" enctype="multipart/form-data" method="post">
    <input type="hidden" value="<? echo $sql; ?>" name="query" />
    <input type="hidden" value="<? echo "Detil Pembayaran Retribusi Pasien"; ?>" name="header" />
    <input type="hidden" value="<? echo "DetilPembayaranRetribusiPasien"; ?>" name="filename" />
    <input type="submit" value="Export To Excel" class="text"/>
    </form>        
</fieldset>
</div>
</div>