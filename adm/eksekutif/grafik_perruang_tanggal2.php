<?
include("phpgraphlib.php");
$graph=new PHPGraphLib(500,350);
$data = unserialize(urldecode(stripslashes($_GET['data'])));
$graph->addData($data);
$graph->setGradient("yellow", "black");
$graph->createGraph();




?>