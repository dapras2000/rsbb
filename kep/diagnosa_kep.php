<?php
require_once('./ps_pagination_x.php');
if(empty($_REQUEST['PERID'])){
	$edit = "no";
} else {
	$edit = "ok";
}
?>
<script>
/*
	Masked Input plugin for jQuery
	Copyright (c) 2007-2011 Josh Bush (digitalbush.com)
	Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license) 
	Version: 1.3
*/
jQuery(document).ready(function(){
	jQuery("#ID_DOMAIN").change(function(){
		var selectValues = jQuery("#ID_DOMAIN").val();
		jQuery.post('./include/ajaxload.php',{iddomain:selectValues,load_diagnosis:'true'},function(data){
			jQuery('#diagnosispilih').html(data);
			jQuery('#dafgejalapilih').html("");
			jQuery('#dafetiologipilih').html("");
			jQuery('#dafoutcomepilih').html("");
			jQuery('#dafintervensipilih').html("");
		});
	});
	
	jQuery("#ID_DIAGNOSIS").change(function(){
		var selectValues = jQuery("#ID_DIAGNOSIS").val();
		jQuery.post('./include/ajaxload.php',{kdID_DIAGNOSIS:selectValues,load_kecamatan:'true'},function(data){
			jQuery('#dafgejalapilih').html(data);
			jQuery('#dafetiologipilih').html("");
			jQuery('#dafoutcomepilih').html("");
			jQuery('#dafintervensipilih').html("");
		});
	});
	
	jQuery("#ID_SUB_VAR1").change(function(){
		var selectValues = jQuery("#ID_SUB_VAR1").val();
		jQuery.post('./include/ajaxload.php',{ID_SUB_VAR1:selectValues,load_ID_SUB_VAR2:'true'},function(data){
			jQuery('#dafetiologipilih').html(data);
			jQuery('#dafoutcomepilih').html("");
			jQuery('#dafintervensipilih').html("");
		});
	});
});

</script>
<div align="center">
  <div id="frame">
  <div id="frame_title"><h3 align="left">Diagnosa Keperawatan</h3></div>
	<div id="all">	
    <form name="myform" id="myform" action="./kep/add_edit_diagnosa_kep.php?edit=<?echo $edit;?>" method="post">
    <?if(isset($_GET['iddiagkep'])){
		$sql	= mysql_query("SELECT * FROM t_diagnosakep WHERE NOMR ='".$_GET['NOMR']."' and idadmission = '".$_GET['idadmission']."' and id_diagnosakep = '".$_GET['iddiagkep']."';"); ?>
		<input class="text" value="<?=$_GET['iddiagkep']?>" type="hidden" name="id_diagkep" id="id_diagkep" >
	<?} $data	= mysql_fetch_array($sql);?>
	<div id="list_data"></div>
	<br>
	<fieldset class="fieldset" align="left">
            <table width="317" border="0" cellspacing="0" class="tb">
                <tr><td width="80">No RM :</td><td width="233"><?=$_GET['NOMR']?></td></tr>
                <tr><td>Nama :</td><td><?=$_GET['nama']?>
					<input class="text" value="<?=$_GET['idadmission']?>" type="hidden" name="idadmission" id="idadmission" >
					<input class="text" value="<?=$_GET['NOMR']?>" type="hidden" name="nomr" id="nomr" >
					<input class="text" value="<?=$_GET['nama']?>" type="hidden" name="nama" id="nama" >
				</td></tr>				
            </table>
						        <table width="317" border="0" cellspacing="0" class="tb">
					<tr>
			<TD> Perawat :&nbsp;
              <select name="perawat" class="text required" title="*" id="perawat">
                <option value="0"> --pilih-- </option>
                <?php
			  $ss	= mysql_query('select IDPERAWAT,NAMA from m_perawat order by NAMA ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($data['IDPERAWAT'] == $ds['IDPERAWAT']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$ds['IDPERAWAT'].'" '.$sel.' />'.$ds['NAMA'].'</option>&nbsp;';
				
			  }
			?>
              </select></TD>
			  
			</tr>
				
				
</table>

			</fieldset>
    <fieldset class="fieldset"><legend>Diagnosa Keperawatan</legend>
      <table width="100%" border="0" cellpadding="3" cellspacing="0">
        <tr>
          <td width="300" valign="top">Domain</td>
          <td colspan="3"><select name="ID_DOMAIN" class="text required" title="*" id="ID_DOMAIN">
            <option value="0"> --pilih-- </option>
			<?php
			  $ss	= mysql_query('select * from m_domain_diagnosa_kep order by id_domain ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($data['id_domain'] == $ds['id_domain']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$ds['id_domain'].'" '.$sel.' /> Domain '.$ds['id_domain'].' - '.$ds['nama_domain'].'</option>&nbsp;';
			  }
			?>
          </select>
		  <input class="text" value="" type="hidden" name="ID_DIAGNOSISHIDDEN" id="ID_DIAGNOSISHIDDEN" >		  
		  <input class="text" value="" type="hidden" name="KECAMATANHIDDEN" id="KECAMATANHIDDEN" >
		  <input class="text" value="" type="hidden" name="ID_SUB_VAR2HIDDEN" id="ID_SUB_VAR2HIDDEN" ></td>
        </tr>
        <tr>
          <td valign="top">Diagnosis Keperawatan</td>
          <td colspan="3"><div id="diagnosispilih"><select name="ID_DIAGNOSIS" class="text required" title="*" id="ID_DIAGNOSIS">
            <option value="0"> --pilih-- </option>
			<?php
			  $ss	= mysql_query('select * from m_diagnosis_kep where id_domain = "'.$data['id_domain'].'" order by ID_DIAGNOSIS ASC');
			  while($ds = mysql_fetch_array($ss)){
				if($data['id_diagnosis'] == $ds['id_diagnosis']): $sel = "selected=Selected"; else: $sel = ''; endif;
				echo '<option value="'.$ds['id_diagnosis'].'" '.$sel.' /> '.$ds['nama_diagnosis'].'</option>&nbsp;';
			  }
			?>
          </select></div></td>
        </tr>
        <tr>
          <td  valign="top">Daftar Gejala - Batasan Karakteristik</td>
          <td colspan="3"><div id="dafgejalapilih">
			<?php
			  $ss	= mysql_query('select * from m_sub_var1_diagnosa_kep where ID_DIAGNOSIS = "'.$data['id_diagnosis'].'" order by id_sub_var1 ASC');
			  $val_1 = split(",",$data['sub_var1']); $i = 0;
			  if(mysql_num_rows($ss) > 0){
				  while($ds = mysql_fetch_array($ss)){
					echo '<input type="checkbox" name="SUB_VAR1[]" value="'.$ds['id_sub_var1'].'" ';
					if($val_1[$i]==$ds['id_sub_var1']){echo "Checked"; $i++;} 
					echo '> '.$ds['nama_sub_var1'].'<br>';
				  }
			  }else{
				echo 'Tidak ada daftar gejala - batasan karakteristik di diagnosis tersebut';
  			  }
			?>
          </div></td>
        </tr>
        <tr>
          <td  valign="top">Daftar Etiologi - Faktor Resiko</td>
          <td colspan="3"><div id="dafetiologipilih">
			<?php
			  $ss	= mysql_query('select * from m_SUB_VAR2_diagnosa_kep where id_diagnosis = "'.$data['id_diagnosis'].'" order by ID_SUB_VAR2 ASC');
			  $val_2 = split(",",$data['sub_var2']); $i = 0;
			  if(mysql_num_rows($ss) > 0){
				  while($ds = mysql_fetch_array($ss)){
					echo '<input type="checkbox" name="SUB_VAR2[]" value="'.$ds['id_sub_var2'].'" ';
					if($val_2[$i]==$ds['id_sub_var2']){echo "Checked"; $i++;} 
					echo '> '.$ds['nama_sub_var2'].'<br>';
				  }
			  }else{
				echo 'Tidak ada daftar etiologi - faktor resiko di diagnosis tersebut';
  			  }
			?>
			</select></div></td>
        </tr>
        <tr>
          <td  valign="top">Daftar Tujuan - Outcome (NOC)</td>
          <td colspan="3"><div id="dafoutcomepilih">
			<?php
			  $ss	= mysql_query('select * from m_SUB_VAR3_diagnosa_kep where id_diagnosis = "'.$data['id_diagnosis'].'" order by ID_SUB_VAR3 ASC');
			  $val_3 = split(",",$data['sub_var3']); $i = 0;
			  if(mysql_num_rows($ss) > 0){
				  while($ds = mysql_fetch_array($ss)){
					echo '<input type="checkbox" name="SUB_VAR3[]" value="'.$ds['id_sub_var3'].'" ';
					if($val_3[$i]==$ds['id_sub_var3']){echo "Checked"; $i++;} 
					echo '> '.$ds['nama_sub_var3'].'<br>';
				  }
			  }else{
				echo 'Tidak ada daftar tujuan - outcome (NOC) di diagnosis tersebut';
  			  }
			?>
			</select></div></td>
        </tr>
        <tr>
          <td  valign="top">Daftar Intervensi (NIC)</td>
          <td colspan="3"><div id="dafintervensipilih">
			<?php
			  $ss	= mysql_query('select * from m_SUB_VAR4_diagnosa_kep where id_diagnosis = "'.$data['id_diagnosis'].'" order by ID_SUB_VAR4 ASC');
			  $val_4 = split(",",$data['sub_var4']); $i = 0;
			  if(mysql_num_rows($ss) > 0){
				  while($ds = mysql_fetch_array($ss)){
					echo '<input type="checkbox" name="SUB_VAR4[]" value="'.$ds['id_sub_var4'].'" ';
					if($val_4[$i]==$ds['id_sub_var4']){echo "Checked"; $i++;} 
					echo '> '.$ds['nama_sub_var4'].'<br>';
				  }
			  }else{
				echo 'Tidak ada daftar intervensi (NIC) di diagnosis tersebut';
  			  }
			?>
			</select></div></td>
        </tr>
        <tr>
          <td colspan="5" align="right"><input type="submit" name="daftar" class="text" value="  S a v e  "/></td>
        </tr>
      </table>	  
    </fieldset>	
  </form>
  <?php
           $page=1;
				$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "orderby=''&searchkey=''&searchfield=''", "index.php?link=diagnosa_kep&");
				$rs = $pager->paginate();?>
                <table class="tb" width="95%" style="margin:10px;" border="0" cellspacing="1" cellspading="1" title="List Kunjungan Data Pasien Per Hari Ini">
                    <tr align="center">
                        <th width="2%">NO</th>
                        <!--<th width="20%">Domain</th>
                        <th width="5%">Kode Diagnosis</th>-->
                        <th width="20%">Perawat</th>
						<th width="10%">Tanggal Update</th>
						<th width="13%">Diagnosis Keperawatan</th>
                        <th width="20%">Daftar Gejala - Batasan Karakteristik</th>
                        <th width="20%">Daftar Etiologi - Faktor Resiko</th>
						<th width="20%">Daftar Tujuan - Outcome (NOC)</th>
                        <th width="20%">Daftar Intervensi (NIC)</th>
						<th width="5%">Aksi</th>
                    </tr>
                <?   $sql = "SELECT a.*, (select nama_domain from m_domain_diagnosa_kep where id_domain = a.id_domain) nama_domain, (select kode_diagnosis from m_diagnosis_kep where id_diagnosis=a.id_diagnosis) kode_diagnosis, (select nama_diagnosis from m_diagnosis_kep where id_diagnosis=a.id_diagnosis) nama_diagnosis FROM t_diagnosakep a WHERE a.NOMR ='".$_GET['NOMR']."' and a.idadmission = '".$_GET['idadmission']."' ORDER BY a.id_diagnosakep";
                $sqlcounter = "SELECT count(id_diagnosakep) FROM t_diagnosakep WHERE NOMR ='".$_GET['NOMR']."' and idadmission = '".$_GET['idadmission']."' ORDER BY id_diagnosakep";			

                    $pager->PS_Pagination($connect, $sql, $sqlcounter, 15, 5, "","index.php?link=diagnosa_kep&");
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
						$sql	= mysql_query('select NAMA from m_perawat where IDPERAWAT = "'.$data['perawat'].'"');
						while($ds = mysql_fetch_array($sql)){
						echo $ds['NAMA'];} ?></td>
						<td valign="top"><? echo $data['tgl']; ?></td>
						<td valign="top"><? echo $data['nama_diagnosis']; ?></td>
                        <td valign="top"><? 
							$sql	= mysql_query('select * from m_sub_var1_diagnosa_kep where id_diagnosis = "'.$data['id_diagnosis'].'" order by id_sub_var1 ASC');
							$var_1 = split(",",$data['sub_var1']); $i = 0;
							while($ds = mysql_fetch_array($sql)){	
								if($var_1[$i]==$ds['id_sub_var1']){echo '- '.$ds['nama_sub_var1'].' <br>'; $i++;}
							} ?></td>
                        <td valign="top"><? 
							$sql	= mysql_query('select * from m_sub_var2_diagnosa_kep where id_diagnosis = "'.$data['id_diagnosis'].'" order by id_sub_var2 ASC');
							$var_2 = split(",",$data['sub_var2']); $i = 0;
							while($ds = mysql_fetch_array($sql)){	
								if($var_2[$i]==$ds['id_sub_var2']){echo '- '.$ds['nama_sub_var2'].' <br>'; $i++;}
							} ?></td>
						<td valign="top"><? 
							$sql	= mysql_query('select * from m_sub_var3_diagnosa_kep where id_diagnosis = "'.$data['id_diagnosis'].'" order by id_sub_var3 ASC');
							$var_3 = split(",",$data['sub_var3']); $i = 0;
							while($ds = mysql_fetch_array($sql)){	
								if($var_3[$i]==$ds['id_sub_var3']){echo '- '.$ds['nama_sub_var3'].' <br>'; $i++;}
							} ?></td>
						<td valign="top"><? 
							$sql	= mysql_query('select * from m_sub_var4_diagnosa_kep where id_diagnosis = "'.$data['id_diagnosis'].'" order by id_sub_var4 ASC');
							$var_4 = split(",",$data['sub_var4']); $i = 0;
							while($ds = mysql_fetch_array($sql)){	
								if($var_4[$i]==$ds['id_sub_var4']){echo '- '.$ds['nama_sub_var4'].' <br>'; $i++;}
							} ?></td>
						<td valign="top"><a href="?link=diagnosa_kep&NOMR=<?=$_GET['NOMR'];?>&nama=<?php echo $_GET['nama']?>&idadmission=<?php echo $data['idadmission']?>&iddiagkep=<?php echo $data['id_diagnosakep']?>&perawat=<?php echo $data['perawat']?>"><input type="button" value="edit" class="text" /></a><a href="?link=det_diagnosa_kep&NOMR=<?=$_GET['NOMR'];?>&nama=<?php echo $_GET['nama']?>&idadmission=<?php echo $data['idadmission']?>&iddiagkep=<?php echo $data['id_diagnosakep']?>&perawat=<?php echo $data['perawat']?>"><input type="button" value="detail" class="text" /></a></td>
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