<?
	session_start();

	define(LOG_ENABLED, 0); // Enable debuggin
	define(FILE_LOG, "/tmp/xajaxDebug.log");  // File to debug.
	define(ROWSXPAGE, 15); // Number of rows show it per page.
	define(MAXROWSXPAGE, 25);  // Total number of rows show it when click on "Show All" button.

	require_once ("include/xajax.inc.php");

	$xajax = new xajax("server.php");
	//$xajax->debugOn();
	$xajax->registerFunction("showGrid");
	$xajax->registerFunction("add");
	$xajax->registerFunction("edit");
	$xajax->registerFunction("show");
	$xajax->registerFunction("delete");
	$xajax->registerFunction("save");
	$xajax->registerFunction("update");
	$xajax->registerFunction("editField");
	$xajax->registerFunction("updateField");

?>
