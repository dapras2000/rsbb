<?
include("../include/connect.php");
$tgl=$_POST['tgl'];
$wkt=$_POST['waktu'];
$t1=$_POST['t1'];
$t2=$_POST['t2'];
$t3=$_POST['t3'];
$t4=$_POST['t4'];
$t5=$_POST['t5'];
$t6=$_POST['t6'];
$t7=$_POST['t7'];
$t8=$_POST['t8'];
$t9=$_POST['t9'];
$t10=$_POST['t10'];
$t11=$_POST['t11'];
$t12=$_POST['t12'];
$t13=$_POST['t13'];
$t14=$_POST['t14'];
$t15=$_POST['t15'];
$t16=$_POST['t16'];
$t17=$_POST['t17'];
$t18=$_POST['t18'];
$t19=$_POST['t19'];
$t20=$_POST['t20'];
$t21=$_POST['t21'];
$t22=$_POST['t22'];
$t23=$_POST['t23'];
$t24=$_POST['t24'];
$t25=$_POST['t25'];
$t26=$_POST['t26'];
$t27=$_POST['t27'];
$t28=$_POST['t28'];
$t29=$_POST['t29'];
$t30=$_POST['t30'];
$t31=$_POST['t31'];
$tgl=$_POST['tglbaru'];

for($i=0;$i<count($t1);$i++) {
    if ($t1[$i] <> '') {
        $q="select * from t_jadwaldokter where iddokter='".$t1[$i]."' and tanggal='".$tgl."'";
        $hasil=mysql_query($q);
        $jml1=mysql_num_rows($hasil);
        if ($jml1>0) {
            $update1="update t_jadwaldokter SET t1='".$wkt."' where iddokter='".$t1[$i]."' and tanggal='".$tgl."'";
            mysql_query($update1);
        }
        else {
            $insert1="insert into t_jadwaldokter values('','".$t1[$i]."','".$tgl."','".$wkt."',
		'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','')";
            mysql_query($insert1);
        }

    }
}

//dua
for($i2=0;$i2<count($t2);$i2++) {
    if ($t2[$i2] <> '') {
        $q2="select * from t_jadwaldokter where iddokter='".$t2[$i2]."' and tanggal='".$tgl."'";
        $hasil2=mysql_query($q2);
        $jml2=mysql_num_rows($hasil2);
        if ($jml2>0) {
            $update2="update t_jadwaldokter SET t2='".$wkt."' where iddokter='".$t2[$i2]."' and tanggal='".$tgl."'";
            mysql_query($update2);
        }
        else {
            $insert2="insert into t_jadwaldokter values('','".$t2[$i2]."','".$tgl."','',
		'".$wkt."','','','','','','','','','','','','','','','','','','','','','','','','','','','','','')";
            mysql_query($insert2);
        }
    }
}


for($i3=0;$i3<count($t3);$i3++) {
    if ($t3[$i3] <> '') {
        $q3="select * from t_jadwaldokter where iddokter='".$t3[$i3]."' and tanggal='".$tgl."'";
        $hasil3=mysql_query($q3);
        $jml3=mysql_num_rows($hasil3);
        if ($jml3>0) {
            $update3="update t_jadwaldokter SET t3='".$wkt."' where iddokter='".$t3[$i3]."' and tanggal='".$tgl."'";
            mysql_query($update3);
        }
        else {
            $insert3="insert into t_jadwaldokter values('','".$t3[$i3]."','".$tgl."','',
		'','".$wkt."','','','','','','','','','','','','','','','','','','','','','','','','','','','','')";
            mysql_query($insert3);
        }
    }
}

for($i4=0;$i4<count($t4);$i4++) {
    if ($t4[$i4] <> '') {
        $q4="select * from t_jadwaldokter where iddokter='".$t4[$i4]."' and tanggal='".$tgl."'";
        $hasil4=mysql_query($q4);
        $jml4=mysql_num_rows($hasil4);
        if ($jml4>0) {
            $update4="update t_jadwaldokter SET t4='".$wkt."' where iddokter='".$t4[$i4]."' and tanggal='".$tgl."'";
            mysql_query($update4);
        }
        else {
            $insert4="insert into t_jadwaldokter values('','".$t4[$i4]."','".$tgl."','',
		'','','".$wkt."','','','','','','','','','','','','','','','','','','','','','','','','','','','')";
            mysql_query($insert4);
        }
    }
}

for($i5=0;$i5<count($t5);$i5++) {
    if ($t5[$i5] <> '') {
        $q5="select * from t_jadwaldokter where iddokter='".$t5[$i5]."' and tanggal='".$tgl."'";
        $hasil5=mysql_query($q5);
        $jml5=mysql_num_rows($hasil5);
        if ($jml5>0) {
            $update5="update t_jadwaldokter SET t5='".$wkt."' where iddokter='".$t5[$i5]."' and tanggal='".$tgl."'";
            mysql_query($update5);
        }
        else {
            $insert5="insert into t_jadwaldokter values('','".$t5[$i5]."','".$tgl."','',
		'','','','".$wkt."','','','','','','','','','','','','','','','','','','','','','','','','','','')";
            mysql_query($insert5);
        }
    }
}

for($i6=0;$i6<count($t6);$i6++) {
    if ($t6[$i6] <> '') {
        $q6="select * from t_jadwaldokter where iddokter='".$t6[$i6]."' and tanggal='".$tgl."'";
        $hasil6=mysql_query($q6);
        $jml6=mysql_num_rows($hasil6);
        if ($jml6>0) {
            $update6="update t_jadwaldokter SET t6='".$wkt."' where iddokter='".$t6[$i6]."' and tanggal='".$tgl."'";
            mysql_query($update6);
        }
        else {
            $insert6="insert into t_jadwaldokter values('','".$t6[$i6]."','".$tgl."','',
		'','','','','".$wkt."','','','','','','','','','','','','','','','','','','','','','','','','','')";
            mysql_query($insert6);
        }
    }
}

for($i7=0;$i7<count($t7);$i7++) {
    if ($t7[$i7] <> '') {
        $q7="select * from t_jadwaldokter where iddokter='".$t7[$i7]."' and tanggal='".$tgl."'";
        $hasil7=mysql_query($q7);
        $jml7=mysql_num_rows($hasil7);
        if ($jml7>0) {
            $update7="update t_jadwaldokter SET t7='".$wkt."' where iddokter='".$t7[$i7]."' and tanggal='".$tgl."'";
            mysql_query($update7);
        }
        else {
            $insert7="insert into t_jadwaldokter values('','".$t7[$i7]."','".$tgl."','',
		'','','','','','".$wkt."','','','','','','','','','','','','','','','','','','','','','','','','')";
            mysql_query($insert7);
        }
    }
}
for($i8=0;$i8<count($t8);$i8++) {
    if ($t8[$i8] <> '') {
        $q8="select * from t_jadwaldokter where iddokter='".$t8[$i8]."' and tanggal='".$tgl."'";
        $hasil8=mysql_query($q8);
        $jml8=mysql_num_rows($hasil8);
        if ($jml8>0) {
            $update8="update t_jadwaldokter SET t8='".$wkt."' where iddokter='".$t8[$i8]."' and tanggal='".$tgl."'";
            mysql_query($update8);
        }
        else {
            $insert8="insert into t_jadwaldokter values('','".$t8[$i8]."','".$tgl."','',
		'','','','','','','".$wkt."','','','','','','','','','','','','','','','','','','','','','','','')";
            mysql_query($insert8);
        }
    }
}
for($i9=0;$i9<count($t9);$i9++) {
    if ($t9[$i9] <> '') {
        $q9="select * from t_jadwaldokter where iddokter='".$t9[$i9]."' and tanggal='".$tgl."'";
        $hasil9=mysql_query($q9);
        $jml9=mysql_num_rows($hasil9);
        if ($jml9>0) {
            $update9="update t_jadwaldokter SET t9='".$wkt."' where iddokter='".$t9[$i9]."' and tanggal='".$tgl."'";
            mysql_query($update9);
        }else {
            $insert9="insert into t_jadwaldokter values('','".$t9[$i9]."','".$tgl."','',
		'','','','','','','','".$wkt."','','','','','','','','','','','','','','','','','','','','','','')";
            mysql_query($insert9);
        }
    }

}


for($i10=0;$i10<count($t10);$i10++) {
    if ($t10[$i10] <> '') {
        $q10="select * from t_jadwaldokter where iddokter='".$t10[$i10]."' and tanggal='".$tgl."'";
        $hasil10=mysql_query($q10);
        $jml10=mysql_num_rows($hasil10);
        if ($jml10>0) {
            $update10="update t_jadwaldokter SET t10='".$wkt."' where iddokter='".$t10[$i10]."' and tanggal='".$tgl."'";
            mysql_query($update10);
        }else {
            $insert10="insert into t_jadwaldokter values('','".$t10[$i10]."','".$tgl."','',
		'','','','','','','','','".$wkt."','','','','','','','','','','','','','','','','','','','','','')";
            mysql_query($insert10);
        }
    }

}

for($i11=0;$i11<count($t11);$i11++) {
    if ($t11[$i11] <> '') {
        $q11="select * from t_jadwaldokter where iddokter='".$t11[$i11]."' and tanggal='".$tgl."'";
        $hasil11=mysql_query($q11);
        $jml11=mysql_num_rows($hasil11);
        if ($jml11>0) {
            $update11="update t_jadwaldokter SET t11='".$wkt."' where iddokter='".$t11[$i11]."' and tanggal='".$tgl."'";
            mysql_query($update11);
        }else {
            $insert11="insert into t_jadwaldokter values('','".$t11[$i11]."','".$tgl."','',
		'','','','','','','','','','".$wkt."','','','','','','','','','','','','','','','','','','','','')";
            mysql_query($insert11);
        }
    }

}


for($i12=0;$i12<count($t12);$i12++) {
    if ($t12[$i12] <> '') {
        $q12="select * from t_jadwaldokter where iddokter='".$t12[$i12]."' and tanggal='".$tgl."'";
        $hasil12=mysql_query($q12);
        $jml12=mysql_num_rows($hasil12);
        if ($jml12>0) {
            $update12="update t_jadwaldokter SET t12='".$wkt."' where iddokter='".$t12[$i12]."' and tanggal='".$tgl."'";
            mysql_query($update12);
        }else {
            $insert12="insert into t_jadwaldokter values('','".$t12[$i12]."','".$tgl."','',
		'','','','','','','','','','','".$wkt."','','','','','','','','','','','','','','','','','','','')";
            mysql_query($insert12);
        }
    }

}

for($i13=0;$i13<count($t13);$i13++) {
    if ($t13[$i13] <> '') {
        $q13="select * from t_jadwaldokter where iddokter='".$t13[$i13]."' and tanggal='".$tgl."'";
        $hasil13=mysql_query($q13);
        $jml13=mysql_num_rows($hasil13);
        if ($jml13>0) {
            $update13="update t_jadwaldokter SET t13='".$wkt."' where iddokter='".$t13[$i13]."' and tanggal='".$tgl."'";
            mysql_query($update13);
        }else {
            $insert13="insert into t_jadwaldokter values('','".$t13[$i13]."','".$tgl."','',
		'','','','','','','','','','','','".$wkt."','','','','','','','','','','','','','','','','','','')";
            mysql_query($insert13);
        }
    }

}


for($i14=0;$i14<count($t14);$i14++) {
    if ($t14[$i14] <> '') {
        $q14="select * from t_jadwaldokter where iddokter='".$t14[$i14]."' and tanggal='".$tgl."'";
        $hasil14=mysql_query($q14);
        $jml14=mysql_num_rows($hasil14);
        if ($jml14>0) {
            $update14="update t_jadwaldokter SET t14='".$wkt."' where iddokter='".$t14[$i14]."' and tanggal='".$tgl."'";
            mysql_query($update14);
        }else {
            $insert14="insert into t_jadwaldokter values('','".$t14[$i14]."','".$tgl."','',
		'','','','','','','','','','','','','".$wkt."','','','','','','','','','','','','','','','','','')";
            mysql_query($insert14);
        }
    }

}


for($i15=0;$i15<count($t15);$i15++) {
    if ($t15[$i15] <> '') {
        $q15="select * from t_jadwaldokter where iddokter='".$t15[$i15]."' and tanggal='".$tgl."'";
        $hasil15=mysql_query($q15);
        $jml15=mysql_num_rows($hasil15);
        if ($jml15>0) {
            $update15="update t_jadwaldokter SET t15='".$wkt."' where iddokter='".$t15[$i15]."' and tanggal='".$tgl."'";
            mysql_query($update15);
        }else {
            $insert15="insert into t_jadwaldokter values('','".$t15[$i15]."','".$tgl."','',
		'','','','','','','','','','','','','','".$wkt."','','','','','','','','','','','','','','','','')";
            mysql_query($insert15);
        }
    }

}


for($i16=0;$i16<count($t16);$i16++) {
    if ($t16[$i16] <> '') {
        $q16="select * from t_jadwaldokter where iddokter='".$t16[$i16]."' and tanggal='".$tgl."'";
        $hasil16=mysql_query($q16);
        $jml16=mysql_num_rows($hasil16);
        if ($jml16>0) {
            $update16="update t_jadwaldokter SET t16='".$wkt."' where iddokter='".$t16[$i16]."' and tanggal='".$tgl."'";
            mysql_query($update16);
        }else {
            $insert16="insert into t_jadwaldokter values('','".$t16[$i16]."','".$tgl."','',
		'','','','','','','','','','','','','','','".$wkt."','','','','','','','','','','','','','','','')";
            mysql_query($insert16);
        }
    }

}

for($i17=0;$i17<count($t17);$i17++) {
    if ($t17[$i17] <> '') {
        $q17="select * from t_jadwaldokter where iddokter='".$t17[$i17]."' and tanggal='".$tgl."'";
        $hasil17=mysql_query($q17);
        $jml17=mysql_num_rows($hasil17);
        if ($jml17>0) {
            $update17="update t_jadwaldokter SET t17='".$wkt."' where iddokter='".$t17[$i17]."' and tanggal='".$tgl."'";
            mysql_query($update17);
        }else {
            $insert17="insert into t_jadwaldokter values('','".$t17[$i17]."','".$tgl."','',
		'','','','','','','','','','','','','','','','".$wkt."','','','','','','','','','','','','','','')";
            mysql_query($insert17);
        }
    }

}


for($i18=0;$i18<count($t18);$i18++) {
    if ($t18[$i18] <> '') {
        $q18="select * from t_jadwaldokter where iddokter='".$t18[$i18]."' and tanggal='".$tgl."'";
        $hasil18=mysql_query($q18);
        $jml18=mysql_num_rows($hasil18);
        if ($jml18>0) {
            $update18="update t_jadwaldokter SET t18='".$wkt."' where iddokter='".$t18[$i18]."' and tanggal='".$tgl."'";
            mysql_query($update18);
        }else {
            $insert18="insert into t_jadwaldokter values('','".$t18[$i18]."','".$tgl."','',
		'','','','','','','','','','','','','','','','','".$wkt."','','','','','','','','','','','','','')";
            mysql_query($insert18);
        }
    }

}


for($i19=0;$i19<count($t19);$i19++) {
    if ($t19[$i19] <> '') {
        $q19="select * from t_jadwaldokter where iddokter='".$t19[$i19]."' and tanggal='".$tgl."'";
        $hasil19=mysql_query($q19);
        $jml19=mysql_num_rows($hasil19);
        if ($jml19>0) {
            $update19="update t_jadwaldokter SET t19='".$wkt."' where iddokter='".$t19[$i19]."' and tanggal='".$tgl."'";
            mysql_query($update19);
        }else {
            $insert19="insert into t_jadwaldokter values('','".$t19[$i19]."','".$tgl."','',
		'','','','','','','','','','','','','','','','','','".$wkt."','','','','','','','','','','','','')";
            mysql_query($insert19);
        }
    }

}


for($i20=0;$i20<count($t20);$i20++) {
    if ($t20[$i20] <> '') {
        $q20="select * from t_jadwaldokter where iddokter='".$t20[$i20]."' and tanggal='".$tgl."'";
        $hasil20=mysql_query($q20);
        $jml20=mysql_num_rows($hasil20);
        if ($jml20>0) {
            $update20="update t_jadwaldokter SET t20='".$wkt."' where iddokter='".$t20[$i20]."' and tanggal='".$tgl."'";
            mysql_query($update20);
        }else {
            $insert20="insert into t_jadwaldokter values('','".$t20[$i20]."','".$tgl."','',
		'','','','','','','','','','','','','','','','','','','".$wkt."','','','','','','','','','','','')";
            mysql_query($insert20);
        }
    }

}


for($i21=0;$i21<count($t21);$i21++) {
    if ($t21[$i21] <> '') {
        $q21="select * from t_jadwaldokter where iddokter='".$t21[$i21]."' and tanggal='".$tgl."'";
        $hasil21=mysql_query($q21);
        $jml21=mysql_num_rows($hasil21);
        if ($jml21>0) {
            $update21="update t_jadwaldokter SET t21='".$wkt."' where iddokter='".$t21[$i21]."' and tanggal='".$tgl."'";
            mysql_query($update21);
        }else {
            $insert21="insert into t_jadwaldokter values('','".$t21[$i21]."','".$tgl."','',
		'','','','','','','','','','','','','','','','','','','','".$wkt."','','','','','','','','','','')";
            mysql_query($insert21);
        }
    }

}

for($i22=0;$i22<count($t22);$i22++) {
    if ($t22[$i22] <> '') {
        $q22="select * from t_jadwaldokter where iddokter='".$t22[$i22]."' and tanggal='".$tgl."'";
        $hasil22=mysql_query($q22);
        $jml22=mysql_num_rows($hasil22);
        if ($jml22>0) {
            $update22="update t_jadwaldokter SET t22='".$wkt."' where iddokter='".$t22[$i22]."' and tanggal='".$tgl."'";
            mysql_query($update22);
        }else {
            $insert22="insert into t_jadwaldokter values('','".$t22[$i22]."','".$tgl."','',
		'','','','','','','','','','','','','','','','','','','','','".$wkt."','','','','','','','','','')";
            mysql_query($insert22);
        }
    }

}

for($i23=0;$i23<count($t23);$i23++) {
    if ($t23[$i23] <> '') {
        $q23="select * from t_jadwaldokter where iddokter='".$t23[$i23]."' and tanggal='".$tgl."'";
        $hasil23=mysql_query($q23);
        $jml23=mysql_num_rows($hasil23);
        if ($jml23>0) {
            $update23="update t_jadwaldokter SET t23='".$wkt."' where iddokter='".$t23[$i23]."' and tanggal='".$tgl."'";
            mysql_query($update23);
        }else {
            $insert23="insert into t_jadwaldokter values('','".$t23[$i23]."','".$tgl."','',
		'','','','','','','','','','','','','','','','','','','','','','".$wkt."','','','','','','','','')";
            mysql_query($insert23);
        }
    }

}

for($i24=0;$i24<count($t24);$i24++) {
    if ($t24[$i24] <> '') {
        $q24="select * from t_jadwaldokter where iddokter='".$t24[$i24]."' and tanggal='".$tgl."'";
        $hasil24=mysql_query($q24);
        $jml24=mysql_num_rows($hasil24);
        if ($jml24>0) {
            $update24="update t_jadwaldokter SET t24='".$wkt."' where iddokter='".$t24[$i24]."' and tanggal='".$tgl."'";
            mysql_query($update24);
        }else {
            $insert24="insert into t_jadwaldokter values('','".$t24[$i24]."','".$tgl."','',
		'','','','','','','','','','','','','','','','','','','','','','','".$wkt."','','','','','','','')";
            mysql_query($insert24);
        }
    }

}

for($i25=0;$i25<count($t25);$i25++) {
    if ($t25[$i25] <> '') {
        $q25="select * from t_jadwaldokter where iddokter='".$t25[$i25]."' and tanggal='".$tgl."'";
        $hasil25=mysql_query($q25);
        $jml25=mysql_num_rows($hasil25);
        if ($jml25>0) {
            $update25="update t_jadwaldokter SET t25='".$wkt."' where iddokter='".$t25[$i25]."' and tanggal='".$tgl."'";
            mysql_query($update25);
        }else {
            $insert25="insert into t_jadwaldokter values('','".$t25[$i25]."','".$tgl."','',
		'','','','','','','','','','','','','','','','','','','','','','','','".$wkt."','','','','','','')";
            mysql_query($insert25);
        }
    }

}

for($i26=0;$i26<count($t26);$i26++) {
    if ($t26[$i26] <> '') {
        $q26="select * from t_jadwaldokter where iddokter='".$t26[$i26]."' and tanggal='".$tgl."'";
        $hasil26=mysql_query($q26);
        $jml26=mysql_num_rows($hasil26);
        if ($jml26>0) {
            $update26="update t_jadwaldokter SET t26='".$wkt."' where iddokter='".$t26[$i26]."' and tanggal='".$tgl."'";
            mysql_query($update26);
        }else {
            $insert26="insert into t_jadwaldokter values('','".$t26[$i26]."','".$tgl."','',
		'','','','','','','','','','','','','','','','','','','','','','','','','".$wkt."','','','','','')";
            mysql_query($insert26);
        }
    }

}

for($i27=0;$i27<count($t27);$i27++) {
    if ($t27[$i27] <> '') {
        $q27="select * from t_jadwaldokter where iddokter='".$t27[$i27]."' and tanggal='".$tgl."'";
        $hasil27=mysql_query($q27);
        $jml27=mysql_num_rows($hasil27);
        if ($jml27>0) {
            $update27="update t_jadwaldokter SET t27='".$wkt."' where iddokter='".$t27[$i27]."' and tanggal='".$tgl."'";
            mysql_query($update27);
        }else {
            $insert27="insert into t_jadwaldokter values('','".$t27[$i27]."','".$tgl."','',
		'','','','','','','','','','','','','','','','','','','','','','','','','','".$wkt."','','','','')";
            mysql_query($insert27);
        }
    }

}

for($i28=0;$i28<count($t28);$i28++) {
    if ($t28[$i28] <> '') {
        $q28="select * from t_jadwaldokter where iddokter='".$t28[$i28]."' and tanggal='".$tgl."'";
        $hasil28=mysql_query($q28);
        $jml28=mysql_num_rows($hasil28);
        if ($jml28>0) {
            $update28="update t_jadwaldokter SET t28='".$wkt."' where iddokter='".$t28[$i28]."' and tanggal='".$tgl."'";
            mysql_query($update28);
        }else {
            $insert28="insert into t_jadwaldokter values('','".$t28[$i28]."','".$tgl."','',
		'','','','','','','','','','','','','','','','','','','','','','','','','','','".$wkt."','','','')";
            mysql_query($insert28);
        }
    }

}

for($i29=0;$i29<count($t29);$i29++) {
    if ($t29[$i29] <> '') {
        $q29="select * from t_jadwaldokter where iddokter='".$t29[$i29]."' and tanggal='".$tgl."'";
        $hasil29=mysql_query($q29);
        $jml29=mysql_num_rows($hasil29);
        if ($jml29>0) {
            $update29="update t_jadwaldokter SET t29='".$wkt."' where iddokter='".$t29[$i29]."' and tanggal='".$tgl."'";
            mysql_query($update29);
        }else {
            $insert29="insert into t_jadwaldokter values('','".$t29[$i29]."','".$tgl."','',
		'','','','','','','','','','','','','','','','','','','','','','','','','','','','".$wkt."','','')";
            mysql_query($insert29);
        }
    }

}

for($i30=0;$i30<count($t30);$i30++) {
    if ($t30[$i30] <> '') {
        $q30="select * from t_jadwaldokter where iddokter='".$t30[$i30]."' and tanggal='".$tgl."'";
        $hasil30=mysql_query($q30);
        $jml30=mysql_num_rows($hasil30);
        if ($jml30>0) {
            $update30="update t_jadwaldokter SET t30='".$wkt."' where iddokter='".$t30[$i30]."' and tanggal='".$tgl."'";
            mysql_query($update30);
        }else {
            $insert30="insert into t_jadwaldokter values('','".$t30[$i30]."','".$tgl."','',
		'','','','','','','','','','','','','','','','','','','','','','','','','','','','','".$wkt."','')";
            mysql_query($insert30);
        }
    }

}

for($i31=0;$i31<count($t31);$i31++) {
    if ($t31[$i31] <> '') {
        $q31="select * from t_jadwaldokter where iddokter='".$t31[$i31]."' and tanggal='".$tgl."'";
        $hasil31=mysql_query($q31);
        $jml31=mysql_num_rows($hasil31);
        if ($jml31>0) {
            $update31="update t_jadwaldokter SET t31='".$wkt."' where iddokter='".$t31[$i31]."' and tanggal='".$tgl."'";
            mysql_query($update31);
        }else {
            $insert31="insert into t_jadwaldokter values('','".$t31[$i31]."','".$tgl."','',
		'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','".$wkt."')";
            mysql_query($insert31);
        }
    }

}


?>

<script language="JavaScript">
    alert("Data Telah Disimpan.");
    window.location="./index.php?link=jdoc2";
</script>