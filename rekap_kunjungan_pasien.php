<?php 
include("include/connect.php");
require_once('ps_pagination.php');

?>

<div align="center">
    <div id="frame" style="width:100%;">
    <div id="frame_title"><h3>REKAP KUNJUNGAN PASIEN</h3></div>
    <div align="right" style="margin:5px;"> 
     
        <div id="table_search">
        <table width="100%" border="0" cellspacing="0" cellspading="0">
          <tr align="center">
            <th>TGL REG</th>
            <th>DALAM</th>
            <th>KB dan KD</th>
            <th>ANAK</th>
            <th>BEDAH</th>
            <th>GIGI</th>
            <th>PSIKIA</th>
            <th>NEURO</th>
            <th>ANESTS</th>
            <th>UGD</th>
            <th>V K</th>
            <th>RJK</th>
            <th>TOT. POLY</th>
            <th>SNDR</th>
            <th>PSKM</th>
            <th>RS</th>
            <th>LAIN2</th>
            <th>TOT. ASAL</th>
            <th>UMUM</th>
            <th>BPJS</th>
            <!--<th>JMKS</th>
            <th>SKTM</th>-->
            <th>LAIN2</th>
            <th>TOT. CrByr</th>
          </tr>
          <?
	$sql = "SELECT tglreg, 
			cast(sum(kdpoly*(1-abs(sign(kdpoly-1)))) as UNSIGNED ) as poli_kd1,
			cast(sum(kdpoly/2*(1-abs(sign(kdpoly-2)))) as UNSIGNED ) as poli_kd2,
			cast(sum(kdpoly/3*(1-abs(sign(kdpoly-3)))) as UNSIGNED ) as poli_kd3, 
			cast(sum(kdpoly/4*(1-abs(sign(kdpoly-4)))) as UNSIGNED ) as poli_kd4,
			cast(sum(kdpoly/5*(1-abs(sign(kdpoly-5)))) as UNSIGNED ) as poli_kd5,
			cast(sum(kdpoly/6*(1-abs(sign(kdpoly-6)))) as UNSIGNED ) as poli_kd6,
			cast(sum(kdpoly/7*(1-abs(sign(kdpoly-7)))) as UNSIGNED ) as poli_kd7,
			cast(sum(kdpoly/8*(1-abs(sign(kdpoly-8)))) as UNSIGNED ) as poli_kd8,
			cast(sum(kdpoly/9*(1-abs(sign(kdpoly-9)))) as UNSIGNED ) as poli_kd9,
			cast(sum(kdpoly/10*(1-abs(sign(kdpoly-10)))) as UNSIGNED ) as poli_kd10,
			cast(sum(kdpoly/11*(1-abs(sign(kdpoly-11)))) as UNSIGNED ) as poli_kd11,

			cast(sum(kdpoly*(1-abs(sign(kdpoly-1)))) as UNSIGNED ) +
			cast(sum(kdpoly/2*(1-abs(sign(kdpoly-2)))) as UNSIGNED )+
			cast(sum(kdpoly/3*(1-abs(sign(kdpoly-3)))) as UNSIGNED ) +
			cast(sum(kdpoly/4*(1-abs(sign(kdpoly-4)))) as UNSIGNED ) +
			cast(sum(kdpoly/5*(1-abs(sign(kdpoly-5)))) as UNSIGNED ) +
			cast(sum(kdpoly/6*(1-abs(sign(kdpoly-6)))) as UNSIGNED ) +
			cast(sum(kdpoly/7*(1-abs(sign(kdpoly-7)))) as UNSIGNED ) +
			cast(sum(kdpoly/8*(1-abs(sign(kdpoly-8)))) as UNSIGNED ) +
			cast(sum(kdpoly/9*(1-abs(sign(kdpoly-9)))) as UNSIGNED ) +
			cast(sum(kdpoly/10*(1-abs(sign(kdpoly-10)))) as UNSIGNED ) +
			cast(sum(kdpoly/11*(1-abs(sign(kdpoly-11)))) as UNSIGNED ) as tot_poly,

			cast(sum(kdrujuk*(1-abs(sign(kdrujuk-1)))) as UNSIGNED ) as rujuk_kd1,
			cast(sum(kdrujuk/2*(1-abs(sign(kdrujuk-2)))) as UNSIGNED ) as rujuk_kd2,
			cast(sum(kdrujuk/3*(1-abs(sign(kdrujuk-3)))) as UNSIGNED ) as rujuk_kd3, 
			cast(sum(kdrujuk/4*(1-abs(sign(kdrujuk-4)))) as UNSIGNED ) as rujuk_kd4,
			
			cast(sum(kdrujuk*(1-abs(sign(kdrujuk-1)))) as UNSIGNED ) +
			cast(sum(kdrujuk/2*(1-abs(sign(kdrujuk-2)))) as UNSIGNED ) +
			cast(sum(kdrujuk/3*(1-abs(sign(kdrujuk-3)))) as UNSIGNED ) +
			cast(sum(kdrujuk/4*(1-abs(sign(kdrujuk-4)))) as UNSIGNED ) as tot_rujuk,
			
			cast(sum(kdcarabayar*(1-abs(sign(kdcarabayar-1)))) as UNSIGNED ) as carabayar_kd1,
			cast(sum(kdcarabayar/2*(1-abs(sign(kdcarabayar-2)))) as UNSIGNED ) as carabayar_kd2,
			cast(sum(kdcarabayar/3*(1-abs(sign(kdcarabayar-3)))) as UNSIGNED ) as carabayar_kd3, 
			cast(sum(kdcarabayar/4*(1-abs(sign(kdcarabayar-4)))) as UNSIGNED ) as carabayar_kd4,
			cast(sum(kdcarabayar/5*(1-abs(sign(kdcarabayar-5)))) as UNSIGNED ) as carabayar_kd5,
			
			cast(sum(kdcarabayar*(1-abs(sign(kdcarabayar-1)))) as UNSIGNED ) +
			cast(sum(kdcarabayar/2*(1-abs(sign(kdcarabayar-2)))) as UNSIGNED ) +
			cast(sum(kdcarabayar/3*(1-abs(sign(kdcarabayar-3)))) as UNSIGNED ) +
			cast(sum(kdcarabayar/4*(1-abs(sign(kdcarabayar-4)))) as UNSIGNED ) +
			cast(sum(kdcarabayar/5*(1-abs(sign(kdcarabayar-5)))) as UNSIGNED ) as tot_byr			
			FROM t_pendaftaran GROUP BY tglreg ORDER BY tglreg DESC";
	$pager = new PS_Pagination($connect, $sql, 15, 5, "param1=valu1&param2=value2");
	
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
            <td><strong><? echo $data['tglreg'];?></strong></td>
            <td align="center"><? echo $data['poli_kd1'];?> </td>
            <td align="center"><? echo $data['poli_kd2']; ?> </td>
            <td align="center"><? echo $data['poli_kd3']; ?> </td>
            <td align="center"><? echo $data['poli_kd4']; ?> </td>
            <td align="center"><? echo $data['poli_kd5'];?> </td>
            <td align="center"><? echo $data['poli_kd6'];?> </td>
            <td align="center"><? echo $data['poli_kd7'];?> </td>
            <td align="center"><? echo $data['poli_kd8'];?> </td>
            <td align="center"><? echo $data['poli_kd9'];?> </td>
            <td align="center"><? echo $data['poli_kd10'];?> </td>
            <td align="center"><? echo $data['poli_kd11'];?> </td>
            <td align="center" bgcolor="#E8E9BE"><? echo $data['tot_poly'];?> </td>
            <td align="center"><? echo $data['rujuk_kd1'];?> </td>
            <td align="center"><? echo $data['rujuk_kd2'];?> </td>
            <td align="center"><? echo $data['rujuk_kd3'];?> </td>
            <td align="center"><? echo $data['rujuk_kd4'];?> </td>
            <td align="center" bgcolor="#E8E9BE"><? echo $data['tot_rujuk'];?> </td>
            <td align="center"><? echo $data['carabayar_kd1'];?> </td>
            <td align="center"><? echo $data['carabayar_kd2'];?> </td>
            <td align="center"><? echo $data['carabayar_kd3'];?> </td>
            <td align="center"><? echo $data['carabayar_kd4'];?> </td>
            <td align="center"><? echo $data['carabayar_kd5'];?> </td>
            <td align="center" bgcolor="#E8E9BE"><? echo $data['tot_byr'];?> </td>
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