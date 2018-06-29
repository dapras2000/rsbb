

<?php
session_start();
require_once("../../include/connect.php"); 
//$var=decode($_SERVER['REQUEST_URI']);
if (isset($_SESSION['KDUNIT']))
{
	
	//$modus  = $var['modus'];	
	$modus  = isset($_GET['modus']) ? htmlspecialchars($_GET['modus'])	: "";	
	$nilai=isset($_GET['nilai']) ? htmlspecialchars($_GET['nilai'])	: "";	
	$tahun=isset($_GET['tahun']) ? htmlspecialchars($_GET['tahun'])	: "";	
	$namaakun='';
	$id='';
	require_once("../entri/tk_arus_kas.php");
	$objTKRAK = new tk_arus_kas();
	$objTKRAK->db_host=$hostname;
	$objTKRAK->db_user=$username;
	$objTKRAK->db_pass=$password;
	$objTKRAK->db_database=$database; 	
	if(!$objTKRAK->db_connect()) {
		echo "<h1>Sorry! Could not connect to the database server.</h1>";	
		exit();	
	}	
	if ($modus=='modify'){
		//$id     = $var['id'];
		$id=isset($_GET['id']) ? htmlspecialchars($_GET['id'])	: "";
		$hideid = isset($_GET['hideid']) ? htmlspecialchars($_GET['hideid'])	: "";	
		$allFields=$objTKRAK->getAllFieldsById($id,$tahun); 
		$nilai=$allFields['nilai'];		
		$namaakun=$allFields['name'];		
		$readonly='readonly="readnonly"';
		
	}elseif($modus == 'insert'){
		$parentid 	= $_REQUEST['nogrupakun'];
		$readonly ='';
	}
		
				
?>
<script>
$(document).ready(function(){
	$('#simpan').click(function(){
			var hideid 			= $('#hideid').val();					
			var id 			= $('#noakun').val();
			var namabaru 	= $('#namaakun').val();
			var nilai  = $('#nilai').val();
			
			if ($('#modus').val()=='modify'){
				$.post('keuangan/entri/proses_arus_kas.php',$('#formData').serialize(),function(data){																												
					id=id.replace(/[.]+/g,'_');		
					$('tr#node-'+id+' > td > span').empty().append(namabaru);
					$('tr#node-'+id+' > td.akun ').empty().append(nilai);												  
					tb_remove();
				});
			}
			
	});
	
});
</script>
<style>
#TB_ajaxContent{width:auto !important; height:auto !important;}
</style>
<div id="divResult" style="font-size:11px;text-align:center;display:none"></div>
<form action="keuangan/encti/proses_arus_kas.php'" method="post" name="formData" id="formData" >
  <table>
     <tr>
         <td>Kode Akun </td> 
         <td><input type="hidden" id="modus" name="modus" value="<?php echo $modus ?>"/>
         <input type="hidden" id="hideid" name="hideid" value="<?php echo $id ?>"/>
         <input type="text" id="noakun" name="noakun" value="<?php echo $id ?>"  <?php echo $readonly?>  /> </td>          
     </tr>
     <tr>
         <td>Nama Akun </td> 
         <td><input type="text" id="namaakun" name="namaakun" value="<?php echo $namaakun ?>" <?php echo $readonly?>/> </td>          
     </tr>
     <tr>
         <td>Tahun</td> 
         <td><input type="text" id="tahun" name="tahun" value="<?php echo $tahun ?>"  <?php echo $readonly?>/> </td>      
     </tr>
     <tr>
       <td>Nilai</td>
        <td><input type="text" id="nilai" name="nilai" value="<?php echo $nilai ?>" /> </td>    
     </tr>
     <tr>
         <td></td> 
         <td> 
         <input type="button" value="Simpan" id="simpan" class="text" >  </td>          
     </tr>
     

  </table>
 </form>
<?php 
}else{
	?><script language="javascript">document.location.href="index.php?<?php echo 'status=forbidden'?>"</script><?php 
}
?>