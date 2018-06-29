<? 
$sql_resep = "SELECT t_resep.KETERANGAN, t_resep.NORESEP, t_resep.TANGGAL, t_resep.IDXDAFTAR
			  FROM t_resep
			  WHERE  t_resep.IDXDAFTAR = ".$idxdaftar;
$get_resep = mysql_query($sql_resep);
?>

<form action="vk/save_resep.php" name="form_resep" id="form_resep" method="POST">
      <input name="txtNoMR" id="txtNoMR" type="hidden" value=<?php echo $nomr; ?> >
	  <input name="txtIdxDaftar" id="txtIdxDaftar" type="hidden" value=<?php echo $idxdaftar; ?> >
	  <input name="txtKdPoly" id="txtKdPoly" type="hidden" value=<?php echo $kdpoly; ?> >
	  <input name="txtKdDokter" id="txtKdDokter" type="hidden" value=<?php echo $kddokter; ?> >
	  <input name="txtTglReg" id="txtTglReg" type="hidden" value=<?php echo $tglreg; ?> >
	  <input name="txtNip" id="txtNip" type="hidden" value=<?php echo $_SESSION['NIP'];?> >
      <table width="95%" border="0" class="tb" cellpadding="0" cellspacing="0">
  		<tr>
  		  <td valign="top"><table width="100%" border="0">
  		    <tr>
  		      <td width="19%" valign="top">
              <input type="hidden" name="nomr" value="<?php echo $userdata['NOMR']; ?>"/>
  		      <input type="hidden" name="IDXDAFTAR" value="<?php echo $userdata['IDXDAFTAR']; ?>"/>
  		        Keterangan Resep  		        </td>
  		      <td width="81%">              
              <textarea name="keterangan" id="keterangan" cols="80" rows="6"></textarea></td>
		      </tr>
  		    <tr>
  		      <td height="48"><input class="text" type="submit" name="tambah" value="Tambah" onsubmit="submitform(document.getElementsById('form_resep'),'vk/save_resep.php','createtask',validatetask);return false;"/></td>
  		      <td>&nbsp;</td>
		      </tr>
  </table></td>
		  </tr>
        <tr>
          <td>
          
             <table width="99%" border="0" cellpadding="1" cellspacing="1" class="tb" >
                <tr>
                   <th>NO</th>
                   <th>TANGGAL</th>
                   <th>RESEP</th>
                </tr>
<? while($dat_resep = mysql_fetch_array($get_resep)){ ?>                
                <tr>
                   <td><?=$dat_resep['NORESEP']?></td>
                   <td><?=$dat_resep['TANGGAL']?></td>
                   <td><?=$dat_resep['KETERANGAN']?></td>
                </tr>
<? } ?>                
             </table>
          
          </td>
        </tr>
        <tr>
        <td></td>
       </tr>
      </table> 
		</form>    
