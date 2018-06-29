<?

	session_start();
if(empty($_SESSION['u_name']))
	header("Location:index.php");	

if(isset($_GET['logout']))
{
	session_destroy();
	header("Location:index.php");
}	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us">
<head>
	<title>Master TARIF</title>
    <link rel="stylesheet" type="text/css" href="../master.css" />
     <link href="css/thickbox.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="css/jq.css" type="text/css" media="print, projection, screen" />
	<link rel="stylesheet" href="themes/blue/style.css" type="text/css" media="print, projection, screen" />
      <script language="javascript" src="js/jquery.js"></script>
  <script language="javascript" src="js/thickbox.js"></script>
  <script language="javascript" src="js/jquery.form.js"></script>
  
	<script type="text/javascript" src="js/jquery.tablesorter.js"></script>
	<script type="text/javascript" src="addons/pager/jquery.tablesorter.pager.js"></script>
	<script type="text/javascript">
	$(function() {
		$("table")
			.tablesorter({widthFixed: true, widgets: ['zebra']})
			.tablesorterPager({container: $("#pager")});
	});
	</script>
  <script language="javascript">
	
	function deleteRow(ID){
		alert('hapus id'.ID);
	   $.post(
	      'delete.php',
		  {kode: ID},
		  function(response){
			if(response == 'ok')  
			  alert('Data berhasil dihapus');
			  self.location="index.php";
			else 
			  alert('Delete gagal');
		  }
	   );
	}
	
	function submitForm(){
		$('#divResult').text('loading...').fadeIn();				
		$('#formData').ajaxSubmit({
		  success: function(response){	
			$('#divResult').hide(); 		
			if(response.status == 1){
			  $('#divResult').text(response.text).css({'color':'#FFFFFF','background-color':'#FF0000'}).fadeIn();				
			}else if(response.status == 2){
			  $('#divResult').text('Data berhasil ditambah').css({'color':'#000000','background-color':'#FFFF00'}).fadeIn();	
			  alert("Data berhasil ditambah");
			  tb_remove();
			  self.location="index.php";
			}else if(response.status == 3){
				alert("Data berhasil di edit");
			  self.location="index.php";
			}
		  }, 
		  dataType: 'json' 
		});
		return false;
	}
  </script>
</head>
<body>
<div id="masthead"> <div id="bg_variation">  
<div id="logo"></div></div></div>
	<ol id="navlinks">
		<li> <a href="../m_icd/index.php">ICD</a></li>
		<li> <a href="../m_login/index.php">USER LOGIN</a></li>
		<li ><a href="../m_poly/index.php"> POLY</a></li>
		<li class="last"> TARIF</li>
		<li> <a href="../m_dokter/index.php">DOKTER</a></li>
		<li> <a href="../m_kamar/index.php">KAMAR DAN KELAS</a></li>
		<li> <a href="../secure.php?logout">LOGOUT</a></li>
	</ol>
<div id="main">
<?php
include("../../include/connect.php");
$result = mysql_query("select * from m_tarif where group_jasa like '0101%' order by kode" );

?>
<a class='thickbox'  href="form.php?kode=<?=$row['kode']?>&width=370&height=230">
<div id="tambah">Tambah</div>
</a>
<!--<form class="tickbox" action="form.php?kode=<?=$row['kode']?>&width=370&height=230" method="get">
<button>Tambah</button>
</form>-->
<div id="cari">Cari</div>

<table cellspacing="1" class="tablesorter">
	<thead>
		<tr>
            <th width="19%">No</th>
			<th width="19%">Kode</th>
			<th width="20%">Kode Group</th>
			<th width="33%">Nama</th>
			<th width="18%">Tarif</th>
			<th style="text-align: center"  width="5%">Edit</th>
			<th style="text-align: center"  width="5%">Delete</th>                        
		</tr>
	</thead>
	<tbody id="tableBody">
    
    <?php $no=1;while($row=mysql_fetch_array($result)){ ?>
		<tr>
            <td><?=$no?></td>
			<td><?=$row['kode']?></td>
			<td><?=$row['group_jasa']?></td>
			<td><?=$row['nama_jasa']?></td>
			<td><?=number_format($row['tarif'],0)?></td>
			<td align="center" width="5%">
			  <a class='thickbox'  href="form.php?kode=<?=$row['kode']?>&width=370&height=230">
                <img src="img/edit.png" border="0">
              </a>
            </td>
            <td align="center" width="5%">
			  <a  href="javascript:if (confirm('Yakin akan dihapus?')){deleteRow('<?=$row['kode']?>');} else{alert('tidak jadi');} ">
                 <img src="img/trash.png" border="0">
              </a>
		  </td>            
		</tr>
		<?php $no=$no+1;}?>
  </table>
<div id="pager" class="pager">
	<form>
		<img src="addons/pager/icons/first.png" class="first"/>
		<img src="addons/pager/icons/prev.png" class="prev"/>
		<input type="text" id="halaman" name="halaman" class="pagedisplay"/>
		<img src="addons/pager/icons/next.png" class="next"/>
		<img src="addons/pager/icons/last.png" class="last"/>
		<select class="pagesize">
			<option selected="selected"  value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option  value="40">40</option>
		</select>
	</form>
</div>

</div>
</body>
</html>

