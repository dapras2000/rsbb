


<?php

$conn = mysql_connect("localhost","root","") or die(mysql_error()) ;
mysql_select_db("simrs_product") or die('Error'. mysql_error());

$norm = $_POST['cintah'];
?>    
<input placeholder="Filter Obat ..." style=" margin-left: 3px; margin-bottom: 7px; margin-top: 12px; height: 17px; width:280px; font-size: 11pt;" id="inputFilter" onkeyup="filter()" type="text" >
<table id="dataObat" style="font-size: 10pt; line-height: 1;">
  <thead >
    <tr>
      <th>NAMA</th>
      <th>HARGA @</th>
      <th>JUMLAH RETUR</th>
      <th>ACT</th>
    </tr>
  </thead>
  <tbody>

<?php
        $idxdaftar = '23134';
        $sqlIdxdaftar = 'SELECT idxdaftar FROM `simrs_product`.`t_pendaftaran` 
        WHERE nomr = '.$norm.' ORDER BY idxdaftar DESC LIMIT 1';
        $result = mysql_query($sqlIdxdaftar) or die(mysql_error());
        $row = array();
        while ($row = mysql_fetch_array($result)) {
        $idxdaftar = $row['idxdaftar'];
        }
        $sql = 'SELECT b.nama_barang, a.kode_obat, a.qty, a.sediaan, a.harga  FROM t_billobat_ranap a 
        JOIN m_barang b ON a.kode_obat = b.kode_barang
        WHERE a.idxdaftar = "'.$idxdaftar.'" GROUP BY b.nama_barang
        HAVING COUNT(*) >= 1';
        $result = mysql_query($sql) or die(mysql_error());
        $row = array();

        while ($row = mysql_fetch_array($result)) {
?>
    
      
    <tr>

      <td id="nama-<?php echo  $row['kode_obat']; ?>" style="width: 35%;">
        <?php echo $row['nama_barang']; ?>
      </td>
  
      <td id="harga-<?php echo  $row['kode_obat']; ?>" style="width: 17%">
        <?php echo str_replace('.00', '', $row['harga']); ?>
      </td>

      <td style="width: 25%;">
          <div>
            <input style="width: 45px;"  id="jml-<?php echo  $row['kode_obat']; ?>" type="text" onkeypress="return cekNomer(event)">
            <span ><?php echo $row['sediaan']; ?></span>
          </div> 
      </td>

      <td style="width: 15%;">  
        <button onclick="retur('<?php echo  $row['kode_obat']; ?>')">
            RETUR
        </button>
      </td>

    </tr>


<?php
  }
?>
  </tbody>
  
</table>



<script>

var dataRetur = [];
var idxDaftar = '<?php echo($idxdaftar); ?>';
function retur(a){
  var namaId = 'nama-'+a;
  var hargaId = 'harga-'+a;
  var jmlId = 'jml-'+a;
  var namaVal = document.getElementById(namaId).firstChild.nodeValue;
  var hargaVal = document.getElementById(hargaId).firstChild.nodeValue;
  var jmlVal = document.getElementById(jmlId).value;
  if (jmlVal !== '') {

  var tr = document.createElement('tr');
      tr.setAttribute('id', a);

  var tdNama = document.createElement('td');
  var tdHarga = document.createElement('td');
  var tdJml = document.createElement('td');
  var tdDel = document.createElement('td');
  var linkDel = document.createElement('a');
      linkDel.setAttribute('onClick', 'busak('+a+')')
      linkDel.setAttribute('href', '#')

  var namaText = document.createTextNode(namaVal);
  var hargaText = document.createTextNode(hargaVal);
  var jmlText = document.createTextNode(jmlVal);
  var delText = document.createTextNode('DELETE');
  linkDel.appendChild(delText);

  tdNama.appendChild(namaText);
  tdHarga.appendChild(hargaText);
  tdJml.appendChild(jmlText);
  tdDel.appendChild(linkDel);
  
  tr.appendChild(tdNama);
  tr.appendChild(tdHarga);
  tr.appendChild(tdJml);
  tr.appendChild(tdDel);
  
  document.getElementById("tab").appendChild(tr);
  
  dataRetur.push([idxDaftar, a, namaVal.trim(), hargaVal.trim(), jmlVal]);
  console.log(dataRetur);
  document.getElementById("dataRetur").value = JSON.stringify(dataRetur);
  } else {
    alert('Wait !, Kamu lupa input jumlah returnya.');
  }
}

function busak(b){
  document.getElementById(b).remove();
  dataRetur = dataRetur.filter(function(item){ return item[1] != b });
  console.log(dataRetur);
  document.getElementById("dataRetur").value = JSON.stringify(dataRetur);
}
</script>