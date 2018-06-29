<?php
include("../../../include/connect.php");
#print_r($_REQUEST);
$poly	= isset($_REQUEST['poly']) ? $_REQUEST['poly'] : '';
if($poly != ''){
	$carabayar	= ' and CARABAYAR = '.$poly;
}else{
	$carabayar	= ' and CARABAYAR != ""';
}

$sql	= mysql_query('CALL reportCaseMixAll("'.$_REQUEST['tgl_kunjungan'].'","'.$_REQUEST['tgl_kunjungan2'].'")');

#$sql	= mysql_query('select *( from t_billrajal where (TANGGAL between "'.$_REQUEST['tgl_kunjungan'].'" and "'.$_REQUEST['tgl_kunjungan2'].'") '.$carabayar);
if(mysql_num_rows($sql) > 0){
	
	$text		= "Kdrs;Klsrs;Norm;Klsrawat;Biaya;Jnsrawat;Tglmsk;Tglklr;Los;Tgllhr;UmurThn;UmurHari;JK;CaraPlg;Berat;Dutama;D1;D2;D3;D4;D5;D6;D7;D8;D9;D10;D11;D12;D13;D14;D15;D16;D17;D18;D19;D20;D21;D22;D23;D24;D25;D26;D27;D28;D29;P1;P2;P3;P4;P5;P6;P7;P8;P9;P10;P11;P12;P13;P14;P15;P16;P17;P18;P19;P20;P21;P22;P23;P24;P25;P26;P27;P28;P29;P30;Recid;Inacbg;Tarif;Deskripsi;ALOS;NamaPasien;DPJP;SKP;Rujukan;BHP;HargaBHP;PengesahanSL3;C1;C2;C3\r\n";
	while($data	= mysql_fetch_array($sql)){
	#print_r($data);
			$value	= array();
			$value[]	= $KDRS;
			$value[]	= $KelasRS;
			$value[]	= $data['NOMR'];
			$value[]	= "KLSRAWAT";
			$value[]	= $data['TARIFRS'];
			$value[]	= $data['JNSRAWAT'];
			$value[]	= $data['TANGGAL'];
			$value[]	= $data['KELUAR'];
			$value[]	= $data['LOS']; #LOS
			$value[]	= $data['TGLLAHIR'];
			$value[]	= $data['UMUR'];
			$value[]	= $data['UMURHARI'];
			$value[]	= $data['JENISKELAMIN'];
			$value[]	= $data['STATUS'];
			$value[]	= $data['BERAT']; # Berat Badan
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE'])); # Dutama Default 
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE2'])); #D1
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE3'])); #D2
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE4'])); #D3
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE5'])); #D4
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE6'])); #D5
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE7'])); #D6
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE8'])); #D7
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE9'])); #D8
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE10'])); #D9
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE11'])); #D10
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE12'])); #D11
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE13'])); #D12
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE14'])); #D13
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE15'])); #D14
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE16'])); #D15
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE17'])); #D16
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE18'])); #D17
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE19'])); #D18
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE20'])); #D19
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE21'])); #D20
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE22'])); #D21
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE23'])); #D22
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE24'])); #D23
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE25'])); #D24
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE26'])); #D25
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE27'])); #D26
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE28'])); #D27
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE29'])); #D28
			$value[]	= str_replace('*','',str_replace('.','',$data['ICD_CODE30'])); #D29
			$value[]	= str_replace('.','',$data['ICD_9']); #P1
			$value[]	= str_replace('.','',$data['ICD_92']); #P1
			$value[]	= str_replace('.','',$data['ICD_93']); #P1
			$value[]	= str_replace('.','',$data['ICD_94']); #P1
			$value[]	= str_replace('.','',$data['ICD_95']); #P1
			$value[]	= str_replace('.','',$data['ICD_96']); #P1
			$value[]	= str_replace('.','',$data['ICD_97']); #P1
			$value[]	= str_replace('.','',$data['ICD_98']); #P1
			$value[]	= str_replace('.','',$data['ICD_99']); #P1
			$value[]	= str_replace('.','',$data['ICD_910']); #P1
			$value[]	= str_replace('.','',$data['ICD_911']); #P1
			$value[]	= str_replace('.','',$data['ICD_912']); #P1
			$value[]	= str_replace('.','',$data['ICD_913']); #P1
			$value[]	= str_replace('.','',$data['ICD_914']); #P1
			$value[]	= str_replace('.','',$data['ICD_915']); #P1
			$value[]	= str_replace('.','',$data['ICD_916']); #P1
			$value[]	= str_replace('.','',$data['ICD_917']); #P1
			$value[]	= str_replace('.','',$data['ICD_918']); #P1
			$value[]	= str_replace('.','',$data['ICD_919']); #P1
			$value[]	= str_replace('.','',$data['ICD_920']); #P1
			$value[]	= str_replace('.','',$data['ICD_921']); #P1
			$value[]	= str_replace('.','',$data['ICD_922']); #P1
			$value[]	= str_replace('.','',$data['ICD_923']); #P1
			$value[]	= str_replace('.','',$data['ICD_924']); #P1
			$value[]	= str_replace('.','',$data['ICD_925']); #P1
			$value[]	= str_replace('.','',$data['ICD_926']); #P1
			$value[]	= str_replace('.','',$data['ICD_927']); #P1
			$value[]	= str_replace('.','',$data['ICD_928']); #P1
			$value[]	= str_replace('.','',$data['ICD_929']); #P1
			$value[]	= str_replace('.','',$data['ICD_930']); #P1
			$value[]	= ""; # RECID
			$value[]	= ""; # INACBG DEFAULT
			$value[]	= "0";
			$value[]	= "";
			$value[]	= "0"; #ALOS
			$value[]	= $data['NAMA'];
			$value[]	= $data['NAMADOKTER'];#"DOKTER"; #DPJP
			$value[]	= "1^0"; #SKP
			$value[]	= $data['MINTA_RUJUKAN'];
			$value[]	= ""; #BHP
			$value[]	= "0"; #HARGA BHP
			$value[]	= "tidak ada"; #PENGESAHAN
			$value[]	= ""; #C1
			$value[]	= "1";
			$value[]	= ""; #C3
			$tulis		= implode(";",$value);
			$text	.= $tulis."\r\n";
	}
	#echo nl2br($text);
	$filename	=	'casemix/casemix'.date('Y-m-d_H-i-s').'.txt';	
	$Casemix = @fopen($filename, "w");
	fwrite($Casemix,$text);
	fclose($Casemix);
	header('Content-type: application/octet');
	header('Content-disposition: attachment; filename='.$filename);
	header('Content-type: text/plain');
	echo $filename;
}
?>