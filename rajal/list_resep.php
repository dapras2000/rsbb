<?php session_start(); ?>
<div id="cart_resep">
<?php 
include("../include/connect.php");
require_once('new_pagination.php');

        //echo $_POST["namabarang"].','.$_POST["kode"].','.$_POST["quantity"].','.$_POST["txtIdxDaftar"];
	$sql="select * from tmp_cartresep where idxdaftar=".$_POST["txtIdxDaftar"]." and namaobat='".$_POST["namabarang"]."'";
    if ($userquery = mysql_query ($sql)){
		if (mysql_num_rows ($userquery) > 0){ 
		  $sql="update tmp_cartresep set jumlah=jumlah+ ".$_POST["quantity"]." where idxdaftar=".$_POST["txtIdxDaftar"]." and namaobat='".$_POST["namabarang"]."'";
		}
		else {
   	     $sql="insert into tmp_cartresep(idxdaftar,kdpoly,kddokter,nomr,tanggal,nip,kdobat,namaobat,jumlah,aturanpakai,keterangan) values('".
	      $_POST["txtIdxDaftar"]. "','". 
	      $_POST["txtKdPoly"]. "','". 
	      $_POST["txtKdDokter"]. "','". 
	      $_POST["txtNoMR"]. "','". 
	      $_POST["txtTglReg"]. "','". 
	      $_POST["txtNip"]. "','". 
	      $_POST["kode"]. "','". 
	      $_POST["namabarang"]."',". 
	      $_POST["quantity"].",'". 
	      $_POST["dosis"]."','". 
	      $_POST["keterangan"]."'". 
	      ")";
		}
	} else {
		echo mysql_error();
	}
 	  
	//echo $sql; 

    mysql_query($sql); 
    $sql="select * from tmp_cartresep WHERE IDXDAFTAR='$_POST[txtIdxDaftar]' AND KDPOLY=".$_SESSION['KDUNIT'];    
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
<div id="cartresep1"></div>
