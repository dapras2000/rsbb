<? if(!empty($_GET['lap'])) {
    $lap = $_GET['lap'];

    if($lap=="1") {

        include("filterlaporan_harian.php");

    }else if($lap=="2") {

        include("filterlaporan_bulanan.php");

    }else if($lap=="3") {

        include("filterrekap_bulanan.php");

    }else if($lap=="4") {

        include("filterrekap_triwulan.php");

    }else if($lap=="5") {

        include("filterrekap_tahunan.php");

    }else if($lap=="6") {

        include("filterbulanan_unit.php");

    }
}else {
    include("filterlaporan_harian.php");
}
?>

