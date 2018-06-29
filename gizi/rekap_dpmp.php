<?php 
include '../include/connect.php';
?>
<div align="center">
    <div id="frame">
    <div id="frame_title">
      <h3>DAFTAR REKAP PERMINTAAN MAKANAN PASIEN</h3></div>
    <form name="formsearch" id="formsearch" method="get">  
		Tanggal 
		<input type="text" name="tgl_pesan" id="tgl_pesan" readonly="readonly" class="text"  style="width:80px"
              value="<? if($_REQUEST['tgl_pesan'] !=""): echo $_REQUEST['tgl_pesan']; else: echo date('Y/m/d'); endif; ?>"/><a href="javascript:showCal('Calendar3')"><img align="top" src="img/date.png" border="0" /></a>
         sampai       
         Tanggal 
		<input type="text" name="tgl_pesan2" id="tgl_pesan2" readonly="readonly" class="text" style="width:80px" 
              value="<? if($_REQUEST['tgl_pesan2'] !=""): echo $_REQUEST['tgl_pesan2']; else: echo date('Y/m/d'); endif; ?>"/><a href="javascript:showCal('Calendar11')"><img align="top" src="img/date.png" border="0" /></a>
         <input type="hidden" name="link" value="161" />
         <input type="submit" value="cari" class="text" />      
        </form>
      <p><h1>A. Rawat Inap</h1>
         <table align="center" width="95%" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr align="center">
    <th rowspan="3">No</th>
    <th rowspan="3">Ruangan</th>
    <th colspan="5" rowspan="2">Pasien Yang Mendapat Makanan Biasa</th>
    <th colspan="27">Pasien Yang Mendapat Makanan Khusus</th>
    <th rowspan="3">Lain  lain</th>
    <th rowspan="3">JML</th>
    <th rowspan="3">Pasien Yang Mendapat Snack</th>
    <th rowspan="3">Keterangan</th>
    </tr>
  <tr align="center">
    <th colspan="3">TKTP</th>
    <th colspan="3">RG</th>
    <th colspan="3">DL</th>
    <th colspan="3">DH</th>
    <th colspan="3">DM</th>
    <th colspan="3">DJ</th>
    <th colspan="3">TP</th>
    <th colspan="3">RP.r</th>
    <th colspan="3">RP</th>
    </tr>
  <tr align="center">
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>C</th>
    <th>SD</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>N</td>
    <th>L</th>
    <th>BS</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    </tr>
  <tr align="center">
    <td>1</td>
    <td>2</td>
    <td>3</td>
    <td>4</td>
    <td>5</td>
    <td>6</td>
    <td>7</td>
    <td>8</td>
    <td>9</td>
    <td>10</td>
    <td>11</td>
    <td>12</td>
    <td>13</td>
    <td>14</td>
    <td>15</td>
    <td>16</td>
    <td>17</td>
    <td>18</td>
    <td>19</td>
    <td>20</td>
    <td>21</td>
    <td>22</td>
    <td>23</td>
    <td>24</td>
    <td>25</td>
    <td>26</td>
    <td>27</td>
    <td>28</td>
    <td>29</td>
    <td>30</td>
    <td>31</td>
    <td>32</td>
    <td>33</td>
    <td>34</td>
    <td>35</td>
    <td>36</td>
    <td>37</td>
    <td>38</td>
  </tr>
  <?
  $SQL = "CALL pr_rekap_dpmp_all('".$_GET['tgl_pesan']."','".$_GET['tgl_pesan2']."')";
	$QRY = mysql_query($SQL);
	while($data = mysql_fetch_array($QRY)){
  ?>
    <tr align="center" <? echo "class ="; $count++; if ($count % 2) { echo "tr1"; }else{ echo "tr2"; }?>>    
    <td>&nbsp;</td>
    <td><?=$data['nama']?></td>
    <td><?=$data['tiga']?></td>
    <td><?=$data['empat']?></td>
    <td><?=$data['lima']?></td>
    <td><?=$data['enam']?></td>
    <td><?=$data['tujuh']?></td>
    <td><?=$data['delapan']?></td>
    <td><?=$data['sembilan']?></td>
    <td><?=$data['sepuluh']?></td>
    <td><?=$data['sebelas']?></td>
    <td><?=$data['duabelas']?></td>
    <td><?=$data['tigabelas']?></td>
    <td><?=$data['empatbelas']?></td>
    <td><?=$data['limabelas']?></td>
    <td><?=$data['enambelas']?></td>
    <td><?=$data['tujuhbelas']?></td>
    <td><?=$data['delapanbelas']?></td>
    <td><?=$data['sembilanbelas']?></td>
    <td><?=$data['duapuluh']?></td>
    <td><?=$data['duasatu']?></td>
    <td><?=$data['duadua']?></td>
    <td><?=$data['duatiga']?></td>
    <td><?=$data['duaempat']?></td>
    <td><?=$data['dualima']?></td>
    <td><?=$data['duaenam']?></td>
    <td><?=$data['duatujuh']?></td>
    <td><?=$data['duadelapan']?></td>
    <td><?=$data['duasembilan']?></td>
    <td><?=$data['tigapuluh']?></td>
    <td><?=$data['tigasatu']?></td>
    <td><?=$data['tigadua']?></td>
    <td><?=$data['tigatiga']?></td>
    <td><?=$data['tigaempat']?></td>
    <td></td>
    <td>&nbsp;</td>
    <td><?=$data['snack']?></td>
    <td>&nbsp;</td>
    </tr>
    <? } ?>
</table>
<?php 
include '../include/connect.php';
?>

      <p><h1>B. Rawat Jalan</h1>
         <table align="center" width="95%" border="0" cellpadding="1" cellspacing="1" class="tb">
  <tr align="center">
    <th rowspan="3">No</th>
    <th rowspan="3">Ruangan</th>
    <th colspan="5" rowspan="2">Pasien Yang Mendapat Makanan Biasa</th>
    <th colspan="27">Pasien Yang Mendapat Makanan Khusus</th>
    <th rowspan="3">Lain  lain</th>
    <th rowspan="3">JML</th>
    <th rowspan="3">Pasien Yang Mendapat Snack</th>
    <th rowspan="3">Keterangan</th>
    </tr>
  <tr align="center">
    <th colspan="3">TKTP</th>
    <th colspan="3">RG</th>
    <th colspan="3">DL</th>
    <th colspan="3">DH</th>
    <th colspan="3">DM</th>
    <th colspan="3">DJ</th>
    <th colspan="3">TP</th>
    <th colspan="3">RP.r</th>
    <th colspan="3">RP</th>
    </tr>
  <tr align="center">
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>C</th>
    <th>SD</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>N</td>
    <th>L</th>
    <th>BS</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    <th>N</th>
    <th>L</th>
    <th>BS</th>
    </tr>
  <tr align="center">
    <td>1</td>
    <td>2</td>
    <td>3</td>
    <td>4</td>
    <td>5</td>
    <td>6</td>
    <td>7</td>
    <td>8</td>
    <td>9</td>
    <td>10</td>
    <td>11</td>
    <td>12</td>
    <td>13</td>
    <td>14</td>
    <td>15</td>
    <td>16</td>
    <td>17</td>
    <td>18</td>
    <td>19</td>
    <td>20</td>
    <td>21</td>
    <td>22</td>
    <td>23</td>
    <td>24</td>
    <td>25</td>
    <td>26</td>
    <td>27</td>
    <td>28</td>
    <td>29</td>
    <td>30</td>
    <td>31</td>
    <td>32</td>
    <td>33</td>
    <td>34</td>
    <td>35</td>
    <td>36</td>
    <td>37</td>
    <td>38</td>
  </tr>
  <?
  $SQL = "CALL pr_rekap_dpmp_rajal('".$_GET['tgl_pesan']."','".$_GET['tgl_pesan2']."')";
	$QRY = mysql_query($SQL);
	while($data = mysql_fetch_array($QRY)){
  ?>
    <tr align="center" <? echo "class ="; $count++; if ($count % 2) { echo "tr1"; }else{ echo "tr2"; }?>>    
    <td>&nbsp;</td>
    <td><?=$data['nama']?></td>
    <td><?=$data['tiga']?></td>
    <td><?=$data['empat']?></td>
    <td><?=$data['lima']?></td>
    <td><?=$data['enam']?></td>
    <td><?=$data['tujuh']?></td>
    <td><?=$data['delapan']?></td>
    <td><?=$data['sembilan']?></td>
    <td><?=$data['sepuluh']?></td>
    <td><?=$data['sebelas']?></td>
    <td><?=$data['duabelas']?></td>
    <td><?=$data['tigabelas']?></td>
    <td><?=$data['empatbelas']?></td>
    <td><?=$data['limabelas']?></td>
    <td><?=$data['enambelas']?></td>
    <td><?=$data['tujuhbelas']?></td>
    <td><?=$data['delapanbelas']?></td>
    <td><?=$data['sembilanbelas']?></td>
    <td><?=$data['duapuluh']?></td>
    <td><?=$data['duasatu']?></td>
    <td><?=$data['duadua']?></td>
    <td><?=$data['duatiga']?></td>
    <td><?=$data['duaempat']?></td>
    <td><?=$data['dualima']?></td>
    <td><?=$data['duaenam']?></td>
    <td><?=$data['duatujuh']?></td>
    <td><?=$data['duadelapan']?></td>
    <td><?=$data['duasembilan']?></td>
    <td><?=$data['tigapuluh']?></td>
    <td><?=$data['tigasatu']?></td>
    <td><?=$data['tigadua']?></td>
    <td><?=$data['tigatiga']?></td>
    <td><?=$data['tigaempat']?></td>
    <td></td>
    <td>&nbsp;</td>
    <td><?=$data['snack']?></td>
    <td>&nbsp;</td>
    </tr>
    <? } ?>
</table>

        
    </div>
</div>