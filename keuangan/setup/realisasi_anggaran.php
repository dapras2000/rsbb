<link href="keuangan/doc/stylesheets/cell.css" rel="stylesheet" type="text/css" />

  <link href="keuangan/css/thickbox.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="keuangan/doc/javascripts/jquery.js"></script>  
<script language="javascript" src="keuangan/javascript/thickbox.js"></script>
<script language="javascript" src="keuangan/javascript/jquery.form.js"></script>

<?php 
ini_set('display_errors',FALSE);
?>

   

<SCRIPT language=JavaScript type=text/javascript>  
  function actionPic(modus,id,name) { 
  if (modus=='delete'){
		$(document).ready(function(){
			if ( confirm ('Yakin hapus '+name+' ?')==true){		   
				$.post('keuangan/setup/delete_rla.php',{id: id},function(response){											
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



  <script type="text/javascript" src="keuangan/doc/javascripts/jquery.ui.js"></script>


  <!-- BEGIN Plugin Code -->

  <link href="keuangan/src/stylesheets/jquery.treeTable.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="keuangan/src/javascripts/jquery.treeTable.js"></script>
  <script type="text/javascript">

  
  $(document).ready(function() {
							 
    $(".example").treeTable({
      initialState: "expanded"
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
  });
  
  </script>
<?php 
require_once("include/connect.php"); 
if (isset($_SESSION['KDUNIT']))
{
	require_once("rla.php");
	$objSetupRLA = new rla();

	
	$objSetupRLA->db_host=$hostname;
	$objSetupRLA->db_user=$username;
	$objSetupRLA->db_pass=$password;
	$objSetupRLA->db_database=$database; 
	
	if(!$objSetupRLA->db_connect()) {
		echo "<h1>Sorry! Could not connect to the database server.</h1>";	
		exit();	
	}	
?>
<!--<a class='thickbox' href="./setup/form_perkiraan.php?&modus=insert">Tambah</a> -->

<table class="example" id="dnd-example">
  <thead>
    <tr>
      <th>Nama Akun</th>
      <th>Id</th>
      <th>Parent Id</th>
      <th>Aksi</th>      
    </tr>
  </thead>
  <tbody>
<?php
	$allFields=$objSetupRLA->getAllFields(); 
	foreach($allFields as $item) {
		?>
      <tr id="node-<?php echo str_replace(".","_",$item['Id']) ?>"<?php if(isset($item['parentId'])) echo str_replace(".","_"," class=\"child-of-node-{$item['parentId']}\"")  ?>>
        <td><span class="<?php  echo ($item['slave'] == '0' ) ? "folder" : "file"
		?>"><?php echo $item['name']?></span></td>
        <td><?php echo $item['Id'] ?></td>

        <td class="akun"><?php echo $item['parentId'] ?></td>
<td class="{CELLCLASS_M}" valign="middle">
<!--        <a class='thickbox' href="home.php?<?php //echo paramEncrypt('page=./setup/form_perkiraan&modus=modify&id='.$item['Id'])?>"><img src="./images/edit.gif" alt="Edit" title="Edit" width="18" height="18" border="0"  style="cursor:pointer" /></a> 
-->
<?php if($item['slave'] == 0): echo '<a class="add thickbox" href="keuangan/setup/form_rla.php?&modus=insert&nogrupakun='.$item['Id'].'" id="'.str_replace(".","_",$item['Id']).'"><img src="./images/add.gif" alt="Add" title="Add" width="18" height="18" border="0"  style="cursor:pointer" /></a> '; endif;?>
<a class='thickbox' href="keuangan/setup/form_rla.php?&modus=modify&id=<?php echo $item['Id']?>"><img src="./images/edit.gif" alt="Edit" title="Edit" width="18" height="18" border="0"  style="cursor:pointer" /></a> 
        <img src="./images/delete.gif" alt="Delete" title="Delete" width="18" height="18" border="0" onClick="actionPic('delete',<?php echo "'".$item['Id']."'" ?>,<?php echo "'".$item['name']."'" ?>);" style="cursor:pointer">  </td>        
      </tr>
    <?php } ?>
  </tbody>
</table> 

	
<?php 
}else{
	?><script language="javascript">document.location.href="index.php?<?php echo  'status=forbidden' ?>"</script><?php 
}
?>