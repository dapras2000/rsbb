<? 
include "db.php";
/*include "sirs_user.php";
include "auto_import.php";
include "auto_import_tw2.php";
include "eplan_user.php";
include "edak_user.php";*/

error_reporting("E_ALL");
session_start();
if (empty($_SESSION[namauser]) AND
empty($_SESSION[password])) {
header("Location:login.php");
}
?>
<html>
<link rel="icon" href="images/depkes_icon.png" type="image/x-icon" />
<link rel="shortcut icon" href="images/depkes_icon.png" type="image/x-icon" />
<title>Direktorat Jenderal Bina Upaya Kesehatan</title>
<link rel="stylesheet" type="text/css" href="include/css/superfish.css">
 <link type="text/css" href="include/css/base/ui.all.css" rel="stylesheet" />   
		<script type="text/javascript" src="include/js/jquery-1.4.js"></script>
		<script type="text/javascript" src="include/js/hoverIntent.js"></script>
		<script type="text/javascript" src="include/js/superfish.js"></script>
		<script type="text/javascript" src="include/js/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="include/js/ui.core.js"></script>
	<SCRIPT LANGUAGE="Javascript" SRC="JS/FusionCharts.js"></SCRIPT>
  <script type="text/javascript">
      $(document).ready(function() {
        $(".tr_s:odd").addClass("ganjil");
        $(".tr_s:even").addClass("genap");
		$(".tr_p:odd").addClass("ganjil1");
        $(".tr_p:even").addClass("genap1");
        $("th").parent().addClass("tbheading");
      });  
    </script>
	<script type="text/javascript">
	$(document).ready(function() {
	$('#tbl_reg').hide();
		  $('#tbl_reg2').hide();

	   $('#yes').click(function(){
	     $('#tbl_reg').hide();
		  $('#tbl_reg2').hide();
	   });
	   $('#no').click(function(){
	     $('#tbl_reg').show();
		 $('#tbl_reg2').show();
	   });
	 });
	 </script>
<style>
        #tbl_rs {	width:1024px;
					
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
                    
					border-spacing:0px; 
                    padding:3px
                    }
	#tbl_rs2 {	width:800px;
					
                    border-collapse:collapse; 
                    background-color:white;
                    font: 11px verdana; 
                    border-bottom:#CCCCCC 1px solid;
					
                    border-spacing:0px; 
                    padding:1px
                    }
        #tbl_reg {	
                    width:300px;
					
                    border-collapse:collapse; 
                    background-color:white;
                    font: 11px verdana; 
                    border-bottom:#CCCCCC 1px solid;
					
                    border-spacing:0px; 
                    padding:3px;
					
                    }
#tbl_reg2 {	
                    width:300px;
					
                    border-collapse:collapse; 
                    background-color:white;
                    font: 11px verdana; 
                    border-bottom:#CCCCCC 1px solid;
					
                    border-spacing:0px; 
                    padding:3px;
					
                    }

		#tbl_reg tr td {text-align:left;}			
		.tr_u	{	border-top:#CCCCCC 1px solid;;}
		.tr_d	{	border-bottom:#CCCCCC  2px solid; background: #7168c1;}
		.tr_s	{	border-top:#CCCCCC 1px solid;
					border-right:#CCCCCC 1px solid;}
		.tr_p	{	border-top:#CCCCCC 1px solid;}
		td		{	padding:5px;}
		.td_u{vertical-align:top; font-size:11;}
		
		th		{	
					font-size:11px; 
					BORDER-BOTTOM: #CCCCC 1px solid;
					padding:8px;"}
    </style>
	<style type="text/css">
    .ganjil { 
      background-color:#9ad5f0 /* baris ganjil berwarna hijau muda */ 
    }
    .genap { 
      background-color:#FFFFFF; /* baris genap berwarna hijau tua */ 
    }
	.ganjil1 { 
      background-color:#FFFFFF; /* baris ganjil berwarna hijau muda */ 
    }
    .genap1 { 
      background-color:#9ad5f0; /* baris genap berwarna hijau tua */ 
    }   
    .tbheading { 
      background-color:#60b9e1; /* baris genap berwarna hijau tua */ 
    }   
    </style>
	<style>
a:link {
font-size:11px;
font-style:inherit;
color:#000000;
text-decoration: none;
}
a:hover {
font-size:11px;
color:#000000;
text-decoration: none;
}
a:active {
font-style:inherit;
color: #000000;
text-decoration: none;
}

</style>
</head>

<body bgcolor="#FFFFFF">


 
		
<table id="tbl_rs2" width="610" align="center" bgcolor="#FFFFFF">
  <tr> 
    <td colspan="2" align="left" valign="top" style="padding-top:10px"><img src="images/depkesgo.jpg" border="0"></td></tr>
  <tr> 
    <td align="left" width="250" valign="top" style="padding-top:10px"><? include"menu.htm"; ?></td>
	<td valign="top" style="padding-top:10px;">
      <table id="tbl_rs2" width="610" align="left" bgcolor="#FFFFFF">
  <tr> 
  <td colspan="10" align="center"><strong><font size="-1" color="#000000">LIST SATKER</font></strong></td></tr>
	  <tr class='tr_u'>
    <th rowspan="2"><div align="left">No</div></th>
    <th rowspan="2"><div align="left">Propinsi</div></th>
	<th rowspan="2"><div align="left">Jumlah Satker</div></th>
    <th rowspan="2"><div align="center">Satker Update RS Online</div></th>
	<th colspan="4"><div align="center">Satker Mengisi Emonev (DAK)</div></th>
	<th colspan="4"><div align="center">Satker Mengisi Emonev (TP)</div></th>
	<th rowspan="2"><div align="center">Satker Mengisi E-Planning</div></th>
	<th rowspan="2"><div align="center">Satker Mengisi E-Dak</div></th>
	
  </tr>
  <tr>
  <th><div align="center">TW I</div></th>
  <th><div align="center">TW II</div></th>
<th><div align="center">TW III</div></th>
<th><div align="center">TW IV</div></th>
  <th><div align="center">TW I</div></th>
  <th><div align="center">TW II</div></th>
<th><div align="center">TW III</div></th>
<th><div align="center">TW IV</div></th>
  </tr>
<?
$n=1;
$sql= "select `KODE RS` as kode1, `NAMA RS` as rs, kodeprop, kodeprop_eplan from kode where groupid=3 order by `kodeprop` ASC";
$hasil=mysql_query($sql);

while($r1=mysql_fetch_array($hasil)){
$sql2="SELECT COUNT(`KODE RS`) as satker from kode where kodeprop='$r1[kodeprop]' and LEFT(`KODE RS`,1)<>'P'";
$hasil2=mysql_query($sql2);
$r2=mysql_fetch_array($hasil2);
$sql6="SELECT COUNT(`koders`) as satker from user_sirs where left(kodeprop,2)='$r1[kodeprop]'";
$hasil6=mysql_query($sql6);
$r6=mysql_fetch_array($hasil6);
$sql3="SELECT COUNT(koders) as satker from user_emonev where left(koders,2)='$r1[kodeprop_eplan]' or kodeprop='$r1[kodeprop]'";
$hasil3=mysql_query($sql3);
$r3=mysql_fetch_array($hasil3);
$sql4="SELECT COUNT(kd_satker) as satker from user_eplanning where CHAR_LENGTH(kd_satker)=6 and left(kd_satker,2)='$r1[kodeprop_eplan]'";
$hasil4=mysql_query($sql4);
$r4=mysql_fetch_array($hasil4);
$sql5="SELECT COUNT(kd_satker) as satker from user_edak where left(kd_satker,2)='$r1[kodeprop_eplan]' and jenis_satker='2'";
$hasil5=mysql_query($sql5);
$r5=mysql_fetch_array($hasil5);
$sql8="SELECT COUNT(kd_satker) as satker from user_edak where left(kd_satker,2)='$r1[kodeprop]' and jenis_satker='1'";
$hasil8=mysql_query($sql8);
$r8=mysql_fetch_array($hasil8);
$sql7="SELECT COUNT(kd_satker) as satker from user_eplanning where kodeprop='$r1[kodeprop]'";
$hasil7=mysql_query($sql7);
$r7=mysql_fetch_array($hasil7);
$eplanning=$r4[satker]+$r7[satker];
$edak=$r5[satker]+$r8[satker];
$sql9="SELECT COUNT(koders) as satker from user_emonev_tw2 where left(koders,2)='$r1[kodeprop_eplan]' or kodeprop='$r1[kodeprop]'";
$hasil9=mysql_query($sql9);
$r9=mysql_fetch_array($hasil9);

$sql11="SELECT COUNT(koders) as satker from user_emonev_tw3 where left(koders,2)='$r1[kodeprop_eplan]' or kodeprop='$r1[kodeprop]'";
$hasil11=mysql_query($sql11);
$r11=mysql_fetch_array($hasil11);
echo"
   <tr class='tr_p'>
					<td class='td_u' align='left'>$n</td>
						<td class='td_u' align='left'><a href=report_detail.php?id=$r1[kodeprop] style='text-decoration:underline'>$r1[rs]</a></td>
					<td class='td_u' align='center'>$r2[satker]</td>
					<td class='td_u' align='center'>$r6[satker]</td>
					<td class='td_u' align='center'>$r3[satker]</td>
					<td class='td_u' align='center'>$r9[satker]</td>
					<td class='td_u' align='center'>$r11[satker]</td>
					<td class='td_u' align='center'>&nbsp;</td>
					<td class='td_u' align='center'>&nbsp;</td>
					<td class='td_u' align='center'>&nbsp;</td>
					<td class='td_u' align='center'>&nbsp;</td>
					<td class='td_u' align='center'>&nbsp;</td>
					<td class='td_u' align='center'>$eplanning</td>
					<td class='td_u' align='center'>$edak</td>
					"; 
					?>
  <? echo"</tr>"; $n++; ?> 
  <? }; ?>
</table></td></tr><tr> 
    <td colspan="2" align="left" valign="top"><? include"footer.php"; ?></td></tr>
</table>

	
</body>


</html>
