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
	
	
  });
  
  </script>
<?php 
require_once("include/connect.php"); 
//$var=decode($_SERVER['REQUEST_URI']);
if (isset($_SESSION['KDUNIT']))
{
	require_once("ParentChildSum.php");
	
	$obj_parentchild = new ParentChildSum();	
	
	$obj_parentchild->db_host=$_SESSION['host'];
	$obj_parentchild->db_user=$_SESSION['user'];
	$obj_parentchild->db_pass=$_SESSION['psw'];
	$obj_parentchild->db_database=$_SESSION['db']; 	
	
	if(!$obj_parentchild->db_connect()) {
		echo "<h1>Sorry! Could not connect to the database server.</h1>";	
		exit();	
	}


	$obj_parentchild->db_table="mk_realisasi_anggaran";	
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
	$tahunNext=$tahun-1;
	$total=0;
	$total_next=0;
	$root_item_id='-99';
	$all_childs=$obj_parentchild->getAllChilds($root_item_id); 
?>
<form action="?<?php echo'link=35k2'?>" method="post" class="input_tahun">
Tahun <input type="text" name="tahun" id="tahun" value="<?php echo $tahun ?>"/><input type="submit" name="btTahun" id="btTahun"  value="Open"/>
</form>

<table class="example" id="dnd-example">
  <thead>
    <tr>
      <th width="80" rowspan="2">Nama Akun</th>
      <th colspan="2">Tahun </th>    
    </tr>
    <tr>
      <th width="50"><?php echo $tahun; ?></th>
      <th width="49"><?php echo $tahunNext; ?></th>
    </tr>
  </thead>
  <tbody>
<?php
	//$allFields=$objSetupNeraca->getAllFields(); 	
	foreach($all_childs as $item) {
		$nilai=0;
		$nilai_next=0;
		if ($item['slave'] == '1' ) {
			$strSQL="SELECT a.id, b.tahun , b.nilai, c.tahun as thn_next, c.nilai as nilai_next
			FROM mk_realisasi_anggaran a
			LEFT JOIN tk_realisasi_anggaran b ON a.id=b.id AND b.tahun IN('$tahun')  
			LEFT JOIN tk_realisasi_anggaran c ON a.id=c.id AND c.tahun IN('$tahunNext')
			WHERE  a.id='$item[Id]' ";

		   $resQuery = mysql_query($strSQL);
			while ($row = mysql_fetch_array($resQuery, MYSQL_ASSOC)) {
			   $nilai=$row["nilai"];
			   $total=$total+$nilai;
			   $nilai_next=$row["nilai_next"];
			   $total_next=$total_next+$nilai_next;			   
			}		   			
		}
		?>
      <tr id="node-<?php echo str_replace(".","_",$item['Id']) ?>"<?php if(isset($item['parentId'])) echo str_replace(".","_"," class=\"child-of-node-{$item['parentId']}\"")  ?>>
        <td><span class="<?php  if ($item['slave'] == '0' ) echo "folder"; if ($item['slave'] == '1' ) echo "file"
		?>"><?php echo $item['name']?></span><input type="text" value="<?php echo $item['name']?>" id="nama_<?php echo str_replace(".","_",$item['Id']) ?>" style="display:none;" /></td>
        
        <td class="akun"><?php if ($item['slave'] == '1' ) echo number_format($nilai); if ($item['slave'] == '2' ) echo number_format($total) ?></td>
        <td class="akun"><?php if ($item['slave'] == '1' ) echo number_format($nilai_next); if ($item['slave'] == '2' ) echo number_format($total_next) ?></td>

 
      </tr>
    <?php if ($item['Id']=="TOTAL") $total=0; $total_next=0;} ?>
  </tbody>
</table> 


<?php 	
	
	$obj_parentchild->db_disconnect();		

?>
	
<?php 
}else{
	?><script language="javascript">document.location.href="index.php?<?php echo 'status=forbidden'?>"</script><?php 
}
?>