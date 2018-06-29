

<?php
session_start();
require_once("../../include/connect.php"); 
//$var=decode($_SERVER['REQUEST_URI']);
if (isset($_SESSION['KDUNIT']))
{
	
	//$modus  = $var['modus'];	
	$modus  = isset($_GET['modus']) ? htmlspecialchars($_GET['modus'])	: "";	
	$icon  		=isset($_GET['icon']) ? htmlspecialchars($_GET['icon']) : "";	
	$icon_checked_folder='';
	$icon_checked_file='';
	$namaakun='';
	$id='';
	$parentid='';
	require_once("neraca.php");
	$objSetupNeraca = new neraca();
	$objSetupNeraca->db_host=$hostname;
	$objSetupNeraca->db_user=$username;
	$objSetupNeraca->db_pass=$password;
	$objSetupNeraca->db_database=$database; 	
	
	if(!$objSetupNeraca->db_connect()) {
		echo "<h1>Sorry! Could not connect to the database server.</h1>";	
		exit();	
	}	
	if ($modus=='modify'){
		//$id     = $var['id'];
		$id=isset($_GET['id']) ? htmlspecialchars($_GET['id'])	: "";
		$hideid = isset($_GET['hideid']) ? htmlspecialchars($_GET['hideid'])	: "";	
		$allFields=$objSetupNeraca->getAllFieldsById($id); 
		$namaakun=$allFields['name'];
		$parentid=$allFields['parentId'];
		$readonly='readonly="readnonly"';
		if ($allFields['slave']==0) {
			$icon_checked_folder='checked="checked"'; 
			}
		else {
			$icon_checked_file= 'checked="checked"';
		}
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
			var nogrupakun  = $('#nogrupakun').val();
			
			if ($('#modus').val()=='modify'){
				$.post('keuangan/setup/proses_neraca.php',$('#formData').serialize(),function(data){																												
					id=id.replace(/[.]+/g,'_');		
					$('tr#node-'+id+' > td > span').empty().append(namabaru);
					$('tr#node-'+id+' > td.akun ').empty().append(id.replace(/[_]+/g,'.'));					
					$('tr#node-'+id+' > td.grupakun').empty().append(nogrupakun);
		      //alert($('tr#node-'+id+' > td > span').text());
			  
					tb_remove();
				});
			}
			else {
  			 $.post('keuangan/setup/proses_neraca.php',$('#formData').serialize(),function(data){
			   /*var str = '<tr id="node-'+id+'" class="child-of-node-'+id.replace(/[.]+/g,'_')+'">';
			   str += '<td><span>'+namabaru+'</span></td>';
			   str += '<td align="center">'+id.replace(/[.]+/g,'_')+'</td>';
			   str += '<td class="akun">'+nogrupakun+'</td>';
			   str += '<td align=center><a href="./setup/form_perkiraan.php?&modus=modify&id='+id+'" class="thickbox"><img src="./images/edit.gif" alt="Edit" title="Edit" width="18" height="18" border="0"  style="cursor:pointer" /></a> </td>';

				   str += '<td> <img src="./images/delete.gif" alt="Delete" title="Delete" width="18" height="18" border="0" style="cursor:pointer" onclick="actionPic(\'delete\',\''+id+'\',\''+namabaru+'\')"></td>';
			   str += '</tr>';			   
			   $('#dnd-example').append(str);
				tb_init('#node-'+id.replace(/[.]+/g,'_')+' td a.thickbox');	*/   
if (confirm('Tambah data lagi ?')==false)
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
<form action="keuangan/setup/proses_neraca.php'" method="post" name="formData" id="formData" >
<!--<form action="./setup/proses_neraca.php" method="post" name="formData" id="formData" >-->
  <table>
     <tr>
       <td>Kode Grup Akun </td>
       <td><input type="text" id="nogrupakun" name="nogrupakun"  readonly="readonly" value="<?php echo $parentid ?>" /></td>
     </tr>
     <tr>
         <td>Kode Akun </td> 
         <td><input type="hidden" id="modus" name="modus" value="<?php echo $modus ?>"/>
         <input type="hidden" id="hideid" name="hideid" value="<?php echo $id ?>"/>
         <input type="text" id="noakun" name="noakun" value="<?php echo $id ?>"  <?php echo $readonly?>  /> </td>          
     </tr>
     <tr>
         <td>Nama Akun </td> 
         <td><input type="text" id="namaakun" name="namaakun" value="<?php echo $namaakun ?>" /> </td>          
     </tr>
     <tr>
         <td>Icon</td> 
          <td colspan="2">    <label>
      <input name="icon" type="radio" id="icon_folder" value="0" <?php echo $icon_checked_folder; ?>> 
      Folder</label>
&nbsp;&nbsp;
    <label>
      <input type="radio" name="icon" value="1" id="icon_file" <?php echo $icon_checked_file; ?>>
      File</label></td>          
     </tr>
     <tr>
         <td></td> 
         <td> <!--<input type="button" value="Simpan" class="text" onclick="document.formData.submit()"> --> 
         <input type="button" value="Simpan" id="simpan" class="text" >  </td>          
     </tr>
     

  </table>
 </form>
<?php 
}else{
	?><script language="javascript">document.location.href="index.php?<?php echo  'status=forbidden'  ?>"</script><?php 
}
?>