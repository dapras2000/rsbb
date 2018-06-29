<link rel="stylesheet" type="text/css" href="style.css" />
<?php 
include("include/connect.php");
include('ps_pagination.php');

?>
<div align="center">
  <div id="frame">
  <div id="frame_title">
  <h3 align="left">PEMERIKSAAN </h3>
</div>

	<div id="all">
<form name="formugd" method="post" action="ugd/saveugd.php" >
    
    <fieldset class="fieldset">
      <legend>Form Pemeriksaan</legend>
      
<?php include("ugd/pasien.php")?>

    </fieldset>
	<div id="list_data"></div>
    <fieldset class="fieldset">
      <legend>Detail Pemeriksaan</legend>
        <div id="wrapper">
            <div id="content">
                <div class="tab"><h3 class="tabtxt" title="second"><a href="#">GLASSGOW COMA SCALE</a></h3></div>
                <div class="tab"><h3 class="tabtxt" title="third"><a href="#">ANAMNESA</a></h3></div>
                <div class="tab"><h3 class="tabtxt" title="fourth"><a href="#">PEMERIKSAAN JASMANI</a></h3></div>
                <div class="tab"><h3 class="tabtxt" title="five"><a href="#">STATUS LOKAL/ BEDAH</a></h3></div>
                <div class="tab"><h3 class="tabtxt" title="six"><a href="#">RONTGEN</a></h3></div>
                <div class="tab"><h3 class="tabtxt" title="seven"><a href="#">OBSERVASI</a></h3></div>
            
        
	<div class="boxholder">
   
<div class="box">
<?php include("ugd/glasgow.php")?>
   </div>	
   
   
<div class="box">
 <?php include("ugd/anamnesa.php")?>
</div>


<div class="box">
  <?php include("ugd/jasmani.php")?>
</div>
    
    
<div class="box">
  <?php include("ugd/bedah.php")?>
</div>
    
    
<div class="box">
  <?php include("ugd/rontgen.php")?>
</div>
    
    
<div class="box">
  <?php include("ugd/observasi.php")?>
</div>
   
    
</div>
</fieldset>
</form>
</div>
</div></div>
<script>
<!--
/*By George Chiang (JK's JavaScript tutorial)
http://javascriptkit.com
Credit must stay intact for use*/
function show(){
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var curTime = 
    ((hours < 10) ? "0" : "") + hours + ":" 
    + ((minutes < 10) ? "0" : "") + minutes + ":" 
    + ((seconds < 10) ? "0" : "") + seconds 
var dn="AM"

if (hours>12){
dn="PM"
hours=hours-12
}
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
document.pasien_masuk.Masuk.value=curTime
document.pasien_keluar.Keluar.value=curTime
setTimeout("show()",1000)
}
show()
//-->
<!-- hide from old browsers
  var curDateTime = new Date()
  var curHour = curDateTime.getHours()
  var curMin = curDateTime.getMinutes()
  var curSec = curDateTime.getSeconds()
  var curTime = 
    ((curHour < 10) ? "0" : "") + curHour + ":" 
    + ((curMin < 10) ? "0" : "") + curMin + ":" 
    + ((curSec < 10) ? "0" : "") + curSec 
//-->
</script>  

  <script type="text/javascript">
	Element.cleanWhitespace('content');
	init();
</script>
