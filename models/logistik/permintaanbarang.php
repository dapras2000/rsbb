
<?php
			$sqlorder = "SELECT 
						  t_permintaan_barang.IDXBARANG AS IDX,
						  t_permintaan_barang.`NO` AS NOBATCH,
						  t_permintaan_barang.NIP AS NIP,
						  t_permintaan_barang.kodebarang AS KODEBARANG,
						  t_permintaan_barang.tglpesan AS TGLPESAN,
						  t_permintaan_barang.jumlahpesan AS JUMLAH,
						  t_permintaan_barang.statusacc AS STATUS,
						  t_permintaan_barang.tglkeluar AS TGLKELUAR,
						  t_permintaan_barang.jmlkeluar AS JMLKELUAR,
						  t_permintaan_barang.KDPOLY AS POLY,
						  t_permintaan_barang.KATEGORY AS KATEGORI,
						  t_permintaan_barang.GROUPBARANG AS GROUPBARANG,
						  t_permintaan_barang.KET AS KET,
						  m_barang.nama_barang AS NAMABARANG,
						  m_barang.group_barang AS GROUPBARANG,
						  m_barang.satuan AS SATUAN
						FROM
						  t_permintaan_barang
						  INNER JOIN m_barang ON (t_permintaan_barang.kodebarang = m_barang.kode_barang)
						WHERE t_permintaan_barang.KATEGORY = 'L'  AND NO = '".$_GET['nobatch']."'";
?>
    
    <fieldset class="fieldset">
      <legend>Permintaan Barang </legend>
      <div id="listbarang" >
      <table class="tb">
        <tr>
          <th>Kode</th>
          <th>Nama Barang</th>
          <th>Group</th>
          <th>Jumlah</th>
          <th>Satuan</th>
          <th>Tanggal Pesan</th>
          <th>Jml Disetujui</th>
          <th>Status</th>
          <th>Option</th>
        </tr>
<?php        
   $roworder = mysql_query($sqlorder)or die(mysql_error()); 
   $i = 1;
   while ( $dataorder = mysql_fetch_array($roworder)){
?>
  <tr>
          <td><?=$dataorder['KODEBARANG']?></td>
          <td><?=$dataorder['NAMABARANG']?></td>
          <td><? $x = $dataorder['GROUPBARANG']; 
		  
		  switch($x){
		    case '1':
			echo "ATK";
			break;
			
			case '2':
			echo "Cetakan";
			break;
			
			case '3':
			echo "ART";
			break;
			
			case '4':
			echo "Alat Bersih dan Pembersih";
			break;
			
			case '5':
			echo "Lain - Lain";
			break;
		  }
		  
		  ?></td>
          <td><?=$dataorder['JUMLAH']?></td>
          <td><?=$dataorder['SATUAN']?></td>
          <td><?=$dataorder['TGLPESAN']?></td>
          <td align="center"><input type="text" class="text" name="jml<?=$dataorder['IDX']?>" id="jml<?=$dataorder['IDX']?>"style="width:30px"/></td>
          
          <td><div id="div<?=$dataorder['IDX']?>" ></div></td>
         
          <td><a href="#" onclick="javascript: MyAjaxRequest('div<?=$dataorder['IDX']?>','logistik/saveorderbarangpengeluaran.php?idxbarang=<?=$dataorder['IDX']?>&amp;opt=1&amp;jml=' + document.getElementById('jml<?=$dataorder['IDX']?>').value); return false;" >Setujui</a>
          &nbsp; | <a href="#" onclick="javascript: MyAjaxRequest('div<?=$dataorder['IDX']?>','logistik/saveorderbarangpengeluaran.php?idxbarang=<?=$dataorder['IDX']?>&amp;opt=2'); return false;" >Tidak Disetujui</a>
		  </td>
  </tr>
<?php } ?>        
      </table>
      </div>
      </fieldset>