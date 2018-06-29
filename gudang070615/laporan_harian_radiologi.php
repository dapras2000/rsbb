<div style="overflow:scroll;width:98%;height:auto;" >     
<table border="0" cellspacing="1" cellpadding="1" bordercolor="#999999" class="tb" width="99%">
  <tr>
    <th rowspan="2"><div align="center">KODE</div></th>

    <th rowspan="2" width="20%"><div align="center">NAMA BARANG</div></th>
    <th rowspan="2"><div align="center">SATUAN</div></th>
    <th rowspan="2"><div align="center">STOK AWAL</div></th>
    <th colspan="5"><div align="center">PENERIMAAN</div></th>
    <th colspan="1"><div align="center">PENGELUARAN</div></th>
    <th rowspan="2"><div align="center">STOK AKHIR</div></th>
    <th rowspan="2"><div align="center">HARGA SATUAN (Rp)</div></th>
    <th rowspan="2"><div align="center">JUMLAH (Rp)</div></th>
  </tr>
  <tr>
    <th><div align="center">APBN</div></th>
    <th><div align="center">APBD I</div></th>
    <th><div align="center">APBD II</div></th>
    <th><div align="center">LAIN-LAIN</div></th>
    <th><div align="center">JUMLAH</div></th>
    
    
    <th><div align="center">RADIOLOGI</div></th>
   </tr>
<?
				
	$pager = new PS_Pagination($connect, $sql, 15, 5, "bulan=".$bulan."&tahun=".$tahun."&group=".$group."&nm_barang=".$nm_barang, "index.php?link=g02&");
	
	//The paginate() function returns a mysql result set 
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	$x= 1;
	while($data = mysql_fetch_array($rs)) {?>
          <tr <?   echo "class =";
                $count++;
                if ($count % 2) {
                echo "tr1"; }
                else {
                echo "tr2";
                }
        ?>>
            
            
            <td><?=$data['kode_barang']?></td>
              <td width="20%"><?=$data['nama_barang']?></td>
            <td><?=$data['satuan']?></td>
            <td align="right"><? if($data['STOKAWAL']==""){ echo "0";
			}else{ echo $data['STOKAWAL']; }?></td>
            <td align="right"><? if($data['APBN']==""){ echo "0";
			}else{ echo $data['APBN']; } ?></td>
            <td align="right"><? if($data['APBD1']==""){ echo "0";
			}else{ echo $data['APBD1']; } ?></td>
            <td align="right"><? if($data['APBD2']==""){ echo "0";
			}else{ echo $data['APBD2']; } ?></td>
            <td align="right"><? if($data['LAINLAIN']==""){ echo "0";
			}else{ echo $data['LAINLAIN']; } ?></td>
            <td align="right"><?=$data['APBN'] + $data['APBD1'] + $data['APBD2'] +$data['LAINLAIN']; ?></td>
            
                         
            <td align="right"><? if($data['RAD']==""){ echo "0";
			}else{ echo $data['LAB']; } ?></td>
                        <td align="right"><? if($data['STOKAKHIR']==""){ echo "0";
			}else{ echo $data['STOKAKHIR']; }?></td>
            <td align="right"><? if($data['harga']==""){ echo "0";
			}else{ echo $data['harga']; }?></td>
            <td align="right"><?=$data['STOKAKHIR'] *  $data['harga'];?></td>
            </tr>
	 <?	$x++;} ?>
     </table>
 </div>