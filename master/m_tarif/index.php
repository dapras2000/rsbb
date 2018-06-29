<?

	session_start();
if(empty($_SESSION['u_name']))
	header("Location:index.php");	

if(isset($_GET['logout']))
{
	session_destroy();
	header("Location:index.php");
}	
	
	// If you have  the PEAR PHP package, you can comment the next line.
	ini_set('include_path',dirname($_SERVER["SCRIPT_FILENAME"])."/include");
	require_once ('common.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Master TARIF</title>
    <link rel="stylesheet" type="text/css" href="../master.css" />
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<?php $xajax->printJavascript("include/") ?>

</head>
<body>

<div id="masthead"> <div id="bg_variation"> <div id="logo"></div></div></div>
	<ol id="navlinks">   	    
		<li> <a href="../m_icd/index.php">ICD</a></li>
		<li> <a href="../m_login/index.php">USER LOGIN</a></li>
		<li> <a href="../m_Poly/index.php">POLY</a></li>
		<li class="last"> TARIF 
		</li>
		<li> <a href="../m_dokter/index.php">DOKTER</a></li>
		<li> <a href="../m_kamar/index.php">KAMAR DAN KELAS</a></li>
		<li> <a href="../m_profil/index.php">PROFIL</a></li>
		<li> <a href="../m_info/index.php">INFO</a></li>
		<li> <a href="../secure.php?logout">LOGOUT</a></li>
	</ol>
    <br>
	<center>
<?php
include "../../include/connect.php";
?>

<script type="text/javascript" src="<?php echo _BASE_;?>jaspel/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo _BASE_;?>jaspel/js/jquery.min.js"></script>
<SCRIPT LANGUAGE="JavaScript">
jQuery(document).ready(function(){
	  $('#grup1').hide();$('#tindakan').hide();$('#subtindakan').hide();$('#tindbaru').hide();
      $('#poli1').hide();$('#poli12').hide();$('#kelas').hide();
  jQuery("#kolamp").change(function(){
    var kode_lampiran = $('#kolamp').val();
    if (kode_lampiran == '01')  {
      $('#grup1').show(); $('#statusgrup1').val("show");
          jQuery("#gruppilih").change(function(){
            var kogrup = $('#GRUP').val();
            if(kogrup == '01.01'){
              $('#tindakan').hide(); $('#statustindakan').val("hidden");
               $('#tindbaru').hide(); $('#statustindbaru').val("hidden");
			   $('#poli1').hide(); $('#statuspoli1').val("hidden");
			   $('#poli12').show(); $('#statuspoli12').val("show");
            }else{
              $('#tindakan').show(); $('#statustindakan').val("show");
              $('#tindbaru').show();$('#statustindbaru').val("show");
			  $('#poli1').show();$('#statuspoli1').val("show");
			  $('#poli12').hide();$('#statuspoli12').val("hidden");
            }
          });
      $('#subtindakan').hide();$('#statussubtindakan').val("hidden");
      $('#kelas').hide();$('#statuskelas').val("hidden");
    }else if (kode_lampiran == '02') {
      $('#grup1').show();$('#statusgrup1').val("show");
      jQuery("#gruppilih").change(function(){
            var kogrup = $('#GRUP').val();
            if(kogrup != '02.01'){
              $('#tindbaru').show();$('#statustindbaru').val("show");
            }else{
              $('#tindbaru').hide();$('#statustindbaru').val("hidden");
            }
            if(kogrup == '02.04'){
              $('#subtindakan').hide();$('#statussubtindakan').val("hidden");
              $('#tindakan').show();$('#statustindakan').val("show");
            }else{
              $('#subtindakan').hide();$('#statussubtindakan').val("hidden");
              $('#tindakan').hide();$('#statustindakan').val("hidden");
            }
          });
       $('#poli1').hide();$('#statuspoli1').val("hidden");
      $('#poli12').hide();$('#statuspoli12').val("hidden");
	  $('#kelas').hide();$('#statuskelas').val("hidden");
    }else if (kode_lampiran == '03') {
      $('#grup1').show();$('#statusgrup1').val("show");
          jQuery("#gruppilih").change(function(){
            var kogrup = $('#GRUP').val();
            if(kogrup != '02.01'){
              $('#tindbaru').show();$('#statustindbaru').val("show");
            }else{
              $('#tindbaru').hide();$('#statustindbaru').val("hidden");
            }
          });
      $('#tindakan').show();$('#statustindakan').val("show");
	  $('#subtindakan').hide();$('#statussubtindakan').val("hidden");
	  $('#tindbaru').hide();$('#statustindbaru').val("hidden");
      $('#poli1').show();$('#statuspoli1').val("show");
	  $('#poli12').hide();$('#statuspoli12').val("hidden");
	  $('#kelas').show();$('#statuskelas').val("show");
    }else if (kode_lampiran == '04') {
      $('#grup1').show();$('#statusgrup1').val("show");
	  $('#subtindakan').hide();$('#statussubtindakan').val("hidden");
	  $('#tindbaru').show();$('#statustindbaru').val("show");
      $('#poli1').hide();$('#statuspoli1').val("hidden");
	  $('#poli12').hide();$('#statuspoli12').val("hidden");
	  $('#kelas').show();$('#statuskelas').val("show");
      jQuery("#gruppilih").change(function(){
            var kogrup = $('#GRUP').val();
            if(kogrup == '04.01' || kogrup == '04.03' || kogrup == '04.05'){
              $('#tindakan').hide();$('#statustindakan').val("hidden");
            }else{
              $('#tindakan').show();$('#statustindakan').val("show");
            }
      });
    }else if (kode_lampiran == '05') {
      $('#grup1').show();$('#statusgrup1').val("show");
	  $('#poli12').hide();$('#statuspoli12').val("hidden");
      jQuery("#gruppilih").change(function(){
            var kogrup = $('#GRUP').val();
            if(kogrup == '05.01'){
              $('#tindakan').hide();$('#statustindakan').val("hidden");
              $('#subtindakan').hide();$('#statussubtindakan').val("hidden");
              $('#kelas').hide();$('#statuskelas').val("hidden");
              $('#poli1').show();$('#statuspoli1').val("show");
              $('#tindbaru').hide();$('#statustindbaru').val("hidden");
            }else{
              $('#tindakan').hide();$('#statustindakan').val("hidden");
              $('#subtindakan').hide();$('#statussubtindakan').val("hidden");
              $('#kelas').show();$('#statuskelas').val("show");
              $('#poli1').show();$('#statuspoli1').val("show");
              $('#tindbaru').show();$('#statustindbaru').val("show");
            }
      });
    }else if (kode_lampiran == '06') {
      $('#grup1').show();$('#statusgrup1').val("show");
	  $('#tindbaru').show();$('#statustindbaru').val("show");
      $('#poli1').show();$('#statuspoli1').val("show");
	  $('#poli12').hide();$('#statuspoli12').val("hidden");
	  $('#kelas').hide();$('#statuskelas').val("hidden");
      jQuery("#gruppilih").change(function(){
            var kogrup = $('#GRUP').val();
            if(kogrup == '06.02' || kogrup == '06.03' || kogrup == '06.04'){
              $('#tindakan').hide();$('#statustindakan').val("hidden");
              $('#subtindakan').hide();$('#statussubtindakan').val("hidden");
            }else{
              $('#tindakan').show();$('#statustindakan').val("show");
              jQuery("#tindakanpilih").change(function(){
                  var kotindakan = $('#KDTINDAKAN').val();
                  if(kotindakan == '06.01.14'){
                    $('#subtindakan').show();$('#statussubtindakan').val("show");
                  }else{
                    $('#subtindakan').hide();$('#statussubtindakan').val("hidden");
                  }
              });
            }
      });
      jQuery("#tindakanpilih").change(function(){
                var kotind = $('#KDTINDAKAN').val();
                  if(kotind == '06.01' || kotind == '06.02' || kotind == '06.03' || kotind == '06.04'){
                    $('#subtindakan').hide();$('#statussubtindakan').val("hidden");
                  }else{
                    $('#subtindakan').show();$('#statussubtindakan').val("show");
                  }
              });
    }else if (kode_lampiran == '07') {
      $('#grup1').show();$('#statusgrup1').val("show");
	  $('#tindakan').hide();$('#statustindakan').val("hidden");
	  $('#subtindakan').hide();$('#statussubtindakan').val("hidden");
	  $('#tindbaru').show();$('#statustindbaru').val("show");
      $('#poli1').hide();$('#statuspoli1').val("hidden");
	  $('#poli12').hide();$('#statuspoli12').val("hidden");
	  $('#kelas').hide();$('#statuskelas').val("hidden");
    }else if (kode_lampiran == '08') {
      $('#grup1').show();$('#statusgrup1').val("show");
	  $('#tindakan').hide();$('#statustindakan').val("hidden");
	  $('#subtindakan').hide();$('#statussubtindakan').val("hidden");
	  $('#tindbaru').show();$('#statustindbaru').val("show");
      $('#poli1').hide();$('#statuspoli1').val("hidden");
	  $('#poli12').hide();$('#statuspoli12').val("hidden");
          jQuery("#gruppilih").change(function(){
            var kogrup = $('#GRUP').val();
            if(kogrup == '08.01.01' || kogrup == '08.01.02' || kogrup == '08.01.03' ){
              $('#kelas').hide();$('#statuskelas').val("hidden");
            }else{
              $('#kelas').show();$('#statuskelas').val("show");
            }
          });
      
    }else if (kode_lampiran == '09') {
      $('#grup1').show();$('#statusgrup1').val("show");
	  $('#tindakan').hide();$('#statustindakan').val("hidden");
	  $('#subtindakan').hide();$('#statussubtindakan').val("hidden");
	  $('#tindbaru').show();$('#statustindbaru').val("show");
      $('#poli1').hide();$('#statuspoli1').val("hidden");
	  $('#poli12').hide();$('#statuspoli12').val("hidden");
	  $('#kelas').hide();$('#statuskelas').val("hidden");
    }else {
      $('#grup1').show();$('#statusgrup1').val("show");
	  $('#tindakan').show();$('#statustindakan').val("show");
	  $('#subtindakan').show();$('#statussubtindakan').val("show");
	  $('#tindbaru').show();$('#statustindbaru').val("show");
      $('#poli1').show();$('#statuspoli1').val("show");
	  $('#poli12').show();$('#statuspoli12').val("show");
	  $('#kelas').show();$('#statuskelas').val("show");
    }
    var selectValues = jQuery("#kolamp").val();
    var grupHidden = jQuery("#GRUPHIDDEN").val();
    var tindakanHidden = jQuery("#TINDAKANHIDDEN").val();
    jQuery.post('./include/jaspel_tarif_load.php',{kolamp:selectValues, kdgrup:grupHidden, kdtindakan:tindakanHidden, load_grup:'true'},function(data){
      jQuery('#gruppilih').html(data);
      jQuery('#GRUP').val(grupHidden).change();
      jQuery('#tindakanpilih').html("<select name=\"KDTINDAKAN\" class=\"text required\" title=\"*\" id=\"KDTINDAKAN\"><option value=\"\"> --pilih-- </option></select>");
      jQuery('#subtindakanpilih').html("<select name=\"SUBTINDAKAN\" class=\"text required\" title=\"*\" id=\"SUBTINDAKAN\"><option value=\"\"> --pilih-- </option></select>");
      jQuery('#sub2tindakanpilih').html("<select name=\"SUB2TINDAKAN\" class=\"text required\" title=\"*\" id=\"SUB2TINDAKAN\"><option value=\"\"> --pilih-- </option></select>");
    });
  });
  
});
</SCRIPT>
<script>
function showUser(str) {
  $('#poli1').hide();
  $('#poli12').show();
}
</script>

<script type="text/javascript" src="<?php echo _BASE_;?>jaspel/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo _BASE_;?>jaspel/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

    var counter = 2;
    var counterhit = 2;
    
    $("#addButton").click(function () {
        
        if(counter>10){
                  alert("Hanya 10 textbox");
                  return false;
        }   
    
      var newTextBoxDiv = $(document.createElement('div'))
           .attr("id", 'TextBoxDiv' + counter);
                    
      newTextBoxDiv.after().html('<input type="hidden" name="hit" id="hit"  value="'+ counter + '">' +
        '<input type="text" name="tindakanbaru' + counter + 
        '" id="tindakanbaru' + counter + '" value="" >');

      newTextBoxDiv.appendTo("#TextBoxesGroup");

      counter++;
     });

     $("#removeButton").click(function () {
  if(counter==2){
          alert("textbox kosong");
          return false;
       }   
        
  counter--;
      
        $("#TextBoxDiv" + counter).remove();
      
     });
    
     $("#getButtonValue").click(function () {
    
  var msg = '';
  for(i=1; i<counter; i++){
      msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
  }
        alert(msg);
     });
  });
</script>
<script>
function tambahgrup() {
    document.getElementById("gruppilih").innerHTML = "<input type='text' name='GRUPNAMA' value='' placeholder='nama' size='25'>";     
		$('#grup1').show();$('#statusgrup1').val("show");
		$('#tindakan').hide();$('#statustindakan').val("hidden");
		$('#subtindakan').hide();$('#statussubtindakan').val("hidden");
		$('#tindbaru').hide();$('#statustindbaru').val("hidden");
		$('#poli1').hide();$('#statuspoli1').val("hidden");
		$('#poli12').hide();$('#statuspoli12').val("hidden");
		$('#kelas').hide();$('#statuskelas').val("hidden");
}
function tambahtindakan() {
    document.getElementById("tindakanpilih").innerHTML = "<input type='text' name='KDTINDAKANNAMA' value='' placeholder='nama' size='35'>";
		$('#grup1').show();$('#statusgrup1').val("show");
		$('#tindakan').show();$('#statustindakan').val("hidden");
		$('#subtindakan').hide();$('#statussubtindakan').val("hidden");
		$('#tindbaru').hide();$('#statustindbaru').val("hidden");
		$('#poli1').hide();$('#statuspoli1').val("hidden");
		$('#poli12').hide();$('#statuspoli12').val("hidden");
		$('#kelas').hide();$('#statuskelas').val("hidden");
}
function tambahsubtindakan() {
    document.getElementById("subtindakanpilih").innerHTML = "<input type='text' name='SUBTINDAKANNAMA' value='' placeholder='nama' size='35'>";
		$('#grup1').show();$('#statusgrup1').val("show");
		$('#tindakan').show();$('#statustindakan').val("show");
		$('#subtindakan').show();$('#statussubtindakan').val("hidden");
		$('#tindbaru').hide();$('#statustindbaru').val("hidden");
		$('#poli1').hide();$('#statuspoli1').val("hidden");
		$('#poli12').hide();$('#statuspoli12').val("hidden");
		$('#kelas').hide();$('#statuskelas').val("hidden");
}
</script>

<div align="left" style="padding-left:5%;">
    <div id="frame" style="width:95%;" >
		<div id="frame_title">
			<h3>FORM TARIF</h3></div>
        <form name="simpan" id="simpan" action="simpan_tariff.php" onsubmit="return validateForm()" method="post">
        <div style="margin:5px;">
            <div id="val_pro"></div>
                <table class="tb" width="100%">
					<tr>
					<td>Tambah Data Tarif<td><br><br>
					</tr>
					<tr>
                            <td width="12%">Kode Lampiran</td>
                            <td><select name="kolamp" class="text required" title="*" id="kolamp" >
                              <option value=""> --pilih-- </option>
                        <?php
                          $ss = mysql_query("SELECT distinct kode_lampiran, nama_gruptindakan
                                    FROM m_tarif2012
                                    where CHAR_LENGTH( kode_gruptindakan ) = '2'");
                          while($ds = mysql_fetch_array($ss)){
                          if($_GET['kolamp'] == $ds['kode_lampiran']): $sel = "selected=Selected"; else: $sel = ''; endif;
                          echo '<option value="'.$ds['kode_lampiran'].'" '.$sel.' >'.$ds['kode_lampiran'].' | '.$ds['nama_gruptindakan'].'</option>';
                          }
                        ?>
                        </select>
                        <input class="text" value="<?=$_GET['grup']?>" type="hidden" name="GRUPHIDDEN" id="GRUPHIDDEN" >
                        <input class="text" value="<?=$_GET['tindakan']?>" type="hidden" name="TINDAKANHIDDEN" id="TINDAKANHIDDEN" >
                        <input class="text" value="<?=$_GET['subtindakan']?>" type="hidden" name="SUBTINDAKANHIDDEN" id="SUBTINDAKANHIDDEN" ></td>
					</tr>

                    <tr id="grup1">
                            <td>Grup Tindakan</td>
                            <td>
                            <div id="gruppilih"><select name="GRUP" class="text required" title="*" id="GRUP" style = "width:25;">
                              <option value=""> --pilih-- </option>
                        <?php
                          $ss = mysql_query('SELECT distinct kode_tindakan, nama_tindakan
                                    FROM m_tarif2012
                                    where CHAR_LENGTH( kode_tindakan ) = "5" and kode_lampiran = "'.$_GET['kolamp'].'"');
                          while($ds = mysql_fetch_array($ss)){
                          if($_GET['GRUP'] == $ds['kode_tindakan']): $sel = "selected=Selected"; else: $sel = ''; endif;
                          echo '<option value="'.$ds['kode_tindakan'].'" '.$sel.' >'.$ds['kode_tindakan'].' | '.$ds['nama_tindakan'].'</option>';
                          }
                        ?>
                            </select></div>
                            
                          <input type="button" class="text" name="grupbaru" id="grupbaru" value=" Tambah Baru " onclick="tambahgrup()">
                          </td>
                    </tr>
                    <tr id="tindakan">
                            <td>Sub Grup Tindakan</td>
                            <td><div id="tindakanpilih"><select name="KDTINDAKAN" class="text required" title="*" id="KDTINDAKAN">
                              <option value=""> --pilih-- </option>
                        <?php
                          $ss = mysql_query('SELECT distinct kode_tindakan, nama_tindakan
                                    FROM m_tarif2012
                                    where CHAR_LENGTH( kode_tindakan ) = "8" and kode_lampiran = "'.$_GET['GRUP'].'"');
                          while($ds = mysql_fetch_array($ss)){
                          if($_GET['KDTINDAKAN'] == $ds['kode_tindakan']): $sel = "selected=Selected"; else: $sel = ''; endif;
                          echo '<option value="'.$ds['kode_tindakan'].'" '.$sel.' /> '.$ds['nama_tindakan'].'</option>&nbsp;';
                          }
                        ?>
                            </select></div>
                            <input type="button" class="text" value=" Tambah Baru " onclick="tambahtindakan()">
                            </td>
                    </tr>
                    <tr id="subtindakan">
                            <td>Sub Tindakan</td>
                            <td><div id="subtindakanpilih"><select name="SUBTINDAKAN" class="text required" title="*" id="SUBTINDAKAN">
                                    <option value=""> --pilih-- </option>
                                        <?php
                                            $ss = mysql_query('SELECT distinct kode_tindakan, nama_tindakan
                                                      FROM m_tarif2012
                                                      where CHAR_LENGTH( kode_tindakan ) = "11" and kode_gruptindakan = "'.$_GET['KDTINDAKAN'].'"');
                                            while($ds = mysql_fetch_array($ss)){
                                            if($_GET['SUBTINDAKAN'] == $ds['kode_tindakan']): $sel = "selected=Selected"; else: $sel = ''; endif;
                                            echo '<option value="'.$ds['kode_tindakan'].'" '.$sel.' /> '.$ds['nama_tindakan'].'</option>&nbsp;';
                                            }
                                        ?>
                                 </select></div>
                                 <input type="button" class="text" value=" Tambah Baru" onclick="tambahsubtindakan()">
                            </td>
                    </tr>
                    <tr id="poli1">
                            <td>Poli/Unit</td>
                            <td><select name="poli2" class="text required" title="*" id="poli2">
                              <option value=""> --pilih-- </option>
                                      <?php
                                        $ss = mysql_query(' SELECT DISTINCT b.kode_unit as kode, a.nama_unit as nama
                                                                                      FROM m_tarif2012 b
                                                                                      Left join m_unit a on a.kode_unit=b.kode_unit
                                                                                      where a.kode_unit is not null');

                                        while($ds = mysql_fetch_array($ss)){
                                        if($_GET['poli2'] == $ds['kode']): $sel = "selected=Selected"; else: $sel = ''; endif;
                                        echo '<option value="'.$ds['kode'].'" '.$sel.' >'.$ds['kode'].' | '.$ds['nama'].'</option>';
                                        }
                                      ?>
                                </select>
                                <input type="button" class="text" value=" Tambah " onclick="showUser(this.value)">
                                
                            </td>
                    </tr>
                    <tr id="poli12">
                            <td>Poli/Unit</td>
                            <td> <select name="poli" class="text required" title="*" id="poli">
                              <option value=""> --pilih-- </option>
                                      <?php
                                        $ss = mysql_query(' SELECT DISTINCT kode, nama
                                                            FROM m_poly
                                                            WHERE kode
                                                            NOT IN (
                                                                SELECT kode_unit
                                                                FROM m_tarif2012
                                                                WHERE kode_unit IS NOT NULL
                                                                )');

                                        while($ds = mysql_fetch_array($ss)){
                                        if($_GET['poli'] == $ds['kode']): $sel = "selected=Selected"; else: $sel = ''; endif;
                                        echo '<option value="'.$ds['kode'].'" '.$sel.' >'.$ds['kode'].' | '.$ds['nama'].'</option>';
                                        }
                                      ?>
                                </select>
                            </td>
                    </tr>
                    <tr id="tindbaru">
                        <td>Tindakan Baru</td>
                        <td><input type="text" class="validate[required] text-input" name="tindakanbaru1" id="tindakanbaru1" value="">
                            <input type='button' class ="text" value=' Tambah ' id='addButton'>
                            <input type='button' class ="text" value=' Hapus ' id='removeButton'><br>
                            <div id='TextBoxesGroup'>
                              <div id="TextBoxDiv">
                              </div>
                            </div>
                        </td>
                    </tr>
                    <tr id="kelas">
                            <td>Kelas</td>
                            <td><select name="kelas" class="text required" title="*" id="kelas">
                              <option value=""> --pilih-- </option>
                                      <?php
                                        $ss = mysql_query('SELECT DISTINCT kokel, kelas
                                                                FROM m_tarifkelas
                                                                ');
                                        while($ds = mysql_fetch_array($ss)){
                                        if($_GET['kelas'] == $ds['kokel']): $sel = "selected=Selected"; else: $sel = ''; endif;
                                        echo '<option value="'.$ds['kokel'].'" '.$sel.' >'.$ds['kelas'].'</option>';
                                        }
                                      ?>
                                </select>
                            </td>
                    </tr>
                    <tr>
					<td></td>
                      <td align="left"><br><input type="submit" name="simpan" class ="text" value="S I M P A N" title="Simpan Tarif"></td>
                    </tr>
					<input type="hidden" name="statustindakan" id="statustindakan">
					<input type="hidden" name="statussubtindakan" id="statussubtindakan">
					<input type="hidden" name="statustindbaru" id="statustindbaru">
					<input type="hidden" name="statuspoli1" id="statuspoli1">
					<input type="hidden" name="statuspoli12" id="statuspoli12">
					<input type="hidden" name="statuskelas" id="statuskelas">
                </table>
        </div>
        </form>
		
    </div>
</div>
	</center><br>
<?php 
require_once('ps_pagination_x.php');
include "../../include/connect.php";
?>



<script>
function hapus(kode){
    tanya = confirm("Yakin akan menghapus tindakan dengan kode tindakan : "+kode);
    if(tanya == 1){
		window.location.href='<?php echo _BASE_;?>master/m_tarif/index.php?delete_id='+kode;
    }
}
</script>
<?php
$id = $_GET['delete_id'];
if(isset($id)){
	$hapus = "delete from m_tarif2012 where kode_tindakan='".$id."'";
	$hapus_oke = mysql_query($hapus);
	if ($hapus_oke){
		echo "<script>alert('Data Berhasil di Hapus');</script>";
	} else {
		echo "<script>alert('Gagal di Hapus');</script>";
	}
}
?>
<script language="javascript" type="text/javascript">
    function dopilih(){
        document.cari.submit();
    }
</script>
<?php
$search = "";
if(!empty($_GET['searchkey'])) {
    $searchkey = $_GET['searchkey'];
}

if(!empty($_GET['searchfield'])) {
    $searchfield = $_GET['searchfield'];
}

if($searchkey!="") {
    if($searchfield=="kode_unit") {
        $search = " AND kode_unit like '%".$searchkey."%'";
    }
    if($searchfield=="kode_lampiran") {
        $search = " AND kode_lampiran like '%".$searchkey."%'";
    }
    if($searchfield=="kode_tindakan") {
        $search = " AND kode_tindakan like '%".$searchkey."%'";
    }
    if($searchfield=="nama_tindakan") {
        $search = " AND nama_tindakan like '%".$searchkey."%'";
    }
    if($searchfield=="nama_gruptindakan") {
        $search = " AND nama_gruptindakan like '%".$searchkey."%'";
    }
}
?>	

<div align="right" style="padding-right:5%;">
<form name="cari" method="get">
                <table class="tb">
                    <tr>
                        <td>Cari <input type="TEXT" name="searchkey" id="searchkey" size="25" class="text" value="<?=$searchkey?>" style="width:145px;" /></td>
                        <td>Berdasarkan <select name="searchfield" id="searchfield" class="text">
						
                                <option value="kode_lampiran" <? if($searchfield=="kode_lampiran") echo "selected"; ?>>Kode Lampiran</option>
                                <option value="kode_unit" <? if($searchfield=="kode_unit") echo "selected"; ?>>Kode Unit</option>
                                <option value="nama_gruptindakan" <? if($searchfield=="nama_gruptindakan") echo "selected"; ?>>Nama Grup Tindakan</option>
                                <option value="kode_tindakan" <? if($searchfield=="kode_tindakan") echo "selected"; ?>>Kode Tindakan</option>
                                <option value="nama_tindakan" <? if($searchfield=="nama_tindakan") echo "selected"; ?>>Nama Tindakan</option>
								</option>
                            </select></td>
                    </tr>
					<tr>
					<td align="right" colspan="2"><input type="submit" onclick="dopilih()" value="C A R I" class="text" /><td>
					</tr>
                </table>
                <!--<input type="hidden" name="link" value="" />-->
            </form>
</div>
<div align="center">
	<table width="90%" style="margin:10px;" border="0" cellspacing="0" cellspading="0" title="List Tarif">
		<tr>
			<th align="center">Kode Lampiran</th>
			<th align="center" >Kode Unit</th>
			<th>Kode Grup Tindakan</th>
			<th>Nama Grup Tindakan</th>
			<th>Kode Tindakan</th>
			<th>Nama Tindakan</th>
			<th align="center">Aksi</th>
		</tr>
		<?
		$sql="SELECT * FROM m_tarif2012 where kode_lampiran != '-1' and kode_lampiran != '0' ".$search;
		$sql1="SELECT count(*) FROM m_tarif2012 where kode_lampiran != '-1' and kode_lampiran != '0' ".$search;
		$pager = new PS_Pagination($connect, $sql, $sql1, 15, 5, "searchkey=".$searchkey."&searchfield=".$searchfield, "index.php");
					
		//The paginate() function returns a mysql result set 
		$rs = $pager->paginate();
		if(!$rs) die(mysql_error());
		while($data = mysql_fetch_array($rs)) {?>
			<tr 
			<?   
			echo "class =";
			$count++;
			if ($count % 2) {
				echo "tr1"; }
			else {
				echo "tr2";
			}
			?>>
				<td width="5%" align="center"><? echo $data['kode_lampiran'];?></td>
				<td width="5%" align="center"><? echo $data['kode_unit']; ?></td>
				<td><? echo $data['kode_gruptindakan']; ?></td>
				<td><? echo $data['nama_gruptindakan']; ?></td>
				<td><? echo $data['kode_tindakan']; ?></td>
				<td><? echo $data['nama_tindakan']; ?></td>
				<td align="center">
					<a href="javascript:hapus('<?php echo $data['kode_tindakan'];?>');"><input type="button" class="text"  value="   Hapus Tindakan   "></a>
				</td>
			</tr>
		<?	} ?>
				  
	</table>
	<?php
	//Display the full navigation in one go
	//echo $pager->renderFullNav();
	//Or you can display the inidividual links
	echo "<div style='padding:5px;' align=\"center\"><br />";
						
		//Display the link to first page: First
		echo $pager->renderFirst()." | ";
							
		//Display the link to previous page: <<
		echo $pager->renderPrev()." | ";
							
		//Display page links: 1 2 3
		echo $pager->renderNav()." | ";
						
		//Display the link to next page: >>
		echo $pager->renderNext()." | ";
						
		//Display the link to last page: Last
		echo $pager->renderLast();
						
	echo "</div>";
	?>
</div>
	
</body>
</html>
