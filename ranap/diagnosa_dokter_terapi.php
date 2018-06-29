<?php
require_once('./ps_pagination_x.php');
if(empty($_REQUEST['PERID'])){
	$edit = "no";
} else {
	$edit = "ok";
}
?>


 <div id="all">	
    <form name="myform" id="myform" action="./kep/add_edit_diagnosa_kep_detail.php?edit=<?echo $edit;?>" method="post">
    <?if(isset($_GET['iddetdiagkep'])) {
		$sql	= mysql_query("SELECT * FROM t_diagnosakep a left join t_detail_diagnosakep b on a.id_diagnosakep = b.id_diagnosakep WHERE a.NOMR ='".$_GET['NOMR']."' and a.idadmission = '".$_GET['idadmission']."' and a.id_diagnosakep = '".$_GET['iddiagkep']."' and b.id_detail_diagnosakep = '".$_GET['iddetdiagkep']."';"); 
		?>
		<input class="text" value="<?=$_GET['iddiagkep']?>" type="text" name="id_diagkep" id="id_diagkep" >
		<input class="text" value="<?=$_GET['iddetdiagkep']?>" type="text" name="id_detail_diagkep" id="id_detail_diagkep" >
	<?} else if(isset($_GET['iddiagkep'])){
		$sql	= mysql_query("SELECT * FROM t_diagnosakep WHERE NOMR ='".$_GET['NOMR']."' and idadmission = '".$_GET['idadmission']."' and id_diagnosakep = '".$_GET['iddiagkep']."';"); ?>
		<input class="text" value="<?=$_GET['iddiagkep']?>" type="text" name="id_diagkep" id="id_diagkep" >
	<?} $data	= mysql_fetch_array($sql);?>
	<div id="list_data"></div>
	<br>
	

    <fieldset class="fieldset"><legend>Diagnosa Terapi</legend>
      <table width="50%" border="0" cellpadding="3" cellspacing="0" align="left">
        <tr>
          <td valign="top" colspan="2">Domain</td>
          <td colspan="2">
			<?php
			  $ss	= mysql_query('select * from m_domain_diagnosa_kep order by id_domain ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($data['id_domain'] == $ds['id_domain']): echo $ds['nama_domain']; endif;
			  }
			?>
          <input class="text" value="" type="text" name="ID_DIAGNOSISHIDDEN" id="ID_DIAGNOSISHIDDEN" >		  
		  <input class="text" value="" type="text" name="KECAMATANHIDDEN" id="KECAMATANHIDDEN" >
		  <input class="text" value="" type="text" name="ID_SUB_VAR2HIDDEN" id="ID_SUB_VAR2HIDDEN" ></td>
        </tr>
        <tr>
          <td valign="top" colspan="2">Diagnosis </td>
          <td colspan="2">
			<?php
			  $ss	= mysql_query('select * from m_diagnosis_kep where id_domain = "'.$data['id_domain'].'" order by ID_DIAGNOSIS ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($data['id_diagnosis'] == $ds['id_diagnosis']): echo $ds['nama_diagnosis']. ' ('.$ds['kode_diagnosis'].')'; endif;
			  }
			?>
          </td>
        </tr>
        <tr>
          <td  valign="top" colspan="2">Daftar Implementasi</td>
          <td colspan="2"><textarea name="implementasi" cols="60" rows="5" class="text"><?=$data['implementasi']?></textarea></td>
        </tr>
		<tr>
          <td valign="top" rowspan="4">Daftar Evaluasi</td>
		  <td valign="top">S</td>
          <td colspan="2"><textarea name="evaluasi_s" cols="60" rows="5" class="text"><?=$data['evaluasi_s']?></textarea></td>
        </tr>
        <tr>
          <td valign="top">O</td>
          <td colspan="2"><textarea name="evaluasi_o" cols="60" rows="5" class="text"><?=$data['evaluasi_o']?></textarea></td>
        </tr>
        <tr>
          <td valign="top">A</td>
          <td colspan="2"><textarea name="evaluasi_a" cols="60" rows="5" class="text"><?=$data['evaluasi_a']?></textarea></td>
        </tr>
        <tr>
          <td valign="top">P</td>
          <td colspan="2"><textarea name="evaluasi_p" cols="60" rows="5" class="text"><?=$data['evaluasi_p']?></textarea></td>
        </tr>
        <tr>
          <td colspan="5" align="right"><a href="?link=diagnosa_kep&NOMR=<?=$_GET['NOMR'];?>&nama=<?php echo $_GET['nama']?>&idadmission=<?php echo $_GET['idadmission']?>"></a>&nbsp;&nbsp;&nbsp;<input type="submit" name="daftar" class="text" value="  S i m p a n  "/></td>
        </tr>
      </table>
	  </form>

	   <table width="50%" border="0" cellpadding="3" cellspacing="0" align="right">
	   	 <tr>
          <td valign="top">
		  <div align="center">
    <div id="frame">
        <div id="frame_title"><h3>DAFTAR INTERVENSI</h3></div>
        <div align="right" style="margin:5px; margin-right:10px;">

            <div id="head_report" style="display:none" >
                <div align="left" style="clear:both; padding:20px">
                    <div style="letter-spacing:-1px; font-size:16px; font:bold;"><?=strtoupper($header1)?></div>
                    <div style="letter-spacing:-2px; font-size:24px; color:#666; font:bold;"><?=strtoupper($header2)?></div>
					<div><?=$header3?><br /><?=$header4?></div>
                    <hr style="margin:5px;" />
                    <h2>LIST DATA PASIEN</h2>
                </div>            
            </div>
            <div id="table_search">
			<form method="get" action="<? $_SERVER['PHP_SELF']; ?>" name="formku" id="formku" onSubmit="return validasi()" >
                <table width="95%" style="margin:10px;" border="0" class="tb" cellspacing="1" cellspading="1" title="List Semua Data Pasien.">
                   <tr><td colspan="5">Search:&nbsp;<input type="hidden" name="link" id="link" value="<? echo"$_GET[link]";?>"><input type="hidden" name="NOMR" id="NOMR" value="<? echo"$_GET[NOMR]";?>">
				   <input type="hidden" name="idadmission" id="idadmission" value="<? echo"$_GET[idadmission]";?>">
				   <input type="hidden" name="nama" id="nama" value="<? echo"$_GET[nama]";?>">
				   <input type="hidden" name="kegiatan" id="kegiatan" width="200" maxlength="200"><input type="submit" value="search"></td></tr>
				    <tr align="center">
                        <th width="2%">No</th>
                        <th width="53%">Kelompok Kegiatan</th>
                        <th width="20%">Kode</th>
                        <th width="20%">Aktivitas</th>
                        <th width="5%">Keterangan</th>
                    </tr>
                    <?
					if($_GET[kegiatan]==''){
                    $sql="SELECT a.* FROM m_intervensi a order by a.id_intervensi";
		  		 	$sql1="SELECT count(*) FROM m_intervensi ";
					}
					else{
					$sql="SELECT a.* FROM m_intervensi a where a.kegiatan like '%$_GET[kegiatan]%' order by a.id_intervensi";
		  		 	$sql1="SELECT count(*) FROM m_intervensi ";
					}
					$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=".$orderby."&searchkey=".$searchkey."&searchfield=".$searchfield, "index.php?link=nic_list&");
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
					$NO = 0;
                    while($data = mysql_fetch_array($rs)) {?>
                    <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
                        <td align="center"><? $NO=($NO+1);
                                if (isset($_GET['page'])==0) {
                                    $hal=0;
                                }else {
                                    $hal=isset($_GET['page'])-1;
                                } echo
									($hal*15)+$NO;?></td>
                        <td><? echo $data['kegiatan']; ?></td>
                        <td><? echo $data['kode']; ?></td>
                        <td><? echo $data['aktivitas']; ?></td>
                        <td align="center"><? if($data['link'] != '') { ?><a href="implementasi/<? echo $data['link']; ?>"><input type="button" value="dokumen" class="text" /></a><?}?></td>
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
				</form>
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
</form>
		  </td>  
    </tr></table> 
    </fieldset>	
    <?php
           $page=1;
				$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=diagnosa_kep&");
				$rs = $pager->paginate();?>
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th width="2%">NO</th>
                        <!--<th width="20%">Domain</th>
                        <th width="5%">Kode Diagnosis</th>-->
                        <th width="19%">Dokter</th>
						<th width="19%">Tanggal Update</th>
						<th width="19%">Daftar Implementasi</th>
                        <th width="19%">Daftar Evaluasi - S</th>
                        <th width="19%">Daftar Evaluasi - O</th>
						<th width="19%">Daftar Evaluasi - A</th>
                        <th width="19%">Daftar Evaluasi - P</th>
						<th width="3%">Aksi</th>
                    </tr>
                <?   $sql = "SELECT a.* FROM t_detail_diagnosakep a WHERE a.id_diagnosakep = '".$_GET['iddiagkep']."'";
                $sqlcounter = "SELECT count(id_detail_diagnosakep) FROM t_detail_diagnosakep WHERE id_diagnosakep = '".$_GET['iddiagkep']."' ORDER BY id_detail_diagnosakep";

                    $pager->PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "","index.php?link=diagnosa_kep_detail&");
                    //The paginate() function returns a mysql result set
                    $rs = $pager->paginate();
                    if(!$rs) die(mysql_error());
					$NO = 0;
                    while($data = mysql_fetch_array($rs)) {?>
                    <tr <?   echo "class =";
                        $count++;
                        if ($count % 2) {
                            echo "tr1";
                        }
                        else {
                            echo "tr2";
                        }
                            ?>>
                        <td valign="top"><? $NO=($NO+1);
                                if (isset($_GET['page'])==0) {
                                    $hal=0;
                                }else {
                                    $hal=isset($_GET['page'])-1;
                                } echo
									($hal*15)+$NO;?></td>
                        <!--<td valign="top"><? echo $data['nama_domain']; ?></td>
                        <td align='center' valign="top"><? echo $data['kode_diagnosis']; ?></td>-->
						<td valign="top"><? 
						$sql	= mysql_query('select NAMA from m_perawat where NIP = "'.$data['perawat'].'"');
						while($ds = mysql_fetch_array($sql)){
						echo $ds['NAMA'];} ?></td>
						<td valign="top"><? echo $data['tgl']; ?></td>
                        <td valign="top"><? echo $data['implementasi']; ?></td>
                        <td valign="top"><? echo $data['evaluasi_s']; ?></td>
                        <td valign="top"><? echo $data['evaluasi_o']; ?></td>
						<td valign="top"><? echo $data['evaluasi_a']; ?></td>
						<td valign="top"><? echo $data['evaluasi_p']; ?></td>
						<td valign="top"><a href="?link=det_diagnosa_kep&NOMR=<?=$_GET['NOMR'];?>&nama=<?php echo $_GET['nama']?>&idadmission=<?php echo $_GET['idadmission']?>&iddiagkep=<?php echo $data['id_diagnosakep']?>&iddetdiagkep=<?php echo $data['id_detail_diagnosakep']?>"><input type="button" value="edit" class="text" /></a></td>
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
