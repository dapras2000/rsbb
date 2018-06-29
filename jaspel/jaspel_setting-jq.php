<link href="jaspel/doc/stylesheets/cell.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="jaspel/doc/javascripts/jquery.js"></script> 
<script language="javascript" src="jaspel/javascript/jquery.form.js"></script>
 <script type='text/javascript' src='include/jquery.autocomplete.pack.js'></script>
<link href="jaspel/css/facebox.css" rel="stylesheet" type="text/css" />  
<script type="text/javascript" src="jaspel/js/facebox.js"></script> 
  

<SCRIPT language=JavaScript type=text/javascript>  
  function actionPic(modus,id,name) { 
  if (modus=='delete'){
		$(document).ready(function(){
			if ( confirm ('Yakin hapus '+name+' ?')==true){		   
				$.post('./setup/delete_jaspel.php',{id: id},function(response){											
							var x=response.trim(' ');								
							if(x == 'ok'){
								$('tr#node-'+id).hide();
								//alert('Delete sukses');
							}
							//else  alert('Delete gagal');
				dataType: 'json' });
		   }
		   else {
			   alert("batal");
		   }
		});
		
	 }
  } 
 

</SCRIPT>



  <script type="text/javascript" src="jaspel/doc/javascripts/jquery.ui.js"></script>


  <!-- BEGIN Plugin Code -->

  <link href="jaspel/src/stylesheets/jquery.treeTable.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="jaspel/src/javascripts/jquery.treeTable.js"></script>
  <script type="text/javascript">

  
  $(document).ready(function() {

							 
    $(".example").treeTable({
      //initialState: "expanded"
	  initialState: "collapsed"
      //expandable: false
    });
    
    // Drag & Drop Example Code
    $("#dnd-example .file, #dnd-example .folder").draggable({
      helper: "clone",
      opacity: .75,
      refreshPositions: true,
      revert: "invalid",
      revertDuration: 300,
      scroll: true
    });
    
    $("#dnd-example .folder").each(function() {
      $($(this).parents("tr")[0]).droppable({
        accept: ".file, .folder",
        drop: function(e, ui) { 
          $($(ui.draggable).parents("tr")[0]).appendBranchTo(this);
          
          // Issue a POST call to send the new location (this) of the 
          // node (ui.draggable) to the server.
          $.post("move.php", {id: $(ui.draggable).parents("tr")[0].id, to: this.id});
        },
        hoverClass: "accept",
        over: function(e, ui) {
          if(this.id != $(ui.draggable.parents("tr.parent")[0]).id && !$(this).is(".expanded")) {
            $(this).expand();
          }
        }
      });
    });
    
    // Make visible that a row is clicked
    $("table#dnd-example tbody tr").mousedown(function() {
      $("tr.selected").removeClass("selected"); // Deselect currently selected rows
      $(this).addClass("selected");
    });
    
    // Make sure row is selected when span is clicked
    $("table#dnd-example tbody tr span").mousedown(function() {
      $($(this).parents("tr")[0]).trigger("mousedown");
    });
	
	$('.modal').click(function(){
							   var links = $(this).attr('link');
							   $.facebox(function(){
								$.get(links,function(data){
													 $.facebox(data);
													 });
					  });
   		});
	
  });
  
  </script>
  
<?php 
//require_once("./encryption/function.php");
require_once("include/connect.php");
if (isset($_SESSION['KDUNIT']))
{
	require_once("m_jaspel2012.php");
	$objSetupTarif = new m_jaspel2012();
	$objSetupTarif->db_host=$hostname;
	$objSetupTarif->db_user=$username;
	$objSetupTarif->db_pass=$password;
	$objSetupTarif->db_database=$database; 	
	if(!$objSetupTarif->db_connect()) {
		echo "<h1>Sorry! Could not connect to the database server.</h1>";	
		exit();	
	}	
?>

<table class="example" id="dnd-example">
  <thead>
    <tr>
      <th>Nama Akun</th>
       <th>Tarif</th>
       <th>Jasa Layanan</th>
       <th>Jasa Sarana</th>      
      <th>dr Spesialis</th>
      <th>dr Umum</th>
      <th>Aksi</th>      
    </tr>
  </thead>
  <tbody>
<?php
	$allFields=$objSetupTarif->getAllFields(); 
	foreach($allFields as $item) {
		?>
      <tr id="node-<?php echo str_replace(".","_",$item['kode_tindakan']) ?>"<?php if(isset($item['kode_gruptindakan'])) echo str_replace(".","_"," class=\"child-of-node-{$item['kode_gruptindakan']}\"")  ?>>
        <td><span class="<?php  echo ($item['tarif'] == '0' ) ? "folder" : "file"
		?>"><?php echo $item['nama_tindakan']?></span></td>
        <td><?php echo $item['tarif'] ?></td>
        <td><?php echo $item['jasa_pelayanan'] ?></td>
        <td><?php echo $item['jasa_sarana'] ?></td>
        <td class="drsp"><?php echo $item['dr_spesialis'] ?></td>
        <td class="drum"><?php echo $item['dr_umum'] ?></td>
<td class="{CELLCLASS_M}" valign="middle">

<!--<a class='thickbox1'  href="./setup/form_jaspel.php?&modus=modify&id=<?php //echo $item['kode_tindakan']?>&hideid=<?php// echo $item['kode_tindakan']?>  ">-->
<a class='modal' link="<?php echo "./jaspel/form_jaspel.php?id=".$item['kode_tindakan']."&hideid=".$item['kode_tindakan']."&modus=modify"?>">
        <img src="./images/Edit.gif" alt="Edit" title="Edit" width="18" height="18" border="0" style="cursor:pointer"></a>

</td>        
      </tr>
    <?php } ?>
  </tbody>
</table> 

	
<?php 
}else{
	?><script language="javascript">document.location.href="index.php?<?php echo 'status=forbidden'?>"</script><?php 
}
?>