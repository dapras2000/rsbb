<p>
  <?  include("../../include/connect.php");
	  $sql_lab = "SELECT t_orderlab.IDXORDERLAB,  
		  t_orderlab.KODE,
		  t_orderlab.HASIL_PERIKSA,
		  t_orderlab.NOMR,
		  t_orderlab.IDXDAFTAR,
		  t_orderlab.KETERANGAN,
		  t_orderlab.TGL_MULAI,
		  t_orderlab.TGL_SELESAI,
		  m_lab.nama_jasa,
		  t_orderlab.nilai_normal,
		  m_lab.unit
		FROM
		  t_orderlab
		INNER JOIN m_lab ON (t_orderlab.KODE = m_lab.kode_jasa)
		WHERE  t_orderlab.IDXDAFTAR = ".$_GET['idx'];
	$get_lab = mysql_query($sql_lab);
	if(mysql_num_rows($get_lab)> 0){
	?>
	  <table class="tb" width="95%">
        <tr>
         <th>No</th>
         <th width="20%">Pemeriksaan Lab</th>
         <th width="30%">Hasil</th>
         <th>Nilai Normal</th>
         <th>Unit</th>
         <th>&nbsp;</th>
        </tr>
     
       
	<? $xc=1; 
	  while($data_lab=mysql_fetch_array($get_lab)){
	?>
       <tr>
         <td><?=$xc?></td>
         <td><?=$data_lab['nama_jasa']?></td>
         <td><?=$data_lab['HASIL_PERIKSA']?></td>
         <td><?=$data_lab['nilai_normal']?></td>
         <td><?=$data_lab['unit']?></td>
         <td> <a href="vk/lab/del_orderlab.php?link=51&nomr=<?=$_GET['nomr']?>&menu=3&idx=<?=$_GET['idx']?>&idxorder=<?=$data_lab['IDXORDERLAB']?>" class="text">BATAL</a></td>
       </tr>  
	<?  
	  $xc++;
	  }
	}
	?>
     </table>
</p>


<p>
 Paket Laboratorium &nbsp;
 <select name="s_paketlab" id="s_paketlab" onchange="javascript: MyAjaxRequest('paketlab','vk/lab/change_paketlab.php?paket='+this.value+'&idx='+<?=$_GET['idx']?>); return false;" >
   <option value="-"> -- </option>
   <option value="1">Non Kelas III </option>
   <option value="2">Diluar Paket</option>
   <option value="3">Paket Kelas III</option>
 </select>
</p>
<p>
  <div id="paketlab" >
  
  </div>
</p>
