<?php 
session_start();
include("include/connect.php");
require_once('gudang/ps_pagination.php');

$periode = "";
if(!empty($_GET['periode'])){
	$periode =$_GET['periode']; 
} 

$unit = "";
if(!empty($_GET['unit'])){
	$unit =$_GET['unit']; 
}

$search = "";
if(!empty($unit) && !empty($periode)){
$search = "AND t_pengadaan_barang.KDUNIT = ".$unit." AND  t_pengadaan_barang.tahun = ".$periode;
}

$farmasi ="x";
if($_SESSION['KDUNIT']=="12"){
	 $farmasi ="1";
}else if($_SESSION['KDUNIT']=="13"){
	 $farmasi ="0";
}

$sql = "SELECT 
			  t_pengadaan_barang.KDUNIT,
			  t_pengadaan_barang.NIP,
		      DATE_FORMAT(t_pengadaan_barang.tglpesan, '%d -%m -%Y') as tglpesan,
			  t_pengadaan_barang.jumlahpesan,
			  t_pengadaan_barang.tahun,
			  m_barang_group.nama_group,
			  m_barang.kode_barang,
			  m_barang.nama_barang,
			  m_barang.satuan,
			  m_login.DEPARTEMEN,
			  (SELECT sum(t_pengeluaran_barang.jmlkeluar)/12 FROM t_pengeluaran_barang
				where t_pengeluaran_barang.kodebarang  = m_barang.kode_barang and
				year(t_pengeluaran_barang.tglkeluar) = t_pengadaan_barang.tahun - 1 and
				t_pengeluaran_barang.KDUNIT = t_pengadaan_barang.KDUNIT) as rata2
			FROM
			  m_barang
			  INNER JOIN m_barang_group ON (m_barang.farmasi = m_barang_group.farmasi)
			  AND (m_barang.group_barang = m_barang_group.group_barang)
			  INNER JOIN t_pengadaan_barang ON (m_barang.kode_barang = t_pengadaan_barang.kodebarang)
			  INNER JOIN m_login ON (t_pengadaan_barang.NIP = m_login.NIP)
			  AND (t_pengadaan_barang.KDUNIT = m_login.KDUNIT)
			  WHERE m_barang.farmasi = '".$farmasi."' ".$search;
			  
$qry_order = mysql_query($sql);

$order = mysql_fetch_assoc($qry_order);

$sqlunit = "SELECT 
  			distinct m_login.DEPARTEMEN,
  			m_login.KDUNIT
			FROM m_login
			WHERE KDUNIT <> 0 AND KDUNIT <> 11 AND KDUNIT <> 12 AND KDUNIT <> 13
AND KDUNIT <> 20 AND KDUNIT <> 22 AND KDUNIT <> 23 AND KDUNIT <> 24 AND KDUNIT <> 25 AND KDUNIT <> 26";
$qry_unit = mysql_query($sqlunit);			
?>
<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title"><h3>PERENCANAAN PENGADAAN BARANG</h3></div>
    <div align="right" style="margin:5px;">
     <form name="formsearch" method="get" >
     <table class="tb">
  <tr>
<?php
  $akhtahun = date('Y') + 5;
  $c = date('Y');
?>
   <td>Periode</td>
   <td><select name="periode" id="periode" class="text" >
 <? while($c <= $akhtahun){ ?>  
   <option value="<?=$c?>" 
   <? if($c==$periode){ echo "selected=selected"; }?>
   ><?=$c?></option>
 <? $c++; } ?>  
   </select></td>
 </tr>
       <tr>
          <td align="right">Unit&nbsp;</td>
          <td align="right">
          <select name="unit" >
          <? while($unitx = mysql_fetch_array($qry_unit)) {?>
            <option value="<?=$unitx['KDUNIT']?>" 
            <? if($unitx['KDUNIT']==$unit){ echo "selected=selected"; }?>
                    ><?=strtoupper($unitx['DEPARTEMEN'])?></option>
		  <? } ?>
          </select>
          </td>
       </tr>
       <tr>
          <td align="right">
          <input type="hidden" name="link" value="89"/>
          <input type="submit" value="Cari" class="text"/></td>
          <td align="right">&nbsp;</td>
       </tr>
            
     </table>
    </form>  
        <div id="table_search">
        <table width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb">
          <tr align="center">
            <th width="5%">KODE </th>
            <th>Nama Barang</th>
            <th>Group</th>
            <th>JML</th>
            <th>Satuan</th>
            <th>UNIT</th>
            <th>PERIODE</th>
            <th>Tanggal</th>
            <th>Pengusul</th>
            <th>Rata2 Pengeluaran/Bulan</th>
          </tr>
          <?

    $pager = new PS_Pagination($connect, $sql, 15, 5, "unit=".$unit."&periode=".$periode, "index.php?link=89&");
	
	//The paginate() function returns a mysql result set 
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
            <td width="5%"><? echo $data['kode_barang']; ?></td>
            <td width="30%"><? echo $data['nama_barang']; ?></td>
            <td><? echo $data['nama_group']; ?></td>
            <td align="right" width="10%"><? echo $data['jumlahpesan']; ?></td>
            <td width="5%"><? echo $data['satuan']; ?></td>
            <td width="15%"><? echo $data['DEPARTEMEN']; ?></td>
            <td width="5%"><? echo $data['tahun']; ?></td>
            <td ><? echo $data['tglpesan']; ?></td>
            <td ><? echo $data['NIP']; ?></td>
            <td ><? echo $data['rata2']; ?></td>
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
