<p>
  <?  include("include/connect.php");
	  $sql_lab = "SELECT m_radiologi.nama_rad,
  				t_radiologi.DIAGNOSA,
  				t_radiologi.IDXORDERRAD,
  				t_radiologi.TGLPERIKSA,
  				t_radiologi.HASILRESUME,
  				t_radiologi.IDXDAFTAR
				FROM t_radiologi
  				INNER JOIN m_radiologi ON (t_radiologi.JENISPHOTO = m_radiologi.kd_rad)
				WHERE  t_radiologi.IDXDAFTAR = ".$_GET['idx'];
	$get_lab = mysql_query($sql_lab);
	if(mysql_num_rows($get_lab)> 0){
	?>
	  <table class="tb" width="95%">
        <tr>
         <th>No</th>
         <th width="20%">Jenis Photo</th>
         <th width="30%">Diagnosa</th>
         <th>Hasil</th>
         <th>&nbsp;</th>
        </tr>
     
       
	<? $xc=1; 
	  while($data_lab=mysql_fetch_array($get_lab)){
	?>
       <tr>
         <td><?=$xc?></td>
         <td><?=$data_lab['nama_rad']?></td>
         <td><?=$data_lab['DIAGNOSA']?></td>
         <td><?=$data_lab['HASILRESUME']?></td>
         <td> <a href="vk/rad/del_orderrad.php?link=51&nomr=<?=$_GET['nomr']?>&menu=3&idx=<?=$_GET['idx']?>&idxorder=<?=$data_lab['IDXORDERRAD']?>" class="text">BATAL</a></td>
       </tr>  
	<?  
	  $xc++;
	  }
	}
	?>
     </table>
</p>

<p>
 Paket Radiodiagnostik &nbsp;
 <select name="s_paketrad" id="s_paketrad" onchange="javascript: MyAjaxRequest('paketrad','vk/rad/change_paketrad.php?paket='+this.value+'&idx='+<?=$_GET['idx']?>); return false;" >
   <option value="-"> -- </option>
   <option value="1">Non Kelas III </option>
   <option value="2">Diluar Paket</option>
 </select>
</p>
<p>
  <div id="paketrad" >
  
  </div>
</p>
