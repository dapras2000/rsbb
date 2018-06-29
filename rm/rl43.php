<?php
    error_reporting( 'E_ALL' );
    session_start(  );
    include( '../include/connect.php' );

    $kode = $_GET[id];
    $smt = $_GET[smt];
    $koders = $_GET[koders];
    $tahun = $_GET[tahun];
    $bln = $_GET[bln];
    $kode_rs = $KDRS;

	$sql_x = '' . 'select a.code_list,b.concate,b.description,a.0_6l as l6,a.0_6p as p6,a.7_28l as l28,a.7_28p as p28,a.29h_1thl as l1th,a.29h_1thp as p1th,a.1th_4thl as l4th,a.1th_4thp as p4th,a.5th_14thl as l14th,a.5th_14thp as p14th,a.15th_24thl as l24th,a.15th_24thp as p24th,a.25th_44thl as l44th,a.25th_44thp as p44th,a.45th_64thl as l64th,a.45th_64thp as p64th,a.65thl as l65th,a.65thp as p65th from rl43 a left join m_rl43 b on b.code_list=a.code_list where a.code_list= \'' . $kode . '\' and a.bulan=\'' . $bln . '\' and a.tahun=\'' . $tahun . '\'';
	
	$hasil_x = mysql_query( $sql_x );
	
	$row_x = mysql_fetch_array( $hasil_x );
	$total_l = $row_x[l6] & $row_x[l28] & $row_x[l1th] & $row_x[l4th] & $row_x[l14th] & $row_x[l24th] & $row_x[l44th] & $row_x[l64th] & $row_x[l65th];
	$total_p = $row_x[p6] & $row_x[p28] & $row_x[p1th] & $row_x[p4th] & $row_x[p14th] & $row_x[p24th] & $row_x[p44th] & $row_x[p64th] & $row_x[p65th];
	$total_all = $total_l & $total_p;
echo '<html>
<html>';

echo '<script type="text/javascript" src="'._BASE_.'/include/jquery-1.4.js"></script>';
echo '<script type=\'text/javascript\' src="'._BASE_.'/include/jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="'._BASE_.'/include/jquery.autocomplete.css" />';


	echo '<script type="text/javascript">
      $(document).ready(function() {
		$("#tbl_reg1").hide();
		$("#file_xml").hide();
		cari();
   	  $(".tr_s:odd").addClass("ganjil");
        $(".tr_s:even").addClass("genap");
		$(".tr_p:odd").addClass("ganjil1");
        $(".tr_p:even").addClass("genap1");
        $("th").parent().addClass("tbheading");';
	echo '
      });  
    </script>';

	echo '<script type="text/javascript">
	function entri(){
	 $("#tbl_reg1").show();
	  $("#entri").hide();
	  $("#file_xml").hide();
	cek2();
	 }

	function update(){
	
	 $("#tbl_reg1").show();
	  $("#entri").hide();
	  
	}

	function hitung(){
		document.getElementById(\'t1\').disabled=true;
		document.getElementById(\'t1\').backgroundColor=\'#ccccc\';
		document.getElementById(\'t1\').value=eval(document.getElementById(\'l1\'';
	echo ').value)+eval(document.getElementById(\'l2\').value)+eval(document.getElementById(\'l3\').value)+eval(document.getElementById(\'l4\').value)+eval(document.getElementById(\'l5\').value)+eval(document.getElementById(\'l6\').value)+eval(document.getElementById(\'l7\').value)+eval(document.getElementById(\'l8\').value)+eval(document.getElementById(\'l9\').value);
		hitung3();
				}
	function hitung2(){
		document';
	echo '.getElementById(\'t2\').disabled=true;
		document.getElementById(\'t2\').backgroundColor=\'#ccccc\';
		document.getElementById(\'t2\').value=eval(document.getElementById(\'p1\').value)+eval(document.getElementById(\'p2\').value)+eval(document.getElementById(\'p3\').value)+eval(document.getElementById(\'p4\').value)+eval(document.getElementById(\'p5\').value)+eval(document.getElementById(\'p6\').value)+eval(document';
	echo '.getElementById(\'p7\').value)+eval(document.getElementById(\'p8\').value)+eval(document.getElementById(\'p9\').value);
		hitung3();
				}
	function hitung3(){
		document.getElementById(\'t3\').disabled=true;
		document.getElementById(\'t3\').backgroundColor=\'#ccccc\';
		document.getElementById(\'t3\').value=eval(document.getElementById(\'t1\').value)+eval(document.getElementById(\'t2\').value);
		}
	</scri';
	echo 'pt>
	

	';
	echo '<s';
	echo 'cript type="text/javascript">
$().ready(function() {	
	$("#dtd").autocomplete("proses4.php", {
		width: 150
  });

	$(dtd).result(function(event, data, formatted) {
				$(\'#dtd\').val(data); 
	});
	
});
</script>

';
	echo '<s';
	echo 'cript type="text/javascript">
   function cek(){
document.getElementById(\'l1\').value=0;
document.getElementById(\'l2\').value=0;
document.getElementById(\'l3\').value=0;
document.getElementById(\'l4\').value=0;
document.getElementById(\'l5\').value=0;
document.getElementById(\'l6\').value=0;
document.getElementById(\'l7\').value=0;
document.getElementById(\'l8\').value=0;
document.getElementById(\'l9\')';
	echo '.value=0;
document.getElementById(\'p1\').value=0;
document.getElementById(\'p2\').value=0;
document.getElementById(\'p3\').value=0;
document.getElementById(\'p4\').value=0;
document.getElementById(\'p5\').value=0;
document.getElementById(\'p6\').value=0;
document.getElementById(\'p7\').value=0;
document.getElementById(\'p8\').value=0;
document.getElementById(\'p9\').value=0;
document.getElementById(\'t1\')';
	echo '.value=0;
document.getElementById(\'t2\').value=0;
document.getElementById(\'t3\').value=0;
document.getElementById(\'dtd1\').value="";
lst();
}

</script>
';
	echo '<s';
	echo 'cript>
   function cari(){
$.post(\'ambildata.php\',
			{   \'reqdata\'   :\'cari_rl43\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'bln\'     :$(\'#bln\').val(),
							\'tahun\'     :$(\'#tahun\').val(),
						
                        },
			function (data) {
				$(\'#hasil\').html(data);
			}
			);

};
  function lst(){
 $.post(\'ambildata.php\',
';
	echo '			{   \'reqdata\'   :\'cari_code43\',
                               \'code\'   :$(\'#dtd\').val()
                            },
			function (data) {
				$(\'#dtd1\').val(data);
				aktif();
				
			}
			);

};

</script>

';
	echo '<s';
	echo 'cript>
   function get_xml(){
$.post(\'ambildata.php\',
			{   \'reqdata\'   :\'xml_rl43\',
                               \'koders\'   :$(\'#koders\').val(),
                            \'bln\'     :$(\'#bln\').val(),
							\'tahun\'     :$(\'#tahun\').val(),
						
                        },
			function (data) {
				$("#entri").show();
				$(\'#hasil\').html(data);
			}
			);

};
</script>
	
';
	echo '<s';
	echo 'cript>
function cancel(){
window.location.replace("'._BASE_.'index.php?link=RL43");
}

function aktif(){
if($(\'#dtd1\').val()=="A33"){
	document.getElementById(\'l1\').disabled=false;
		document.getElementById(\'l1\').backgroundColor=\'\';
	document.g';
	echo 'etElementById(\'l2\').disabled=false;
		document.getElementById(\'l2\').backgroundColor=\'\';		
	document.getElementById(\'l3\').disabled=true;
		document.getElementById(\'l3\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l4\').disabled=true;
		document.getElementById(\'l4\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l5\').disabled=true;
		document.getElementById(\'l5\').backgroundColor=\'';
	echo '#ccccc\';
	document.getElementById(\'l6\').disabled=true;
		document.getElementById(\'l6\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l7\').disabled=true;
		document.getElementById(\'l7\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l8\').disabled=true;
		document.getElementById(\'l8\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l9\').disabled=true;
		document.getElementById';
	echo '(\'l9\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p1\').disabled=false;
		document.getElementById(\'p1\').backgroundColor=\'\';
	document.getElementById(\'p2\').disabled=false;
		document.getElementById(\'p2\').backgroundColor=\'\';				
	document.getElementById(\'p3\').disabled=true;
		document.getElementById(\'p3\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p4\').disabled=true;
		docum';
	echo 'ent.getElementById(\'p4\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p5\').disabled=true;
		document.getElementById(\'p5\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p6\').disabled=true;
		document.getElementById(\'p6\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p7\').disabled=true;
		document.getElementById(\'p7\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p8\')';
	echo '.disabled=true;
		document.getElementById(\'p8\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p9\').disabled=true;
		document.getElementById(\'p9\').backgroundColor=\'#ccccc\';														
}
else if($(\'#dtd1\').val()=="A34-A35"){
	document.getElementById(\'l1\').disabled=true;
		document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l2\').disabled=true;
		documen';
	echo 't.getElementById(\'l2\').backgroundColor=\'#ccccc\';		
	document.getElementById(\'l3\').disabled=false;
		document.getElementById(\'l3\').backgroundColor=\'\';
	document.getElementById(\'l4\').disabled=false;
		document.getElementById(\'l4\').backgroundColor=\'\';
	document.getElementById(\'l5\').disabled=false;
		document.getElementById(\'l5\').backgroundColor=\'\';
	document.getElementById(\'l6\').disabled=false';
	echo ';
		document.getElementById(\'l6\').backgroundColor=\'\';
	document.getElementById(\'l7\').disabled=false;
		document.getElementById(\'l7\').backgroundColor=\'\';
	document.getElementById(\'l8\').disabled=false;
		document.getElementById(\'l8\').backgroundColor=\'\';
	document.getElementById(\'l9\').disabled=false;
		document.getElementById(\'l9\').backgroundColor=\'\';
	document.getElementById(\'p1\').disabled=t';
	echo 'rue;
		document.getElementById(\'p1\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p2\').disabled=true;
		document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
	document.getElementById(\'p3\').disabled=false;
		document.getElementById(\'p3\').backgroundColor=\'\';
	document.getElementById(\'p4\').disabled=false;
		document.getElementById(\'p4\').backgroundColor=\'\';
	document.getElementByI';
	echo 'd(\'p5\').disabled=false;
		document.getElementById(\'p5\').backgroundColor=\'\';
	document.getElementById(\'p6\').disabled=false;
		document.getElementById(\'p6\').backgroundColor=\'\';
	document.getElementById(\'p7\').disabled=false;
		document.getElementById(\'p7\').backgroundColor=\'\';
	document.getElementById(\'p8\').disabled=false;
		document.getElementById(\'p8\').backgroundColor=\'\';
	document.getElemen';
	echo 'tById(\'p9\').disabled=false;
		document.getElementById(\'p9\').backgroundColor=\'\';														
}
else if($(\'#dtd1\').val()=="A50"){
	document.getElementById(\'l1\').disabled=false;
		document.getElementById(\'l1\').backgroundColor=\'\';
	document.getElementById(\'l2\').disabled=false;
		document.getElementById(\'l2\').backgroundColor=\'\';		
	document.getElementById(\'l3\').disabled=false;
		document.get';
	echo 'ElementById(\'l3\').backgroundColor=\'\';
	document.getElementById(\'l4\').disabled=false;
		document.getElementById(\'l4\').backgroundColor=\'\';
	document.getElementById(\'l5\').disabled=true;
		document.getElementById(\'l5\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l6\').disabled=true;
		document.getElementById(\'l6\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l7\').disabled=true;
	';
	echo '	document.getElementById(\'l7\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l8\').disabled=true;
		document.getElementById(\'l8\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l9\').disabled=true;
		document.getElementById(\'l9\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p1\').disabled=false;
		document.getElementById(\'p1\').backgroundColor=\'\';
	document.getElementById(\'p2\'';
	echo ').disabled=false;
		document.getElementById(\'p2\').backgroundColor=\'\';				
	document.getElementById(\'p3\').disabled=false;
		document.getElementById(\'p3\').backgroundColor=\'\';
	document.getElementById(\'p4\').disabled=false;
		document.getElementById(\'p4\').backgroundColor=\'\';
	document.getElementById(\'p5\').disabled=true;
		document.getElementById(\'p5\').backgroundColor=\'#ccccc\';
	document.getEle';
	echo 'mentById(\'p6\').disabled=true;
		document.getElementById(\'p6\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p7\').disabled=true;
		document.getElementById(\'p7\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p8\').disabled=true;
		document.getElementById(\'p8\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p9\').disabled=true;
		document.getElementById(\'p9\').backgroundColor=\'#c';
	echo 'cccc\';														
}
else if($(\'#dtd1\').val()=="A52-A53"){
	document.getElementById(\'l1\').disabled=true;
		document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l2\').disabled=true;
		document.getElementById(\'l2\').backgroundColor=\'#ccccc\';		
	document.getElementById(\'l3\').disabled=true;
		document.getElementById(\'l3\').backgroundColor=\'#ccccc\';
	document.getEle';
	echo 'mentById(\'l4\').disabled=true;
		document.getElementById(\'l4\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l5\').disabled=false;
		document.getElementById(\'l5\').backgroundColor=\'\';
	document.getElementById(\'l6\').disabled=false;
		document.getElementById(\'l6\').backgroundColor=\'\';
	document.getElementById(\'l7\').disabled=false;
		document.getElementById(\'l7\').backgroundColor=\'\';
	docume';
	echo 'nt.getElementById(\'l8\').disabled=false;
		document.getElementById(\'l8\').backgroundColor=\'\';
	document.getElementById(\'l9\').disabled=false;
		document.getElementById(\'l9\').backgroundColor=\'\';
	document.getElementById(\'p1\').disabled=true;
		document.getElementById(\'p1\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p2\').disabled=true;
		document.getElementById(\'p2\').backgroundColor=\'#cc';
	echo 'ccc\';				
	document.getElementById(\'p3\').disabled=true;
		document.getElementById(\'p3\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p4\').disabled=true;
		document.getElementById(\'p4\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p5\').disabled=false;
		document.getElementById(\'p5\').backgroundColor=\'\';
	document.getElementById(\'p6\').disabled=false;
		document.getElementById(\'p';
	echo '6\').backgroundColor=\'\';
	document.getElementById(\'p7\').disabled=false;
		document.getElementById(\'p7\').backgroundColor=\'\';
	document.getElementById(\'p8\').disabled=false;
		document.getElementById(\'p8\').backgroundColor=\'\';
	document.getElementById(\'p9\').disabled=false;
		document.getElementById(\'p9\').backgroundColor=\'\';														
}
else if($(\'#dtd1\').val()=="A55-A56" && $(\'#dtd1\').val()';
	echo '=="A57-A64"){
	document.getElementById(\'l1\').disabled=true;
		document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l2\').disabled=true;
		document.getElementById(\'l2\').backgroundColor=\'#ccccc\';		
	document.getElementById(\'l3\').disabled=true;
		document.getElementById(\'l3\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l4\').disabled=false;
		document.getEle';
	echo 'mentById(\'l4\').backgroundColor=\'\';
	document.getElementById(\'l5\').disabled=false;
		document.getElementById(\'l5\').backgroundColor=\'\';
	document.getElementById(\'l6\').disabled=false;
		document.getElementById(\'l6\').backgroundColor=\'\';
	document.getElementById(\'l7\').disabled=false;
		document.getElementById(\'l7\').backgroundColor=\'\';
	document.getElementById(\'l8\').disabled=false;
		document.ge';
	echo 'tElementById(\'l8\').backgroundColor=\'\';
	document.getElementById(\'l9\').disabled=false;
		document.getElementById(\'l9\').backgroundColor=\'\';
	document.getElementById(\'p1\').disabled=true;
		document.getElementById(\'p1\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p2\').disabled=true;
		document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
	document.getElementById(\'p3\').disabled=tru';
	echo 'e;
		document.getElementById(\'p3\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p4\').disabled=false;
		document.getElementById(\'p4\').backgroundColor=\'\';
	document.getElementById(\'p5\').disabled=false;
		document.getElementById(\'p5\').backgroundColor=\'\';
	document.getElementById(\'p6\').disabled=false;
		document.getElementById(\'p6\').backgroundColor=\'\';
	document.getElementById(\'p7\').dis';
	echo 'abled=false;
		document.getElementById(\'p7\').backgroundColor=\'\';
	document.getElementById(\'p8\').disabled=false;
		document.getElementById(\'p8\').backgroundColor=\'\';
	document.getElementById(\'p9\').disabled=false;
		document.getElementById(\'p9\').backgroundColor=\'\';														
}
else if($(\'#dtd1\').val()=="C53" || $(\'#dtd1\').val()=="C54" || $(\'#dtd1\').val()=="C55" || $(\'#dtd1\').val()=="C56" |';
	echo '| $(\'#dtd1\').val()=="C58" || $(\'#dtd1\').val()=="C51-C52.C57" || $(\'#dtd1\').val()=="D06" || $(\'#dtd1\').val()=="d25" || $(\'#dtd1\').val()=="d27" || $(\'#dtd1\').val()=="N70" || $(\'#dtd1\').val()=="N72" || $(\'#dtd1\').val()=="N73" || $(\'#dtd1\').val()=="N75.0.1" || $(\'#dtd1\').val()=="N71, N74, N75.8-N77" || $(\'#dtd1\').val()=="N80" || $(\'#dtd1\').val()=="N81" || $(\'#dtd1\').val()=="N83" || $(\'#dtd1\').val()=="';
	echo 'N91.0.1.2" || $(\'#dtd1\').val()=="N92.0.1" || $(\'#dtd1\').val()=="Q50-Q52"){
	document.getElementById(\'l1\').disabled=true;
		document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l2\').disabled=true;
		document.getElementById(\'l2\').backgroundColor=\'#ccccc\';		
	document.getElementById(\'l3\').disabled=true;
		document.getElementById(\'l3\').backgroundColor=\'#ccccc\';
	doc';
	echo 'ument.getElementById(\'l4\').disabled=true;
		document.getElementById(\'l4\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l5\').disabled=true;
		document.getElementById(\'l5\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l6\').disabled=true;
		document.getElementById(\'l6\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l7\').disabled=true;
		document.getElementById(\'l7\').backgro';
	echo 'undColor=\'#ccccc\';
	document.getElementById(\'l8\').disabled=true;
		document.getElementById(\'l8\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l9\').disabled=true;
		document.getElementById(\'l9\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p1\').disabled=false;
		document.getElementById(\'p1\').backgroundColor=\'\';
	document.getElementById(\'p2\').disabled=false;
		document.getEleme';
	echo 'ntById(\'p2\').backgroundColor=\'\';				
	document.getElementById(\'p3\').disabled=false;
		document.getElementById(\'p3\').backgroundColor=\'\';
	document.getElementById(\'p4\').disabled=false;
		document.getElementById(\'p4\').backgroundColor=\'\';
	document.getElementById(\'p5\').disabled=false;
		document.getElementById(\'p5\').backgroundColor=\'\';
	document.getElementById(\'p6\').disabled=false;
		document.';
	echo 'getElementById(\'p6\').backgroundColor=\'\';
	document.getElementById(\'p7\').disabled=false;
		document.getElementById(\'p7\').backgroundColor=\'\';
	document.getElementById(\'p8\').disabled=false;
		document.getElementById(\'p8\').backgroundColor=\'\';
	document.getElementById(\'p9\').disabled=false;
		document.getElementById(\'p9\').backgroundColor=\'\';														
}
else if($(\'#dtd1\').val()=="C60" || $(\'';
	echo '#dtd1\').val()=="C61" || $(\'#dtd1\').val()=="C62" || $(\'#dtd1\').val()=="C63" || $(\'#dtd1\').val()=="N40" || $(\'#dtd1\').val()=="N41-N42" || $(\'#dtd1\').val()=="N43" || $(\'#dtd1\').val()=="N47" || $(\'#dtd1\').val()=="N44-N46, N48-N51" || $(\'#dtd1\').val()=="Q54-Q56"){
	document.getElementById(\'l1\').disabled=false;
		document.getElementById(\'l1\').backgroundColor=\'\';
	document.getElementById(\'l2\').disable';
	echo 'd=false;
		document.getElementById(\'l2\').backgroundColor=\'\';		
	document.getElementById(\'l3\').disabled=false;
		document.getElementById(\'l3\').backgroundColor=\'\';
	document.getElementById(\'l4\').disabled=false;
		document.getElementById(\'l4\').backgroundColor=\'\';
	document.getElementById(\'l5\').disabled=false;
		document.getElementById(\'l5\').backgroundColor=\'\';
	document.getElementById(\'l6\').d';
	echo 'isabled=false;
		document.getElementById(\'l6\').backgroundColor=\'\';
	document.getElementById(\'l7\').disabled=false;
		document.getElementById(\'l7\').backgroundColor=\'\';
	document.getElementById(\'l8\').disabled=false;
		document.getElementById(\'l8\').backgroundColor=\'\';
	document.getElementById(\'l9\').disabled=false;
		document.getElementById(\'l9\').backgroundColor=\'\';
	document.getElementById(\'p1';
	echo '\').disabled=true;
		document.getElementById(\'p1\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p2\').disabled=true;
		document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
	document.getElementById(\'p3\').disabled=true;
		document.getElementById(\'p3\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p4\').disabled=true;
		document.getElementById(\'p4\').backgroundColor=\'#ccccc\';
';
	echo '	document.getElementById(\'p5\').disabled=true;
		document.getElementById(\'p5\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p6\').disabled=true;
		document.getElementById(\'p6\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p7\').disabled=true;
		document.getElementById(\'p7\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p8\').disabled=true;
		document.getElementById(\'p8\').bac';
	echo 'kgroundColor=\'#ccccc\';
	document.getElementById(\'p9\').disabled=true;
		document.getElementById(\'p9\').backgroundColor=\'#ccccc\';														
}
else if($(\'#dtd1\').val()=="F53.0" || $(\'#dtd1\').val()=="O03" || $(\'#dtd1\').val()=="O04" || $(\'#dtd1\').val()=="O00" || $(\'#dtd1\').val()=="O01" || $(\'#dtd1\').val()=="O05" || $(\'#dtd1\').val()=="O02.O06-O08" || $(\'#dtd1\').val()=="O14" || $(\'#dtd1\').val()=="';
	echo 'O15" || $(\'#dtd1\').val()=="O10-O13.O16" || $(\'#dtd1\').val()=="O44" || $(\'#dtd1\').val()=="O45" || $(\'#dtd1\').val()=="O46" || $(\'#dtd1\').val()=="O30" || $(\'#dtd1\').val()=="O40" || $(\'#dtd1\').val()=="O42" || $(\'#dtd1\').val()=="O48" || $(\'#dtd1\').val()=="O31-O39, O41, 043, 047" || $(\'#dtd1\').val()=="O64-O66" || $(\'#dtd1\').val()=="O72" || $(\'#dtd1\').val()=="O24" || $(\'#dtd1\').val()=="O60" || $(\'#dtd1\')';
	echo '.val()=="O68" || $(\'#dtd1\').val()=="O84" || $(\'#dtd1\').val()=="O20-O23. 025-O29, O61-O63. O67, O69-71, O73-O75. 081-O83" || $(\'#dtd1\').val()=="080" || $(\'#dtd1\').val()=="O85-O99" || $(\'#dtd1\').val()=="Z34" || $(\'#dtd1\').val()=="Z35" || $(\'#dtd1\').val()=="Z36" || $(\'#dtd1\').val()=="Z39" || $(\'#dtd1\').val()=="O85-O99"){
	document.getElementById(\'l1\').disabled=true;
		document.getElementById(\'l1\').';
	echo 'backgroundColor=\'#ccccc\';
	document.getElementById(\'l2\').disabled=true;
		document.getElementById(\'l2\').backgroundColor=\'#ccccc\';		
	document.getElementById(\'l3\').disabled=true;
		document.getElementById(\'l3\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l4\').disabled=true;
		document.getElementById(\'l4\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l5\').disabled=true;
		docu';
	echo 'ment.getElementById(\'l5\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l6\').disabled=true;
		document.getElementById(\'l6\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l7\').disabled=true;
		document.getElementById(\'l7\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l8\').disabled=true;
		document.getElementById(\'l8\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l9\'';
	echo ').disabled=true;
		document.getElementById(\'l9\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p1\').disabled=true;
		document.getElementById(\'p1\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p2\').disabled=true;
		document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
	document.getElementById(\'p3\').disabled=true;
		document.getElementById(\'p3\').backgroundColor=\'#ccccc\';
	';
	echo 'document.getElementById(\'p4\').disabled=true;
		document.getElementById(\'p4\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p5\').disabled=false;
		document.getElementById(\'p5\').backgroundColor=\'\';
	document.getElementById(\'p6\').disabled=false;
		document.getElementById(\'p6\').backgroundColor=\'\';
	document.getElementById(\'p7\').disabled=false;
		document.getElementById(\'p7\').backgroundCol';
	echo 'or=\'\';
	document.getElementById(\'p8\').disabled=false;
		document.getElementById(\'p8\').backgroundColor=\'\';
	document.getElementById(\'p9\').disabled=false;
		document.getElementById(\'p9\').backgroundColor=\'\';														
}
else if($(\'#dtd1\').val()=="G20" || $(\'#dtd1\').val()=="Z46.3"){
	document.getElementById(\'l1\').disabled=true;
		document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
	do';
	echo 'cument.getElementById(\'l2\').disabled=true;
		document.getElementById(\'l2\').backgroundColor=\'#ccccc\';		
	document.getElementById(\'l3\').disabled=true;
		document.getElementById(\'l3\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l4\').disabled=true;
		document.getElementById(\'l4\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l5\').disabled=false;
		document.getElementById(\'l5\').bac';
	echo 'kgroundColor=\'\';
	document.getElementById(\'l6\').disabled=false;
		document.getElementById(\'l6\').backgroundColor=\'\';
	document.getElementById(\'l7\').disabled=false;
		document.getElementById(\'l7\').backgroundColor=\'\';
	document.getElementById(\'l8\').disabled=false;
		document.getElementById(\'l8\').backgroundColor=\'\';
	document.getElementById(\'l9\').disabled=false;
		document.getElementById(\'l9\')';
	echo '.backgroundColor=\'\';
	document.getElementById(\'p1\').disabled=true;
		document.getElementById(\'p1\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p2\').disabled=true;
		document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
	document.getElementById(\'p3\').disabled=true;
		document.getElementById(\'p3\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p4\').disabled=true;
		documen';
	echo 't.getElementById(\'p4\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p5\').disabled=false;
		document.getElementById(\'p5\').backgroundColor=\'\';
	document.getElementById(\'p6\').disabled=false;
		document.getElementById(\'p6\').backgroundColor=\'\';
	document.getElementById(\'p7\').disabled=false;
		document.getElementById(\'p7\').backgroundColor=\'\';
	document.getElementById(\'p8\').disabled=false;
';
	echo '
		document.getElementById(\'p8\').backgroundColor=\'\';
	document.getElementById(\'p9\').disabled=false;
		document.getElementById(\'p9\').backgroundColor=\'\';														
}
else if($(\'#dtd1\').val()=="G43-G44"){
	document.getElementById(\'l1\').disabled=true;
		document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l2\').disabled=true;
		document.getElementById(\'l2\').back';
	echo 'groundColor=\'#ccccc\';		
	document.getElementById(\'l3\').disabled=true;
		document.getElementById(\'l3\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l4\').disabled=false;
		document.getElementById(\'l4\').backgroundColor=\'\';
	document.getElementById(\'l5\').disabled=false;
		document.getElementById(\'l5\').backgroundColor=\'\';
	document.getElementById(\'l6\').disabled=false;
		document.getEleme';
	echo 'ntById(\'l6\').backgroundColor=\'\';
	document.getElementById(\'l7\').disabled=false;
		document.getElementById(\'l7\').backgroundColor=\'\';
	document.getElementById(\'l8\').disabled=false;
		document.getElementById(\'l8\').backgroundColor=\'\';
	document.getElementById(\'l9\').disabled=false;
		document.getElementById(\'l9\').backgroundColor=\'\';
	document.getElementById(\'p1\').disabled=true;
		document.getEl';
	echo 'ementById(\'p1\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p2\').disabled=true;
		document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
	document.getElementById(\'p3\').disabled=true;
		document.getElementById(\'p3\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p4\').disabled=false;
		document.getElementById(\'p4\').backgroundColor=\'\';
	document.getElementById(\'p5\').disabled=';
	echo 'false;
		document.getElementById(\'p5\').backgroundColor=\'\';
	document.getElementById(\'p6\').disabled=false;
		document.getElementById(\'p6\').backgroundColor=\'\';
	document.getElementById(\'p7\').disabled=false;
		document.getElementById(\'p7\').backgroundColor=\'\';
	document.getElementById(\'p8\').disabled=false;
		document.getElementById(\'p8\').backgroundColor=\'\';
	document.getElementById(\'p9\').disab';
	echo 'led=false;
		document.getElementById(\'p9\').backgroundColor=\'\';														
}
else if($(\'#dtd1\').val()=="K02" || $(\'#dtd1\').val()=="K00-K01" || $(\'#dtd1\').val()=="K03"){
	document.getElementById(\'l1\').disabled=true;
		document.getElementById(\'l1\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l2\').disabled=true;
		document.getElementById(\'l2\').backgroundColor=\'#ccccc\';		
	document.g';
	echo 'etElementById(\'l3\').disabled=false;
		document.getElementById(\'l3\').backgroundColor=\'\';
	document.getElementById(\'l4\').disabled=false;
		document.getElementById(\'l4\').backgroundColor=\'\';
	document.getElementById(\'l5\').disabled=false;
		document.getElementById(\'l5\').backgroundColor=\'\';
	document.getElementById(\'l6\').disabled=false;
		document.getElementById(\'l6\').backgroundColor=\'\';
	docume';
	echo 'nt.getElementById(\'l7\').disabled=false;
		document.getElementById(\'l7\').backgroundColor=\'\';
	document.getElementById(\'l8\').disabled=false;
		document.getElementById(\'l8\').backgroundColor=\'\';
	document.getElementById(\'l9\').disabled=false;
		document.getElementById(\'l9\').backgroundColor=\'\';
	document.getElementById(\'p1\').disabled=true;
		document.getElementById(\'p1\').backgroundColor=\'#ccccc\';';
	echo '
	document.getElementById(\'p2\').disabled=true;
		document.getElementById(\'p2\').backgroundColor=\'#ccccc\';				
	document.getElementById(\'p3\').disabled=false;
		document.getElementById(\'p3\').backgroundColor=\'\';
	document.getElementById(\'p4\').disabled=false;
		document.getElementById(\'p4\').backgroundColor=\'\';
	document.getElementById(\'p5\').disabled=false;
		document.getElementById(\'p5\').backgr';
	echo 'oundColor=\'\';
	document.getElementById(\'p6\').disabled=false;
		document.getElementById(\'p6\').backgroundColor=\'\';
	document.getElementById(\'p7\').disabled=false;
		document.getElementById(\'p7\').backgroundColor=\'\';
	document.getElementById(\'p8\').disabled=false;
		document.getElementById(\'p8\').backgroundColor=\'\';
	document.getElementById(\'p9\').disabled=false;
		document.getElementById(\'p9\').ba';
	echo 'ckgroundColor=\'\';														
}
if($(\'#dtd1\').val()=="P00-P04" || $(\'#dtd1\').val()=="P05-P07" || $(\'#dtd1\').val()=="P10-P15" || $(\'#dtd1\').val()=="P20-P21" || $(\'#dtd1\').val()=="P22-P28" || $(\'#dtd1\').val()=="P35-P37" || $(\'#dtd1\').val()=="P38-P39" || $(\'#dtd1\').val()=="P55" || $(\'#dtd1\').val()=="P95" || $(\'#dtd1\').val()=="P08, P29, P50-54, P56-P94, P96" || $(\'#dtd1\').val()=="R95"){
	document';
	echo '.getElementById(\'l1\').disabled=false;
		document.getElementById(\'l1\').backgroundColor=\'\';
	document.getElementById(\'l2\').disabled=false;
		document.getElementById(\'l2\').backgroundColor=\'\';		
	document.getElementById(\'l3\').disabled=false;
		document.getElementById(\'l3\').backgroundColor=\'\';
	document.getElementById(\'l4\').disabled=true;
		document.getElementById(\'l4\').backgroundColor=\'#ccccc\';';
	echo '
	document.getElementById(\'l5\').disabled=true;
		document.getElementById(\'l5\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l6\').disabled=true;
		document.getElementById(\'l6\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l7\').disabled=true;
		document.getElementById(\'l7\').backgroundColor=\'#ccccc\';
	document.getElementById(\'l8\').disabled=true;
		document.getElementById(\'l8\').b';
	echo 'ackgroundColor=\'#ccccc\';
	document.getElementById(\'l9\').disabled=true;
		document.getElementById(\'l9\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p1\').disabled=false;
		document.getElementById(\'p1\').backgroundColor=\'\';
	document.getElementById(\'p2\').disabled=false;
		document.getElementById(\'p2\').backgroundColor=\'\';				
	document.getElementById(\'p3\').disabled=false;
		document.get';
	echo 'ElementById(\'p3\').backgroundColor=\'\';
	document.getElementById(\'p4\').disabled=true;
		document.getElementById(\'p4\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p5\').disabled=true;
		document.getElementById(\'p5\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p6\').disabled=true;
		document.getElementById(\'p6\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p7\').disabled=tru';
	echo 'e;
		document.getElementById(\'p7\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p8\').disabled=true;
		document.getElementById(\'p8\').backgroundColor=\'#ccccc\';
	document.getElementById(\'p9\').disabled=true;
		document.getElementById(\'p9\').backgroundColor=\'#ccccc\';														
}
}
		function sh_menu(){
$(\'#menu\').show();
}
		</script>	
	';



	echo '<s';
	echo 'tyle>
        #tbl_rs {	width:1220px;
					
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
	
		td		{	padding:5px;}
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
    <div id="frame_title"><h3>Laporan RL 4.3</h3></div>';


echo '<div align="center">

<table width="800" height="auto" bgcolor="#FFFFFF" style="border:1px solid #eae7e7" align=\'center\' id=\'tbl_rs\'>
<tr class=\'tr_s\'><td colspan=2><table id=\'tbl_reg\' name=\'tbl_reg\'>
<tr class=\'tr_s\'><td colspan=6>';
    echo '<font color="white"><strong>Periode :</strong></font></td></tr>
<tr class=\'tr_s\'><td class=\'td_d\'>Bulan :</td><td><input type=\'hidden\' name=\'koders\' id=\'koders\' disabled value=\'';
    echo $kode_rs;
    echo '\'><input type=\'hidden\' id=\'kode\' name=\'kode\' value="';
    echo '' . $kode;
    echo '"><input type=\'hidden\' id=\'smt1\' name=\'smt1\' value="';
    echo '' . $smt;
    echo '">';
    echo '<s';
    echo 'elect id=\'bln\' name=\'bln\' onChange=\'cari()\'>
<option value=""></option>
<option value=1 ';

    if ($bln  == '1') {
        echo 'selected="selected"';
    }

    echo '>Januari</option>
<option value=2 ';

    if ($bln  == '2') {
        echo 'selected="selected"';
    }

    echo '>Februari</option>
<option value=3 ';

    if ($bln  == '3') {
        echo 'selected="selected"';
    }

    echo '>Maret</option>
<option value=4 ';

    if ($bln  == '4') {
        echo 'selected="selected"';
    }

    echo '>April</option>
<option value=5 ';

    if ($bln  == '5') {
        echo 'selected="selected"';
    }

    echo '>Mei</option>
<option value=6 ';

    if ($bln  == '6') {
        echo 'selected="selected"';
    }

    echo '>Juni</option>
<option value=7 ';

    if ($bln  == '7') {
        echo 'selected="selected"';
    }

    echo '>Juli</option>
<option value=8 ';

    if ($bln  == '8') {
        echo 'selected="selected"';
    }

    echo '>Agustus</option>
<option value=9 ';

    if ($bln  == '9') {
        echo 'selected="selected"';
    }

    echo '>September</option>
<option value=10 ';

    if ($bln  == '10') {
        echo 'selected="selected"';
    }

    echo '>Oktober</option>
<option value=11 ';

    if ($bln  == '11') {
        echo 'selected="selected"';
    }

    echo '>November</option>
<option value=12 ';

    if ($bln  == '12') {
        echo 'selected="selected"';
    }

    echo '>Desember</option>
</select>
</td>


<td class=\'td_d\'>Tahun :</td><td><input type=\'hidden\' id=\'tahun1\' name=\'tahun1\' value="';
    echo '' . $tahun;
    echo '">';
echo '<select id=\'tahun\' name=\'tahun\'  onChange=\'cari()\'>
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


<!--
<td class=\'td_d\'>Jumlah Hari 1 Periode :</td>
<td class=\'td_d\'><input type=\'text\' id=\'j_hari\' name=\'j_hari\' value="';
	echo '' . $row_x['j_hari'];
	echo '" size=3 onchange=\'hitung()\' ></td>-->
</tr>
</table>
<div id=\'entri\'>
<input type=\'button\' id=\'input\' value=\'Buat File Laporan\' onclick=\'get_xml()\'></div>
<br>
<form name=\'irna\'>
<table id=\'tbl_reg1\'>
<tr><td colspan=30>';
	echo '<s';
	echo 'trong>Data Morbiditas</strong></td></tr>
<tr><th rowspan=3 style=\'background:#39b54a;border:1px solid grey;\'>No Daftar Terperinci</th>
<th colspan=18 style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Pasien Mati Menurut Kelompok Umur dan Jenis Kelamin</th><th rowspan=2 colspan=2 style=\'background:#39b54a;border:1px solid grey;\'>Jumlah Pasien Keluar Mati Menurut Jenis</th>
<th rowspan=3 style=\'backg';
	echo 'round:#39b54a;border:1px solid grey;\'>Jumlah Pasien Keluar Mati</th>
</tr>
<tr><th style=\'background:#39b54a;border:1px solid grey;\' colspan=2>0-6hr</th><th style=\'background:#39b54a;border:1px solid grey;\' colspan=2>6-28hr</th>
<th style=\'background:#39b54a;border:1px solid grey;\' colspan=2>29hr-<1th</th><th style=\'background:#39b54a;border:1px solid grey;\'colspan=2>1th-4th</th>
<th style=\'background:#eba';
	echo '39b54a;border:1px solid grey;\' colspan=2>5-14th</th>
<th style=\'background:#39b54a;border:1px solid grey;\' colspan=2>15-24th</th><th style=\'background:#39b54a;border:1px solid grey;\' colspan=2>25-44th</th>
<th style=\'background:#39b54a;border:1px solid grey;\' colspan=2>45-64th</th><th style=\'background:#39b54a;border:1px solid grey;\' colspan=2>>=65th</th></tr>
<tr><th style=\'background:#39b54a;border:1px soli';
	echo 'd grey;\'>L</th><th style=\'background:#39b54a;border:1px solid grey;\'>P</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>L</th><th style=\'background:#39b54a;border:1px solid grey;\'>P</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>L</th><th style=\'background:#39b54a;border:1px solid grey;\'>P</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>L</th><th style=\'background:#39b54a;bor';
	echo 'der:1px solid grey;\'>P</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>L</th><th style=\'background:#39b54a;border:1px solid grey;\'>P</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>L</th><th style=\'background:#39b54a;border:1px solid grey;\'>P</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>L</th><th style=\'background:#39b54a;border:1px solid grey;\'>P</th>
<th style=\'backgrou';
	echo 'nd:#39b54a;border:1px solid grey;\'>L</th><th style=\'background:#39b54a;border:1px solid grey;\'>P</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>L</th><th style=\'background:#39b54a;border:1px solid grey;\'>P</th>
<th style=\'background:#39b54a;border:1px solid grey;\'>L</th><th style=\'background:#39b54a;border:1px solid grey;\'>P</th>

</tr>
<tr><td style=\'background:#fffff;border:1px solid grey;\'>
';
	echo '
<input type="text" id=\'dtd\' name=\'dtd\' size=30 value="';
	echo '' . $row_x['concate'];
	echo '" onkeypress=\'lst()\' onchange=\'cek()\'>
<input type="text" id=\'dtd1\' name=\'dtd1\' size=30 value="';
	echo '' . $row_x['code_list'];
	echo '" disabled >
</td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'l1\' name=\'l1\' size=2 onchange=\'hitung()\' ';

	if (1 <= $row_x[l6]) {
		echo '' . 'value=' . $row_x['l6'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'p1\' name=\'p1\' size=2 onchange=\'hitung2()\'  ';

	if (1 <= $row_x[p6]) {
		echo '' . 'value=' . $row_x['p6'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'l2\' name=\'l2\' size=2 onchange=\'hitung()\' ';

	if (1 <= $row_x[l28]) {
		echo '' . 'value=' . $row_x['l28'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'p2\' name=\'p2\' size=2 onchange=\'hitung2()\'  ';

	if (1 <= $row_x[p28]) {
		echo '' . 'value=' . $row_x['p28'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'l3\' name=\'l3\' size=2 onchange=\'hitung()\' ';

	if (1 <= $row_x[l1th]) {
		echo '' . 'value=' . $row_x['l1th'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'p3\' name=\'p3\' size=2 onchange=\'hitung2()\'  ';

	if (1 <= $row_x[p1th]) {
		echo '' . 'value=' . $row_x['p1th'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'l4\' name=\'l4\' size=2 onchange=\'hitung()\' ';

	if (1 <= $row_x[l4th]) {
		echo '' . 'value=' . $row_x['l4th'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'p4\' name=\'p4\' size=2 onchange=\'hitung2()\'  ';

	if (1 <= $row_x[p4th]) {
		echo '' . 'value=' . $row_x['p4th'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'l5\' name=\'l5\' size=2 onchange=\'hitung()\' ';

	if (1 <= $row_x[l14th]) {
		echo '' . 'value=' . $row_x['l14th'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'p5\' name=\'p5\' size=2 onchange=\'hitung2()\'  ';

	if (1 <= $row_x[p14th]) {
		echo '' . 'value=' . $row_x['p14th'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'l6\' name=\'l6\' size=2 onchange=\'hitung()\' ';

	if (1 <= $row_x[l24th]) {
		echo '' . 'value=' . $row_x['l24th'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'p6\' name=\'p6\' size=2 onchange=\'hitung2()\'  ';

	if (1 <= $row_x[p24th]) {
		echo '' . 'value=' . $row_x['p24th'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'l7\' name=\'l7\' size=2 onchange=\'hitung()\' ';

	if (1 <= $row_x[l44th]) {
		echo '' . 'value=' . $row_x['l44th'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'p7\' name=\'p7\' size=2 onchange=\'hitung2()\'  ';

	if (1 <= $row_x[p44th]) {
		echo '' . 'value=' . $row_x['p44th'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'l8\' name=\'l8\' size=2 onchange=\'hitung()\' ';

	if (1 <= $row_x[l64th]) {
		echo '' . 'value=' . $row_x['l64th'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'p8\' name=\'p8\' size=2 onchange=\'hitung2()\'  ';

	if (1 <= $row_x[p64th]) {
		echo '' . 'value=' . $row_x['p64th'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'l9\' name=\'l9\' size=2 onchange=\'hitung()\' ';

	if (1 <= $row_x[l65th]) {
		echo '' . 'value=' . $row_x['l65th'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'p9\' name=\'p9\' size=2 onchange=\'hitung2()\'  ';

	if (1 <= $row_x[p65th]) {
		echo '' . 'value=' . $row_x['p65th'];
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'t1\' name=\'t1\' size=3 disabled ';

	if (1 <= $total_l) {
		echo '' . 'value=' . $total_l;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'t2\' name=\'t2\' size=3 disabled ';

	if (1 <= $total_p) {
		echo '' . 'value=' . $total_p;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
<td style=\'background:#fffff;border:1px solid grey;font-size:12px;\'><input type=\'text\' id=\'t3\' name=\'t3\' size=3 disabled ';

	if (1 <= $total_all) {
		echo '' . 'value=' . $total_all;
	} 
else {
		echo 'value=0';
	}

	echo '></td>
</tr>
<tr><td colspan=15 align=\'center\'><input type=\'button\' id=\'simpan\' value=\'Simpan\' onclick=\'save()\'>&nbsp;&nbsp;&nbsp;<input type=\'button\' id=\'batal\' value=\'Batal\' onClick=\'cancel()\'></td></tr>
</table> </form>
</td></tr>
<tr><td colspan=2><div id=\'hasil\'></div>
</td></tr>
</table>
		</div>
		<div> ';
	include( 'footer.php' );
	echo ' 
</div>
</body>


</html>';
?>