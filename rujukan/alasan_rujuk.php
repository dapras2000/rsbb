<? 
include("../include/connect.php");
include("../include/function.php");
if($_GET['poly'] != ''){
	$sqll	= mysql_query('select a.*, b.NAMADOKTER
						  from m_dokter_jaga a 
						  join m_dokter b on a.kddokter = b.KDDOKTER
						  where a.kdpoly = '.$_REQUEST['poly']);
	if(mysql_num_rows($sqll) > 0){
        echo '<select name="dokter_pemeriksa" id="dokter_pemeriksa" class="text">';
        	while($dd = mysql_fetch_array($sqll)){
				echo '<option value="'.$dd['kddokter'].'"> '.$dd['NAMADOKTER'].' </option>';
			}
		echo '</select>';
	}
}

if(!empty($_GET['rujuk'])){
	$rujuk =  $_GET['rujuk'];
	if($rujuk == "6"){
	?>
    <script>
	jQuery(document).ready(function(){
		jQuery('.alasan_rujuk').click(function(){
			alert('a');
		});
	});
	</script>
	<table width="98%" >
		<tr>
        	<td width="5%"></td>
            <td width="15%"></td>
            <td width="10%">Alasan Rujuk</td>
            <td width="25%">
              	<select name="alasan_rujuk" class="text">
    				<?php 
					$sdasar	= mysql_query('select * from m_dasarrujuk');
					while($dsr_rujuk = mysql_fetch_array($sdasar)){ ?>
    				<option value="<?=$dsr_rujuk['kode']?>" ><?=$dsr_rujuk['nama']?></option>
					<?php } ?> 
			  	</select></td>
              <td width="20%"><div id="dokter_pemeriksa"></div></td>
              <td></td>
            </tr>
      </table>
	<?php 
	}elseif($rujuk == "5"){ 
	$sql_poly ="SELECT m_poly.kode, m_poly.nama FROM m_poly";
	$get_poly = mysql_query($sql_poly);
	?>
	<table width="98%" >
		<tr>
        	<td width="5%"></td>
            <td width="15%"></td>
            <td width="10%">Poly</td>
            <td width="25%">
              	<select name="poly" class="text" onchange="javascript: MyAjaxRequest('dokter_pemeriksa','rujukan/alasan_rujuk.php?poly=' + this.value); return false;" >	
    				<option value="0" > -- </option>
    				<?php while($dat_poly = mysql_fetch_array($get_poly)){ ?>
    				<option value="<?=$dat_poly['kode']?>" ><?=$dat_poly['nama']?></option>
					<?php } ?> 
			  	</select></td>
              <td width="20%"><div id="dokter_pemeriksa"></div></td>
              <td></td>
            </tr>
      </table>
	<?php 
  }
}

?>