<? 
include("../include/connect.php");

$sql_reg_partus = "SELECT DATE_FORMAT(tanggal, '%Y-%m-%d') as tgl_lahir, 
                   DATE_FORMAT(tanggal, '%H:%i:%s') as jam_lahir,
				   idxreg_partus, lahir, idxdaftar, nomr, tanggal,
  				   nama, no_surat_lahir, no_surat_mati, anus,
  				   cacad, jenis_kelamin, paritas, berat_badan, panjang_badan,
  				   nilai_apgar, penolong, asisten, jns_persalinan, penyulit, KDUNIT,
  				   NIP, kode_icd, diagnosa, nilai_apgar_2, 
				   (SELECT jenis_penyakit from icd where icd_code=trim(t_reg_partus.kode_icd)) AS jenis_penyakit
        FROM t_reg_partus WHERE idxdaftar = ".$idxdaftar;
$get_reg_partus = mysql_query($sql_reg_partus);
$darp = mysql_fetch_assoc($get_reg_partus);
?> 
<form name="reg_partus" id="reg_partus" method="post" action="vk/addreg_partus.php" >
  <table class="tb">
     <tr>
      <td width="201">Tanggal Lahir</td>
 <? $tanggal = date("Y-m-d");?>     
      <td colspan="2"><input type="text" name="tgl_lahir" id="tgl_lahir" class="text"  value="<? if(!empty($darp['tgl_lahir'])){ echo $darp['tgl_lahir']; 
	  }else { echo trim($tanggal); }
	 ?>"/>
     <input type="hidden" name="idxreg_partus" value="<?=$darp['idxreg_partus']?>" />
     </td>
     </tr>
     <tr>
      <td>Jam</td>
 <? $jam = date("h:i:s");?>          
      <td colspan="2"><input type="text" name="jam_lahir"  id="jam_lahir" class="text" value="<? if(!empty($darp['jam_lahir'])){ echo $darp['jam_lahir']; 
	  }else { echo trim($jam); }
	 ?>"/></td>
     </tr>
     <tr>
       <td>Lahir</td>
       <td><input type="radio" name="lahir" value="1" <? if($darp['lahir']== "1") echo "checked=checked"; ?> />
       Hidup</td>
       <td><input type="radio" name="lahir" value="0"  <? if($darp['lahir']== "0") echo "checked=checked"; ?>/>
       Mati</td>
     </tr>
<? 
 $thn = date("Y");
 $bln = date("m");
 $sql_nourut_m = "SELECT no_surat_mati FROM t_reg_partus WHERE YEAR(tanggal) = '".$thn."' 
                AND lahir = 0
				ORDER BY idxreg_partus DESC LIMIT 1";
 $get_nourut_m = mysql_query($sql_nourut_m);				
 if(mysql_num_rows($get_nourut_m)){
     $dat_nourut_m = mysql_fetch_assoc($get_nourut_m);
	 $no_last_m = substr($dat_nourut_m['no_surat_mati'],0,5) + 1;
	 $nourut_m = substr("00000",0,5-strlen($no_last_m)).$no_last_m."/".$bln."/".strtoupper($singsurat)."/".$thn;
 }else{
     $nourut_m = "00001/".$bln."/".strtoupper($singsurat)."/".$thn;
 }
 ?>
     <tr>
       <td>No Urut Surat Kematian</td>
       <td colspan="2"><input type="text" name="no_surat_mati" id="no_surat_mati"  class="text" value="<? if(!empty($darp['idxreg_partus'])){ echo $darp['no_surat_mati']; 
	  }else { echo trim($nourut_m); }
	 ?>" style="width:200px"/></td>
     </tr>
     <tr>
       <td>ICD</td>
       <td colspan="2"><input name="icdv" type="text" class="text" id="icdv" size="50" onKeyPress="if(enter_pressed(event))
          				{
                        var str=document.getElementById('icdv').value;
                        var kode=str.split('--');
                        document.getElementById('icd_code').value=kode[1];  
                        document.getElementById('diagnosa').focus();                    
                        }" value="<? if(!empty($darp['jenis_penyakit'])){ echo $darp['jenis_penyakit']; 
	  }?>" /></td>
     </tr>
     <tr>
       <td>Kode ICD</td>
       <td colspan="2"><input type="text" name="icd_code" id="icd_code" class="text" readonly="readonly" value="<? if(!empty($darp['kode_icd'])){ echo $darp['kode_icd']; 
	  }?>" /></td>
     </tr>
     <tr>
       <td>Diagnosa</td>
       <td colspan="2"><textarea name="diagnosa" id="diagnosa" cols="100" class="text" rows="10"><? if(!empty($darp['diagnosa'])){ echo $darp['diagnosa']; 
	  }?>
       </textarea></td>
     </tr>
     <tr>
       <td>&nbsp;</td>
       <td colspan="2">&nbsp;</td>
     </tr>
     <tr>
      <td>Nama</td>
      <td colspan="2"><input type="text" name="nama" id="nama"  class="text" style="width:250px" value="<? if(!empty($darp['nama'])){ echo $darp['nama']; 
	  }?>"/></td>
     </tr>
     <tr>
     
 <? 
 $sql_nourut = "SELECT no_surat_lahir FROM t_reg_partus WHERE YEAR(tanggal) = '".$thn."' 
                AND lahir = 1
				ORDER BY idxreg_partus DESC LIMIT 1";
 $get_nourut = mysql_query($sql_nourut);				
 if(mysql_num_rows($get_nourut)){
     $dat_nourut = mysql_fetch_assoc($get_nourut);
	 $no_last = substr($dat_nourut['no_surat_lahir'],0,5) + 1;
	 $nourut = substr("00000",0,5-strlen($no_last)).$no_last."/".$bln."/".strtoupper($singsurat)."/".$thn;
 }else{
     $nourut = "00001/".$bln."/".strtoupper($singsurat)."/".$thn;
 }
 ?>    
       <td>No Urut Surat Ket. Lahir</td>
       <td><input type="text" name="no_surat_lahir" id="no_surat_lahir"  class="text" value="<? if(!empty($darp['idxreg_partus'])){ echo $darp['no_surat_lahir']; 
	  }else { echo trim($nourut); }
	 ?>" style="width:200px"/></td>
       <td>&nbsp;</td>
     </tr>
     <tr>
      <td>Paritas</td>
      <td><input type="text" name="paritas" id="paritas"  class="text" value="<? if(!empty($darp['paritas'])){ echo $darp['paritas']; 
	  }?>" style="width:50px"/></td>
      <td>&nbsp;</td>
     </tr> 
      <tr>
      
<? if(!empty($darp['jenis_kelamin'])){ 
 $jns_kelamin=$darp['jenis_kelamin']; 
}else{
 $jns_kelamin = "x";
}?>      
        <td>Jenis Kelamin</td>
        <td><input type="radio" name="jenis_kelamin" value="L" <? if($jns_kelamin=="L") echo "checked=checked"; ?>/>
        Laki -laki</td>
        <td><input type="radio" name="jenis_kelamin" value="P" <? if($jns_kelamin=="P") echo "checked=checked"; ?>/>
          Perempuan</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="checkbox" name="anus" value="1" <? if(!empty($darp['anus'])){ echo "checked=checked"; 
	  }?>/>
        &nbsp;Anus</td>
        <td><input type="checkbox" name="cacad" value="1" <? if(!empty($darp['cacad'])){ echo "checked=checked"; 
	  }?>/>
        &nbsp;Cacad</td>
      </tr>
      <tr>
      <td>Berat Badan</td>
      <td><input type="text" name="berat_badan" id="berat_badan"  class="text" value="<? if(!empty($darp['berat_badan'])){ echo $darp['berat_badan']; 
	  }?>" style="width:50px"/>
        Kg</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
        <td >Panjang Badan</td>
        <td ><input type="text" name="panjang_badan" id="panjang_badan"  class="text" value="<? if(!empty($darp['panjang_badan'])){ echo $darp['panjang_badan']; 
	  }?>" style="width:50px"/>
          Cm</td>
        <td >&nbsp;</td>
    </tr>
    <tr>
      <td >Nilai Apgar</td>
      <td width="200" >1` 
      <input type="text" name="nilai_apgar" id="nilai_apgar"  class="text" value="<? if(!empty($darp['nilai_apgar'])){ echo $darp['nilai_apgar']; 
	  }?>" /></td>
      <td width="415" >5` 
      <input type="text" name="nilai_apgar_2" id="nilai_apgar_2"  class="text" value="<? if(!empty($darp['nilai_apgar_2'])){ echo $darp['nilai_apgar_2']; 
	  }?>" /></td>
    </tr>
    <tr>
  <?    
  $sql_dokter = "SELECT m_dokter.KDDOKTER, m_dokter.KDPOLY, m_dokter.NAMADOKTER
				FROM m_dokter ";
  $get_dokter = mysql_query($sql_dokter);
  $get_dokterx = mysql_query($sql_dokter);
?>    
      <td >Penolong</td>
      <td ><select name="penolong" />
        <?
	     while($dat_dokter = mysql_fetch_array($get_dokter)){
	  ?>
        <option value="<?=$dat_dokter['KDDOKTER']?>" <? if($darp['penolong']==$dat_dokter['KDDOKTER']) echo "selected=selected";?> ><?=$dat_dokter['NAMADOKTER']?></option>
        <?		 
		 }
      ?>     
      </select></td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >Asisten</td>
      <td ><select name="asisten" />
      <?
	     while($dat_dokterx = mysql_fetch_array($get_dokterx)){
	  ?>
          <option value="<?=$dat_dokterx['KDDOKTER']?>" <? if($darp['asisten']==$dat_dokterx['KDDOKTER']) echo "selected=selected";?> ><?=$dat_dokterx['NAMADOKTER']?></option>
      <?		 
		 }
      ?>     
      </select></td>
      <td >&nbsp;</td>
    </tr>
    
 <? if(!empty($darp['jns_persalinan'])){ 
        $jns_persalinan = $darp['jns_persalinan']; 
	  }else{
		$jns_persalinan = "x"; 
	  }?>   
    <tr>
      <td >Jenis Persalinan</td>
      <td ><input type="radio" name="jns_persalinan" value="1" <? if($jns_persalinan=="1") echo "checked=checked"; ?>/>&nbsp;Partus Normal</td>
      <td ><input type="radio" name="jns_persalinan" value="2" <? if($jns_persalinan=="2") echo "checked=checked"; ?>/>&nbsp;
        Partus SC</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td ><input type="radio" name="jns_persalinan" value="3" <? if($jns_persalinan=="3") echo "checked=checked"; ?>/>&nbsp;Spontan Dengan Penyulit</td>
      
 <? if(!empty($darp['penyulit'])){ 
        $penyulit = $darp['penyulit']; 
	  }else{
		$penyulit = "x"; 
	  }?>   
      <td ><select name="penyulit" id="penyulit">
          <option > -- </option>
          <option value="1" <? if($penyulit=="1") echo "selected=selected"; ?>>Pre Eclamsia Berat</option>
          <option value="2" <? if($penyulit=="2") echo "selected=selected"; ?>>Pre Eclamsia Ringan</option>
          <option value="3" <? if($penyulit=="3") echo "selected=selected"; ?>>Eclamsia</option>
          <option value="4" <? if($penyulit=="4") echo "selected=selected"; ?>>Pendarahan Sebelum Persalinan</option>
          <option value="5" <? if($penyulit=="5") echo "selected=selected"; ?>>Pendarahan Sesudah Persalinan</option>
          <option value="6" <? if($penyulit=="6") echo "selected=selected"; ?>>Infeksi</option>
          <option value="7" <? if($penyulit=="7") echo "selected=selected"; ?>>Sungsang</option>
          <option value="8" <? if($penyulit=="8") echo "selected=selected"; ?>>Vacum</option>
          <option value="9" <? if($penyulit=="9") echo "selected=selected"; ?>>Restosia Bahu</option>
          <option value="10" <? if($penyulit=="10") echo "selected=selected"; ?>>KPD</option>
          <option value="11" <? if($penyulit=="11") echo "selected=selected"; ?>>Induksi</option>
      </select></td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
     <td >
     <input type="hidden" name="idxdaftar" value="<?=$idxdaftar?>" />
     <input type="hidden" name="nomr" value="<?=$nomr?>" />
     <input type="hidden" name="NIP" value="<?=$_SESSION['NIP']?>" />
     <input type="hidden" name="KDUNIT" value="<?=$_SESSION['KDUNIT']?>" />
     <input type="hidden" name="link" value="51" />
     <input type="hidden" name="menu" value="2" />
     <input type="submit" value="S i m p a n" class="text" /></td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
    </tr>
    <tr>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
     <td >&nbsp;</td>
    </tr>    
  </table>
 
</form>