<?php
    error_reporting( 'E_ALL' );
    session_start(  );
    include( '../include/connect.php' );

    echo '<html>
<head>';

    echo '<script type="text/javascript" src="'._BASE_.'/include/jquery-1.4.js"></script>';
    echo '<script type=\'text/javascript\' src="'._BASE_.'/include/jquery.autocomplete.js"></script>
    <link rel="stylesheet" type="text/css" href="'._BASE_.'/include/jquery.autocomplete.css" />';


    echo '<script type="text/javascript">
      $(document).ready(function() {
      $("#tbl_reg1").hide();

      cari();
        $(".tr_s:odd").addClass("ganjil");
        $(".tr_s:even").addClass("genap");
        $(".tr_p:odd").addClass("ganjil1");
        $(".tr_p:even").addClass("genap1");
        $("th").parent().addClass("tbheading");
        });  
    </script>';
    

    echo '<script type="text/javascript">
    function entri(){
        $("#file_xml").hide();
        $("#tbl_reg1").show();
    }


    function hitung(){
        document.getElementById(\'total\').disabled=true;
        document.getElementById(\'total\').backgroundColor=\'#ccccc\';
        document.getElementById(\'total\').value=eval(document.getElementById(\'svip\'';
    echo ').value)+eval(document.getElementById(\'vip\').value)+eval(document.getElementById(\'kls_1\').value)+eval(document.getElementById(\'kls_2\').value)+eval(document.getElementById(\'kls_3\').value)+eval(document.getElementById(\'non_kelas\').value);
                }

    </script>';



    echo '<script type="text/javascript">
   function cek(){
document.getElementById(\'svip\').value=0;
document.getElementById(\'vip\').value=0;
document.getElementById(\'kls_1\').value=0;
document.getElementById(\'kls_2\').value=0;
document.getElementById(\'kls_3\').value=0;
document.getElementById(\'non_kelas\').value=0;
document.getElementById(\'total\').value=0;
}
</script>
';



 echo '<script>
function cari(){
$.post(\'rm/ambildata_rl310.php\',
            {   \'reqdata\'   :\'cari_rl310\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'smstr\'     :$(\'#smstr\').val(),
                            \'tahun\'     :$(\'#tahun\').val(),
                        
                        },
            function (data) {
                $(\'#hasil\').html(data);
            }
            );

};
</script>';




echo '<script>
function get_xml(){
$("#tbl_reg1").hide();
$.post(\'rm/ambildata_rl310.php\',
            {   \'reqdata\'   :\'xml_rl310\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'smstr\'     :$(\'#smstr\').val(),
                            \'tahun\'     :$(\'#tahun\').val(),
                        
                        },
            function (data) {
                $(\'#hasil\').html(data);
            }
            );

};
</script>';



    echo '<script>
function cancel(){
window.location.replace("'._BASE_.'index.php?link=rl310");
}
</script>';



    echo '<style>
        #tbl_rs {   width:1220px;
                    
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
                    border: 1px solid gray; 
                    border-bottom:3px solid grey;
                    border-right:3px solid grey;
                    border-spacing:0px; 
                    padding:3px
                    }
   ';
    echo '     #tbl_reg {   
                    width:1024px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
                    border: 1px solid gray;
                    
                    }
         #tbl_reg1 {    
                    width:1024px;
                    border-collapse:collapse; 
                    background-color:white;
                    fo';
    echo 'nt: 12px verdana; 
                    
                    
                    }           
                    
        #tbl_reg2 { 
                    width:650px;
                    border-collapse:collapse; 
                    background-color:white;
                    font: 12px verdana; 
                    border: 1px solid gray;
                    
                    }
    
        td      {   padding:5px;}
        .td_d{padding-left:50px}
        #tr_d{
        backgro';
    echo 'und : #39b54a;
        BORDER-TOP: 1px solid grey;"}
    
        
        
                        
        .rest{ font:10px; color:red;}
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
      background-color:#39b54a; /* baris ganjil berwarna hijau muda */ 
    }
    .genap { 
      background-color:#FFFFFF; /* baris genap berwarna hijau tua */ 
    }
    .ganjil1 { 
      background-color:#FFFFFF; /* baris ganjil berwarna hijau muda */ 
    }
    .genap1 { 
      background-color:#39b54a; /* baris genap berwarna hijau tua */ 
    }   
    .tbheadin';
    echo 'g { 
      background-color:#f1fe1b; 
     
      /* baris genap berwarna hijau tua */ } 
       
    </style>
</head>

<body bgcolor="#fff">

<div id="frame">
    <div id="frame_title"><h3>Laporan RL 3.10</h3></div>

<div align="center">

<table width="800" height="auto" bgcolor="#FFFFFF" style="border:1px solid #eae7e7" align=\'center\' id=\'tbl_rs\'>
<tr class=\'tr_s\'><td colspan=2><table id=\'tbl_reg\' name=\'tbl_reg\'>
<tr class=\'tr_s\'><td colspan=6>';
    echo '<font color="white"><strong>Periode :</strong></font></td></tr>
<tr class=\'tr_s\'><td class=\'td_d\'>Semester :</td><td><input type=\'hidden\' name=\'koders\' id=\'koders\' disabled value=\'';
    echo $kode_rs;
    echo '\'><input type=\'hidden\' id=\'kode\' name=\'kode\' value="';
    echo '' . $kode;
    echo '"><input type=\'hidden\' id=\'smt1\' name=\'smt1\' value="';
    echo '' . $smt;
    echo '">';
    echo '<select id=\'smstr\' name=\'smstr\' onChange=\'cari()\'>
<option value=""></option>
<option value=I ';

    if ($smstr  == 'I') {
        echo 'selected="selected"';
    }

    echo '>I</option>
<option value=II ';

    if ($smstr  == 'II') {
        echo 'selected="selected"';
    }

    echo '>II</option>
</select>
</td>
<td class=\'td_d\'>Tahun :</td><td><input type=\'hidden\' id=\'tahun1\' name=\'tahun1\' value="';
    echo '' . $tahun;
    echo '">';
    echo '<s';
    echo 'elect id=\'tahun\' name=\'tahun\'  onChange=\'cari()\'>
<option value=""></option>
<option value="2014" ';

    if ($tahun  == '2014') {
        echo 'selected="selected"';
    }

    echo '>2014</option>
<option value="2015" ';

    if ($tahun  == '2015') {
        echo 'selected="selected"';
    }

    echo '>2015</option>
<option value="2016" ';

    if ($tahun  == '2016') {
        echo 'selected="selected"';
    }

    echo '>2016</option>
<option value="2017" ';

    if ($tahun  == '2017') {
        echo 'selected="selected"';
    }

    echo '>2017</option>
<option value="2018" ';

    if ($tahun  == '2018') {
        echo 'selected="selected"';
    }

    echo '>2018</option>
<option value="2019" ';

    if ($tahun  == '2019') {
        echo 'selected="selected"';
    }

    echo '>2019</option>
</select>
</td>

<!--<td class=\'td_d\'>Jumlah Hari 1 Periode :</td>
<td class=\'td_d\'><input type=\'text\' id=\'j_hari\' name=\'j_hari\' value="';
    echo '' . $row_x['j_hari'];
    echo '" size=3 onchange=\'hitung()\' ></td>-->
</tr>
</table>

<div id=\'entri\'>
    <input type=\'button\' id=\'input\' value=\'Buat File Laporan\' onclick=\'get_xml()\'>
</div>

<tr>
    <td colspan=2>
        <div id=\'hasil\'></div>
    </td>
</tr>
</table>


</body>


</html>';
?>