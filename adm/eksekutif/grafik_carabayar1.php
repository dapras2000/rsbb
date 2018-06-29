<?
include("phpgraphlib.php");
$graph=new PHPGraphLib(500,350);
$data = unserialize(urldecode(stripslashes($_GET['data'])));
$graph->addData($data);
//$graph->setTitle("REKAP CARA BAYAR PASIEN");
//$graph->setLegend(false);
//$graph->setLegendTitle("-");
$graph->setGradient("lime", "black");
$graph->createGraph();



?>
