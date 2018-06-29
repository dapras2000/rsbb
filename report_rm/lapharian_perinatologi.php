<?php 
session_start();
include("include/connect.php");

$search = "";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
} 

if($tgl_kunjungan !=""){
	$search = " and (date(a.keluarrs) = '".$tgl_kunjungan."' or date(a.masukrs) = '".$tgl_kunjungan."')";
}else{
	$search = " and (date(a.keluarrs) = curdate() or date(a.masukrs) = curdate())";
}

$sql = "";
$sql= mysql_query("select a.nomr,b.nama,b.tgllahir,b.jeniskelamin, DATE_FORMAT(a.masukrs,'%d/%m/%Y') as tglmasuk, date(masukrs) as tanggal, 
       DATE_FORMAT(nullif(a.keluarrs,'0000-00-00'),'%d/%m/%Y') as tglkeluar,
      DATEDIFF(a.keluarrs,a.masukrs) as lamadirawat,c.kdrujuk,d.nama as carabayar,
      e.diagnosapulang,e.icdkeluar,berat_badan,g.namadokter,h.nama as poly, e.statuspulang
from t_admission a
inner join m_pasien b on a.nomr=b.nomr
inner join t_pendaftaran c on a.id_admission=c.idxdaftar
inner join m_carabayar d on d.kode=a.statusbayar
left join t_resumepulang e on e.IDADMISSION=a.id_admission
left join t_reg_partus f on f.idxdaftar=a.id_admission
inner join m_dokter g on a.dokterpengirim=g.kddokter
inner join m_poly h on h.kode=a.kd_rujuk where a.noruang=10 ".$search) or die (mysql_error());
?>
<div align="center">
    <div id="frame" style="width:95%">
    <div id="frame_title">
      <h3>LAPORAN HARIAN PASIEN PERINATOLOGI (HIDUP & MENINGGAL)</h3></div>
    <div align="right" style="margin:5px;">
    <form name="formsearch" method="get" >
     <table width="248" border="0" cellspacing="0" class="tb">
  <tr>
    <td>Tanggal</td>
    <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($tgl_kunjungan!=""){
			  echo $tgl_kunjungan;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="Cari" class="text"/>
    <input type="hidden" name="link" value="137" /></td>
  </tr>
</table>

    </form>      
        <div id="table_search">
         <!--<div style="overflow:scroll;width:98%;height:500px;" > -->
       <table width="95%" style="margin:10px;" border="1" cellspacing="0" cellspading="0" class="tb">
          <tr align="center">
            <th width="3%" rowspan="2">NO</th>
            <th width="9%" rowspan="2">NOMOR RM</th>
            <th width="13%" rowspan="2">NAMA PASIEN</th>
            <th colspan="2">UMUR</th>
            <th width="7%" rowspan="2">TGL MASUK</th>
            <th width="8%" rowspan="2">TGL KELUAR</th>
            <th width="8%" rowspan="2">LAMA DIRAWAT</th>
            <th width="11%" colspan="4">ASAL PASIEN</th>
            <th width="12%" rowspan="2">CARA BAYAR</th>
            <th width="7%" rowspan="2">DIAGNOSA AKHIR</th>
            <th width="9%" rowspan="2">ICD-X</th>
            <th width="4%" rowspan="2">TINDAKAN</th>
            <th width="2%" rowspan="2">ICD-9 CM</th>
            <th colspan="2">BERAT BAYI</th>
             <th width="0%" rowspan="2">DOKTER</th>
            <th width="0%" rowspan="2">ASAL WILAYAH</th>
            <th width="0%" rowspan="2">MASUK DARI</th>
            <th width="0%" colspan="4">KEADAAN KELUAR</th>
            <th width="1%" rowspan="2">KET</th>
          </tr>
          <tr align="center">
            <th width="6%">L</th>
            <th width="6%">P</th>
            <th width="11%">DS</th>
            <th width="6%">PKM</th>
            <th width="11%">RS LAIN</th>
            <th width="11%">INSTANSI LAIN</th>
            <th width="1%">&lt; 2500 gr</th>
            <th width="1%">&gt;= 2500 gr</th>
            <th width="0%">H</th>
            <th width="0%">R</th>
            <th width="0%">K</th>
            <th width="0%">M</th>
          </tr>
          <?
	while($data = mysql_fetch_array($sql)) {?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
        <td>&nbsp;</td>
            <td><?=$data['nomr'];?></td>
            <td><?=$data['nama'];?></td>
                <td><?php 
				      $a = datediff($data['tanggal'], $data['TGLLAHIR']);
					  if ($data['jeniskelamin']=='L'){echo $a[years].' tahun '; }?></td>
                <td><?php 
				      $a = datediff($data['tanggal'], $data['TGLLAHIR']);
					  if ($data['jeniskelamin']=='P'){echo $a[years].' tahun '; }?></td>
            <td><?=$data['tglmasuk'];?></td>
            <td><?=$data['tglkeluar'];?></td>
            <td><?=$data['lamadirawat'];?></td>
                <td><?php 
					  if ($data['kdrujuk']=='1'){echo ' X'; }?></td>
                <td><?php 
					  if ($data['kdrujuk']=='2'){echo ' X'; }?></td>
                <td><?php 
					  if ($data['kdrujuk']=='3'){echo ' X'; }?></td>
                <td><?php 
					  if ($data['kdrujuk']=='4'){echo ' X'; }?></td>
            <td><?=$data['carabayar'];?></td>
            <td><?=$data['diagnosapulang'];?></td>
            <td><?=$data['icdkeluar'];?></td>
            <td><?=$data['x'];?></td>
            <td><?=$data['x'];?></td>
            <td><?php 
					  if ($data['berat_badan'] <2500){echo ' X'; }?></td>
                <td><?php 
					  if ($data['berat_badan']>=2500){echo ' X'; }?></td>
           <td><?=$data['namadokter'];?></td>
              <td><?=$data['x'];?></td>
              <td><?=$data['poly'];?></td>
                <td><?php 
					  if (($data['statuspulang']=='1') or ($data['statuspulang']=='5')) {echo ' X'; }?></td>
                <td><?php 
					  if ($data['statuspulang']=='3'){echo ' X'; }?></td>
                <td><?php 
					  if ($data['statuspulang']=='4'){echo ' X'; }?></td>
                <td><?php 
					   if (($data['statuspulang']=='2') or ($data['statuspulang']=='6')) {echo ' X'; }?></td>
               <td>&nbsp;</td>
          </tr>
	 <?	} ?>
  
</table>
<!--</div>-->

	
        </div>
    </div>

