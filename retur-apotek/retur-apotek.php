<script src="retur-apotek/ajax.min.js"></script>


<div align="center">
  <div id="frame" style="width: 100%;">
    <div id="frame_title"><h3>EKSTENSI RETUR OBAT RANAP</h3></div>
  </div>
</div>


<div class="container-retur">
    <div class="input-retur">
      <div class="container-panel">
        <div class="header-panel"><p>INPUT NOMER REKAM MEDIK PASIEN RANAP</p></div>
        <div class="body-panel">

          <div class="body-panel-inputrm">
            <input for="btnRM" id="inputRM" autofocus="autofocus" onkeypress="return cekNomer(event)" type="text">
            <button id="btnRM">Cari ...</button>
          </div>
          
        </div>
      </div>
        
    </div>

  <div class="load-obat">
    <div class="container-panel">
        <div class="header-panel"><p>LIST OBAT AKAN DI RETUR</p></div>
        <div class="body-panel">
          
            <div id="loadRetur" class="load-obat-content"></div>
          
        </div>
    </div>
  </div>
    
    <div class="save-retur">
      <div class="container-panel">
        <div class="header-panel"><p>SAVE RETUR OBAT</p></div>
        <div class="body-panel">
          <div class="body-panel-content">
            <div id="myDIV" style="margin-left: 30px;">
                <table style="font-size: 10pt; margin-top: 12px; margin-left: 7px;">
                  <thead >
                    <tr>
                      <th>NAMA</th>
                      <th>HARGA @</th>
                      <th>JML</th>
                      <th>DELETE</th>
                      
                    </tr>
                  </thead>
                  <tbody id="tab">
                  
                  </tbody>
                </table>
                <form action="saveRetur.php" method="POST">
                    <input id="dataRetur" name="dataRetur" type="hidden" value="">
                    <input type="submit" value="Simpan" style="float: right; width: 57px; height: 31px; margin-bottom: 12px;">
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>










<!-- JAVASCRIPT START FROM HERE -->
<script>

$(document).ready(function(){
    $("#btnRM").click(function(){
        var cek = $('#inputRM').val();
        if(cek !== ''){
            $('#loadRetur').load('retur-apotek/load-retur.php',{
                cintah: cek
            });
            $('#inputRM').val('');
        }else{
            alert('OKAY !, Nomer RM belum kamu input, then ?');
        }
       
    });
});


var input = document.getElementById("inputRM");

input.addEventListener("keyup", function(event) {
  event.preventDefault();
  if (event.keyCode === 13) {
    document.getElementById("btnRM").click();
  }
});


function cekNomer(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}


// INI ADALAH JAVASCRIPT NATIVE
function filter() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("inputFilter");
  filter = input.value.toUpperCase();
  table = document.getElementById("dataObat");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
        
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

</script>




<!-- INI ADALAH LOAD RETUR  -->




