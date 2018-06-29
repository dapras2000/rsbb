<?php 
 include("../include/connect.php");
 include("inc/function.php");
 
 $ip = getRealIpAddr();
 $sql2="SELECT tmp_cartorderlab.KODEJASA,
  			m_lab.nama_jasa,
  			tmp_cartorderlab.QTY,
			tmp_cartorderlab.IDXORDERLAB
		FROM
  			tmp_cartorderlab
  		INNER JOIN m_lab ON (tmp_cartorderlab.KODEJASA = m_lab.kode_jasa) WHERE tmp_cartorderlab.IP = '$ip'";
 				 
		$nomr = $_POST['txtNoMR'];
		$idxdaftar = $_POST['txtIdxDaftar'];
		$kddokter = $_POST['txtKdDokter'];
		$tglreg = $_POST['txtTglReg'];
		$kdpoly = $_POST['txtKdPoly'];
  
		$sql="SELECT kode_jasa FROM m_lab WHERE group_jasa <> '0101' ORDER BY kode_jasa";
		$row = mysql_query($sql)or die(mysql_error());
  
        mysql_query("DELETE FROM tmp_cartorderlab WHERE IP = '$ip'")or die(mysql_error());
  
        while($data = mysql_fetch_array($row)){
	     if(!empty($_POST[$data['kode_jasa']])){
		    $kode_jasa = $data['kode_jasa'];
				if($kode_jasa == "01010118"){
					@mysql_query("INSERT INTO tmp_cartorderlab(KODEJASA, QTY, IP, KET) VALUES ('01010101', 1, '$ip', 'Hematologi Automatic')");
					@mysql_query("INSERT INTO tmp_cartorderlab(KODEJASA, QTY, IP, KET) VALUES ('01010102', 1, '$ip', 'Hematologi Automatic')");
					@mysql_query("INSERT INTO tmp_cartorderlab(KODEJASA, QTY, IP, KET) VALUES ('01010106', 1, '$ip', 'Hematologi Automatic')");
					@mysql_query("INSERT INTO tmp_cartorderlab(KODEJASA, QTY, IP, KET) VALUES ('01010110', 1, '$ip', 'Hematologi Automatic')");
				}else{
		    		@mysql_query("INSERT INTO tmp_cartorderlab(KODEJASA, QTY, IP) VALUES ('$kode_jasa', 1, '$ip')");
				}
		  }
        }

 
 

$row2 = mysql_query($sql2)or die(mysql_error());
if(mysql_num_rows($row2) > 0){ ?>
<form name="formsavelab" id="formsavelab" method="post" action="lab/saveorderlab.php">
<input type="submit" class="text" value="S i m p a n" submit="submitform (document.getElementById('formsavelab'),'lab/saveorderlab.php','validlab',validatetask);return false;" />
 <input name="txtNoMR" id="txtNoMR" type="hidden" value=<?php echo $nomr; ?> >
 <input name="txtIdxDaftar" id="txtIdxDaftar" type="hidden" value=<?php echo $idxdaftar; ?> >
 <input name="txtKdDokter" id="txtKdDokter" type="hidden" value=<?php echo $kddokter; ?> >
 <input name="txtTglReg" id="txtTglReg" type="hidden" value=<?php echo $tglreg; ?> >
 <input name="txtKdPoly" id="txtKdPoly" type="hidden" value=<?php echo $kdpoly; ?> >
 </form>
<? } ?>