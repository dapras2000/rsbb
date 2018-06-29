<?php 
session_start();

include("../include/connect.php");
require_once('ps_pagination.php');

$search = " AND DATE(t_operasi.TGLORDER) = curdate() ";

$tgl_reg = "";
if(!empty($_GET['tgl_reg'])) {
    $tgl_reg =$_GET['tgl_reg'];
}

if($tgl_reg !="") {
    $search = " AND DATE(t_operasi.TGLORDER) BETWEEN  '".$tgl_reg."' ";
}

$tgl_reg2 = "";
if(!empty($_GET['tgl_reg2'])) {
    $tgl_reg2 =$_GET['tgl_reg2'];
}


if($tgl_reg !="") {
    if($tgl_reg2 !="") {
        $search = $search." AND '".$tgl_reg2."' ";
    }else {
        $search = $search." AND '".$tgl_reg."' ";
    }
}


$sql = "SELECT t_operasi.id_operasi, t_operasi.nomr,
		  m_pasien.NAMA, m_pasien.ALAMAT, t_operasi.diagnosa,
		  t_operasi.JNSOPERASI, t_operasi.TGLORDER,
		  t_operasi.KDUNIT, t_operasi.`status`,
		  t_operasi.jamselesai, m_carabayar.NAMA as CARABAYAR, t_operasi.JNSOPERASI 
		FROM                                     
		  t_operasi
		  INNER JOIN m_pasien ON (t_operasi.nomr = m_pasien.NOMR)
		  INNER JOIN t_pendaftaran ON (t_operasi.IDXDAFTAR = t_pendaftaran.IDXDAFTAR)
		  INNER JOIN m_carabayar ON (t_pendaftaran.KDCARABAYAR = m_carabayar.KODE) 
		WHERE t_operasi.KDUNIT = 10 ".$search;
$qry_order = mysql_query($sql);

$order = mysql_fetch_assoc($qry_order);
?>
<div align="center">
    <div id="frame" style="width:100%">
    <div id="frame_title">
      <h3>RENCANA OPERASI</h3></div>
    <div align="right" style="margin:5px;">
    <form name="formsearch" method="get" >
     <table class="tb">
                    <tr>
                        <td align="right">Tanggal &nbsp;<input type="text" name="tgl_reg" id="tgl_pesan" readonly="readonly" class="text"
                                                               value="<? if($tgl_reg!="") {
                                                                   echo $tgl_reg;
                                                               }?>" style="width:100px;"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a></td>
                    <tr>
                        <td align="right">S/d &nbsp;<input type="text" name="tgl_reg2" id="tgl_pesan2" readonly="readonly" class="text"
                                                           value="<? if($tgl_reg2!="") {
                                                               echo $tgl_reg2;
                                                           }?>" style="width:100px;" /><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a></td>
                    </tr>
                    <tr>
                        <td align="right"><input type="submit" value="C A R I" class="text"/></td>
                    </tr>
                </table>
                <input type="hidden" name="link" value="v03" />
    </form> 
        <div id="table_search">
        <table width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" class="tb">
          <tr align="center">
              <th>No</th>
              <th>Tgl Rencana Operasi</th>
            <th>NOMR</th>
            <th>Nama Pasien</th>
            <th>Alamat</th>
            <th>Diagnosa</th>
            <th>Cara Bayar</th>
            <th>Jns Operasi</th>
            <th>&nbsp;</th>
          </tr>
          <?
              $NO=0;
			  
    $pager = new PS_Pagination($connect, $sql, 15, 5, "tgl_reg=".$tgl_reg."&tgl_reg2=".$tgl_reg2,"index.php?link=v03&");
	
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
              <td><? $NO=($NO+1);
                                if ($_GET['page']==0) {
                                    $hal=0;
                                }else {
                                    $hal=$_GET['page']-1;
                                } echo


    ($hal*15)+$NO;?></td>
              <td><?php echo $data['TGLORDER']; ?></td>
      <td><?php echo $data['nomr']; ?></td>
      <td><?php echo $data['NAMA']; ?></td>
      <td><?php echo $data['ALAMAT']; ?></td>
      <td><?php echo $data['diagnosa']; ?></td>
      <td><?php echo $data['CARABAYAR']; ?></td>
      <td><?php if($data['JNSOPERASI']=="c"){ echo "Cito";
	  }else if($data['JNSOPERASI']=="e"){ echo "Elektif"; }?></td>
      <td><?php if($data['status']=="batal"){ echo "Batal"; 
	  }else if($data['status']=="selesai"){ echo "Selesai"; 
	  }else{
	  ?><div id="div<?=$data['id_operasi']?>">
	  <a href="#" onClick="javascript: MyAjaxRequest('div<?=$data['id_operasi']?>','vk/status_operasi.php?idxoperasi=<?=$data['id_operasi']?>'); return false;" ><input type="button" value="BATAL" class="text" /></a></div>
	  <?
	  }?></td>
          </tr>
	 <?	} 
	
	
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
$qry_excel = "SELECT t_operasi.TGLORDER AS TGL_RENCANA_OPERASI,
					t_operasi.nomr AS NORM,
					m_pasien.NAMA AS NAMA_PASIEN,
					m_pasien.ALAMAT,
					t_operasi.diagnosa AS DIAGNOSA,
					m_carabayar.NAMA as CARABAYAR,
					CASE t_operasi.JNSOPERASI
                                        WHEN 'c' THEN 'Cito'
                                        WHEN 'e' THEN 'Elektif'
                                        END AS JNS_OPERASI
		FROM                                     
		  t_operasi
		  INNER JOIN m_pasien ON (t_operasi.nomr = m_pasien.NOMR)
		  INNER JOIN t_pendaftaran ON (t_operasi.IDXDAFTAR = t_pendaftaran.IDXDAFTAR)
		  INNER JOIN m_carabayar ON (t_pendaftaran.KDCARABAYAR = m_carabayar.KODE) 
		WHERE t_operasi.KDUNIT = 10 ".$search;
?>
<div align="left">
<form name="formprint" method="post" action="gudang/excelexport.php" target="_blank" >
<input type="hidden" name="query" value="<?=$qry_excel?>" />
<input type="hidden" name="header" value="RENCANA OPERASI" />
<input type="hidden" name="filename" value="rencana_operasi" />
<input type="submit" value="Export To Ms Excel Document" class="text" /> 
</form>
</div>
</div>
