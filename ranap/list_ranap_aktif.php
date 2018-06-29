<?php 
session_start();
include("include/connect.php");
require_once('new_pagination.php');
/*
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
} 
*/
$tgl_pesan="";
if($tgl_pesan !=""){
	$search = " AND DATE(a.masukrs) = '".$tgl_pesan."' ";
}else{
	$search = "";
}

$ruang = "";
if(!empty($_GET['ruang'])){
	$ruang = $_GET['ruang'];

if($ruang !="-Pilih Ruang-"){
	$search = $search." AND a.noruang ='".$ruang."' ";
	}
}
	
$norm = "";
if(!empty($_GET['norm'])){
	$norm =$_GET['norm']; 
} 

if($norm !=""){
	$search = $search." AND b.nomr = '".$norm."' ";
}

$nama = "";
if(!empty($_GET['nama'])){
	$nama =$_GET['nama']; 
} 

if($nama !=""){
	$search = $search." AND b.nama LIKE '%".$nama."%' ";
}
?>

<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>LIST KUNJUNGAN RAWAT INAP AKTIF</h3></div>
    <div align="right" style="margin:5px;"> 
     <form name="formsearch" method="get" >
     <table class="tb">
       <tr>
          <td>NO MR</td>
          <td><input type="text" name="norm" id="norm" value="<? if($norm!=""){
			  echo $norm;}?>" class="text" /></td>
          <td><!--Tanggal--></td>
          <td><!--<input type="text" name="tgl_pesan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? //if($_REQUEST['tgl_kunjungan'] !=""): echo $_REQUEST['tgl_kunjungan']; else: echo date('Y-m-d'); endif;
?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a>--></td>
       </tr>
       <tr>
       <td>Nama Pasien</td>
       <td><input type="text" name="nama" id="nama" value="<? if($nama!=""){
			  echo $nama;}?>" class="text" /></td>
       <td >Ruang</td>       
       <td>
              <select name="ruang" class="text">
              	<option selected="selected">-Pilih Ruang-</option>
                <?	$QRY_RUANG = mysql_query("SELECT * FROM m_ruang ORDER BY no ASC"); 
					while($DATA_RUANG = mysql_fetch_array($QRY_RUANG)){
				?>
              	<option value="<?=$DATA_RUANG['no']?>" <? 
				   if($DATA_RUANG['no']==$_GET['ruang']) echo "selected=selected";
				?>><?=$DATA_RUANG['nama']?></option>
                <? } ?>
              </select></td>
        </tr>
        <tr><td colspan="4" >      
              <input type="hidden" name="link" value="12aktif" />
              <input type="submit" value="Cari" class="text"/>
         </td>
          </tr>
     </table>
    </form>
        <div id="table_search">
        <table width="100%" class="tb" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Rawat Inap">
  <tr>
    <th>NOMR</th>
    <th>Nama Pasien</th>
    <th>Alamat Pasien</th>
    <th>Jenis Pembayaran</th>
    <th>Tanggal Masuk RS</th>
    <th>Tanggal Pindah</th>
    <th>Nama Ruang</th>
    <th>No Bed</th>
    <th>Admin</th>
    <th>Status Pasien</th>
    <th>Aksi</th>
  </tr>
          <?
          $sql = "SELECT a.id_admission, a.keluarrs as metu, b.nama as namapasien, a.tgl_pindah, a.nomr, b.alamat, a.statusbayar, c.nama as jenisbayar, a.masukrs, a.noruang, e.nama, a.nott, a.icd_masuk, a.NIP, d.jenis_penyakit 
FROM t_admission a
inner join m_pasien b on a.nomr=b.nomr 
inner join m_carabayar c on a.statusbayar=c.kode 
left join icd d on a.icd_masuk=d.icd_code 
inner join m_ruang e on a.noruang=e.no WHERE a.keluarrs='0000-00-00 00:00:00'".$search." ORDER BY a.id_admission DESC";
//echo $sql;
	$pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&ruang=".$ruang."&nama=".$nama."&nomr=".$nomr,"index.php?link=12aktif&");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {
		
		?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
      <td><? echo $data['nomr'];?></td>
      <td><? echo $data['namapasien'];?></td>
      <td><?php echo $data['alamat']; ?></td>
      <td><?php echo $data['jenisbayar']; ?></td>
      <td><?php echo $data['masukrs']; ?></td>
      <td><?php if($data['tgl_pindah']=="0000-00-00"){echo "-";}else{ echo $data['tgl_pindah']; } ?></td>
      <td><?php echo $data['nama']; ?></td>
      <td><?php echo $data['nott']; ?></td>
      <td><?php echo $data['NIP']; ?></td>
      <td><?php echo "Belum Pulang";?>
      </td>
      <td>
      
      			<a href='index.php?link=121&amp;id_admission=<?php echo $data['id_admission']?>' ><input type='button' class='text' value='Proses' /></a>
      			<a href='index.php?link=175&indeks=<?php echo $data['id_admission']?>&historyback=<?php echo $_REQUEST['link'];?>' ><input type='button' class='text' value='Pindah' /></a>
         
      </td>
    </tr>
	 <?	} 
	//Display the full navigation in one go
	//echo $pager->renderFullNav();
	
	//Or you can display the inidividual links
	echo "<div style='padding:5px;' align=\"center\"><br />";
	
	//Display the link to first page: First
	echo $pager->renderFirst()." | ";
	
	//Display the link to previous page: <<
	echo $pager->renderPrev()." | ";
	
	//Display page links: 1 2 3
	echo $pager->renderNav()." | ";
	
	//Display the link to next page: >>
	echo $pager->renderNext()." | ";
	
	//Display the link to last page: Last
	echo $pager->renderLast();
	
	echo "</div>";
?>
  
</table>

	<?php
	
	//Display the full navigation in one go
	//echo $pager->renderFullNav();
	
	//Or you can display the inidividual links
	echo "<div style='padding:5px;' align=\"center\"><br />";
	
	//Display the link to first page: First
	echo $pager->renderFirst()." | ";
	
	//Display the link to previous page: <<
	echo $pager->renderPrev()." | ";
	
	//Display page links: 1 2 3
	echo $pager->renderNav()." | ";
	
	//Display the link to next page: >>
	echo $pager->renderNext()." | ";
	
	//Display the link to last page: Last
	echo $pager->renderLast();
	
	echo "</div>";
			?>
        </div>
    </div>
</div>
<br />
<? 
$qry_excel = "SELECT a.id_admission AS INDEX_DAFTAR, 
				a.nomr AS NOMR, 
				b.nama AS NAMA_PASIEN, 
				b.alamat AS ALAMAT, 
				c.nama AS STATUS_BAYAR,
				a.masukrs AS TGL_MASUK,
				a.tgl_pindah AS TGL_PINDAH, 
				e.nama AS RUANG, 
				a.nott AS NO_BED,
				CASE
				WHEN a.keluarrs is NULL THEN 'Sudah Pulang'
				ELSE  'Belum Pulang'
				END AS STATUS_PULANG
			FROM t_admission a
			inner join m_pasien b on a.nomr=b.nomr 
			inner join m_carabayar c on a.statusbayar=c.kode 
			left join icd d on a.icd_masuk=d.icd_code 
			inner join m_ruang e on a.noruang=e.no 
			".$search." ORDER BY a.nott ASC";
?>
<div align="left">
<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$qry_excel?>" />
<input type="hidden" name="header" value="LIST PASIEN RAWAT INAP" />
<input type="hidden" name="filename" value="list_ranap" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>
</div>