<?
include("phpgraphlib.php");
$graph=new PHPGraphLib(500,350);
$data = unserialize(urldecode(stripslashes($_GET['data'])));
$graph->addData($data);

//$graph->setTitle("REKAP KUNJUNGAN PASIEN DATANG SENDIRI");
//$graph->setLegend(false);
//$graph->setLegendTitle("-");
$graph->setGradient("yellow", "black");
$graph->createGraph();



?>
