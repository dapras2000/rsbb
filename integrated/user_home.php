<?
 
include "db.php";
error_reporting("E_ALL");
session_start();
if (empty($_SESSION[namauser]) AND
empty($_SESSION[password])) {
header("Location:index.html");
}
if($_GET['idxdaftar']!=''){
$sqlx= mysql_query("select a.NOMR, b.nama from t_pendaftaran a left join m_pasien b on b.NOMR=a.NOMR where a.IDXDAFTAR='".$_GET['idxdaftar']."'");
$rx= mysql_fetch_array($sqlx);
extract($rx);
$nama_pasien= $nama;
$nomr= $NOMR;
}
else{
$nama_pasien= $_POST['nama'];
}
$tgl1= $_POST['tglmulai'];
$tgl2= $_POST['tglselesai'];
if ($nama_pasien==''){
$q= "a.TGLREG >= '$tgl1' and a.TGLREG <= '$tgl2'"; }
else if($nomr!=''){
$q= "b.NOMR='$nomr'";}
else{
$q= "b.NAMA like '%$nama_pasien%' and a.TGLREG >= '$tgl1' and a.TGLREG <= '$tgl2'"; }

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
        <script type="text/javascript" src="include/js/ui.datepicker.js"></script> 
		<script type="text/javascript" src="include/js/ui.datepicker-id.js"></script>
 <script type="text/javascript" src="include/js/ui.core.js"></script>
	
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
	 
    <script type="text/javascript"> 
      $(document).ready(function(){
        $("#tglmulai").datepicker({
					dateFormat      : "yy-mm-dd",  
					changeMonth	  : true,
		  changeYear	  : true ,        
          showOn          : "button",
          buttonImage     : "images/datepicker/images/calendar.gif",
          buttonImageOnly : true				
        });
      });
	   $(document).ready(function(){
        $("#tglselesai").datepicker({
					dateFormat      : "yy-mm-dd",  
					changeMonth	  : true,
		  changeYear	  : true ,        
          showOn          : "button",
          buttonImage     : "images/datepicker/images/calendar.gif",
          buttonImageOnly : true				
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
	#tbl_rs2 {	width:700px;
					
                    border-collapse:collapse; 
                    background-color:white;
                    font: 11px verdana; 
                    
					
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
      background-color:#ebfee7 /* baris ganjil berwarna hijau muda */ 
    }
    .genap { 
      background-color:#FFFFFF; /* baris genap berwarna hijau tua */ 
    }
	.ganjil1 { 
      background-color:#FFFFFF; /* baris ganjil berwarna hijau muda */ 
    }
    .genap1 { 
      background-color:#ebfee7; /* baris genap berwarna hijau tua */ 
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
    <td align="left" width="250" valign="top" style="padding-top:10px"><a href='logout.php'>Logout</a></td>
	<td valign="top" style="padding-top:10px;">
      <table id="tbl_rs2" width="610" align="left" bgcolor="#FFFFFF">
	<form  method="post" name="form2" id="form2" action="<? $_SERVER['PHP_SELF']; ?>">


<tr><td colspan="11" align="left" style="background-color:#999999">Nama Pasien: &nbsp;
<input type="text" id="nama" name="nama" value= "<? echo $nama_pasien; ?>" size="60">
</td></tr>
<tr><td colspan="11" align="left" style="background-color:#999999">Tanggal Mulai: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="tglmulai" id="tglmulai" value= "<? echo $tgl1; ?>">&nbsp;Tanggal Selesai :&nbsp;<input type="text" name="tglselesai" id="tglselesai"  value= "<? echo $tgl2; ?>">&nbsp;<input type="submit" name="submit" value="Search"></td>
</tr></form>
 
 <tr> 
  <td colspan="11" align="center"><strong><font size="-1" color="#000000">Report Status <? echo"$_SESSION[jabatan]"; ?></font></strong></td></tr>
	  <tr class='tr_u'>
    <th><div align="left">No</div></th>
    <th><div align="left">NO RM</div></th>
    <th><div align="left">NAMA</div></th>
    <th><div align="center">Tgl Lahir</div></th>
	<th><div align="center">Jenis Kelamin</div></th>
	<th><div align="center">Cara Bayar</div></th>
	<th><div align="center">Tgl Masuk</div></th>
	<th><div align="center">Tgl Pulang</div></th>
	<th><div align="center">Diagnosis</div></th>
	<th><div align="center">Prosedur</div></th>
	<th><div align="center">Status Input</div></th>
	
  </tr>
  
  <?
$n=1;
$sql= "select a.IDXDAFTAR,a.NOKARTU,b.NO_KARTU,b.NOMR,b.NAMA,b.TGLLAHIR,b.JENISKELAMIN, c.NAMA as payplan, a.TGLREG,a.KDCARABAYAR,d.keluarrs,e.ICD_CODE, e.icd_code2, e.icd_code3, e.icd_code4, e.icd_code5, e.icd_code6, e.icd_code7, e.icd_code8, e.icd_code9, e.icd_code10,e.icd_code11,e.icd_code12,e.icd_code13,e.icd_code14,e.icd_code15,e.icd_code16,e.icd_code17,e.icd_code18,e.icd_code19,e.icd_code20,e.icd_code21,e.icd_code22,e.icd_code23,e.icd_code24,e.icd_code25,e.icd_code26,e.icd_code27,e.icd_code28,e.icd_code29,e.icd_code30,e.icd_9,e.icd_92,e.icd_93,e.icd_94,e.icd_95,e.icd_96,e.icd_97,e.icd_98,e.icd_99,e.icd_910,e.icd_911,e.icd_912,e.icd_913,e.icd_914,e.icd_915,e.icd_916,e.icd_917,e.icd_918,e.icd_919,e.icd_920,e.icd_921,e.icd_922,e.icd_923,e.icd_924,e.icd_925,e.icd_926,e.icd_927,e.icd_928,e.icd_929,e.icd_930,f.KODE_CBG from t_pendaftaran a left JOIN "
	  ."m_pasien b on b.NOMR=a.NOMR LEFT JOIN m_carabayar c on c.KODE=a.KDCARABAYAR left join t_admission d on d.id_admission=a.IDXDAFTAR left join t_diagnosadanterapi e on e.IDXDAFTAR=a.IDXDAFTAR left join res_cbg f on f.IDXDAFTAR=a.IDXDAFTAR where $q order by a.TGLREG"; 
	  
$hasil=mysql_query($sql);
$data=mysql_num_rows($hasil);
#echo $sql;
while($r1=mysql_fetch_array($hasil)){
if ($r1[keluarrs]==''){
$tglkeluar= $r1[TGLREG];}
else{
$tglkeluar= $r1[keluarrs];}
if ($r1[KODE_CBG]==''){
$cbg= '<a href=get_cbg.php?id='.$r1['IDXDAFTAR'].'&nomr='.$r1['NOMR'].'&sep='.$r1['NOKARTU'].'&kartu_bpjs='.$r1['NO_KARTU'].'>Post to CBG</a>';}
else{
$cbg= $r1[KODE_CBG];
}
echo"
  <tr class='tr_p'>
					<td class='td_u' align='left'>$n</td>
					<td class='td_u' align='left'>$r1[NOMR]</td>
					<td class='td_u' align='left'>$r1[NAMA]</td>
					<td class='td_u' align='left'>$r1[TGLLAHIR]</td>
					<td class='td_u' align='left'>$r1[JENISKELAMIN]</td>
					<td class='td_u' align='left'>$r1[payplan]</td>
					<td class='td_u' align='left'>$r1[TGLREG]</td>
					<td class='td_u' align='left'>$tglkeluar</td>
					<td class='td_u' align='left'>$r1[ICD_CODE],$r1[ICD_CODE2],$r1[ICD_CODE3],$r1[ICD_CODE4],$r1[ICD_CODE5]</td>
					<td class='td_u' align='left'>$r1[ICD_9],$r1[ICD_92],$r1[ICD_93],$r1[ICD_94],$r1[ICD_95]</td>
					<td>$cbg</td>
					"; 
					?>
  <? echo"</tr>"; $n++; ?> 
  <? }; ?>
</table></td></tr><tr> 
    <td colspan="2" align="left" valign="top"><? include"footer.php"; ?></td></tr>
</table>

	
</body>


</html>
