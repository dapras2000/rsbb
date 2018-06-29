<?php 
include("include/connect.php");
require_once('ps_pagegizi.php');

$search_tanggal = " AND date(A.TANGGAL) BETWEEN CURDATE() AND CURDATE() ";
$tgl_kunjungan = "";
if(!empty($_GET['tgl_kunjungan'])){
	$tgl_kunjungan =$_GET['tgl_kunjungan']; 
} 

if($tgl_kunjungan !=""){
	$search_tanggal = " AND date(A.TANGGAL) BETWEEN  '".$tgl_kunjungan."' ";
}

$tgl_kunjungan2 = "";
if(!empty($_GET['tgl_kunjungan2'])){
	$tgl_kunjungan2 =$_GET['tgl_kunjungan2']; 
} 


if($tgl_kunjungan !=""){
if($tgl_kunjungan2 !=""){
	$search_tanggal = $search_tanggal." AND '".$tgl_kunjungan2."' ";
}else{
	$search_tanggal = $search_tanggal." AND '".$tgl_kunjungan."' ";
}
}

?>
<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>DAFTAR PERMINTAAN MAKANAN PASIEN</h3></div>
       
    <form name="formsearch" id="formsearch" method="get">  

    <div align="right" style="margin:5px;">
	       List Berdasarkan :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <table>
             	<tr>
                   <td>
             			<select name="ruang" id="ruang" class="text" >
               				<option value="0">-Pilih Ruang-</option>
               				<? 
			 					$sql = mysql_query("SELECT * FROM m_ruang")or die (mysql_error());
								while ($row= mysql_fetch_array($sql)){
			 				?>
               				<option value="<? echo $row['no'];?>"><? echo $row['nama'];?></option>
               				<? } ?>
             			</select>        
                   </td>
                   <td>
                   		<select name="poly" id="poly" class="text" >
               				<option value="0">-Pilih Poly-</option>
               				<option value="9">UGD</option>
               				<option value="10">VK</option>
             			</select>
                   </td>
             	</tr>
                <tr>
                   <td>
                   <select name="shift" id="shift" class="text" >
						<option value="0">-Pilih Shift-</option>
                     	<option value="1">I Pagi</option>
                     	<option value="2">II Siang</option>
                     	<option value="3">III Sore</option>
                     	<option value="4">snack Pagi</option>
                     	<option value="5">snack Sore</option>
      			  </select>

                   </td>
                   <td>&nbsp;</td>
             	</tr>
                <tr>
                    <td><input type="text" name="tgl_kunjungan" id="tgl_pesan" readonly="readonly" class="text"  style="width:80px"
              value="<? if($_REQUEST['tgl_kunjungan'] !=""): echo $_REQUEST['tgl_kunjungan']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    <td><input type="text" name="tgl_kunjungan2" id="tgl_pesan2" readonly="readonly" class="text" style="width:80px" 
              value="<? if($_REQUEST['tgl_kunjungan2'] !=""): echo $_REQUEST['tgl_kunjungan2']; else: echo date('Y/m/d'); endif;?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                </tr>
             </table>   
                    <input type="hidden" name="link" value="16" />
<input type="submit" class="text" value="Cari" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

             
             
</div>
            
      </form>     
        <div id="cari_poly">
          <table width="95%" class="tb" style="margin:10px;" border="0" cellspacing="0" cellspading="0" title="List Pemesan Makanan Per Hari">
            <tr align="LEFT">
            <th width="5%">NO </th>
            <th width="5%">Tanggal </th>
              <th width="8%">NoRM</th>
              <th width="12%">NamaPasien</th>
              <th width="5%">Kelas</th>
              <th width="5%">Ruang</th>
              <th width="5%">Poly</th>
              <th width="15%">Type Makanan</th>
              <th width="9%">Keterangan</th>
              <th width="11%">Jenis Makanan</th>
              <th width="6%">Shift</th>
              <th width="19%">Keterangan Request</th>
            </tr>
            <?
$kondisi='';			
if ($_GET['ruang']!=0){
	$kruang=' and A.RUANG = '.$_GET['ruang'];
}
if ($_GET['shift']!=0){
	$kshift=' and A.SHIFT = '.$_GET['shift'];
}
if ($_GET['poly']!=0){
	$kpoly=' and A.POLY = '.$_GET['poly'];
}
$kondisi=$kruang.$kshift.$kpoly.$search_tanggal;
  $sql="SELECT A.NOMR, A.TANGGAL,
		 case A.TYPEMAKANAN 
		 		   when 1 then 'PASIEN YANG MENDAPAT MAKANAN BIASA' 
 				   when 2 then 'PASIEN YANG MENDAPAT MAKANAN KHUSUS'
				   ELSE '-'
		 end as TYPEMAKANAN,
		 case A.KETERANGAN 
		 		   when 1 then 'TKTP' 
 				   when 2 then 'RG' 
				   when 3 then 'DL' 
                   when 4 then 'DH' 
				   when 5 then 'DM'
				   when 6 then 'DJ'
				   when 7 then 'TP'
				   when 8 then 'RP.r'
				   when 9 then 'RP'
				   ELSE '-'
		 end as KETERANGAN,
 	     case A.JENISMAKANAN 
		           when 1 then 'NASI' 
				   when 6 then 'NASI TIM'
 				   when 2 then 'LUNAK / BUBUR' 
				   when 3 then 'BUBUR SARING' 
                   when 4 then 'CAIR' 
				   when 5 then 'SONDE'
				   ELSE '-'
		 end as JENISMAKANAN,
		 case A.SHIFT
		 		   when 1 then 'PAGI'
		 		   when 2 then 'SIANG'
		 		   when 3 then 'SORE'
		 		   when 4 then 'SNACK PAGI'
		 		   when 5 then 'SNACK SORE'
				   ELSE '-'
		 end as SHIFT, 
		      A.KETERANGANTAMBAHAN, A.RUANG, A.POLY, 
			  B.NAMA
		FROM t_dpmp A, m_pasien B
		WHERE A.NOMR=B.NOMR ".$kondisi." ORDER BY IDX DESC";
$NO=0;
//"shift=".$_GET['shift']."&ruang=".$_GET['ruang']
	$pager = new PS_Pagegizi($connect, $sql, 15, 5, "shift=".$_GET['shift']."&poly=".$_GET['poly']."&ruang=".$_GET['ruang'],"index.php?link=16&");
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
        ?> valign="top">
              <td><? $NO=($NO+1);if ($_GET['page']==0){$hal=0;}else{$hal=$_GET['page']-1;} echo ($hal*15)+$NO;?></td>
              <td><? echo $data['TANGGAL'];?></td>
              <td><? echo $data['NOMR'];?></td>
              <td><? echo $data['NAMA']; ?></td>
               <td><?
			   		if($data['RUANG']!=0){
					//$qry11 = mysql_query("SELECT kelas FROM m_ruang WHERE no='".$data['RUANG']."'")or die(mysql_error());
					$qry11 = mysql_query("SELECT kelas FROM m_ruang,t_admission WHERE t_admission.nomr='".$data['NOMR']."' AND m_ruang.no=t_admission.noruang ")or die(mysql_error());
					while ($cas = mysql_fetch_array($qry11)){
					echo $cas['kelas'];
					}
					}else{
						echo "-";
					}    
				   ?></td>
              <td><? 
			  		if($data['RUANG']!=0){
					//$qry1 = mysql_query("SELECT nama FROM m_ruang WHERE no='".$data['RUANG']."'")or die(mysql_error());
					$qry1 = mysql_query("SELECT nama FROM m_ruang,t_admission WHERE t_admission.nomr='".$data['NOMR']."' AND m_ruang.no=t_admission.noruang ")or die(mysql_error());
					while ($ca = mysql_fetch_array($qry1)){
					echo $ca['nama'];
					}
					}else{
						echo "-";
					}
				  ?>
              </td>
              <td><? 
 			  		if($data['POLY']!=0){
					$qry1 = mysql_query("SELECT nama FROM m_poly WHERE kode='".$data['POLY']."'")or die(mysql_error());
					while ($ca = mysql_fetch_array($qry1)){
					echo $ca['nama'];
					}
					}else{
						echo "-";
					}
 
			      ?></td>
              <td><? echo $data['TYPEMAKANAN']; ?></td>
               <td><? echo $data['KETERANGAN']; ?></td>
              <td><? echo $data['JENISMAKANAN'];?></td>
              <td><? echo $data['SHIFT'];?></td>
              <td><? echo $data['KETERANGANTAMBAHAN'];?></td>
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