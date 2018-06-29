<div align="center">
<div id="frame">
    <div id="frame_title"><h3>Laporan RL 1.1</h3></div>
<form id="form_rl1">
<table border="0" width="95%">
	<tr valign="top">
		<td align="center">
	
	<?php
	error_reporting( 'E_ALL' );
	session_start(  );
	include( '../include/connect.php' );
	$kode = $KDRS;
	$sql_x = 'select * from data_rs where Propinsi = \'' . $kode . '\'';
	$hasil_x = mysql_query( $sql_x );
	$row_x = mysql_fetch_array( $hasil_x );
	$tgl_berlaku12 = date( "d-m-Y", strtotime( $row_x[berlaku_akr_2012] ) );
	
	echo '<s';
	echo 'cript type="text/javascript" src="'._BASE_.'rm/include/js/hoverIntent.js"></script>
		';
	echo '<s';
	echo 'cript type="text/javascript" src="'._BASE_.'rm/include/js/superfish.js"></script>
		';
	echo '<s';
	echo 'cript type="text/javascript" src="'._BASE_.'rm/include/js/jquery-1.3.2.js"></script>
    ';
	echo '<s';
	echo 'cript type="text/javascript" src="'._BASE_.'rm/include/js/ui.core.js"></script>
    ';
	
	echo '<script type="text/javascript" src="'._BASE_.'include/jquery-1.4.js"></script>
	';
	echo '<script type="text/javascript" src="'._BASE_.'rm/include/js/ui.datepicker.js"></script>
	';
	echo '<script type="text/javascript" src="'._BASE_.'rm/include/js/ui.datepicker-id.js"></script>
	';
	echo '<script src="http://code.jquery.com/jquery-latest.js"></script>
	';
	echo '<script type="text/javascript" src="'._BASE_.'include/js.js"></script>
	';
    
	echo '<script language="javascript" src="'._BASE_.'include/cal2.js"></script>
	';
    echo '<script language="javascript" src="'._BASE_.'include/cal_conf2.js"></script>
	';
		
	echo '<s';
	echo 'cript type="text/javascript">
      $(document).ready(function() {
	 	
		$(".tr_s:odd").addClass("ganjil");
        $(".tr_s:even").addClass("genap");
		$(".tr_p:odd").addClass("ganjil1");
        $(".tr_p:even").addClass("genap1");
        $("th").parent().addClass("tbheading");
			document.getElementById(\'penyelenggara\').style.backgroundColor=\'#cccccc\';
			document';
	echo '.getElementById(\'kelasrs\').style.backgroundColor=\'#cccccc\';
			document.getElementById(\'jenisrs\').style.backgroundColor=\'#cccccc\';	
      });  
    </script>
	    ';
	echo '<s';
	echo 'cript type="text/javascript"> 
      
	$(document).ready(function(){
        $("#tglberlaku07").datepicker({
					dateFormat      : "dd-mm-yy",  
					changeMonth	  : true,
		  changeYear	  : true ,        
          showOn          : "button",
          buttonImage     : "rm/images/datepicker/images/calendar.gif",
          buttonImageOnly : true				
        });
      });
	    $(document).ready(function(){
        $("#tglberlaku12").datep';
	echo 'icker({
					dateFormat      : "dd-mm-yy",  
					changeMonth	  : true,
		  changeYear	  : true ,        
          showOn          : "button",
          buttonImage     : "rm/images/datepicker/images/calendar.gif",
          buttonImageOnly : true				
        });
      });
</script>
';
	echo '<s';
	echo 'cript>
   function simpan(){
if($(\'#namars\').val()==""){
alert(\'Nama RS Belum Diisi\');
   	$(\'#namars\').focus();
	}
else if($(\'#jenisrs\').val()==""){
alert(\'Jenis RS Belum Diisi\');
$(\'#jenisrs\').focus();
   	}	
else if($(\'#kelasrs\').val()==""){
alert(\'Kelas RS Belum Diisi\');
$(\'#kelasrs\').focus();
   	}	
else if($(\'#nosk\').val()==""){
alert(\'Nomor SK Penetapan Kelas Belum Diisi\');
';
	echo '$(\'#nosk\').focus();
   	}	
else if($(\'#skpendidikan\').val()=="Pendidikan" && $(\'#noskpendidikan\').val()==""){
alert(\'Nomor SK RS Pendidikan Belum Diisi\');
$(\'#noskpendidikan\').focus();
   	}	
else if($(\'#direktur\').val()==""){
alert(\'Direktur Belum Diisi\');
$(\'#direktur\').focus();
   	}
else if($(\'#alamat\').val()==""){
alert(\'Alamat RS Belum Diisi\');
$(\'#alamat\').focus();
   	}
	
else if($(\'#fax\').val()==""){
alert(\'Fax Belum Diisi\');
$(\'#fax\').focus();
   	';
	echo '}	
else if($(\'#email\').val()==""){
alert(\'Email Belum Diisi\');
$(\'#email\').focus();
   	}	
else if($(\'#ltanah\').val()=="" || $(\'#ltanah\').val()==0){
alert(\'Luas Tanah Belum Diisi atau 0\');
$(\'#ltanah\').focus();
   	}
else if($(\'#lbangunan\').val()=="" || $(\'#lbangunan\').val()==0){
alert(\'Luas Bangunan Belum Diisi atau 0\');
$(\'#lbangunan\').focus();
   	}
else if($(\'#no_si\').val()==""){
';
	echo '
alert(\'Nomor Surat Izin Operasional Belum Diisi\');
$(\'#no_si\').focus();
   	}	
else if($(\'#masa_berlaku\').val()==""){
alert(\'Masa Berlaku Surat Izin Belum Diisi\');
$(\'#masa_berlaku\').focus();
   	}
else if($(\'#st_akreditasi12\').val()=="Sudah"){
alert(\'Tahapan Dan Masa Berlaku Akreditasi 2012 Wajib Diisi\');
if($(\'#tahapan_akreditasi12\')==""){
$(\'#tahapan_akreditasi12\').focus();
}
else ';
	echo 'if($(\'#tglberlaku12\')==""){
$(\'#tglberlaku12\').focus();
}
   	}	
	else{
	$.post(\'rm/ambildata_rl1.php\',
			{   \'reqdata\'   :\'simpan\',
                            \'koders\'   :$(\'#koders\').val(),
                            \'namars\'     :$(\'#namars\').val(),
							\'jenisrs\'     :$(\'#jenisrs\').val(),
							\'kelasrs\'     :$(\'#kelasrs\').val(),
							\'nosk\'     :$(\'#nosk\').val(),
							\'skpendid';
	echo 'ikan\'     :$(\'#skpendidikan\').val(),
							\'noskpendidikan\'     :$(\'#noskpendidikan\').val(),
							\'direktur\'     :$(\'#direktur\').val(),
							\'penyelenggara\'     :$(\'#penyelenggara\').val(),
							\'alamat\'     :$(\'#alamat\').val(),
							\'kab\'     :$(\'#kab\').val(),
							\'kopos\'     :$(\'#kopos\').val(),
							\'fax\'     :$(\'#fax\').val(),
							\'tlp\'     :$(\'#tlp\').val(),							
					';
	echo '		\'email\'     :$(\'#email\').val(),
							\'web\'     :$(\'#web\').val(),
							\'ltanah\'     :$(\'#ltanah\').val(),
							\'lbangunan\'     :$(\'#lbangunan\').val(),
							\'no_si\'     :$(\'#no_si\').val(),
							\'masa_berlaku\'     :$(\'#masa_berlaku\').val(),
							\'stakreditasi_12\'     :$(\'#st_akreditasi12\').val(),
							\'tahapan_akreditasi12\'     :$(\'#tahapan_akreditasi12\').val(),
							\'tglberl';
	echo 'aku12\'     :$(\'#tglberlaku12\').val(),
							\'ponek\'     :$(\'#ponek\').val(),
							\'simrs\'     :$(\'#simrs\').val(),
							\'bank_darah\'     :$(\'#bank_darah\').val(),
							\'hemodialisa\'     :$(\'#hemodialisa\').val(),
							\'akupunktur\'     :$(\'#akupunktur\').val(),
							\'hiperbarik\'     :$(\'#hiperbarik\').val()
                        },
			function (data) {
				$(\'#hasil\').html(data);
	';
	echo '		}
			);

	}
}	
</script>
       ';
	echo '<s';
	echo 'cript src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>  
  ';
	echo '<s';
	echo 'cript type="text/javascript">
 
function reset(){
$(\'#tbl_reg1\').load(\'tlb_reg.php\').hide().fadeIn(2000);

	  }
	  
</script>
 ';
	echo '<s';
	echo 'cript type="text/javascript">
 function del_tt(){
	$.post(\'rm/ambildata_rl1.php\',
			{   \'reqdata\'   :\'del_tt\',
                            \'koders\'   :$(\'#koders\').val(),
                            \'id\'     :$(\'#id\').val()
							
                        },
						function (data) {
				$(\'#tbl_reg1\').load(\'tlb_reg.php\').hide().fadeIn(2000);
			}
						);
 						
 }
 </script>
';
	echo '<s';
	echo 'cript>
   function tambah(){
   $koders= $(\'#koders\').val();
  window.open("add_tt.php?id="+$koders,"popup","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, navigation=no, width=400, height=350",true);

       }
  </script> 
	';
	echo '<s';
	echo 'tyle>
          #tbl_rs {	width:auto;
					height:auto;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
					align:center;
                    border-spacing:0px; 
                    padding:3px
                    }
        #tbl_reg {	
                    border-collapse:collapse;';
	echo ' background-color:white;
                    font: 12px verdana; 
                 
                    }
		 #tbl_reg1 {	
					
					margin-left: 33px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 

                    
                    }			
					
		#tbl_reg2 {	
					margin-left: 33px;
					width:500px;';
	echo '
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
					border: 1px solid 666;
                    
                    }
	
		td		{	padding:5px;}
		.td_u{padding:3px}
		.tr_s { background:#666; }
		
		th		{	background:#39b54a;BORDER-RIGHT: black 1px solid; 
					BORDER-BOTTOM: 1px solid 666;"}
		.rest{ font:10px; color:red;}
    #';
	echo 'menu{ 
    opacity:0.92; 
    position: absolute;
    top: 115px;
    left: 45px;
	
}
	#teks{ 
    opacity:0.92; 
    position: absolute;
    top: 90px;
    left: auto;
	
}
	</style>
	';
	echo '<s';
	echo 'tyle>
    .ganjil { 
      background-color:#666; /* baris ganjil berwarna hijau muda */ 
    }
    .genap { 
      background-color:#FFFFFF; /* baris genap berwarna hijau tua */ 
    }
	.ganjil1 { 
      background-color:#FFFFFF; /* baris ganjil berwarna hijau muda */ 
    }
    .genap1 { 
      background-color:#666; /* baris genap berwarna hijau tua */ 
    }   
    .tbheading';
	echo '{ 
      background-color:#666; /* baris genap berwarna hijau tua */ 
    }   
    </style>


<table width="95%" id=\'tbl_reg\' name=\'tbl_reg\'>

<tr class=\'tr_s\'><td class=\'td_u\'>Kode RS : </td><td class=\'td_u\'>&nbsp;<input type=\'text\' name=\'koders\' id=\'koders\' disabled value=\'';
	echo '' . $row_x['Propinsi'];
	echo '\'></td><td colspan=2 class=\'td_u\'>&nbsp;';
	echo '<s';
	echo 'trong>Alamat/ Lokasi RS:</strong> </td><td colspan=2 class=\'td_u\'>&nbsp;';
	echo '<s';
	echo 'trong>Izin Operasional:</strong> </td></tr>
<tr class=\'tr_s\'><th>Nama RS : </td><th>&nbsp;<input type=\'text\' name=\'namars\' id=\'namars\' value=\'';
	echo '' . $row_x['RUMAH_SAKIT'];
	echo '\'></td><th>&nbsp;Jalan : </td><th>&nbsp;<input type=\'text\' name=\'alamat\' id=\'alamat\' value=\'';
	echo '' . $row_x['ALAMAT'];
	echo '\'></td>
<th>No. Surat Izin: </td><th>&nbsp;<input type=\'text\' name=\'no_si\' id=\'no_si\' value=\'';
	echo '' . $row_x['NO_SURAT_IJIN'];
	echo '\'></td>
</tr>
<tr class=\'tr_s\'><td class=\'td_u\'>Jenis RS : </td><td class=\'td_u\'>&nbsp;';
	echo '<s';
	echo 'elect name=\'jenisrs\' id=\'jenisrs\' value=\'';
	echo '' . $row_x['JENIS'];
	echo '\' disabled>
<option>RSU</option>
<option>RSIA</option>
<option>RS Jantung</option>
<option>RS Kanker</option>
<option>RS Orthopedi</option>
<option>RS Paru</option>
<option>RS Jiwa</option>
<option>RS Kusta</option>
<option>RS Mata</option>
<option>RSKO</option>
<option>RS Stroke</option>
<option>RSPI</option>
<option>RS Bersalin</option>
<option>RSGM</option>
<option>RSRM</option>
<option>RSTHT</option>
<option>';
	echo 'RS Bedah</option>
<option>RS Ginjal</option>
<option>RSKK</option>
<option>RSK Lainnya</option>
</select>
</td><td class=\'td_u\'>&nbsp;Kab/ Kota : </td><td class=\'td_u\'>&nbsp;';
	echo '<s';
	echo 'elect name=\'kab\' id=\'kab\'>
<option style="background-color:pink;" value=\'';
	echo '' . $row_x['link'];
	echo '\'>';
	echo '' . $row_x['KAB_KOTA'];
	echo '</option>

';
	$sql = '' . 'select link,`KAB/KOTA` as kab from `kab/kota` where propinsi_kode=\'' . $row_x['usrpwd2'] . '\' order by kab_id';
	
	$hasil = mysql_query( $sql, $connection );
	

	if ($row = mysql_fetch_array( $hasil )) {
		extract( $row );
		echo '' . '<option value=\'' . $kab . '\'>' . $kab . '</option>
';
	}

	echo '</select></td>
<td  class=\'td_u\'>Masa Berlaku s.d: </td><td class=\'td_u\'>&nbsp;<input size=10 type=\'text\' name=\'masa_berlaku\' id=\'masa_berlaku\' value=\'';
	echo '' . $row_x['MASA_BERLAKU_SURAT_IJIN'];
	echo '\'>
	<a href=\'javascript:showCal("Calendar_Masa")\'><img align=\'top\' src=\'img/date.png\' border=\'0\' /></td>
</tr>
<tr><th colspan=2>';
	echo '<s';
	echo 'trong>KELAS RS</strong></td><th>&nbsp;Kode Pos: </td><th>&nbsp;<input type=\'text\' id=\'kopos\' name=\'kopos\' value=\'';
	echo '' . $row_x['KODE'];
	echo '\'></td></tr>
<tr class=\'tr_s\'><th>Kelas RS : </td><th>&nbsp;';
	
	echo '<select name=\'kelasrs\' id=\'kelasrs\' value=\'\'  disabled>
<option value=\'A\' ';

	if ($row_x['kelasrs']  = 'A') {
		echo 'selected="selected"';
	}

	echo '>A</option>
<option value=\'B\' ';

	if ($row_x['kelasrs']  = 'B') {
		echo 'selected="selected"';
	}

	echo '>B</option>
<option value=\'C\' ';

	if ($row_x['kelasrs']  = 'C') {
		echo 'selected="selected"';
	}

	echo '>C</option>
<option value=\'D\' ';

	if ($row_x['kelasrs']  = 'D') {
		echo 'selected="selected"';
	}

	echo '>D</option>
<option value=\'-\' ';

	if ($row_x['kelasrs']  = '-') {
		echo 'selected="selected"';
	}

	echo '>Belum Ditetapkan</option>
</select>
</td><th>&nbsp;Telepon/ Fax: </td><th colspan=2>&nbsp;<input size=10 type=\'text\' id=\'tlp\' name=\'tlp\' value=\'';
	echo '' . $row_x['TELEPON'];
	echo '\'>&nbsp;/&nbsp;<input size=10 type=\'text\' id=\'fax\' name=\'fax\' value=\'';
	echo '' . $row_x['FAX'];
	echo '\'></td>

</tr>

<tr class=\'tr_s\'><td class=\'td_u\'>No. SK Penetapan Kelas :</td><td class=\'td_u\'>&nbsp;<input type=\'text\' name=\'nosk\' id=\'nosk\' value=\'';
	echo '' . $row_x['SK_KLS'];
	echo '\'></td><td>&nbsp;Email: </td><td>&nbsp;<input type=\'text\' id=\'email\' name=\'email\'  value=\'';
	echo '' . $row_x['EMAIL'];
	echo '\'></td>
<td class=\'td_u\' colspan=2>';
	echo '<s';
	echo 'trong>Akreditasi RS</strong></td>
</tr>
<tr class=\'tr_s\'><th>Pendidikan/ Non Pendidikan :</td><th>&nbsp;';
	echo '<s';
	echo 'elect name=\'skpendidikan\' id=\'skpendidikan\'><option value=1  ';

	if ($row_x['RSPENDIDIKAN']  = 1) {
		echo 'selected="selected"';
	}

	echo '>Pendidikan</option>
<option value=0  ';

	if ($row_x['RSPENDIDIKAN']  = 0) {
		echo 'selected="selected"';
	}

	echo '>Non Pendidikan</option></select>
</td><th>&nbsp;Website: </td><th>&nbsp;<input type=\'text\' id=\'web\' name=\'web\' value=\'';
	echo '' . $row_x['WEBSITE'];
	echo '\'></td>
<th>&nbsp;Status Akreditasi 2012 :</td>
<th>';

	echo '<select name=\'st_akreditasi12\' id=\'st_akreditasi12\'>
<option value=1  ';

	if ($row_x['akreditasi2012']  = 1) {
		echo 'selected="selected"';
	}

	echo '>Sudah</option>
<option value=0  ';

	if ($row_x['akreditasi2012']  = 0) {
		echo 'selected="selected"';
	}

	echo '>Belum</option>
</td>
</tr>
<tr class=\'tr_s\'><td class=\'td_u\'>No. SK Penetapan RS Pendidikan:</td><td class=\'td_u\'>&nbsp;<input type=\'text\' name=\'noskpendidikan\' id=\'noskpendidikan\' value=\'';
	echo '' . $row_x['NOSK_PENDIDIKAN'];
	echo '\'></td><td colspan=2>&nbsp;';
	echo '<s';
	echo 'trong>LUAS RS :</strong></td>
<td class=\'td_u\'>&nbsp;Pentahapan Akreditasi 2012:</td>
<td class=\'td_u\'>';
	echo '<s';
	echo 'elect name=\'tahapan_akreditasi12\' id=\'tahapan_akreditasi12\'>
	<option style="background-color:pink;"  value=\'';
	echo '' . $row_x['tahapan_akr_2012'];
	echo '\'>';
	echo '' . $row_x['tahapan_akr_2012'];
	echo '</option>

';
	$sql = 'select id,tahapan from akreditasi12 order by id';
	
	$hasil = mysql_query( $sql, $connection );
	

	if ($row = mysql_fetch_array( $hasil )) {
		extract( $row );
		echo '' . '<option value=\'' . $tahapan . '\'>' . $tahapan . '</option>
';
	}

	echo '</select></td>
</tr>
<tr class=\'tr_s\'><th>Nama Direktur:</td><th>&nbsp;<input type=\'text\' name=\'direktur\' id=\'direktur\' value=\'';
	echo '' . $row_x['DIREKTUR_RS'];
	echo '\'></td><th>&nbsp;Luas Tanah: </td><th>&nbsp;<input type=\'text\' size=5 id=\'ltanah\' name=\'ltanah\' value=\'';
	echo '' . $row_x['LUAS_TANAH'];
	echo '\'>&nbsp;m2</td>
<th>Tanggal Berlaku s.d :</td><th><input type=\'text\' size=10 name=\'tglberlaku12\' id=\'tglberlaku12\' value=\'';
	echo '' . $row_x['berlaku_akr_2012'];
	echo '\'>
	<a href=\'javascript:showCal("Calendar_Tgl")\'><img align=\'top\' src=\'img/date.png\' border=\'0\' /></td>
</tr>
<tr class=\'tr_s\'><td class=\'td_u\'>Penyelenggara</td><td class=\'td_u\'>';
	echo '<s';
	echo 'elect name=\'penyelenggara\' id=\'penyelenggara\'  disabled>
	<option style="background-color:pink;" value=\'';
	echo '' . $row_x['PENYELENGGARA'];
	echo '\'>';
	echo '' . $row_x['PENYELENGGARA'];
	echo '</option>

';
	$sql = 'select id,penyelenggara from penyelenggara order by id';
	
	$hasil = mysql_query( $sql, $connection );
	

	if ($row = mysql_fetch_array( $hasil )) {
		extract( $row );
		echo '' . '<option>' . $penyelenggara . '</option>';
	}

	echo '</select></td><td>&nbsp;Luas Bangunan: </td><td>&nbsp;<input type=\'text\' size=5 id=\'lbangunan\' name=\'lbangunan\' value=\'';
	echo '' . $row_x['LUAS_BANGUNAN'];
	echo '\'>&nbsp;m2</td>
<td colspan=2></td> 
</tr>
	
	</table>
</td></tr>
<tr><td colspan=2>';
	echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '<strong>DATA TEMPAT TIDUR RS</strong></td></tr>

<tr><td colspan=2>
';
	include('tlb_reg.php');
	echo '</td></tr>
<tr><td colspan=2>';
	echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '<strong>Lain-Lain</strong></td></tr>
<tr><td colspan=2>
<table id=\'tbl_reg2\'>
<tr class=\'tr_s\'><td>&nbsp;Melayani Ponek</td><td>&nbsp;';
	echo '<s';
	echo 'elect name=\'ponek\' id=\'ponek\'><option value=""></option>
<option value=1 ';

	if ($row_x['ponek']  = 1) {
		echo 'selected="selected"';
	}

	echo '>Ya</option>
<option value=0 ';

	if ($row_x['ponek']  = 0) {
		echo 'selected="selected"';
	}

	echo '>Tidak</option> 
</select></td></tr> 
<tr class=\'tr_s\'><td>&nbsp;SIMRS</td><td>&nbsp;';
	echo '<s';
	echo 'elect name=\'simrs\' id=\'simrs\' value=""><option value=""></option>
<option value=3 ';

	if ($row_x['simrs']  = 3) {
		echo 'selected="selected"';
	}

	echo '>Terintegrasi Menyeluruh</option>
<option value=2 ';

	if ($row_x['simrs']  = 2) {
		echo 'selected="selected"';
	}

	echo '>Terintegrasi Sebagian</option>
<option value=1 ';

	if ($row_x['simrs']  = 1) {
		echo 'selected="selected"';
	}

	echo '>Belum Terintegrasi</option>
<option value=0 ';

	if ($row_x['simrs']  = 0) {
		echo 'selected="selected"';
	}

	echo '>Tidak Ada</option>
</select></td></tr>
<tr class=\'tr_s\'><td>&nbsp;BANK Darah</td><td>&nbsp;';
	echo '<s';
	echo 'elect name=\'bank_darah\' id=\'bank_darah\' value=""><option></option>
<option value=1 ';

	if ($row_x['bank_darah']  = 1) {
		echo 'selected="selected"';
	}

	echo '>Ada</option>
<option value=0 ';

	if ($row_x['bank_darah']  = 0) {
		echo 'selected="selected"';
	}

	echo '>Tidak Ada</option>
</select></td></tr> 
<tr class=\'tr_s\'><td>&nbsp;Hemodialisa</td><td>&nbsp;';
	echo '<s';
	echo 'elect name=\'hemodialisa\' id=\'hemodialisa\'><option value=""></option>
<option value=1 ';

	if ($row_x['hemodialisa']  = 1) {
		echo 'selected="selected"';
	}

	echo '>Ada</option>
<option value=0 ';

	if ($row_x['hemodialisa']  = 0) {
		echo 'selected="selected"';
	}

	echo '>Tidak Ada</option>
</select></td></tr>
<tr class=\'tr_s\'><td>&nbsp;Akupunktur</td><td>&nbsp;';
	echo '<s';
	echo 'elect name=\'akupunktur\' id=\'akupunktur\'><option value=""></option>
<option value=1 ';

	if ($row_x['akupunktur']  = 1) {
		echo 'selected="selected"';
	}

	echo '>Ada</option>
<option value=0 ';

	if ($row_x['akupunktur']  = 0) {
		echo 'selected="selected"';
	}

	echo '>Tidak Ada</option>
</select></td></tr>
<tr class=\'tr_s\'><td>&nbsp;Hiperbarik</td><td>&nbsp;';
	echo '<s';
	echo 'elect name=\'hiperbarik\' id=\'hiperbarik\'><option value=""></option>
<option value=1 ';

	if ($row_x['hiperbarik']  = 1) {
		echo 'selected="selected"';
	}

	echo '>Ada</option>
<option value=0 ';

	if ($row_x['hiperbarik']  = 0) {
		echo 'selected="selected"';
	}

	echo '>Tidak Ada</option>
</select></td></tr>

<tr><td colspan=2><input type=\'button\' value=\'simpan\' onClick=\'simpan()\'>&nbsp;<div id=\'hasil\' class=\'rest\'></div></td></tr>
<tr  valign="top"  colspan=2 style="padding-top:600px;"> <td width="1024"> ';
echo '</td></tr>';

?>
</table>
</br></br>
        </td>
		
    </tr>
	
</table>
</form>
</div>
</div>