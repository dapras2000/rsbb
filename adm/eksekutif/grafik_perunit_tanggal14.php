<?
include("phpgraphlib.php");
$graph=new PHPGraphLib(500,350);
$data = unserialize(urldecode(stripslashes($_GET['data'])));
$graph->addData($data);
//$graph->setTitle("REKAP KUNJUNGAN PASIEN RUJUKAN");
//$graph->setLegend(false);
//$graph->setLegendTitle("Dalam");
$graph->setGradient("teal", "green");
$graph->createGraph();
?>