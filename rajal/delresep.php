<div id="cart_resep">
<?php include("../include/connect.php");

	$sql="delete from tmp_cartresep where idxresep=".$_POST["idxresep"];
	//echo $sql; 
    mysql_query($sql); 
    $sql="select * from tmp_cartresep ";    
    //echo $sql; 
    
   if ($userquery = mysql_query ($sql)){
		if (mysql_num_rows ($userquery) > 0){ ?>		   

		     <table width="50%" class="tb" align="center">
             <tr>
             	<th>Nama Obat</th>
                <th>Jumlah Obat</th>
                <th>Aturan Pakai</th>
                <th>Keterangan</th>
             </tr>
                <?php
				while ($userdata = mysql_fetch_array ($userquery)){?>
				  <tr>	
					
					<td><a href="javascript:deleteResep(<?=$userdata['IDXRESEP'].','.$userdata['IDXDAFTAR']?>)"><?=$userdata['NAMAOBAT'];?></a></td>				
					<td><?php echo $userdata['JUMLAH'];?></td> 
					<td><?php echo $userdata['ATURANPAKAI'];?></td> 
					<td><?php echo $userdata['KETERANGAN'];?></td> 
				  </tr>	
				<?php } ?>
                <tr>
                	<td colspan="4" align="right">
                       <a href="javascript:saveresep(<?php echo $_POST['txtIdxDaftar']; ?>)"><div style="width:100px; cursor:pointer;" align="center" class="text">Simpan</div></a>
                    </td>
                </tr>
			</table> 
			
			<?php
		}
	} else {
		echo mysql_error();
	}
        

?>
</div>
