<?php 
session_start();
include("include/connect.php");
require_once('new_pagination.php');

//page relink (kembali ke list terakhir)
$_SESSION['page']=$_GET['page'];
$_SESSION['tgl_kunjungan']=$_GET['tgl_kunjungan'];


$search = " AND b.tglreg = curdate() ";

$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
} 

if($tgl_kunjungan !=""){
	$search = " AND b.tglreg = '".$tgl_kunjungan."' ";
}
	


$ruang = "";
if(!empty($_GET['ruang'])){
	$ruang = $_GET['ruang'];

if($ruang !="-Pilih Poly-"){
	$search = $search." AND b.kdpoly ='".$ruang."' ";
	}
}
	
$norm = "";
if(!empty($_GET['norm'])){
	$norm =$_GET['norm']; 
} 

if($norm !=""){
	$search = $search." AND a.nomr = '".$norm."' ";
}

$nama = "";
if(!empty($_GET['nama'])){
	$nama =$_GET['nama']; 
} 

if($nama !=""){
	$search = $search." AND a.nama LIKE '%".$nama."%' ";
}

?>
<div align="center">
    <div id="frame">
    <div id="frame_title"><h3>LIST DATA PASIEN RAWAT JALAN</h3></div>
    <div align="right" style="margin:5px;"> 
      <form name="formsearch" method="get" >
     <table class="tb">
       <tr>
          <td>NO MR</td>
          <td><input type="text" name="norm" id="norm" value="<? if($norm!=""){
			  echo $norm;}?>" class="text" /></td>
          <td>Tanggal</td>
          <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($_REQUEST['tgl_kunjungan'] !=""): echo $_REQUEST['tgl_kunjungan']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
       </tr>
       <tr>
       <td>Nama Pasien</td>
       <td><input type="text" name="nama" id="nama" value="<? if($nama!=""){
			  echo $nama;}?>" class="text" /></td>
       <td >Poly</td>       
       <td>
              <select name="ruang" class="text">
              	<option selected="selected">-Pilih Poly-</option>
                <?	$QRY_RUANG = mysql_query("SELECT m_poly.kode, m_poly.nama FROM m_poly"); 
					while($DATA_RUANG = mysql_fetch_array($QRY_RUANG)){
				?>
              	<option value="<?=$DATA_RUANG['kode']?>" <? 
				   if($DATA_RUANG['kode']==$_GET['ruang']) echo "selected=selected";
				?>><?=$DATA_RUANG['nama']?></option>
                <? } ?>
              </select></td>
        </tr>
        <tr><td colspan="4" >      
              <input type="hidden" name="link" value="17f" />
              <input type="submit" value="Cari" class="text"/>
         </td>
          </tr>
     </table>
    </form>
        <div id="table_search">
        <table width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb">
          <tr align="center">
          <th width="3%">NO </th>
            <th width="7%">NO RM</th>
            <th width="19%">Nama Pasien</th>
            <th width="21%">Alamat</th>
            <th width="13%">Jenis Kelamin</th>
            <th width="5%">Tgl Lahir</th>
            <th width="10%">Poly</th>
            <th width="8%">Masuk</th>
            <th width="7%">Keluar</th>
            <th width="15%">Status Keluar</th>
			<th width="6%">Prosess</th>            
          </tr>
          <?
	$sql="SELECT a.*, b.MASUKPOLY, b.KELUARPOLY, b.STATUS as STATKELUAR, b.IDXDAFTAR, k.keterangan, d.nama as namapoly, a.tgllahir,
		  (SELECT nama from m_poly where kode = b.kdpoly) AS polyasal
	      FROM m_pasien a, t_pendaftaran b 
		  LEFT JOIN m_statuskeluar k on b.status=k.status
		  LEFT JOIN t_alasan_rujuk c on b.idxdaftar=c.idxdaftar
		  LEFT JOIN m_poly d on d.kode=c.poly
		  WHERE a.nomr=b.nomr ".$search."  
		  ORDER BY b.IDXDAFTAR ASC";
	$pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_kunjungan=".$tgl_kunjungan."&ruang=".$ruang."&nama=".$nama."&nomr=".$nomr,"index.php?link=17f&");
	
	//The paginate() function returns a mysql result set 
	$NO=0;
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	while($data = mysql_fetch_array($rs)) {?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
        <td><? $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?></td>
            <td><? echo $data['NOMR'];?></td>
            <td><? echo $data['NAMA']; ?></td>
            <td><? echo $data['ALAMAT']; ?></td>
            <td><? if($data['JENISKELAMIN']=="l" || $data['JENISKELAMIN']=="L"){echo"Laki-Laki";}elseif($data['JENISKELAMIN']=="p" || $data['JENISKELAMIN']=="P"){echo"Perempuan";} ?></td>
            <td><? echo $data['tgllahir']; ?></td>
            <td align="center"><? echo $data['polyasal']; ?></td>
            <td><? echo $data['MASUKPOLY']; ?></td>
            <td><? echo $data['KELUARPOLY']; ?></td>
            <td><? echo $data['keterangan']." (".$data['namapoly'].")"; ?></td>
            <td><a href="index.php?link=17g&nomr=<?=$data['NOMR'];?>&idx=<? echo $data['IDXDAFTAR']; ?>"><input type="button" class="text" value="Rujuk RANAP" /></a></td>
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
</div>
<p></p>
