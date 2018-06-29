<?php


if (!(defined("XOCP_CONFIG_INCLUDED")))
{
	define("XOCP_CONFIG_INCLUDED", TRUE);
	global $xocpConfig;
	define("XOCP_DOC_ROOT", "c:/inacbg");
	define("XOCP_SERVER_SUBDIR", "/inacbg");
	define("XOCP_SERVER", "http://localhost");
	define("XOCP_AJAX_REQUESTHANDLER", XOCP_SERVER_SUBDIR . "/ajaxreq.php");
	define("XOCP_CBG", "c:\\inacbg\\groupCBG.exe");
	$xocpConfig["db"] = array(array("host" => "localhost", "user" => "root", "password" => "CBGMASTER", "database" => "inacbg"), array("host" => "localhost", "user" => "root", "password" => "CBGMASTER", "database" => "inacbg"));
	$xocpConfig["database"] = "mysql";
	$xocpConfig["dbhost"] = "localhost";
	$xocpConfig["dbuname"] = "root";
	$xocpConfig["dbpass"] = "root";
	define("XXXDBSECRET", "CBGMASTER");
	$xocpConfig["dbname"] = "inacbg";
	define("XOCP_PREFIX", "xocp_");
	$xocpConfig["sitename"] = "Software INA-CBG's";
	$xocpConfig["slogan"] = "Indonesian CBG's";
	$xocpConfig["adminmail"] = "budi.laksono@bvk.co.id";
	$xocpConfig["language"] = "indonesian";
	define("XOCP_PORTAL_ID", 1);
	$xocpConfig["debug_mode"] = TRUE;
	$xocpConfig["default_theme"] = "plain";
	$xocpConfig["startpage"] = "guest";
	define("_GUEST_USER", "tamu");
	$xocpConfig["guestuser"] = "tamu";
	define("XOCP_ORGANIZATION_ID", 4);
	define("XOCP_VERSION", "XOCP 1.0");
	define("XOCP_URL", XOCP_SERVER . XOCP_SERVER_SUBDIR);
	define("XOCP_SESSION_SAVEPATH", XOCP_DOC_ROOT . "/cache/session");
	define("XOCP_SESSION_TMPDATA", XOCP_DOC_ROOT . "/cache/tmpdata");
	define("XOCP_PAGE_CACHEDIR", XOCP_DOC_ROOT . "/cache/pages");
	define("XOCP_TZ_INTERVAL", 7);
	$xocpConfig["db_pconnect"] = 1;
	include_once XOCP_DOC_ROOT . "/class/database/database.php";
	class Database extends DBConnection {

		public $conn = null;
		public $connector = null;

		public function Database() {

			$this->connector = array();
			return;
		}
