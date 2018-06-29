<?php session_start();
if(!isset($_SESSION['SES_REG'])) {
    header("location:login.php");
}
include("include/connect.php");
include("include/function.php");
include('include/phpMyBorder2.class.php'); 
$pmb = new PhpMyBorder(false);

if(isset($_GET["link"])){
	$link = $_GET["link"];
}else{
	$link = "";
}
// semua komentar di hapus
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?= ucwords($rstitle)?></title>

        <link rel="stylesheet" type="text/css" href="rajal/style.css"/>
	<link rel="stylesheet" type="text/css" href="rajal/normal.css"/>
        <link href="dq_sirs.css" type="text/css" rel="stylesheet" />
        <link rel="shortcut icon" href="rsud.ico" />
        <link rel="stylesheet" type="text/css" href="include/jquery.autocomplete.css" />
        <link rel="stylesheet" href="retur-apotek/style-retur.css">
        <link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />


        <script language="javascript" type="text/javascript" src="rajal/functions.js"></script>
        <script language="javascript" type="text/javascript" src="rajal/xmlhttp.js"></script>
        <script type="text/javascript" language="javascript" src="include/ajaxrequest.js"></script>
       
        <script type="text/javascript" src="include/js.js"></script>
        <script language="javascript" src="include/cal2.js"></script>
        <script language="javascript" src="include/cal_conf2.js"></script>
        <!-- JQUERY -->
        <script src="js/jquery-1.7.min.js" language="JavaScript" type="text/javascript"></script>
        <script src="js/jquery.validate.js" language="JavaScript" type="text/javascript"></script>
        
        <script src="js/jqclock_201.js" language="JavaScript" type="text/javascript"></script>
        <script type="text/javascript">
			jQuery.noConflict();
		</script>
        <!--
        <script type="text/javascript" src="include/scripts/prototype.lite.js"></script>
		<script src="include/prototype.js" type="text/javascript"></script>
        -->
        <!--Notifikasi-->
        <!--<script src="include/jquery.js" language="JavaScript" type="text/javascript"></script>-->
        <script src="include/notification.js" language="JavaScript" type="text/javascript"></script>

        <!--autocomplete-->
        <!--<script type="text/javascript" src="include/jquery-1.2.6.pack.js"></script>-->
        <script type='text/javascript' src='include/jquery.autocomplete.pack.js'></script>
        <script type="text/javascript" src="rajal/jscripts/nicEdit.js"></script>


        <script type="text/javascript">
            bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
        </script>

        <script type="text/javascript">
            function init(){
                var stretchers = document.getElementsByClassName('box');
                var toggles = document.getElementsByClassName('tab');
                var myAccordion = new fx.Accordion(
                toggles, stretchers, {opacity: false, height: true, duration: 600}
            );
                //hash functions
                var found = false;
                toggles.each(function(h3, i){
                    var div = Element.find(h3, 'nextSibling');
                    if (window.location.href.indexOf(h3.title) > 0) {
                        myAccordion.showThisHideOpen(div);
                        found = true;
                    }
                });
                if (!found) myAccordion.showThisHideOpen(stretchers[0]);
            }


            function jumpTo (link)
            {
                var new_url=link;
                if (  (new_url != "")  &&  (new_url != null)  )
                    window.location=new_url;
            }
        </script>

        <!-- admission pasien-->
        <script type="text/javascript">
            jQuery(document).ready(function() {
                //pendaftaran
                //$("#NAMA").autocomplete("include/scripts/auto_nama.php", { width: 260, selectFirst: true });
                <!-- OK-->
                jQuery("#nomroperasi").autocomplete("operasi/nomroperasi.php",{width:260});
                <!-- VK-->
                jQuery("#icdv").autocomplete("vk/autocomplete_vk.php",{width:260});
                <!-- Rawat Inap-->
                jQuery("#namaobat1").autocomplete("ranap/auto_icd.php",{width:260});
            });
        </script>

        <!--auto refresh jumlah pasien-->
        <script type="text/javascript">
            var auto_refresh = setInterval(
            function ()
            {
                jQuery('#totalpasienhariini').load('admission/jmlpasien.php').fadeIn("slow");
            }, 5000); // refresh every 10000 milliseconds
        </script>
        <!--auto refresh jumlah pasien-->



        <script type="text/javascript">
            function enter_pressed(e){
                var keycode;
                if (window.event) keycode = window.event.keyCode;
                else if (e) keycode = e.which;
                else return false;
                return (keycode == 13);
            }

        </script>
        <script type="text/javascript" src="js/bsn.AutoSuggest_c_2.0.js"></script>
        <script>
					//					var today;
					//jQuery(document).ready(function(){
						//jQuery("#clock4").clock({"format":"24","calendar":"false"});
						//servertime = parseFloat( jQuery("#servertime").val() ) * 1000;
						//jQuery("#clockn").clock({"format":"24","calendar":"false"});
						//jQuery.data = function(success){
						//	jQuery.get("http://json-time.appspot.com/time.json?callback=?", function(response){
						//		success(new Date(response.datetime));
						//	}, "json");
						//};
					//});
					/*
					function update(){
						var start = new Date("March 25, 2011 17:00:00");
						//var today = new Date();
						jQuery.data(function(time){
							today = time;
						});
						var bla = today.getTime() - start.getTime();
						jQuery("#milliseconds").text(bla);
					}
			*/
					//setInterval("update()", 1);

		</script>
        <link rel="stylesheet" href="css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />

    </head>
    
	</HEAD>
	<!--<BODY onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">-->
    

        <?php include("notification.php"); ?>
        <div id="header">
            <div id="bg_variation">
                <div id="logo">
                </div>
                <div id="info_header">
                    <div id="info_isi">
                        <div><?=strtoupper($singrstitl)?> <?=strtoupper($singhead1)?></div>
                        <div>
                            <?php
                            if($_SESSION['SES_REG']) {
                                echo '<a href="log_out.php">Sign Out</a> | User : <span class="date">'.$_SESSION['NIP'].'</span>';
                            }else {
                                echo '<a href="login.php">Sign In</a> | guest';
                            }
                            ?>
                        </div>
                        <div class="date"><?php echo date("l, F Y"); ?></div>
                        <div class="date">
                            <?php
                            $dep  = "SELECT * FROM m_login WHERE KDUNIT = '".$_SESSION['KDUNIT']."' AND ROLES = '".$_SESSION['ROLES']."'";
                            $qe   = mysql_query($dep);
                            if($qe) {
                                $deps = mysql_fetch_assoc($qe);
                                echo "<div><b>".$deps['DEPARTEMEN']."</b></div>";
                                echo "<div style='position:absolute;'>";
                                //include("chat/chatroom.php");
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("menu.php"); ?>
        </div>
<br>

		<? include("runtext.php"); ?>
			
        <div id="container_master_bg">
            <div id="container">
                <?php include("switch.php"); ?>
            </div>
        </div>

        <div align="center" id="footer">
            <div class="left"><?=$singrstitl?> <?=strtoupper($singhead1)?> System Application Development</div>
            <div class="right"><?= ucwords($rstitle)?> &copy; <?php echo date("Y"); ?>
            <?php 
			$timestamp = time();
			echo "<input id='servertime' type='hidden' value='".$timestamp."' />";
			echo "<input id='clockn' type='hidden' />";
			?>
            </div>
        </div>
    </body>
</html>
<?php mysql_close($connect);?>

