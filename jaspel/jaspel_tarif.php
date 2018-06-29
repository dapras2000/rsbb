<?php
include '../include/connect.php';
?>
<script type="text/javascript" src="<?php echo _BASE_;?>jaspel/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php echo _BASE_;?>jaspel/js/jquery.min.js"></script>
<SCRIPT LANGUAGE="JavaScript">
jQuery(document).ready(function(){
   $('#grup1').hide();
      $('#tindakan').hide();
      $('#subtindakan').hide();
      $('#tindbaru').hide();
      $('#poli1').hide();
      $('#profesi').hide();
      $('#dokter').hide();
      $('#kelas').hide();
  jQuery("#gruppilih").change(function(){
    var kogrup = $('#GRUP').val();
    if(kogrup == '01.01'){
        $('#tindbaru').hide();
      }else {
        $('#tindbaru').show();
      }
  });
  
  jQuery("#kolamp").change(function(){
    var kode_lampiran = $('#kolamp').val();
    if (kode_lampiran == '01')  {
      $('#grup1').show();
      $('#tindakan').hide();
      $('#subtindakan').hide();
      $('#tindbaru').hide();
      $('#poli1').show();
      $('#profesi').hide();
      $('#dokter').hide();
      $('#kelas').hide();
    }else if (kode_lampiran == '02') {
      $('#grup1').show();
      $('#tindakan').hide();
      $('#subtindakan').hide();
      $('#tindbaru').hide();
      $('#poli1').show();
      $('#profesi').show();
      $('#dokter').hide();
      $('#kelas').hide();
    }else if (kode_lampiran == '03') {
      $('#grup1').show();
      $('#tindakan').show();
      $('#subtindakan').hide();
      $('#tindbaru').hide();
      $('#poli1').show();
      $('#profesi').show();
      $('#dokter').show();
      $('#kelas').show();
    }else if (kode_lampiran == '04') {
      $('#grup1').show();
      $('#tindakan').show();
      $('#subtindakan').hide();
      $('#tindbaru').hide();
      $('#poli1').show();
      $('#profesi').hide();
      $('#dokter').hide();
      $('#kelas').show();
    }else if (kode_lampiran == '05') {
      $('#grup1').show();
      $('#tindakan').show();
      $('#subtindakan').hide();
      $('#tindbaru').hide();
      $('#poli1').show();
      $('#profesi').show();
      $('#dokter').show();
      $('#kelas').hide();
    }else if (kode_lampiran == '06') {
      $('#grup1').show();
      $('#tindakan').show();
      $('#subtindakan').show();
      $('#tindbaru').hide();
      $('#poli1').show();
      $('#profesi').hide();
      $('#dokter').hide();
      $('#kelas').hide();
    }else if (kode_lampiran == '07') {
      $('#grup1').show();
      $('#tindakan').show();
      $('#subtindakan').hide();
      $('#tindbaru').hide();
      $('#poli1').hide();
      $('#profesi').hide();
      $('#dokter').hide();
      $('#kelas').hide();
    }else if (kode_lampiran == '08') {
      $('#grup1').show();
      $('#tindakan').show();
      $('#subtindakan').show();
      $('#tindbaru').hide();
      $('#poli1').hide();
      $('#profesi').hide();
      $('#dokter').hide();
      $('#kelas').hide();
    }else {
      $('#grup1').show();
      $('#tindakan').show();
      $('#subtindakan').show();
      $('#tindbaru').hide();
      $('#poli1').hide();
      $('#profesi').hide();
      $('#dokter').hide();
      $('#kelas').hide();
    }
    var selectValues = jQuery("#kolamp").val();
    var grupHidden = jQuery("#GRUPHIDDEN").val();
    var tindakanHidden = jQuery("#TINDAKANHIDDEN").val();
    jQuery.post('<?php echo _BASE_;?>include/jaspel_tarif_load.php',{kolamp:selectValues, kdgrup:grupHidden, kdtindakan:tindakanHidden, load_grup:'true'},function(data){
      jQuery('#gruppilih').html(data);
      jQuery('#GRUP').val(grupHidden).change();
      jQuery('#tindakanpilih').html("<select name=\"KDTINDAKAN\" class=\"text required\" title=\"*\" id=\"KDTINDAKAN\"><option value=\"0\"> --pilih-- </option></select>");
      jQuery('#subtindakanpilih').html("<select name=\"SUBTINDAKAN\" class=\"text required\" title=\"*\" id=\"SUBTINDAKAN\"><option value=\"0\"> --pilih-- </option></select>");
      jQuery('#sub2tindakanpilih').html("<select name=\"SUB2TINDAKAN\" class=\"text required\" title=\"*\" id=\"SUB2TINDAKAN\"><option value=\"0\"> --pilih-- </option></select>");
    });
  });
  
});
</SCRIPT>
<script>
function showUser(str) {
  //alert ('xxx');
  $('#poli').hide();
  if (str=="") {
    document.getElementById("add").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("add").innerHTML=xmlhttp.responseText;
    
    }
  }
  xmlhttp.open("GET","<?php echo _BASE_; ?>jaspel/Jaspel_poli.php?q="+str,true);
  
  xmlhttp.send();
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
                    
      /*newTextBoxDiv.after().html('<input type="text" name="tindakanbaru' + counter + 
            '" id="tindakanbaru' + counter + '" value="" >' + '
            <input type="text" name="hit" id="hit" value="' + counterhit + 
            '" >');*/
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
     var kogrupnama = $('#GRUPNAMA').val();
    if(kogrupnama != ''){
        $('#poli1').hide();
        $('#tindbaru').hide();
      }
        
        
}
function tambahtindakan() {
    document.getElementById("tindakanpilih").innerHTML = "<input type='text' name='KDTINDAKANNAMA' value='' placeholder='nama' size='35'>";
}

</script>

<div align="center">
    <div id="frame" style="width:50%">
        <div id="frame_title">
            <h3>FORM INPUT TARIF</h3>
        </div>
        <form name="simpan" id="simpan" action="jaspel/simpan_tariff.php" method="post">
        <div style="margin:5px;">
            <div id="val_pro"></div>
                <table width="90%" style="padding:10px;" title="Form Input Jaspel" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                            <td>Kode Lampiran</td>
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
                            <td>Tindakan</td>
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
                            <input type="button" class="text" value=" Tambah " onclick="tambahtindakan()">
                            <input type="button" class="text" value=" Hapus " onclick="kurangtindakan()">
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
                            </td>
                    </tr>
                    <tr id="poli1">
                            <td>Poli</td>
                            <td><select name="poli" class="text required" title="*" id="poli">
                              <option value=""> --pilih-- </option>
                                      <?php
                                        $ss = mysql_query(' SELECT DISTINCT b.kode_unit as kode, a.nama_unit as nama
                                                                                      FROM m_tarif2012 b
                                                                                      Left join m_unit a on a.kode_unit=b.kode_unit
                                                                                      where a.kode_unit is not null');

                                        while($ds = mysql_fetch_array($ss)){
                                        if($_GET['poli'] == $ds['kode']): $sel = "selected=Selected"; else: $sel = ''; endif;
                                        echo '<option value="'.$ds['kode'].'" '.$sel.' >'.$ds['kode'].' | '.$ds['nama'].'</option>';
                                        }
                                      ?>
                                </select>
                                <div id="add"></div>
                                <input type="button" class="text" value=" Tambah " onclick="showUser(this.value)">
                                
                            </td>
                    </tr>
                    <tr id="tindbaru">
                        <td>Tindakan </td>
                        <td><input type="text" class ="text" name="tindakanbaru1" id="tindakanbaru1" value="">
                            <input type='button' class ="text" value=' Tambah ' id='addButton'>
                            <input type='button' class ="text" value=' Hapus ' id='removeButton'><br>
                            <div id='TextBoxesGroup'>
                              <div id="TextBoxDiv">
                              </div>
                            </div>
                        </td>
                    </tr>
                    <tr id="profesi">
                            <td>Profesi</td>
                            <td><select name="profesi" class="text required" title="*" id="profesi">
                                  <option value=""> --pilih-- </option>
                                  <option value="1"> Pemeriksaan dan Konsultasi dokter spesialis </option>
                                  <option value="0"> Pemeriksaan dan Konsultasi dokter umum </option>
                                  <option value="3"> Pemeriksaan dan Konsultasi dokter tenaga ahli lain </option>
                                </select>
                            </td>
                    </tr>
                    <tr id="dokter">
                            <td>Dokter</td>
                            <td><select name="dokter" class="text required" title="*" id="dokter">
                                  <option value=""> --pilih-- </option>
                                  <option value="01"> dokter umum </option>
                                  <option value="02"> dokter spesialis </option>
                                </select>
                            </td>
                    </tr>
                    <tr id="kelas">
                            <td>Kelas</td>
                            <td><select name="kelas" class="text required" title="*" id="kelas">
                              <option value=""> --pilih-- </option>
                                      <?php
                                        $ss = mysql_query('SELECT DISTINCT substr(kode_tindakan,-2) as kokel, kelas
                                                                FROM m_tarif2012
                                                                WHERE kelas IS NOT NULL
                                                                ');
                                        while($ds = mysql_fetch_array($ss)){
                                        if($_GET['kelas'] == $ds['kokel']): $sel = "selected=Selected"; else: $sel = ''; endif;
                                        echo '<option value="'.$ds['kokel'].'" '.$sel.' >'.$ds['kokel'].' | '.$ds['kelas'].'</option>';
                                        }
                                      ?>
                                </select>
                            </td>
                    </tr>
                    
                    <tr>
                      <td colspan="2" align="center"><input type="submit" name="simpan" class ="text" value="S I M P A N" title="Simpan Tarif"></td>
                    </tr>
                </table>
               
        </div>
        </form>
    </div>
</div>