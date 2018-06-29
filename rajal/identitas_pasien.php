<?php
  include("../include/connect.php");
  $myquery = "select a.NOMR,b.NAMA,b.ALAMAT,b.JENISKELAMIN,b.TGLLAHIR,c.NAMA as CARABAYAR
			  from T_PENDAFTARAN a, m_pasien b, m_carabayar c
			  where a.NOMR=b.NOMR AND a.KDCARABAYAR=c.KODE and a.NOMR='".$_GET["nomr"]."'";
   if ($userquery = mysql_query ($myquery)){
		if (mysql_num_rows ($userquery) > 0){ ?>
		     <table><?php
				while ($userdata = mysql_fetch_array ($userquery)){?>
			    <tr>
			      <td>NoMR</td>
			      <td><?php echo $userdata['NOMR'];?></td> 
			    </tr>
			    <tr>
			      <td>NAMA</td>
			      <td><?php echo $userdata['NAMA'];?></td> 
			    </tr>
			    <tr>			    
			      <td>ALAMAT</td>
			      <td><?php echo $userdata['ALAMAT'];?></td> 
			    </tr>
			    <tr>
			      <td>L/P</td>
			      <td><?php echo $userdata['JENISKELAMIN'];?></td> 
			    </tr>
			    <tr>
			      <td>TGL.LAHIR</td>
			      <td><?php echo $userdata['TGLLAHIR'];?></td> 
			    </tr>
			    <tr>
			      <td>CARA BAYAR</td>			      
			      <td><?php echo $userdata['CARABAYAR'];?></td> 
			    </tr> 				
				<?php } ?>
			</table> <?php
		}
	} else {
		echo mysql_error();
	}

?>
