<?
include("../include/connect.php");
require_once('ps_pagination.php');
?>
<div align="center">
  <div id="frame">
   	<div id="frame_title"><h3>History Pasien</h3></div>
	<?
	$crbyrs = "";
	$nomrs 	= "";
	if($_GET['crbyr']!=''){
		$crbyrs = " AND b.KDCARABAYAR=".$_REQUEST['crbyr'];
	}
	if($_GET['nomr']!=""){
		$nomrs = " AND b.nomr='".$_GET['nomr']."'";
	}
	
    ?>
<?
  echo $pmb -> begin_round("500px","FFF","CCC","CCC"); //  (width, fillcolor, edgecolor, shadowcolor)
?>

    <form name="cari" method="get">
    cari Berdasarkan 
    <select name="crbyr" class="text">
    	<?php $sqlddd = mysql_query('select * from m_carabayar where kode not in (1,5)');
		while($dsql = mysql_fetch_array($sqlddd)){
			echo '<option value="'.$dsql['KODE'].'">'.$dsql['NAMA'].'</option>';
		}
		?>
    </select>
    nomr 
    	<input type="text" name="nomr" class="text" size="20">
        <input type="hidden" name="link" value="14h" />
        <input type="submit" value="cari" name="submit" class="text">
    </form>    
<? 
  echo $pmb -> end_round();
?>    
      <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
        <tr align="center">
          <th width="14%">NO RM</th>
          <th width="10%">Nama</th>
          <th width="20%">Jns Kelamin</th>
          <th width="15%">Tgl Lahir</th>
          <th width="28%">Alamat</th>
            <th width="13%">Cara Bayar</th>
            
          <th width="13%">&nbsp;</th>
        </tr>
        <?
	$sql = "SELECT a.NOMR, a.NAMA, a.ALAMAT, a.JENISKELAMIN, a.TGLLAHIR, b.KDCARABAYAR, b.KDPOLY, c.NAMA as CARABAYAR 
	FROM m_pasien a, t_pendaftaran b 
	JOIN m_carabayar c on c.KODE = b.KDCARABAYAR 
	WHERE a.NOMR=b.NOMR".$crbyrs.$nomrs;		
	
	$pager = new PS_Pagination($connect, $sql, 15, 5, "crbyr=".$crbyrs."&nomr=".$nomrs,"index.php?link=14h&");
	//The paginate() functiton returns a mysql result set 
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
          <td><? echo $data['NOMR'];?></td>
          <td><? echo $data['NAMA']; ?></td>
          <td><? 
				if($data['JENISKELAMIN']=="L"){
					echo "Laki - laki";
				}else{
					echo "Perempuan";
				}?></td>
          <td><? echo $data['TGLLAHIR']; ?></td>
          <td><? echo $data['ALAMAT']; ?></td>
            <td><?php echo $data['CARABAYAR'];?></td>
            
          <td><a href="index.php?link=rm6&amp;nomr=<?php echo $data['NOMR']?>&nama=<?php echo $data['NAMA']?>" ><input type="button" value="DETAIL RIWAYAT" class="text"/></a></td>
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
        
        
    </div>
</div>