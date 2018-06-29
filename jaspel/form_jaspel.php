

<?php
session_start();
require_once("../include/connect.php");
if (isset($_SESSION['KDUNIT']))
{
	
	//$modus  = $var['modus'];	
	$modus  = isset($_GET['modus']) ? htmlspecialchars($_GET['modus'])	: "";	
	//$icon  		=isset($_GET['icon']) ? htmlspecialchars($_GET['icon']) : "";	
	$icon_checked_folder='';
	$icon_checked_file='';
	$namaakun='';
	$id='';
	$parentid='';
	$tarif=0;
	$jassar=0;
	$jaspel=0;
	require_once("m_jaspel2012.php");
	$objSetupLAK = new m_jaspel2012();
	$objSetupLAK->db_host=$hostname;
	$objSetupLAK->db_user=$username;
	$objSetupLAK->db_pass=$password;
	$objSetupLAK->db_database=$database; 	
	if(!$objSetupLAK->db_connect()) {
		echo "<h1>Sorry! Could not connect to the database server.</h1>";	
		exit();	
	}	
	if ($modus=='modify'){
		//$id     = $var['id'];
		$id=isset($_GET['id']) ? htmlspecialchars($_GET['id'])	: "";
		$hideid = isset($_GET['hideid']) ? htmlspecialchars($_GET['hideid'])	: "";	
		$allFields=$objSetupLAK->getAllFieldsById($id); 
		$namaakun=$allFields['nama_tindakan'];
		$parentid=$allFields['kode_gruptindakan'];
		$tarif=$allFields['tarif'];
		$jassar=$allFields['jasa_sarana'];
		$jaspel=$allFields['jasa_pelayanan'];
		$drsp=$allFields['dr_spesialis'];
		$manajemen_sp=$allFields['manajemen_sp'];
		$pendukung_sp=$allFields['pendukung_sp'];
		$asisten_sp=$allFields['asisten_sp'];
		$dr_um=$allFields['dr_umum'];
		$manajemen_um=$allFields['manajemen_um'];
		$pendukung_um=$allFields['pendukung_um'];
		$asisten_um=$allFields['asisten_um'];		
		$bidan=$allFields['bidan'];
		$manajemen_bd=$allFields['manajemen_bd'];
		$pendukung_bd=$allFields['pendukung_bd'];
		$asisten_bd=$allFields['asisten_bd'];	
		$drOperator_ok=$allFields['drOperator'];	
		$drAnestesi_ok=$allFields['drAnestesi'];	
		$dranak_ok=$allFields['drAnak'];	
		$dr_umum_ok=$allFields['dr_umum'];	
		$perawat_ok=$allFields['perawat_ok'];	
		$perawat_perina=$allFields['perawat_perina'];	
		$manajemen_ok=$allFields['manajemen_ok'];	
		$asisten_ok=$allFields['asisten_ok'];	
		$pendukung_ok=$allFields['pendukung_ok'];	
		$readonly='readonly="readnonly"';
		if ($allFields['tarif']==0) {
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
			var drsp = $('#drsp').val();
			var drum = $('#dr_um').val();
		
			if ($('#modus').val()=='modify'){
				$.post('./jaspel/proses_jaspel.php',$('#formData').serialize(),function(data){																												
					id=id.replace(/[.]+/g,'_');		
					//$('tr#node-'+id+' > td > span').empty().append(namabaru);
					$('tr#node-'+id+' > td.drsp ').empty().append(drsp);					
					$('tr#node-'+id+' > td.drum').empty().append(drum);
		      //alert($('tr#node-'+id+' > td > span').text());
			  
					//tb_remove();
					
				});
				$(this).trigger('close.facebox');
			}
			else {
  			 $.post('./jaspel/proses_jaspel.php',$('#formData').serialize(),function(data){
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
#facebox .body {width: 970px !important;}
#tblFormJaspel td { padding:2px 0px 3px}
#tblFormJaspel2 td { padding:2px 0px 3px}
</style>
<div id="divResult" style="font-size:11px;text-align:center;display:none"></div>
<form action="?<?php echo './jaspel/proses_jaspel.php'?>" method="post" name="formData" id="formData" >
  <table width="965" id="tblFormJaspel">
     <tr>
       <td width="144">Kode Grup Akun <td colspan="9"><input type="text" id="nogrupakun" name="nogrupakun"  readonly="readonly" value="<?php echo $parentid ?>" /></td>
     </tr>
     <tr>
         <td>Kode Akun </td> 
         <td colspan="8"><input type="hidden" id="modus" name="modus" value="<?php echo $modus ?>"/>
         <input type="hidden" id="hideid" name="hideid" value="<?php echo $id ?>"/>
         <input type="text" id="noakun" name="noakun" value="<?php echo $id ?>"   readonly="readonly" /> </td>          
     </tr>
     <tr>
         <td>Nama Akun </td> 
         <td colspan="8"><input type="text" id="namaakun" name="namaakun" value="<?php echo $namaakun ?>" readonly="readonly" size="100"/> </td>          
     </tr>

     <tr>
       <td>Tarif</td>
       <td colspan="8"><input type="text" id="tarif" name="tarif" value="<?php echo $tarif ?>"  readonly="readonly"/></td>
     </tr>
     <tr>
       <td>Jasa Sarana</td>
       <td colspan="8"><input type="text" id="jassar" name="jassar" value="<?php echo $jassar ?>"  readonly="readonly"/></td>
     </tr>
     <tr>
       <td>Jasa Pelayanan</td>
       <td colspan="8"><input type="text" id="jaspel" name="jaspel" value="<?php echo $jaspel ?>"  readonly="readonly"/></td>
     </tr>
     </table>
     
     <table id="tblFormJaspel2">
     <tr>
     <td style="width:140px">Tindakan dr Spesialis</td>
     <td style="width:100px">Dokter</td> 
      <td style="width:100px"><input type="text" id="drsp" name="drsp" value="<?php echo $drsp ?>" size="10"/></td>
     <td style="width:50px">Manajemen</td>     
      <td style="width:100px"><input type="text" id="manajemen_sp" name="manajemen_sp" value="<?php echo $manajemen_sp ?>" size="10"/></td>
     <td style="width:50px">Pendukung</td>
     <td style="width:100px"><input type="text" id="pendukung_sp" name="pendukung_sp" value="<?php echo $pendukung_sp ?>" size="10"/></td>
     <td style="width:50px">Asisten</td>
     <td style="width:100px"><input type="text" id="asisten_sp" name="asisten_sp" value="<?php echo $asisten_sp ?>" size="10"/></td>
     </tr>

     <tr>
     <td style="width:100px">Tindakan dr Umum</td>
     <td style="width:50px">Dokter</td> 
      <td style="width:100px"><input type="text" id="dr_um" name="dr_um" value="<?php echo $dr_um ?>" size="10"/></td>
     <td style="width:50px">Manajemen</td>     
      <td style="width:100px"><input type="text" id="manajemen_um" name="manajemen_um" value="<?php echo $manajemen_um ?>" size="10"/></td>
     <td style="width:50px">Pendukung</td>
     <td style="width:100px"><input type="text" id="pendukung_um" name="pendukung_um" value="<?php echo $pendukung_um ?>" size="10"/></td>
     <td style="width:50px">Asisten</td>
     <td style="width:100px"><input type="text" id="asisten_um" name="asisten_um" value="<?php echo $asisten_um ?>" size="10"/></td>
     </tr>
     
     <tr>
     <td style="width:100px">Tindakan Ahli Lain</td>
     <td style="width:50px">Ahli Lain</td> 
      <td style="width:100px"><input type="text" id="bidan" name="bidan" value="<?php echo $bidan ?>" size="10"/></td>
     <td style="width:50px">Manajemen</td>     
      <td style="width:100px"><input type="text" id="manajemen_bd" name="manajemen_bd" value="<?php echo $manajemen_bd ?>" size="10"/></td>
     <td style="width:50px">Pendukung</td>
     <td style="width:100px"><input type="text" id="pendukung_bd" name="pendukung_bd" value="<?php echo $pendukung_bd ?>" size="10"/></td>
     <td style="width:50px">Asisten</td>
     <td style="width:100px"><input type="text" id="asisten_bd" name="asisten_bd" value="<?php echo $asisten_bd ?>" size="10"/></td>
     </tr>
     
 <tr>
     <td rowspan="3" style="width:100px">Tindakan OK  </td>
     <td style="width:50px">dr Operator</td> 
      <td style="width:100px"><input type="text" id="drOperator_ok" name="drOperator_ok" value="<?php echo $drOperator_ok ?>" size="10"/></td>
     <td style="width:50px">dr Anestesi</td>     
      <td style="width:100px"><input type="text" id="drAnestesi_ok" name="drAnestesi_ok" value="<?php echo $drAnestesi_ok ?>" size="10"/></td>
     <td style="width:50px">dr Anak</td>
     <td style="width:100px"><input type="text" id="dranak_ok" name="dranak_ok" value="<?php echo $dranak_ok ?>" size="10"/></td>
     <td style="width:50px">dr Umum</td>
     <td style="width:100px"><input type="text" id="dr_umum_ok" name="dr_umum_ok" value="<?php echo $dr_umum_ok ?>" size="10"/></td>
     </tr>
          
<tr>
     <td style="width:50px">perawat Ok</td> 
      <td style="width:100px"><input type="text" id="perawat_ok" name="perawat_ok" value="<?php echo $perawat_ok ?>" size="10"/></td>
     <td style="width:50px">Manajemen</td>     
      <td style="width:100px"><input type="text" id="manajemen_ok" name="manajemen_ok" value="<?php echo $manajemen_ok ?>" size="10"/></td>
     <td style="width:50px">Pendukung </td>
     <td style="width:100px"><input type="text" id="pendukung_ok" name="pendukung_ok" value="<?php echo $pendukung_ok ?>" size="10"/></td>
     <td style="width:50px">Asisten</td>
     <td style="width:100px"><input type="text" id="asisten_ok" name="asisten_ok" value="<?php echo $asisten_ok ?>" size="10"/></td>
     </tr>
      
<tr>
     <td style="width:50px">perawat Perina </td> 
      <td style="width:100px"><input type="text" id="perawat_perina" name="perawat_perina" value="<?php echo $perawat_perina ?>" size="10"/></td>
     <td style="width:50px">&nbsp;</td>     
      <td style="width:100px">&nbsp;</td>
     <td style="width:50px">&nbsp;</td>
     <td style="width:100px">&nbsp;</td>
     <td style="width:50px"> </td>
     <td style="width:100px"> </td>
     </tr>
         
<tr>
     <td style="width:100px"> </td>
     <td style="width:50px"> </td> 
      <td style="width:100px"><input type="button" value="Simpan" id="simpan" class="text" > </td>
     <td style="width:50px"> </td>     
      <td style="width:100px"> </td>
     <td style="width:50px"> </td>
     <td style="width:100px"> </td>
     <td style="width:50px"> </td>
     <td style="width:100px"> </td>
     </tr>
               
     </table>
      
 </form>
<?php 
}else{
	?><script language="javascript">document.location.href="index.php?<?php echo 'status=forbidden' ?>"</script><?php 
}
?>