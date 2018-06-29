<?php include("../../include/connect.php");
 
?>



  <p>
	<?php 
      $sqltab_1="SELECT kode_jasa, nama_jasa FROM m_lab WHERE group_jasa = '010701x' and tab_view = 1 ORDER BY kode_jasa";
      $rowtab_1 = mysql_query($sqltab_1)or die(mysql_error());
      $sqltab_2="SELECT kode_jasa, nama_jasa FROM m_lab WHERE group_jasa = '010701x' and tab_view = 2 ORDER BY kode_jasa";
      $rowtab_2 = mysql_query($sqltab_2)or die(mysql_error());
      $sqltab_3="SELECT kode_jasa, nama_jasa FROM m_lab WHERE group_jasa = '010701x' and tab_view = 3 ORDER BY kode_jasa";
      $rowtab_3 = mysql_query($sqltab_3)or die(mysql_error());
      $sqltab_4="SELECT kode_jasa, nama_jasa FROM m_lab WHERE group_jasa = '010701x' and tab_view = 4 ORDER BY kode_jasa";
      $rowtab_4 = mysql_query($sqltab_4)or die(mysql_error());
    ?>
   
         <div id="validlab" >
    </div>
    <form name="formlab" id="formlab" method="post" action="lab/lab/validorderlab.php">
       <table width="100%"><tr>
   <td valign="top" width="25%"><table>
<?php  //while ( $datatab_1 = mysql_fetch_array($rowtab_1)){  ?>
   		<tr>
        	<td><strong><?php //echo $datatab_1['nama_jasa']?></strong></td>     
 	    </tr>
 <?php       	  
 $kode_jasatab_1 =  "010701";//$datatab_1['kode_jasa'];
 $sql2_tab_1="SELECT kode_jasa, nama_jasa FROM m_lab WHERE group_jasa = '$kode_jasatab_1'  and tab_view = 1 ORDER BY kode_jasa";
 $row2_tab_1 = mysql_query($sql2_tab_1)or die(mysql_error());
 ?>
        
<?php  if(count($row2_tab_1 > 0)){
			 while ( $data2_tab_1 = mysql_fetch_array($row2_tab_1)){ ?> 
            <tr>
             <td valign="top"><input type="checkbox" name="<?php echo $data2_tab_1['kode_jasa']?>" value="1" 
             onchange="newsubmitform (document.getElementById('formlab'),'lab/lab/validorderlab.php','validlab',validatetask); return false;"/>&nbsp;<?php echo $data2_tab_1['nama_jasa']?></td>
            </tr>
<? } }?>
<?php //} ?>     
   </table></td>
   <td valign="top" width="25%">
   <table>
<?php  //while ( $datatab_2 = mysql_fetch_array($rowtab_2)){  ?>
   		<tr>
        	<td><strong><?php //echo $datatab_2['nama_jasa']?></strong></td>     
 	    </tr>
 <?php       	  
 $kode_jasatab_2 =  "010701";//$datatab_2['kode_jasa'];
 $sql2_tab_2="SELECT kode_jasa, nama_jasa FROM m_lab WHERE group_jasa = '$kode_jasatab_2'  and tab_view = 2 ORDER BY kode_jasa";
 $row2_tab_2 = mysql_query($sql2_tab_2)or die(mysql_error());
 ?>
        
<?php  if(count($row2_tab_2 > 0)){
			 while ( $data2_tab_2 = mysql_fetch_array($row2_tab_2)){ ?> 
            <tr>
             <td valign="top"><input type="checkbox" name="<?php echo $data2_tab_2['kode_jasa']?>"  value="1" 
             onchange="newsubmitform (document.getElementById('formlab'),'lab/lab/validorderlab.php','validlab',validatetask); return false;"/>&nbsp;<?php echo $data2_tab_2['nama_jasa']?></td>
            </tr>
<? } }?>
<?php //} ?>     
   </table>
   </td>
   <td valign="top" width="25%">
   	   <table>
<?php  //while ( $datatab_3 = mysql_fetch_array($rowtab_3)){  ?>
   		<tr>
        	<td><strong><?php //echo $datatab_3['nama_jasa']?></strong></td>     
 	    </tr>
 <?php       	  
 $kode_jasatab_3 =  "010701";//$datatab_3['kode_jasa'];
 $sql2_tab_3="SELECT kode_jasa, nama_jasa FROM m_lab WHERE group_jasa = '$kode_jasatab_3'  and tab_view = 3 ORDER BY kode_jasa";
 $row2_tab_3 = mysql_query($sql2_tab_3)or die(mysql_error());
 ?>
        
<?php  if(count($row2_tab_3 > 0)){
			 while ( $data2_tab_3 = mysql_fetch_array($row2_tab_3)){ ?> 
            <tr>
             <td valign="top"><input type="checkbox" name="<?php echo $data2_tab_3['kode_jasa']?>" value="1" 
             onchange="newsubmitform (document.getElementById('formlab'),'lab/lab/validorderlab.php','validlab',validatetask); return false;"/>&nbsp;<?php echo $data2_tab_3['nama_jasa']?></td>
            </tr>
<? } }?>
<?php //} ?>     
   </table>
   </td>
   <td valign="top" width="25%">
   	   <table>
<?php  //while ( $datatab_4 = mysql_fetch_array($rowtab_4)){  ?>
   		<tr>
        	<td><strong><?php //echo $datatab_4['nama_jasa']?></strong></td>     
 	    </tr>
 <?php       	  
 $kode_jasatab_4 =  "010701";//$datatab_4['kode_jasa'];
 $sql2_tab_4="SELECT kode_jasa, nama_jasa FROM m_lab WHERE group_jasa = '$kode_jasatab_4'  and tab_view = 4 ORDER BY kode_jasa";
 $row2_tab_4 = mysql_query($sql2_tab_4)or die(mysql_error());
 ?>
        
<?php  if(count($row2_tab_4 > 0)){
			 while ( $data2_tab_4 = mysql_fetch_array($row2_tab_4)){ ?> 
            <tr>
             <td valign="top"><input type="checkbox" name="<?php echo $data2_tab_4['kode_jasa']?>" value="1" 
             onchange="newsubmitform (document.getElementById('formlab'),'lab/lab/validorderlab.php','validlab',validatetask); return false;"/>&nbsp;<?php echo $data2_tab_4['nama_jasa']?></td>
            </tr>
<? } }?>
<?php //} ?>     
   </table>
   </td>
   </tr>
   </table>
       <br />
       <table>
       </table>
      <input name="idxdaftar" id="idxdaftar" type="hidden" value=<?php echo $_GET['idx']; ?> >

    </form>
    
    </p>