<link href="keuangan/doc/stylesheets/cell.css" rel="stylesheet" type="text/css" />
  <link href="keuangan/css/thickbox.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="keuangan/doc/javascripts/jquery.js"></script>  
<script language="javascript" src="keuangan/javascript/thickbox.js"></script>
<script language="javascript" src="keuangan/javascript/jquery.form.js"></script>
  <script type="text/javascript" src="keuangan/doc/javascripts/jquery.ui.js"></script>


  <!-- BEGIN Plugin Code -->

  <link href="keuangan/src/stylesheets/jquery.treeTable.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="keuangan/src/javascripts/jquery.treeTable.js"></script>
  


  <script type="text/javascript">

  
  $(document).ready(function() {
							 
    $(".example").treeTable({
      //initialState: "expanded"
	  initialState: "collapsed"
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
	$('tr > td > a.save').hide();
	$('.edit').click(function(){
		  var id = $(this).attr('id');
		  $('tr#node-'+id+' > td > span').empty();
		  $('#nama_'+id).css({'display':'inline','width':'200px'});
		  
		  $('tr#node-'+id+' > td > a.edit').hide();
		  $('tr#node-'+id+' > td > a.save').show();
		  
	});
	$('.save').click(function(){
		  var id = $(this).attr('id');
		  var val = $('#nama_'+id).val();
		  $.post('./entri/proses.php',{noakun:id,namaakun:val,modus:'modify'},function(data){
				  $('tr#node-'+id+' > td > span').text(val);
				  $('#nama_'+id).css({'display':'none'});
				  $('tr#node-'+id+' > td > a.edit').show();
				  $('tr#node-'+id+' > td > a.save').hide();											
		  });
		 
	});
	
	$('.add').click(function(){
		var val = $(this).attr('id');
		
	});
	

	
  });
  
  </script>
<?php 
require_once("include/connect.php"); 
//$var=decode($_SERVER['REQUEST_URI']);
if (isset($_SESSION['KDUNIT']))
{
	require_once("ParentChild.php");
	
	$obj_parentchild = new ParentChild();	
	$obj_parentchild->db_host=$hostname;
	$obj_parentchild->db_user=$username;
	$obj_parentchild->db_pass=$password;
	$obj_parentchild->db_database=$database; 
	
	if(!$obj_parentchild->db_connect()) {
		echo "<h1>Sorry! Could not connect to the database server.</h1>";	
		exit();	
	}


	$obj_parentchild->db_table="mk_arus_kas";	
	$obj_parentchild->item_identifier_field_name="Id";
	$obj_parentchild->parent_identifier_field_name="parentId";
	$obj_parentchild->item_list_field_name="name"; 
	$obj_parentchild->extra_condition=""; //if required 
	$obj_parentchild->order_by_phrase=" ORDER BY `Id` ";
	
	$obj_parentchild->level_identifier="";
	$obj_parentchild->item_pointer="";
	
	if (!empty($_POST['tahun']))
	  $tahun=$_POST['tahun'];	
	else
	  $tahun=date('Y');	
	
	
	$root_item_id='-99';
	$all_childs=$obj_parentchild->getAllChilds($root_item_id); 
?>
<form action="?<?php echo'link=31k3' ?>" method="post" class="input_tahun">
Tahun <input type="text" name="tahun" id="tahun" value="<?php echo $tahun ?>"/><input type="submit" name="btTahun" id="btTahun"  value="Open"/>
</form>

<table class="example" id="dnd-example">
  <thead>
    <tr>
      <th>Nama Akun</th>
       <th>Tahun <?php echo $tahun?></th> 
      <th>Aksi</th>      
    </tr>
  </thead>
  <tbody>
<?php
	//$allFields=$objSetupNeraca->getAllFields(); 	
	foreach($all_childs as $item) {
		$nilai=0;
		if ($item['slave'] == '1' ) {
		   $strSQL="select * from tk_arus_kas where tahun='$tahun' and id='$item[Id]'";
		   $resQuery = mysql_query($strSQL);
			while ($row = mysql_fetch_array($resQuery, MYSQL_ASSOC)) {
			   $nilai=$row["nilai"];
			}		   
		}
		?>
      <tr id="node-<?php echo str_replace(".","_",$item['Id']) ?>"<?php if(isset($item['parentId'])) echo str_replace(".","_"," class=\"child-of-node-{$item['parentId']}\"")  ?>>
        <td><span class="<?php  echo ($item['slave'] == '0' ) ? "folder" : "file"
		?>"><?php echo $item['name']?></span><input type="text" value="<?php echo $item['name']?>" id="nama_<?php echo str_replace(".","_",$item['Id']) ?>" style="display:none;" /></td>
        
        <td class="akun"><?php if ($item['slave'] == '1' ) echo number_format($nilai) ?></td>

<td class="{CELLCLASS_M}" valign="middle">
<?php if ($item['slave'] == '1' ){?>
<a class='thickbox'  href="keuangan/entri/form_arus_kas.php?&modus=modify&id=<?php echo $item['Id']?>&hideid=<?php echo $item['Id']?>&tahun=<?php echo $tahun ?>&nilai=<?php echo $nilai?>  ">
        <img src="./images/Edit.gif" alt="Edit" title="Edit" width="18" height="18" border="0" style="cursor:pointer"></a>
<?php } ?>
        </td>        
      </tr>
    <?php } ?>
  </tbody>
</table> 


<?php 	
	
	$obj_parentchild->db_disconnect();		

?>




	
<?php 
}else{
	?><script language="javascript">document.location.href="index.php?<?php echo paramEncrypt('status=forbidden')?>"</script><?php 
}
?>