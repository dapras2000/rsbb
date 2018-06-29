<?php 
session_start();

$tgl_pesan = "";
if(!empty($_GET['tgl_pesan'])){
	$tgl_pesan =$_GET['tgl_pesan']; 
} 
if(!empty($_POST['tgl_pesan'])){
	$tgl_pesan =$_POST['tgl_pesan']; 
}

if($tgl_pesan !=""){
	$search = " AND t_resep.TANGGAL = '".$tgl_pesan."' ";
}else{
	$search = "";
}

include("../include/connect.php");
include('vk/ps_pagination.php');

			 $sql = "SELECT 
  						m_carabayar.NAMA AS CARABAYAR,
						m_pasien.NOMR,
  						m_pasien.NAMA,
  						m_pasien.ALAMAT,
  						m_dokter.NAMADOKTER,
  						t_resep.KDPOLY,
						m_poly.nama AS NAMAPOLY,
  						t_resep.NORESEP,
  						DATE_FORMAT(t_resep.TANGGAL, '%d -%m -%Y %H:%i:%s') AS TANGGAL,
  						t_resep.NAMAOBAT,
  						t_resep.NIP,
						t_resep.IDXRESEP
					FROM
						t_resep
						INNER JOIN m_pasien ON (t_resep.NOMR = m_pasien.NOMR)
						INNER JOIN m_dokter ON (t_resep.KDDOKTER = m_dokter.KDDOKTER)
						INNER JOIN m_poly ON (t_resep.KDPOLY = m_poly.kode)
						INNER JOIN t_pendaftaran ON (t_pendaftaran.IDXDAFTAR = t_resep.IDXDAFTAR)
						INNER JOIN m_carabayar ON (t_pendaftaran.KDCARABAYAR = m_carabayar.KODE)
  						
					WHERE t_resep.STATUS = '1' ".$search;

$qry_order = mysql_query($sql);

?>
<div align="center">
    <div id="frame"  style="width:95%">
    <div id="frame_title">
      <h3>SENSUS  HARIAN VK</h3></div>
    <div align="right" style="margin:5px;">
    <form name="formsearch" method="post" >
     <table class="tb">
       <tr>
          <td align="right">Tanggal&nbsp;
            <input type="text" name="tgl_pesan" id="tgl_pesan" readonly="readonly" class="text" 
              value="<? if($tgl_pesan!=""){
			  echo $tgl_pesan;}?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a>
              <input type="submit" value="Cari" class="text"/></td>
          </tr>
     </table>
    </form> 
        <div id="table_search" align="center">
        <table width="99%" class="tb">
       <tr>
         <th width="42" rowspan="3"><div align="center">TANGGAL</div></th>
         <th width="43" rowspan="3"><div align="center">JENIS TINDAKAN</div></th>
         <th width="94" colspan="3"><div align="center">ASAL PASIEN</div></th>
         <th width="173" colspan="2" rowspan="2"><div align="center">BERAT BAYI</div></th>
         <th width="110" colspan="5" rowspan="2"><div align="center">CARA PEMBAYARAN</div></th>
         <th width="110" colspan="4" rowspan="2"><div align="center">JUMLAH PASIEN</div></th>
         <th width="110" rowspan="3"><div align="center">KETERANGAN</div></th>
         </tr>
       <tr>
         <th colspan="2">RUJUKAN</th>
         <th rowspan="2">NON RUJUKAN</th>
       </tr>
       <tr>
         <th>POLI</th>
         <th>LUAR RS</th>
         <th width="85">&lt;2500gr</th>
         <th width="86">&gt;=2500gr</th>
         <th width="54">TUNAI</th>
         <th width="54">BPJS</th>
         <!--<th width="110">JMKS</th>
         <th width="110">SKTM</th>-->
         <th width="110">LAIN-LAIN</th>
         <th width="54">HIDUP</th>
         <th width="54">MENINGGAL</th>
         <th width="110">DIRUJUK</th>
         <th width="110">TOTAL</th>
       </tr>
          <?
	$pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_pesan=".$tgl_pesan, "index.php?link=54&");
	
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
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
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
