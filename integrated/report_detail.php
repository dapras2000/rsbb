	<? 
include "db.php";
error_reporting("E_ALL");
session_start();
if (empty($_SESSION[namauser]) AND
empty($_SESSION[password])) {
header("Location:login.php");
}
$kodeprop=$_GET[id];
$find= $_GET[find];
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
    <td align="left" width="250" valign="top" style="padding-top:10px"><? include"menu2.htm"; ?></td>
	<td valign="top" style="padding-top:10px;">
      <table id="tbl_rs2" width="610" align="left" bgcolor="#FFFFFF">
<tr><td colspan="10">
		<form method="get" action="<? $_SERVER['PHP_SELF']; ?>" name="formku" id="formku"><font size=-1>
&nbsp;Search:&nbsp;&nbsp;</font><input type="text"  name="find" id="find" value="<? echo"$find"; ?>" size="50">
<input type="hidden"  name="id" id="id" value="<? echo"$kodeprop"; ?>">
      
		<input type="submit" value="Find" name="submit">
</form><br>
</td></tr>
	  <tr> 
  <td colspan="10" align="center"><strong><font size="-1" color="#000000">LIST SATKER</font></strong></td></tr>
	  <tr class='tr_u'>
    <th rowspan="2"><div align="left">No</div></th>
    <th rowspan="2"><div align="left">Kode Satker</div></th>
    <th rowspan="2"><div align="left">Satker</div></th>
    <th rowspan="2"><div align="center">RS Online</div></th>
<th colspan="4"><div align="center">E-monev(DAK)</div></th>
	<th colspan="4"><div align="center">E-monev(TP)</div></th>
	<th rowspan="2"><div align="center">E-Planning</div></th>
	<th rowspan="2"><div align="center">E-Dak</div></th>
	
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
  if ($_GET[find]==""){
$n=1;
$sql= "select `KODE RS` as kode1, `NAMA RS` as rs from kode where kodeprop='$kodeprop' and left(`KODE RS`,1)<>'P' order by user ASC";
$hasil=mysql_query($sql);
}
else{
$n=1;
$sql= "select `KODE RS` as kode1, `NAMA RS` as rs from kode where kodeprop='$kodeprop' and left(`KODE RS`,1)<>'P' and `NAMA RS` like '%$find%' order by user ASC";
$hasil=mysql_query($sql);}
while($r1=mysql_fetch_array($hasil)){
$sql2="SELECT COUNT(koders) as koders from user_sirs where koders='$r1[kode1]'";
$hasil2=mysql_query($sql2);
$r2=mysql_fetch_array($hasil2);
$sql_c="SELECT wajib_lapor_rsonline from kode where `KODE RS`='$r1[kode1]'";
$hasil_c=mysql_query($sql_c);
$r_c=mysql_fetch_array($hasil_c);
if($r2[koders]==1 && $r_c[wajib_lapor_rsonline]=="T"){
$icon_rs="images/1dot4a.gif";
}
else if($r2[koders]==0 && $r_c[wajib_lapor_rsonline]=="F"){
$icon_rs="images/bullet-cog.png";
}
else if($r2[koders]==0 && $r_c[wajib_lapor_rsonline]=="T"){
$icon_rs="images/1dot1a.gif";}
$sql3="SELECT COUNT(koders) as koders from user_emonev where koders='$r1[kode1]'";
$hasil3=mysql_query($sql3);
$r3=mysql_fetch_array($hasil3);
$sql6="SELECT COUNT(kd_satker) as koders from emonev_wajib_lapor where kd_satker='$r1[kode1]'";
$hasil6=mysql_query($sql6);
$r6=mysql_fetch_array($hasil6);
if($r3[koders]==1){
$icon_emonev="images/1dot4a.gif";
}
else if($r6[koders]< 1){
$icon_emonev="images/bullet-cog.png";
}
else if($r3[koders]<1 || $r6[koders]==1){
$icon_emonev="images/1dot1a.gif";}
$sql4="SELECT COUNT(kd_satker) as koders from user_edak where kd_satker='$r1[kode1]'";
$hasil4=mysql_query($sql4);
$r4=mysql_fetch_array($hasil4);
if($r4[koders]==1){
$icon_edak="images/1dot4a.gif";
}
else{
$icon_edak="images/1dot1a.gif";}
$sql5="SELECT COUNT(kd_satker) as koders from user_eplanning where kd_satker='$r1[kode1]'";
$hasil5=mysql_query($sql5);
$r5=mysql_fetch_array($hasil5);
if($r5[koders]==1){
$icon_eplan="images/1dot4a.gif";
}
else{
$icon_eplan="images/1dot1a.gif";}
$sql13="SELECT COUNT(koders) as koders from user_emonev_tw2 where koders='$r1[kode1]'";
$hasil13=mysql_query($sql13);
$r13=mysql_fetch_array($hasil13);
$sql16="SELECT COUNT(kd_satker) as koders from emonev_wajib_lapor where kd_satker='$r1[kode1]'";
$hasil16=mysql_query($sql16);
$r16=mysql_fetch_array($hasil16);
if($r13[koders]==1){
$icon_emonev2="images/1dot4a.gif";
}
else if($r16[koders]< 1){
$icon_emonev2="images/bullet-cog.png";
}
else if($r13[koders]<1 || $r16[koders]==1){
$icon_emonev2="images/1dot1a.gif";}


$sql14="SELECT COUNT(koders) as koders from user_emonev_tw3 where koders='$r1[kode1]'";
$hasil14=mysql_query($sql14);
$r14=mysql_fetch_array($hasil14);
$sql15="SELECT COUNT(kd_satker) as koders from emonev_wajib_lapor where kd_satker='$r1[kode1]'";
$hasil15=mysql_query($sql15);
$r15=mysql_fetch_array($hasil15);
if($r14[koders]==1){
$icon_emonev3="images/1dot4a.gif";
}
else if($r15[koders]< 1){
$icon_emonev3="images/bullet-cog.png";
}
else if($r14[koders]<1 || $r15[koders]==1){
$icon_emonev3="images/1dot1a.gif";}

$sql16="SELECT COUNT(koders) as koders from user_tp_tw3 where koders='$r1[kode1]'";
$hasil16=mysql_query($sql16);
$r16=mysql_fetch_array($hasil16);
$sql17="SELECT COUNT(kd_satker) as koders from emonev_tp_lapor where kd_satker='$r1[kode1]'";
$hasil17=mysql_query($sql17);
$r17=mysql_fetch_array($hasil17);
if($r16[koders]==1){
$icon_emonev4="images/1dot4a.gif";
}
else if($r17[koders]< 1){
$icon_emonev4="images/bullet-cog.png";
}
else if($r16[koders]<1 || $r17[koders]==1){
$icon_emonev4="images/1dot1a.gif";}

echo"
  <tr class='tr_p'>
					<td class='td_u' align='left'>$n</td>
					<td class='td_u' align='left'>$r1[kode1]</td>
					<td class='td_u' align='left'>$r1[rs]</td>
					<td class='td_u' align='center'><img src=$icon_rs border=0></td>
					<td class='td_u' align='center'><img src=$icon_emonev border=0></td>
					<td class='td_u' align='center'><img src=$icon_emonev2 border=0></td>
					<td class='td_u' align='center'><img src=$icon_emonev3 border=0></td>
					<td class='td_u' align='center'><img src=images/1dot1a.gif border=0></td>
					<td class='td_u' align='center'><img src=$icon_emonev4 border=0></td>
					<td class='td_u' align='center'><img src=$icon_emonev4 border=0></td>
					<td class='td_u' align='center'><img src=$icon_emonev4 border=0></td>
					<td class='td_u' align='center'><img src=$icon_emonev4 border=0></td>
					<td class='td_u' align='center'><img src=$icon_eplan border=0></td>
					<td class='td_u' align='center'><img src=$icon_edak border=0></td>
					"; 
					?>
  <? echo"</tr>"; $n++; ?> 
  <? }; ?>
</table></td></tr><tr> 
    <td colspan="2" align="left" valign="top"><? include"footer.php"; ?></td></tr>
</table>

	
</body>


</html>
